<?php
class Evaluation_model extends CI_Model
{
    var $table = 'HR_EVALUATION A ';
    var $column_order = array('A.SYS_EVA_ID', 'A.SYS_EVA_DT', 'A.SYS_EVA_CODE', 'A.PLN_SYS_ID', 'A.EMP_CODE', 'A.EMP_NAME', 'EMP_DEPT', 'A.STATUS');
    var $column_search = array('A.SYS_EVA_ID', 'A.SYS_EVA_DT', 'A.SYS_EVA_CODE', 'A.PLN_SYS_ID', 'A.EMP_CODE', 'A.EMP_NAME', 'EMP_DEPT', 'A.STATUS');
    var $order = array('A.SYS_EVA_DT' => 'ASC');

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('tmi_ext', true);
    }

    private function _get_datatables_query()
    {
        $DB = $this->db;
        $dept_id = $this->session->userdata('dept_id');
        $role_id = $this->session->userdata('role_id');

        $DB->select($this->column_order);
        $DB->from($this->table);

        $DB->select("C.STATUSID, C.STATUS_NAME");
        $DB->from("TMI.HR_STATUS C");
        $DB->where('A.STATUS = C.STATUSID');

        $DB->select("B.PLN_TOPIC, B.PLN_DEPT, B.PLN_YEAR");
        $DB->from("TMI.HR_TRAIN_PLAN B");

        if ($role_id == 1 || $role_id == 141) {
            $DB->where('A.PLN_SYS_ID = B.PLN_SYS_ID');
        } else {
            $r1 = $this->db->query("SELECT * FROM HR_DEPT WHERE DEPT_SYS_ID = " . $dept_id);
            $dep_name = $r1->row()->DEPT_NAME;
            $DB->where("A.PLN_SYS_ID = B.PLN_SYS_ID AND EMP_DEPT = '$dep_name'");
        }


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

    public function getData()
    {
        $q1 = $this->db->query("SELECT * FROM TMI.HR_EVALUATION A INNER JOIN TMI.HR_TRAIN_PLAN B ON A.PLN_SYS_ID = B.PLN_SYS_ID");
        return $q1->result_array();
    }

    public function xss_html_filter($input)
    {
        return $this->security->xss_clean(html_escape($input));
    }

    public function gettopic()
    {
        extract($this->xss_html_filter(array_merge($this->data, $_POST, $_GET)));
        $q1 = $this->db2->query("SELECT DISTINCT OVT_DEPT_EMP FROM OVT_OM_EMPLOYEES WHERE OVT_BADGED = $employee");
        $r1 = $q1->row();
        $dept = $r1->OVT_DEPT_EMP;

        $q2 = $this->db->query("SELECT A.PLN_SYS_ID, A.PLN_TOPIC, A.PLN_YEAR FROM TMI.HR_TRAIN_PLAN A
		INNER JOIN TMI.HR_TRAINING_RCD B ON A.PLN_SYS_ID = B.PLN_SYS_ID
		INNER JOIN TMI.HR_DEPT C ON A.PLN_DEPT = C.DEPT_SYS_ID
		WHERE C.DEPT_SYS_CD = '$dept' GROUP BY A.PLN_SYS_ID, A.PLN_TOPIC, A.PLN_YEAR ORDER BY A.PLN_YEAR DESC");
        if ($q1->num_rows() > 0) {
            echo "<option value=''>-Select-</option>";
            foreach ($q2->result() as $res1) {
                echo "<option value='" . $res1->PLN_SYS_ID . "'>" . $res1->PLN_TOPIC . ' - ' . $res1->PLN_YEAR . "</option>";
            }
        } else {
            echo "<option value=''>No Records Found</option>";
        }
    }

    public function get_duration()
    {
        extract($this->xss_html_filter(array_merge($this->data, $_POST, $_GET)));
        $display_json = array();
        $pln_topic = $pln_topic;

        $q1 = $this->db->query("SELECT B.TR_DUR, B.TR_DUR_UNIT, COALESCE(B.TR_ST_DT, TRUNC(CURRENT_DATE)) AS TR_ST_DT, COALESCE(B.TR_END_DT , TRUNC(CURRENT_DATE)) AS TR_END_DT
        FROM TMI.HR_TRAIN_PLAN A
		INNER JOIN TMI.HR_TRAINING_RCD B ON A.PLN_SYS_ID = B.PLN_SYS_ID WHERE A.PLN_SYS_ID = $pln_topic");
        $res = $q1->row();

        $tr_end_dt = $res->TR_END_DT;
        $str_tr_end_dt = strtotime($tr_end_dt);
        $dt_7 = date("d-m-Y", strtotime('+7 day', $str_tr_end_dt));

        function randomdate($st_dt, $ed_dt)
        {
            $min = strtotime($st_dt);
            $max = strtotime($ed_dt);
            $random = rand($min, $max);
            $rd_dt = date('d-m-Y', $random);
            return $rd_dt;
        }

        $st_dt = date('d-m-Y', strtotime($res->TR_ST_DT . '+76 days'));
        $ed_dt = date('d-m-Y', strtotime($res->TR_END_DT . '+3 month'));
        $randomdate = randomdate($st_dt, $ed_dt);
        $json_arr["PLAN_QTY"] = $res->TR_DUR;
        $json_arr["PLAN_UNIT"] = $res->TR_DUR_UNIT;
        $json_arr["PLN_ST_DT"] = date("d-m-Y", strtotime($res->TR_ST_DT));
        $json_arr["PLN_EN_DT"] = date("d-m-Y", strtotime($res->TR_END_DT));
        $json_arr["date7"] = $dt_7;
        $json_arr["date_month"] = $randomdate;
        array_push($display_json, $json_arr);
        echo json_encode($display_json);
        exit;
    }

    public function verify_and_save()
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));

        if ($command == 'save') {
            $init = 'EV';
            $q1 = $this->db->query("SELECT COALESCE(MAX(SYS_EVA_ID),0) + 1 AS MAXID FROM TMI.HR_EVALUATION");
            $maxid = $q1->row()->MAXID;
            $code = $init . str_pad($maxid, 4, '0', STR_PAD_LEFT);

            $q1 = $this->db2->query("SELECT * FROM OVT_OM_EMPLOYEES WHERE OVT_BADGED = $EMP_CODE");
            $r1 = $q1->row();
            $EMP_NAME = $r1->OVT_NAME_EMP;
            $EMP_DEPT = $r1->OVT_DEPT_EMP;
            $EMP_CODE = $r1->OVT_BADGED;
            $EMP_POSITION = $r1->OVT_POSITION;
            $evaluation_entry = array(
                'SYS_EVA_CODE'    => $code,
                'EMP_CODE'        => $EMP_CODE,
                'EMP_NAME'        => $EMP_NAME,
                'EMP_DEPT'        => $EMP_DEPT,
                'EMP_POSITION'    => $EMP_POSITION,
                'PLN_SYS_ID'      => $PLN_SYS_ID,
                'CONDUCTED'       => $CONDUCTED,
                'COST_EVA'        => $COST_EVA,
                'FIELDCHECK1'     => $FIELDCHECK1,
                'FIELDTEXT1'      => $FIELDTEXT1,
                'FIELDCHECK2'     => $FIELDCHECK2,
                'FIELDTEXT2'      => $FIELDTEXT2
            );

            $q2 = $this->db->insert("TMI.HR_EVALUATION", $evaluation_entry);
            if ($q2) {
                $result = "success";
            } else {
                $result = "failed";
            }
        } elseif ($command == 'update') {
            $evaluation_entry = array(
                'PLN_SYS_ID'      => $PLN_SYS_ID,
                'CONDUCTED'       => $CONDUCTED,
                'COST_EVA'        => $COST_EVA,
                'FIELDCHECK1'     => $FIELDCHECK1,
                'FIELDTEXT1'      => $FIELDTEXT1,
                'FIELDCHECK2'     => $FIELDCHECK2,
                'FIELDTEXT2'      => $FIELDTEXT2
            );
            $q1 = $this->db->where('SYS_EVA_ID', $q_id)->update('TMI.HR_EVALUATION', $evaluation_entry);
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
        $query = $this->db->query("SELECT A.SYS_EVA_ID, A.PLN_SYS_ID, A.EMP_CODE, A.EMP_NAME, A.CONDUCTED, A.COST_EVA, A.FIELDCHECK1, A.FIELDTEXT1, A.FIELDCHECK2, A.FIELDTEXT2, B.PLN_PLAN_QTY, B.PLN_PLAN_UNIT
        FROM TMI.HR_EVALUATION A 
        INNER JOIN TMI.HR_TRAIN_PLAN B ON A.PLN_SYS_ID = B.PLN_SYS_ID
        WHERE UPPER(SYS_EVA_ID)=UPPER('$id')");
        if ($query->num_rows() == 0) {
            show_404();
            exit;
        } else {
            $query = $query->row();
            $data['q_id'] = $query->SYS_EVA_ID;
            $data['evaluation_id'] = $query->SYS_EVA_ID;
            $data['EMP_CODE'] = $query->EMP_CODE;
            $data['EMP_NAME'] = $query->EMP_NAME;
            $data['PLN_SYS_ID'] = $query->PLN_SYS_ID;
            $data['CONDUCTED'] = $query->CONDUCTED;
            $data['COST_EVA'] = $query->COST_EVA;
            $data['FIELDCHECK1'] = $query->FIELDCHECK1;
            $data['FIELDTEXT1'] = $query->FIELDTEXT1;
            $data['FIELDCHECK2'] = $query->FIELDCHECK2;
            $data['FIELDTEXT2'] = $query->FIELDTEXT2;

            $data['PLN_PLAN_QTY'] = $query->PLN_PLAN_QTY;
            $data['PLN_PLAN_UNIT'] = $query->PLN_PLAN_UNIT;

            return $data;
        }
    }

    public function get_preview($id, $data)
    {
        $display_json = array();
        $query = $this->db->query("SELECT A.SYS_EVA_ID, A.PLN_SYS_ID, A.EMP_CODE, A.EMP_NAME, A.CONDUCTED, A.COST_EVA, A.FIELDCHECK1, A.FIELDTEXT1, A.FIELDCHECK2, A.FIELDTEXT2, B.PLN_PLAN_QTY, B.PLN_PLAN_UNIT, B.PLN_TOPIC, A.EMP_DEPT, B.PLN_ST_DT, B.PLN_EN_DT
        FROM TMI.HR_EVALUATION A 
        INNER JOIN TMI.HR_TRAIN_PLAN B ON A.PLN_SYS_ID = B.PLN_SYS_ID
        WHERE UPPER(SYS_EVA_ID)=UPPER('$id')");
        if ($query->num_rows() == 0) {
            show_404();
            exit;
        } else {
            $query = $query->row();
            $data['q_id'] = $query->SYS_EVA_ID;
            $data['evaluation_id'] = $query->SYS_EVA_ID;
            $data['EMP_CODE'] = $query->EMP_CODE;
            $data['EMP_NAME'] = $query->EMP_NAME;
            $data['EMP_DEPT'] = $query->EMP_DEPT;
            $data['PLN_SYS_ID'] = $query->PLN_SYS_ID;
            $data['PLN_TOPIC'] = $query->PLN_TOPIC;
            $data['CONDUCTED'] = $query->CONDUCTED;
            $data['COST_EVA'] = $query->COST_EVA;
            $data['FIELDCHECK1'] = $query->FIELDCHECK1;
            $data['FIELDTEXT1'] = $query->FIELDTEXT1;
            $data['FIELDCHECK2'] = $query->FIELDCHECK2;
            $data['FIELDTEXT2'] = $query->FIELDTEXT2;

            $data['PLN_ST_DT'] = $query->PLN_ST_DT;
            $data['PLN_EN_DT'] = $query->PLN_EN_DT;

            // $data['PLN_PLAN_QTY'] = $query->PLN_PLAN_QTY;
            // $data['PLN_PLAN_UNIT'] = $query->PLN_PLAN_UNIT;

            $data['PLN_PLAN_QTY'] = $query->PLN_PLAN_QTY;
            $data['PLN_PLAN_UNIT'] = $query->PLN_PLAN_UNIT;

            $dt_7 = date("d-m-Y", strtotime('+7 day', strtotime($query->PLN_EN_DT)));
            $data["date7"] = $dt_7;


            return $data;
        }
    }

    public function delete_evaluation($id)
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));
        $query1 = "DELETE FROM HR_EVALUATION WHERE SYS_EVA_ID = $id";
        if ($this->db->query($query1)) {
            echo "success";
            $this->session->set_flashdata('success', 'Success!! Training Evaluation Deleted Succssfully!');
        } else {
            echo "failed";
        }
    }

    public function update_status($id, $status)
    {
        $query1 = "UPDATE HR_EVALUATION SET STATUS='$status' WHERE SYS_EVA_ID = $id";
        if ($this->db->simple_query($query1)) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    public function view_evaluation_modal($id, $status)
    {
        //$db2 = $this->load->database('tmi_ext', true);
?>
        <div class="modal fade" id="view_evaluation_modal">
            <form method="post" accept-charset="utf-8" id="modal_evaluation">
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
                                                <label for="evaluation_status" class="col-sm-3 control-label">Change Status</label>
                                                <div class="col-md-6">
                                                    <select class="form-control select2" id="evaluation_status" name="evaluation_status" style="width: 100%;">
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
                            <button type="button" onclick="save_evaluation()" class="btn btn-primary evaluation_save"> Save </button>
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

    public function status_evaluation($id, $status)
    {
        //extract($this->xss_html_filter(array_merge($this->data, $_POST, $_GET)));
        $q1 = $this->db->query("UPDATE HR_EVALUATION SET STATUS = $status WHERE SYS_EVA_ID = $id");
        if ($q1) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
