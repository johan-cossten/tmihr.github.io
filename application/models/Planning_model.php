<?php
class Planning_model extends CI_Model
{
    var $table = 'HR_TRAIN_PLAN A ';
    var $column_order = array('A.PLN_SYS_ID', 'A.PLN_YEAR', 'A.PLN_SYS_CD', 'A.PLN_TOPIC', 'A.STATUS');
    var $column_search = array('A.PLN_SYS_ID', 'A.PLN_YEAR', 'A.PLN_SYS_CD', 'A.PLN_TOPIC', 'A.STATUS');
    var $order = array('A.PLN_SYS_ID' => 'DESC');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select($this->column_order);
        $this->db->from($this->table);
        $this->db->select("B.DEPT_SYS_ID, B.DEPT_SYS_CD, B.DEPT_NAME");
        $this->db->from("TMI.HR_DEPT B");
        $this->db->where('A.PLN_DEPT = B.DEPT_SYS_ID');
        $this->db->select("C.STATUSID, C.STATUS_NAME");
        $this->db->from("TMI.HR_STATUS C");
        $this->db->where('A.STATUS = C.STATUSID');


        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function xss_html_filter($input)
    {
        return $this->security->xss_clean(html_escape($input));
    }

    public function verify_and_save()
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));

        if ($command == 'save') {
            $init = 'PLN';
            $q1 = $this->db->query("SELECT COALESCE(MAX(PLN_SYS_ID),0) + 1 AS MAXID FROM TMI.HR_TRAIN_PLAN");
            $maxid = $q1->row()->MAXID;
            $code = $init . str_pad($maxid, 4, '0', STR_PAD_LEFT);

            $q2 = $this->db->query("INSERT INTO TMI.HR_TRAIN_PLAN (PLN_SYS_CD, PLN_YEAR, PLN_DEPT, PLN_TOPIC, PLN_PLAN_QTY, PLN_PLAN_UNIT, PLN_ST_DT, PLN_EN_DT, PLN_REMARK) 
            VALUES ('$code', '$PLN_YEAR', '$PLN_DEPT', '$PLN_TOPIC', '$PLN_PLAN_QTY', '$PLN_PLAN_UNIT', TO_DATE('$PLN_ST_DT','DD/MM/YYYY'), TO_DATE('$PLN_EN_DT','DD/MM/YYYY'), '$PLN_REMARK')");
            if ($q2) {
                $result = "success";
            } else {
                $result = "failed";
            }
        } elseif ($command == 'update') {
            $q1 = $this->db->query("UPDATE TMI.HR_TRAIN_PLAN SET PLN_YEAR = '$PLN_YEAR', PLN_DEPT = '$PLN_DEPT', PLN_TOPIC = '$PLN_TOPIC', PLN_PLAN_QTY = '$PLN_PLAN_QTY', PLN_PLAN_UNIT = '$PLN_PLAN_UNIT', PLN_ST_DT = TO_DATE('$PLN_ST_DT','DD/MM/YYYY'), PLN_EN_DT = TO_DATE('$PLN_EN_DT','DD/MM/YYYY'), PLN_REMARK = '$PLN_REMARK' WHERE PLN_SYS_ID = $q_id");

            if ($q1) {
                $result = "success";
            } else {
                $result = "failed";
            }
        }
        if ($result == "success") {
            $this->session->set_flashdata('success', 'Success, Record Saved Successfully!!');
            return "success";
        } else {
            $this->session->set_flashdata('error', 'Error, Record Saved Faileddd!!');
            return "failed";
        }
    }

    public function get_details($id, $data)
    {
        $query = $this->db->query("SELECT *
        FROM TMI.HR_TRAIN_PLAN
        WHERE UPPER(PLN_SYS_ID)=UPPER('$id')");
        if ($query->num_rows() == 0) {
            show_404();
            exit;
        } else {
            $query = $query->row();
            $data['q_id'] = $query->PLN_SYS_ID;
            $data['planning_id'] = $query->PLN_SYS_ID;
            $data['PLN_DEPT'] = $query->PLN_DEPT;
            $data['PLN_TOPIC'] = $query->PLN_TOPIC;
            $data['PLN_PLAN_QTY'] = $query->PLN_PLAN_QTY;
            $data['PLN_PLAN_UNIT'] = $query->PLN_PLAN_UNIT;
            $data['PLN_ST_DT'] = $query->PLN_ST_DT;
            $data['PLN_EN_DT'] = $query->PLN_EN_DT;
            $data['PLN_REMARK'] = $query->PLN_REMARK;
            $data['PLN_YEAR'] = $query->PLN_YEAR;

            return $data;
        }
    }

    public function delete_planning($id)
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));
        $query1 = "DELETE FROM HR_TRAIN_PLAN WHERE PLN_SYS_ID = $id";
        if ($this->db->query($query1)) {
            echo "success";
            $this->session->set_flashdata('success', 'Success!! Training Planning Deleted Succssfully!');
        } else {
            echo "failed";
        }
    }

    public function update_status($id, $status)
    {
        $query1 = "UPDATE HR_TRAIN_PLAN SET STATUS='$status' WHERE PLN_SYS_ID = $id";
        if ($this->db->simple_query($query1)) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    public function view_planning_modal($id, $status)
    {
        //$db2 = $this->load->database('tmi_ext', true);
?>
        <div class="modal fade" id="view_planning_modal">
            <form method="post" accept-charset="utf-8" id="modal_planning">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header header-custom">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title text-center">Change Status</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-info">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <input type="hidden" id="ID" value="<?php echo isset($id) ? $id : '' ?>">
                                                <label for="planning_status" class="col-sm-3 control-label">Change Status</label>
                                                <div class="col-md-6">
                                                    <select class="form-control select2" id="planning_status" name="planning_status" style="width: 100%;">
                                                        <?php
                                                        $q2 = $this->db->query("SELECT * FROM HR_STATUS WHERE STATUSID NOT IN (5,6) ");
                                                        if ($q2->num_rows() > 0) {
                                                            echo "<option value=''>-Select-</option>";
                                                            foreach ($q2->result() as $res1) {
                                                                if ((isset($status) && !empty($status)) && $status == $res1->STATUSID) {
                                                                    $selected = 'selected';
                                                                } else {
                                                                    $selected = '';
                                                                }
                                                                echo "<option $selected value='" . $res1->STATUSID . "'>" . $res1->STATUS_NAME . "</option>";
                                                            }
                                                        } else {
                                                        ?>
                                                            <option value="">No Records Found</option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Close </button>
                            <button type="button" onclick="save_planning()" class="btn btn-primary planning_save"> Save </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </form>
        </div>
        <script type="text/javascript">
            $(".select2").select2();
        </script>
<?php
    }

    public function status_planning($id, $status)
    {
        //extract($this->xss_html_filter(array_merge($this->data, $_POST, $_GET)));
        $q1 = $this->db->query("UPDATE HR_TRAIN_PLAN SET STATUS = $status WHERE PLN_SYS_ID = $id");
        if ($q1) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
