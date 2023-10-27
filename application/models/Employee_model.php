<?php
class Employee_model extends CI_Model
{
    var $table = 'TMIEXT.OVT_OM_EMPLOYEES';
    var $column_order = array("OVT_BADGED", "OVT_NAME_EMP", "OVT_DEPT_EMP", "OVT_POSITION", "OVT_CODE");
    var $column_search = array("OVT_BADGED", "OVT_NAME_EMP", "OVT_DEPT_EMP", "OVT_POSITION", "OVT_CODE");
    var $order = array('OVT_CODE' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('tmi_ext', true);
    }

    private function _get_datatables_query()
    {

        $dept_id = $this->session->userdata('dept_id');
        $role_id = $this->session->userdata('role_id');

        $this->db2->select($this->column_order);
        $this->db2->from($this->table);
        if ($role_id == 1 || $role_id == 141) {
            $this->db2->where("SUBSTR(OVT_BADGED, 1, 1) IN (0,1,2,3,9)");
        } else {
            $r1 = $this->db2->query("SELECT * FROM HR_DEPT WHERE DEPT_SYS_ID = " . $dept_id);
            $dep_name = $r1->row()->DEPT_NAME;
            $this->db2->where("SUBSTR(OVT_BADGED, 1, 1) IN (0,1,2,3,9) AND OVT_DEPT_EMP='$dep_name' AND OVT_CODE IS NULL ");
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db2->group_start();
                    $this->db2->like($item, $_POST['search']['value']);
                } else {
                    $this->db2->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db2->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $order = $this->column_order;
            $this->db2->order_by($order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db2->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db2->limit($_POST['length'], $_POST['start']);
        $query = $this->db2->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db2->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db2->from($this->table);
        return $this->db2->count_all_results();
    }

    public function xss_html_filter($input)
    {
        return $this->security->xss_clean(html_escape($input));
    }

    public function view_transfer_modal($id)
    {
        //$db2 = $this->load->database('tmi_ext', true);
?>
        <div class="modal fade" id="view_transfer_modal">
            <form method="post" accept-charset="utf-8" id="modal_transfer">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header header-custom">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title text-center">Transfer Training</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-info">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="employee_old" class="col-sm-3 control-label">Old Number Employee</label>
                                                <div class="col-md-6">
                                                    <select class="form-control select2" id="employee_old" name="employee_old" style="width: 100%;">
                                                        <?php
                                                        $q2 = $this->db2->select("*")->get("TMIEXT.OVT_OM_EMPLOYEES");
                                                        if ($q2->num_rows() > 0) {
                                                            echo "<option value=''>-Select-</option>";
                                                            foreach ($q2->result() as $res1) {
                                                                echo "<option value='" . $res1->OVT_BADGED . "'>" . $res1->OVT_NAME_EMP . ' - ' . $res1->OVT_BADGED . "</option>";
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
                                            <br>
                                            <br>
                                            <div class="form-group">
                                                <label for="employee_new" class="col-sm-3 control-label">New Number Employee</label>
                                                <div class="col-md-6">
                                                    <select class="form-control select2" id="employee_new" name="employee_new" style="width: 100%;" disabled>
                                                        <?php
                                                        $q3 = $this->db2->select("*")->where("OVT_BADGED", $id)->get("TMIEXT.OVT_OM_EMPLOYEES");
                                                        if ($q3->num_rows() > 0) {
                                                            echo "<option value=''>-Select-</option>";
                                                            foreach ($q3->result() as $res2) {

                                                                echo "<option selected value='" . $res2->OVT_BADGED . "'>" . $res2->OVT_NAME_EMP . ' - ' . $res2->OVT_BADGED . "</option>";
                                                            }
                                                        } else { ?>
                                                            <option value="">No Records Found</option>
                                                        <?php } ?>
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
                            <button type="button" onclick="save_transfer()" class="btn btn-primary training_save"> Transfer </button>
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

    public function view_evaluation_modal($id)
    {
        //$db2 = $this->load->database('tmi_ext', true);
        $q = $this->db2->query("SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_BADGED = $id");
        $res = $q->row();
        $emp_no = $res->OVT_BADGED;
        $emp_name = $res->OVT_NAME_EMP;
        $emp_dept = $res->OVT_DEPT_EMP;
        $emp_position = $res->OVT_POSITION;
    ?>
        <div class="modal fade" id="view_evaluation_modal">
            <form method="post" accept-charset="utf-8" id="modal_evaluation">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header header-custom">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title text-center">Training Evaluation</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url() ?>" />
                                            <input type="hidden" id="employee_id" name="employee_id" value="<?php echo $emp_no ?>" />
                                            <input type="hidden" id="employee_name" name="employee_name" value="<?php echo $emp_name ?>" />
                                            <input type="hidden" id="department" name="department" value="<?php echo $emp_dept ?>" />
                                            <input type="hidden" id="qty" name="qty" value="<?php echo $emp_dept ?>" />
                                            <input type="hidden" id="unit" name="unit" value="<?php echo $emp_dept ?>" />
                                            <label for="employee" class="col-sm-2 control-label">Employee Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="employee" name="employee" placeholder="" value="<?php echo $emp_name ?>" readonly />
                                            </div>
                                            <label for="dept" class="col-sm-2 control-label">Department</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="dept" name="dept" placeholder="" value="<?php echo $emp_dept ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="topic_id" class="col-sm-2 control-label">Training Topic<label class="text-danger">*</label></label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" id="topic_id" name="topic_id" style="width: 100%;" onchange="updateduration()">
                                                    <?php
                                                    $q2 = $this->db->query("SELECT * FROM TMI.HR_TRAIN_PLAN A INNER JOIN HR_DEPT B ON A.PLN_DEPT = B.DEPT_SYS_ID WHERE B.DEPT_SYS_CD = '$emp_dept'");
                                                    if ($q2->num_rows() > 0) {
                                                        echo "<option selected value=''>-Select-</option>";
                                                        foreach ($q2->result() as $res) {
                                                            echo "<option value='" . $res->PLN_SYS_ID . "'>" . $res->PLN_TOPIC . "</option>";
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
                                <div class="col-md-12">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="conducted" class="col-sm-2 control-label">Conducted by</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="conducted" name="conducted" placeholder="" />
                                            </div>
                                            <label for="cost_con" class="col-sm-2 control-label">Cost (if any)</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="cost_con" name="cost_con" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="duration" class="col-sm-2 control-label">Duration</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="duration" name="duration" placeholder="" disabled />
                                            </div>
                                            <label for="duration_unit" class="col-sm-2 control-label">Duration Unit</label>
                                            <div class="col-sm-4">
                                                <select class="form-control select2" id="duration_unit" name="duration_unit" style="width: 100%;" disabled>
                                                    <option selected disabled></option>
                                                    <?php
                                                    $unit = oci_parse($this->conn, "SELECT * FROM TMI.HR_TR_UNIT_DR");
                                                    oci_execute($unit);
                                                    while ($row = oci_fetch_array($unit)) :
                                                    ?>
                                                        <option value="<?php echo $row['CODE'] ?>"><?php echo $row['CODE'] ?></option>
                                                    <?php endwhile; ?>

                                                    <?php
                                                    $q3 = $this->db->query("SELECT * FROM TMI.HR_TR_UNIT_DR");
                                                    if ($q3->num_rows() > 0) {
                                                        echo "<option value=''>-Select-</option>";
                                                        foreach ($q3->result() as $res1) {
                                                            echo "<option selected value='" . $res1->CODE . "'>" . $res1->CODE . "</option>";
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
                                <div class="col-md-12">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="from_dt" class="col-sm-2 control-label">From</label>
                                            <div class="col-sm-4">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker" id="from_dt" name="from_dt" value="<?php date('d-m-Y') ?>" readonly>
                                                </div>
                                            </div>
                                            <label for="to_dt" class="col-sm-2 control-label">To</label>
                                            <div class="col-sm-4">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker" id="to_dt" name="to_dt" value="<?php date('d-m-Y') ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Close </button>
                            <button type="button" class="btn btn-primary" id="btn_show" name="btn_show" onclick="show_eval()"> Show </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </form>
        </div>
        <script type="text/javascript">
            $(".select2").select2();
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy',
                todayHighlight: true
            });
        </script>
<?php
    }

    public function save_transfer()
    {
        extract($this->xss_html_filter(array_merge($this->data, $_POST, $_GET)));

        $q1 = $this->db->query("SELECT * FROM TMI.HR_TRAINING_RCD WHERE EMPLOYEE LIKE '%$employee_old%'");
        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $res) {
                $init = 'TR';
                $q2 = $this->db->query("SELECT COALESCE(MAX(TR_SYS_ID),0)+1 AS MAXID FROM TMI.HR_TRAINING_RCD");
                $maxid = $q2->row()->MAXID;
                $tr_code = $init . str_pad($maxid, 4, '0', STR_PAD_LEFT);
                $training_entry = array(
                    'TR_SYS_CODE'       => $tr_code,
                    'EMPLOYEE'          => $employee_new,
                    'PLN_SYS_ID'        => $res->PLN_SYS_ID,
                    'TR_DUR'            => $res->TR_DUR,
                    'TR_DUR_UNIT'       => $res->TR_DUR_UNIT,
                    'TR_ST_DT'          => $res->TR_ST_DT,
                    'TR_END_DT'         => $res->TR_END_DT,
                    'TR_INSTITUTION'    => $res->TR_INSTITUTION,
                    'REMARKS'           => $res->REMARKS,
                );
                $insert = $this->db->insert('TMI.HR_TRAINING_RCD', $training_entry);
            }
        }
        return "success";
    }

    public function get_duration()
    {
        extract($this->xss_html_filter(array_merge($this->data, $_POST, $_GET)));
        $display_json = array();
        $pln_topic = $pln_topic;

        $q1 = $this->db->query("SELECT B.TR_DUR, B.TR_DUR_UNIT, B.TR_ST_DT, B.TR_END_DT  FROM TMI.HR_TRAIN_PLAN A
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

    public function preview_evaluation()
    {
        extract($this->xss_html_filter(array_merge($this->data, $_POST, $_GET)));
        $q1 = $this->db->query("SELECT * FROM TMI.HR_TRAIN_PLAN WHERE PLN_SYS_ID = $topic");
        $res = $q1->row();
        $topic_code = $res->PLN_TOPIC;
        $data['topiccd'] = $topic_code;
        return $data;
    }
}
