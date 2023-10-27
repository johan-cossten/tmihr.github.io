<?php
class Training_model extends CI_Model
{
    var $table = 'HR_TRAINING_RCD A';
    var $column_order = array('A.TR_SYS_ID', 'A.TR_SYS_CODE', 'EMPLOYEE', 'A.PLN_SYS_ID', 'A.TR_DUR', 'A.TR_DUR_UNIT', 'A.TR_ST_DT', 'A.TR_END_DT', 'A.TR_INSTITUTION', 'A.REMARKS', 'A.STATUS');
    var $column_search = array('A.TR_SYS_ID', 'A.TR_SYS_CODE', 'EMPLOYEE', 'A.PLN_SYS_ID', 'A.TR_DUR', 'A.TR_DUR_UNIT', 'A.TR_ST_DT', 'A.TR_END_DT', 'A.TR_INSTITUTION', 'A.REMARKS', 'A.STATUS');
    var $order = array('A.TR_SYS_ID' => 'DESC');

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('tmi_ext', true);
    }

    private function _get_datatables_query()
    {
        $DB = $this->db;
        $DB->select($this->column_order);
        $DB->from($this->table);
        $DB->select("B.PLN_TOPIC, B.PLN_DEPT, B.PLN_YEAR");
        $DB->from("TMI.HR_TRAIN_PLAN B");
        $DB->where('A.PLN_SYS_ID = B.PLN_SYS_ID');
        $DB->select("C.DEPT_SYS_ID, C.DEPT_SYS_CD, C.DEPT_NAME");
        $DB->from("TMI.HR_DEPT C");
        $DB->where('B.PLN_DEPT = C.DEPT_SYS_ID');
        $DB->select("C.STATUSID, C.STATUS_NAME");
        $DB->from("TMI.HR_STATUS C");
        $DB->where('A.STATUS = C.STATUSID');


        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $DB->group_start();
                    $DB->like($item, $_POST['search']['value']);
                } else {
                    $DB->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $DB->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $DB->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $DB->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $DB = $this->db;
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $DB->limit($_POST['length'], $_POST['start']);
        $query = $DB->get();
        return $query->result();
    }

    function count_filtered()
    {
        $DB = $this->db;
        $this->_get_datatables_query();
        $query = $DB->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $DB = $this->db;
        $DB->from($this->table);
        return $DB->count_all_results();
    }

    public function xss_html_filter($input)
    {
        return $this->security->xss_clean(html_escape($input));
    }

    public function employee_name($id)
    {
        $db2 = $this->load->database('tmi_ext', true);
        $q2 = "SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE SUBSTR(OVT_BADGED, 1, 1) IN (0,1,2,3,9) AND OVT_BADGED IN ('$id')";
        $res = $db2->query($q2)->row();
        $data = $res->OVT_NAME_EMP;
        return $data;
    }

    public function verify_and_save()
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));
        $EMPLOYEE_ID = implode(",", $EMPLOYEE);
        if ($command == 'save') {
            $init = 'TR';
            $q1 = $this->db->query("SELECT COALESCE(MAX(TR_SYS_ID),0) + 1 AS MAXID FROM TMI.HR_TRAINING_RCD");
            $maxid = $q1->row()->MAXID;
            $code = $init . str_pad($maxid, 4, '0', STR_PAD_LEFT);

            $q2 = $this->db->query("INSERT INTO TMI.HR_TRAINING_RCD (TR_SYS_CODE, EMPLOYEE, PLN_SYS_ID, TR_DUR, TR_DUR_UNIT, TR_ST_DT, TR_END_DT, TR_INSTITUTION, REMARKS) VALUES ('$code', '$EMPLOYEE_ID', $PLN_SYS_ID, '$TR_DUR', '$TR_DUR_UNIT', TO_DATE('$TR_ST_DT', 'dd/mm/yyyy'), TO_DATE('$TR_END_DT', 'dd/mm/yyyy'), '$TR_INSTITUTION', '$REMARKS')");
            if ($q2) {
                return "success";
            } else {
                return "failed";
            }
        } elseif ($command == 'update') {
            $q3 = $this->db->query("UPDATE TMI.HR_TRAINING_RCD SET EMPLOYEE = '$EMPLOYEE_ID', PLN_SYS_ID = $PLN_SYS_ID, TR_DUR = '$TR_DUR', TR_DUR_UNIT = '$TR_DUR_UNIT', TR_ST_DT = TO_DATE('$TR_ST_DT', 'dd/mm/yyyy'), TR_END_DT = TO_DATE('$TR_END_DT', 'dd/mm/yyyy'), TR_INSTITUTION = '$TR_INSTITUTION', REMARKS = '$REMARKS' WHERE TR_SYS_ID = $q_id");
            if ($q3) {
                return "success";
            } else {
                return "failed";
            }
        }
        $this->session->set_flashdata('success', 'Success, Record Saved Successfully!!');
        return "success<<<###>>>$assessment_id";
    }

    public function get_details($id, $data)
    {
        $emp = array();
        $query = $this->db->query("SELECT * FROM HR_TRAINING_RCD WHERE UPPER(TR_SYS_ID)=UPPER('$id')");
        if ($query->num_rows() == 0) {
            show_404();
            exit;
        } else {
            $query = $query->row();
            $emp = $query->EMPLOYEE;
            $data['q_id'] = $query->TR_SYS_ID;
            $data['training_id'] = $query->TR_SYS_ID;
            $data['TR_SYS_CODE'] = $query->TR_SYS_CODE;
            $data['EMPLOYEE'] = $emp;
            $data['PLN_SYS_ID'] = $query->PLN_SYS_ID;
            $data['TR_DUR'] = $query->TR_DUR;
            $data['TR_DUR_UNIT'] = $query->TR_DUR_UNIT;
            $data['TR_ST_DT'] = $query->TR_ST_DT;
            $data['TR_END_DT'] = $query->TR_END_DT;
            $data['TR_INSTITUTION'] = $query->TR_INSTITUTION;
            $data['REMARKS'] = $query->REMARKS;

            return $data;
        }
    }

    public function delete_training($id)
    {
        $this->db->trans_begin();
        $query1 = "DELETE FROM HR_TRAINING_RCD WHERE TR_SYS_ID = $id";
        if ($this->db->simple_query($query1)) {
            echo "success";
            $this->session->set_flashdata('success', 'Success!! Training Deleted Succssfully!');
        } else {
            echo "failed";
        }
    }

    public function get_data_preview($id)
    {
        $this->db2 = $this->load->database('tmi_ext', true);
        $q1 = $this->db->query("SELECT * FROM TMI.HR_TRAINING_RCD WHERE TR_SYS_ID = $id");
        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $res) {
                $q2 = $this->db2->query("SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_BADGED = '$res->EMPLOYEE'");
                $r1 = $q2->row();
                $data['employee'] = $r1->OVT_NAME_EMP;
                $data['employee_code'] = $r1->OVT_BADGED;
                $data['ovt_group'] = $r1->OVT_GROUP;
                $data['department'] = $r1->OVT_DEPT_EMP;
                $data['position'] = $r1->OVT_POSITION;
                $data['joined'] = $r1->OVT_JOIN_DATE;
                $data['DATEPERIODFR'] = $res->DATEPERIODFR;
                $data['DATEPERIODTO'] = $res->DATEPERIODTO;
                $data['PURPOSE'] = $res->PURPOSE;
                $data['contract'] = $res->ATT_UNPAID;
                $data['contract'] = $res->ATT_MEDICAL;
                $data['contract'] = $res->ATT_ABSENT;
                $data['contract'] = $res->WL3_MONTH;
                $data['contract'] = $res->WL3_MONTH_1;
                $data['contract'] = $res->WL6_MONTH;
                $data['contract'] = $res->WL6_MONTH_1;
                $data['contract'] = $res->WL12_MONTH;
                $data['contract'] = $res->WL12_MONTH_1;
                $data['contract'] = $res->WL_JOIN;
                $data['contract'] = $res->WL_JOIN_1;
                $data['contract'] = $res->REASON_ACCOUN;

                if ($res->ATT_UNPAID == 1 || $res->ATT_UNPAID == 2) {
                    $POINTS_UNPAID = '-0.1';
                } elseif ($res->ATT_UNPAID == 3 || $res->ATT_UNPAID == 4 || $res->ATT_UNPAID == 5) {
                    $POINTS_UNPAID = '-0.2';
                } elseif ($res->ATT_UNPAID == 6 || $res->ATT_UNPAID == 7 || $res->ATT_UNPAID == 8 || $res->ATT_UNPAID == 9 || $res->ATT_UNPAID == 10) {
                    $POINTS_UNPAID = '-0.3';
                } elseif ($res->ATT_UNPAID > 10) {
                    $POINTS_UNPAID = '-0.4';
                } elseif ($res->ATT_UNPAID = 0) {
                    $POINTS_UNPAID = '0';
                }

                if ($res->ATT_MEDICAL == 1 || $res->ATT_MEDICAL == 2 || $res->ATT_MEDICAL == 3) {
                    $POINTS_MEDICAL = '-0.1';
                } elseif ($res->ATT_MEDICAL == 4 || $res->ATT_MEDICAL == 5 || $res->ATT_MEDICAL == 6) {
                    $POINTS_MEDICAL = '-0.2';
                } elseif ($res->ATT_MEDICAL == 7 || $res->ATT_MEDICAL == 8 || $res->ATT_MEDICAL == 9 || $res->ATT_MEDICAL == 10 || $res->ATT_MEDICAL == 11 || $res->ATT_MEDICAL == 12) {
                    $POINTS_MEDICAL = '-0.3';
                } elseif ($res->ATT_MEDICAL > 12) {
                    $POINTS_MEDICAL = '-0.4';
                } elseif ($res->ATT_MEDICAL = 0) {
                    $POINTS_MEDICAL = '0';
                }

                if ($res->ATT_ABSENT == 1) {
                    $POINTS_ABSENT = '-0.5';
                } elseif ($res->ATT_ABSENT > 1) {
                    $POINTS_ABSENT = '-1';
                } elseif ($res->ATT_ABSENT = 0) {
                    $POINTS_ABSENT = '0';
                }

                if ($res->WL3_MONTH == 1 || $res->WL3_MONTH_1 == 1) {
                    $POINT_WARNING3 = '-0.5';
                } elseif ($res->WL3_MONTH == 0 || $res->WL3_MONTH_1 == 0) {
                    $POINT_WARNING3 = '0';
                } elseif ($res->WL3_MONTH >= 2 || $res->WL3_MONTH_1 >= 2) {
                    $POINT_WARNING3 = '-1';
                }

                if ($res->WL6_MONTH == 1 || $res->WL6_MONTH_1 == 1) {
                    $POINT_WARNING6 = '-0.5';
                } elseif ($res->WL6_MONTH == 0 || $res->WL6_MONTH_1 == 0) {
                    $POINT_WARNING6 = '0';
                } elseif ($res->WL6_MONTH >= 2 || $res->WL6_MONTH_1 >= 2) {
                    $POINT_WARNING6 = '-1';
                }

                if ($res->WL12_MONTH == 1 || $res->WL12_MONTH_1 == 1) {
                    $POINT_WARNING12 = '-0.5';
                } elseif ($res->WL12_MONTH == 0 || $res->WL12_MONTH_1 == 0) {
                    $POINT_WARNING12 = '0';
                } elseif ($res->WL12_MONTH >= 2 || $res->WL12_MONTH_1 >= 2) {
                    $POINT_WARNING12 = '-1';
                }

                if ($res->WL_JOIN == 1 || $res->WL_JOIN_1 == 1) {
                    $POINT_JOIN = '-0.5';
                } elseif ($res->WL_JOIN == 0 || $res->WL_JOIN_1 == 0) {
                    $POINT_JOIN = '0';
                } elseif ($res->WL_JOIN >= 2 || $res->WL_JOIN_1 >= 2) {
                    $POINT_JOIN = '-1';
                }

                if ($res->WL12_MONTH == 1) {
                    $POINT_REPROT = '-0.1';
                } elseif ($res->WL12_MONTH == 2) {
                    $POINT_REPROT = '-0.2';
                } elseif ($res->WL12_MONTH == 3) {
                    $POINT_REPROT = '-0.3';
                } elseif ($res->WL12_MONTH == 0) {
                    $POINT_REPROT = '0';
                } elseif ($res->WL12_MONTH > 3) {
                    $POINT_REPROT = '-0.5';
                }

                $data['POINT_ATT'] = ($POINTS_UNPAID + $POINTS_MEDICAL + $POINTS_ABSENT);
                $data['POINT_WARNING'] = ($POINT_WARNING3 + $POINT_WARNING6 + $POINT_WARNING12 + $POINT_JOIN);
                $data['TOT'] = (($POINTS_UNPAID + $POINTS_MEDICAL + $POINTS_ABSENT) + ($POINT_WARNING3 + $POINT_WARNING6 + $POINT_WARNING12 + $POINT_JOIN) + $POINT_REPROT);
            }
        }
        return $data;
    }

    public function get_plan()
    {
        extract($this->xss_html_filter(array_merge($this->data, $_POST, $_GET)));
        $display_json = array();

        $q1 = $this->db->query("SELECT * FROM TMI.HR_TRAIN_PLAN WHERE PLN_SYS_ID = '$topicid'");
        $res = $q1->row();
        $PLN_PLAN_QTY = $res->PLN_PLAN_QTY;
        $PLN_PLAN_UNIT = $res->PLN_PLAN_UNIT;

        $json_arr["PLN_PLAN_QTY"] = $PLN_PLAN_QTY;
        $json_arr["PLN_PLAN_UNIT"] = $PLN_PLAN_UNIT;
        array_push($display_json, $json_arr);
        echo json_encode($display_json);
        exit;
    }

    public function update_status($id, $status)
    {
        $query1 = "UPDATE TMI.HR_TRAINING_RCD SET STATUS='$status' WHERE TR_SYS_ID = $id";
        if ($this->db->simple_query($query1)) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    public function view_training_modal($id, $status)
    {
        //$db2 = $this->load->database('tmi_ext', true);
?>
        <div class="modal fade" id="view_training_modal">
            <form method="post" accept-charset="utf-8" id="modal_training">
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
                                                <label for="training_status" class="col-sm-3 control-label">Change Status</label>
                                                <div class="col-md-6">
                                                    <select class="form-control select2" id="training_status" name="training_status" style="width: 100%;">
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
                            <button type="button" onclick="save_training()" class="btn btn-primary training_save"> Save </button>
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

    public function status_training($id, $status)
    {
        //extract($this->xss_html_filter(array_merge($this->data, $_POST, $_GET)));
        $q1 = $this->db->query("UPDATE HR_TRAINING_RCD SET STATUS = $status WHERE PLN_SYS_ID = $id");
        if ($q1) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
