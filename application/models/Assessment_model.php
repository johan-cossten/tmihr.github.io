<?php
class Assessment_model extends CI_Model
{
    var $table = 'TBLPERF_ASSESS A';
    var $column_order = array('A.ID', 'A.CODE', 'A.EMPLOYEEID', 'A.DATEASSESS', 'A.DATEPERIODFR', 'A.PURPOSE', 'A.FLEX01', 'A.FLEX02', 'A.ATTENDANCE_SCORE', 'A.WARNING_LETTERS_SCORE', 'A.REASON_ACCOUN_SCORE', 'A.REASON_ACCOUN', 'A.ATT_UNPAID', 'A.ATT_MEDICAL', 'A.ATT_ABSENT', 'A.WL3_MONTH', 'A.WL6_MONTH', 'A.WL12_MONTH', 'A.WL_JOIN', 'A.FLEX03', 'A.FLEX04', 'A.FLEX05', 'A.TOT_SCORE', 'A.DATEPERIODTO', 'A.WL3_MONTH_1', 'A.WL6_MONTH_1', 'A.WL12_MONTH_1', 'A.WL_JOIN_1', 'A.STATUS');
    var $column_search = array('A.ID', 'A.CODE', 'A.EMPLOYEEID', 'A.DATEASSESS', 'A.DATEPERIODFR', 'A.PURPOSE', 'A.FLEX01', 'A.FLEX02', 'A.ATTENDANCE_SCORE', 'A.WARNING_LETTERS_SCORE', 'A.REASON_ACCOUN_SCORE', 'A.REASON_ACCOUN', 'A.ATT_UNPAID', 'A.ATT_MEDICAL', 'A.ATT_ABSENT', 'A.WL3_MONTH', 'A.WL6_MONTH', 'A.WL12_MONTH', 'A.WL_JOIN', 'A.FLEX03', 'A.FLEX04', 'A.FLEX05', 'A.TOT_SCORE', 'A.DATEPERIODTO', 'A.WL3_MONTH_1', 'A.WL6_MONTH_1', 'A.WL12_MONTH_1', 'A.WL_JOIN_1', 'A.STATUS'); //set column field database for datatable searchable 
    var $order = array('CODE' => 'ASC'); // default order 

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select($this->column_order);
        $this->db->from($this->table);
        $this->db->select("B.STATUSID, B.STATUS_NAME");
        $this->db->from("TMI.HR_STATUS B");
        $this->db->where('A.STATUS = B.STATUSID');

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

    public function employee_name($id)
    {
        $db2 = $this->load->database('tmi_ext', true);
        $q2 = "SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE SUBSTR(OVT_BADGED, 1, 1) IN (0,1,2,3,9) AND OVT_BADGED = '$id'";
        $res = $db2->query($q2)->row();
        $data = $res->OVT_NAME_EMP;
        return $data;
    }

    public function verify_and_save()
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));

        if ($command == 'save') {
            $init = 'AS';
            $q1 = $this->db->query("SELECT COALESCE(MAX(ID),0) + 1 AS MAXID FROM TMI.TBLPERF_ASSESS");
            $maxid = $q1->row()->MAXID;
            $code = $init . str_pad($maxid, 4, '0', STR_PAD_LEFT);

            $q2 = $this->db->query("INSERT INTO TMI.TBLPERF_ASSESS (CODE, EMPLOYEEID, DATEASSESS, DATEPERIODFR, PURPOSE, REASON_ACCOUN, ATT_UNPAID, ATT_MEDICAL, ATT_ABSENT, WL3_MONTH, WL6_MONTH, WL12_MONTH, WL_JOIN, FLEX03, FLEX04, FLEX05, DATEPERIODTO, WL3_MONTH_1, WL6_MONTH_1, WL12_MONTH_1, WL_JOIN_1) VALUES ('$code','$employeeid', TO_DATE('$date_assessment', 'dd/mm/yyyy'), TO_DATE('$period_assessment', 'dd/mm/yyyy'), '$PURPOSE','$account_score','$unpaid_score','$medical_score','$absent_score','$warning01','$warning03',
            '$warning05','$warning07','$reason1','$reason2','$reason3', TO_DATE('$period_assessment', 'dd/mm/yyyy'), '$warning02','$warning04','$warning06','$warning08')");

            // $assessment_entry = array(
            //     'CODE'                  => $code,
            //     'EMPLOYEEID'            => $employeeid,
            //     'DATEASSESS'            => 'TO_DATE("$date_assessment", "dd/mm/yyyy")',
            //     'DATEPERIODFR'          => 'TO_DATE("$period_assessment", "dd/mm/yyyy")',
            //     'PURPOSE'               => $PURPOSE,
            //     'REASON_ACCOUN'         => $account_score,
            //     'ATT_UNPAID'            => $unpaid_score,
            //     'ATT_MEDICAL'           => $medical_score,
            //     'ATT_ABSENT'            => $absent_score,
            //     'WL3_MONTH'             => $warning01,
            //     'WL6_MONTH'             => $warning03,
            //     'WL12_MONTH'            => $warning05,
            //     'WL_JOIN'               => $warning07,
            //     'FLEX03'                => $reason1,
            //     'FLEX04'                => $reason2,
            //     'FLEX05'                => $reason3,
            //     'DATEPERIODTO'          => 'TO_DATE("$to_period_assessment", "dd/mm/yyyy")',
            //     'WL3_MONTH_1'           => $warning02,
            //     'WL6_MONTH_1'           => $warning04,
            //     'WL12_MONTH_1'          => $warning06,
            //     'WL_JOIN_1'             => $warning08
            // );
            // $q2 = $this->db->insert("TMI.TBLPERF_ASSESS", $assessment_entry);
            $q3 = $this->db->query("SELECT ID FROM (SELECT ID FROM TMI.TBLPERF_ASSESS ORDER BY ID DESC) WHERE ROWNUM < 2");
            $assessment_id = $q3->row()->ID;
        } elseif ($command == 'update') {
            // $assessment_entry = array(
            //     'REASON_ACCOUN'         => $account_score,
            //     'ATT_UNPAID'            => $unpaid_score,
            //     'ATT_MEDICAL'           => $medical_score,
            //     'ATT_ABSENT'            => $absent_score,
            //     'WL3_MONTH'             => $warning01,
            //     'WL6_MONTH'             => $warning03,
            //     'WL12_MONTH'            => $warning05,
            //     'WL_JOIN'               => $warning07,
            //     'FLEX03'                => $reason1,
            //     'FLEX04'                => $reason2,
            //     'FLEX05'                => $reason3,
            //     'DATEPERIODTO'          => "TO_DATE('$to_period_assessment', 'dd/mm/yyyy')",
            //     'WL3_MONTH_1'           => $warning02,
            //     'WL6_MONTH_1'           => $warning04,
            //     'WL12_MONTH_1'          => $warning06,
            //     'WL_JOIN_1'             => $warning08
            // );
            // $q1 = $this->db->where('ID', $assessment_id)->update('TMI.TBLPERF_ASSESS', $assessment_entry);

            $q3 = $this->db->query("UPDATE TMI.TBLPERF_ASSESS SET REASON_ACCOUN = '$account_score', ATT_UNPAID = '$unpaid_score', ATT_MEDICAL = '$medical_score', ATT_ABSENT = '$absent_score', WL3_MONTH = '$warning01', WL6_MONTH = '$warning03', WL12_MONTH = '$warning05',WL_JOIN = '$warning07', FLEX03 = '$reason1', FLEX04 = '$reason2', FLEX05 = '$reason3', DATEPERIODTO = TO_DATE('$period_assessment', 'dd/mm/yyyy'), WL3_MONTH_1 = '$warning02', WL6_MONTH_1 = '$warning04', WL12_MONTH_1 = '$warning06', WL_JOIN_1 = '$warning08' WHERE ID = $assessment_id");
        }
        $this->session->set_flashdata('success', 'Success, Record Saved Successfully!!');
        return "success";
    }

    public function get_details($id, $data)
    {
        $query = $this->db->query("SELECT * FROM TBLPERF_ASSESS WHERE UPPER(ID)=UPPER('$id')");
        if ($query->num_rows() == 0) {
            show_404();
            exit;
        } else {
            $query = $query->row();
            $data['q_id'] = $query->ID;
            $data['assessment_id'] = $query->ID;
            $data['CODE'] = $query->CODE;
            $data['EMPLOYEEID'] = $query->EMPLOYEEID;
            $data['DATEASSESS'] = $query->DATEASSESS;
            $data['DATEPERIODFR'] = $query->DATEPERIODFR;
            $data['PURPOSE'] = $query->PURPOSE;
            $data['FLEX01'] = $query->FLEX01;
            $data['FLEX02'] = $query->FLEX02;
            $data['ATTENDANCE_SCORE'] = $query->ATTENDANCE_SCORE;
            $data['WARNING_LETTERS_SCORE'] = $query->WARNING_LETTERS_SCORE;
            $data['REASON_ACCOUN_SCORE'] = $query->REASON_ACCOUN_SCORE;
            $data['REASON_ACCOUN'] = $query->REASON_ACCOUN;
            $data['ATT_UNPAID'] = $query->ATT_UNPAID;
            $data['ATT_MEDICAL'] = $query->ATT_MEDICAL;
            $data['ATT_ABSENT'] = $query->ATT_ABSENT;
            $data['WL3_MONTH'] = $query->WL3_MONTH;
            $data['WL6_MONTH'] = $query->WL6_MONTH;
            $data['WL12_MONTH'] = $query->WL12_MONTH;
            $data['WL_JOIN'] = $query->WL_JOIN;
            $data['FLEX03'] = $query->FLEX03;
            $data['FLEX04'] = $query->FLEX04;
            $data['FLEX05'] = $query->FLEX05;
            $data['TOT_SCORE'] = $query->TOT_SCORE;
            $data['DATEPERIODTO'] = $query->DATEPERIODTO;
            $data['WL3_MONTH_1'] = $query->WL3_MONTH_1;
            $data['WL6_MONTH_1'] = $query->WL6_MONTH_1;
            $data['WL12_MONTH_1'] = $query->WL12_MONTH_1;
            $data['WL_JOIN_1'] = $query->WL_JOIN_1;

            return $data;
        }
    }

    public function update_category()
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));

        $query = $this->db->query("SELECT * FROM TMI.HR_DEPT WHERE UPPER(DEPT_SYS_CD) = UPPER('$department') AND DEPT_SYS_ID <> $q_id");
        if ($query->num_rows() > 0) {
            return "This Department Name already Exist.";
        } else {
            $query1 = "UPDATE TMI.HR_DEPT SET DEPT_SYS_CD = '$department', DEPT_NAME = '$description' WHERE DEPT_SYS_ID = $q_id";
            if ($this->db->simple_query($query1)) {
                $this->session->set_flashdata('success', 'Success!! Department Updated Successfully!');
                return "success";
            } else {
                return "failed";
            }
        }
    }

    public function delete_assessment($id)
    {
        $this->db->trans_begin();
        $query1 = "DELETE FROM TBLPERF_ASSESS WHERE ID = $id";
        if ($this->db->simple_query($query1)) {
            $this->db->trans_commit();
            echo "success";
            $this->session->set_flashdata('success', 'Success!! Department Deleted Succssfully!');
        } else {
            $this->db->trans_rollback();
            echo "failed";
        }
    }

    public function get_data_preview($id)
    {
        $this->db2 = $this->load->database('tmi_ext', true);
        $POINTS_UNPAID = $POINTS_MEDICAL = $POINTS_ABSENT = 0;
        $q1 = $this->db->query("SELECT * FROM TMI.TBLPERF_ASSESS WHERE ID = $id");
        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $res) {
                $q2 = $this->db2->query("SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_BADGED = '$res->EMPLOYEEID'");
                $r1 = $q2->row();
                $data['employee'] = $r1->OVT_NAME_EMP;
                $data['employee_code'] = $r1->OVT_BADGED;
                $data['ovt_group'] = $r1->OVT_GROUP;
                $data['department'] = $r1->OVT_DEPT_EMP;
                $data['position'] = $r1->OVT_POSITION;
                $data['joined'] = $r1->OVT_JOIN_DATE;
                $data['DATEASSESS'] = $res->DATEASSESS;
                $data['DATEPERIODFR'] = $res->DATEPERIODFR;
                $data['DATEPERIODTO'] = $res->DATEPERIODTO;
                $data['PURPOSE'] = $res->PURPOSE;
                $data['ATT_UNPAID'] = $res->ATT_UNPAID;
                $data['ATT_MEDICAL'] = $res->ATT_MEDICAL;
                $data['ATT_ABSENT'] = $res->ATT_ABSENT;
                $data['WL3_MONTH'] = $res->WL3_MONTH;
                $data['WL3_MONTH_1'] = $res->WL3_MONTH_1;
                $data['WL6_MONTH'] = $res->WL6_MONTH;
                $data['WL6_MONTH_1'] = $res->WL6_MONTH_1;
                $data['WL12_MONTH'] = $res->WL12_MONTH;
                $data['WL12_MONTH_1'] = $res->WL12_MONTH_1;
                $data['WL_JOIN'] = $res->WL_JOIN;
                $data['WL_JOIN_1'] = $res->WL_JOIN_1;
                $data['REASON_ACCOUN'] = $res->REASON_ACCOUN;
                $data['FLEX03'] = $res->FLEX03;
                $data['FLEX04'] = $res->FLEX04;
                $data['FLEX05'] = $res->FLEX05;

                if ($res->ATT_UNPAID == 1 || $res->ATT_UNPAID == 2) {
                    $POINTS_UNPAID = ($res->ATT_UNPAID * -1);
                } elseif ($res->ATT_UNPAID == 3 || $res->ATT_UNPAID == 4 || $res->ATT_UNPAID == 5) {
                    // $POINTS_UNPAID = '-2';
                    $POINTS_UNPAID = ($res->ATT_UNPAID * -2);
                } elseif ($res->ATT_UNPAID == 6 || $res->ATT_UNPAID == 7 || $res->ATT_UNPAID == 8 || $res->ATT_UNPAID == 9 || $res->ATT_UNPAID == 10) {
                    // $POINTS_UNPAID = '-3';
                    $POINTS_UNPAID = ($res->ATT_UNPAID * -3);
                } elseif ($res->ATT_UNPAID > 10) {
                    // $POINTS_UNPAID = '-4';
                    $POINTS_UNPAID = ($res->ATT_UNPAID * -4);
                } elseif ($res->ATT_UNPAID = 0) {
                    $POINTS_UNPAID = '0';
                }

                if ($res->ATT_MEDICAL == 1 || $res->ATT_MEDICAL == 2 || $res->ATT_MEDICAL == 3) {
                    // $POINTS_MEDICAL = '-1';
                    $POINTS_MEDICAL = ($res->ATT_MEDICAL * -1);
                } elseif ($res->ATT_MEDICAL == 4 || $res->ATT_MEDICAL == 5 || $res->ATT_MEDICAL == 6) {
                    // $POINTS_MEDICAL = '-2';
                    $POINTS_MEDICAL = ($res->ATT_MEDICAL * -2);
                } elseif ($res->ATT_MEDICAL == 7 || $res->ATT_MEDICAL == 8 || $res->ATT_MEDICAL == 9 || $res->ATT_MEDICAL == 10 || $res->ATT_MEDICAL == 11 || $res->ATT_MEDICAL == 12) {
                    // $POINTS_MEDICAL = '-3';
                    $POINTS_MEDICAL = ($res->ATT_MEDICAL * -3);
                } elseif ($res->ATT_MEDICAL > 12) {
                    // $POINTS_MEDICAL = '-4';
                    $POINTS_MEDICAL = ($res->ATT_MEDICAL * -4);
                } elseif ($res->ATT_MEDICAL = 0) {
                    $POINTS_MEDICAL = '0';
                }

                if ($res->ATT_ABSENT == 1) {
                    // $POINTS_ABSENT = '-5';
                    $POINTS_ABSENT = ($res->ATT_ABSENT * -5);
                } elseif ($res->ATT_ABSENT > 1) {
                    // $POINTS_ABSENT = '-1';
                    // $POINTS_ABSENT = '-5';
                    $POINTS_ABSENT = ($res->ATT_ABSENT * -1);
                } elseif ($res->ATT_ABSENT = 0) {
                    $POINTS_ABSENT = '0';
                }

                if ($res->WL3_MONTH == 1 || $res->WL3_MONTH_1 == 1) {
                    // $POINT_WARNING3 = '-5';
                    $POINT_WARNING3 = ($res->WL3_MONTH * -5);
                } elseif ($res->WL3_MONTH == 0 || $res->WL3_MONTH_1 == 0) {
                    $POINT_WARNING3 = '0';
                } elseif ($res->WL3_MONTH >= 2 || $res->WL3_MONTH_1 >= 2) {
                    // $POINT_WARNING3 = '-1';
                    $POINT_WARNING3 = ($res->WL3_MONTH * -1);
                }

                if ($res->WL6_MONTH == 1 || $res->WL6_MONTH_1 == 1) {
                    // $POINT_WARNING6 = '-5';
                    $POINT_WARNING6 = ($res->WL6_MONTH * -5);
                } elseif ($res->WL6_MONTH == 0 || $res->WL6_MONTH_1 == 0) {
                    $POINT_WARNING6 = '0';
                } elseif ($res->WL6_MONTH >= 2 || $res->WL6_MONTH_1 >= 2) {
                    // $POINT_WARNING6 = '-1';
                    $POINT_WARNING6 = ($res->WL6_MONTH * -1);
                }

                if ($res->WL12_MONTH == 1 || $res->WL12_MONTH_1 == 1) {
                    // $POINT_WARNING12 = '-5';
                    $POINT_WARNING12 = ($res->WL12_MONTH * -5);
                } elseif ($res->WL12_MONTH == 0 || $res->WL12_MONTH_1 == 0) {
                    $POINT_WARNING12 = '0';
                } elseif ($res->WL12_MONTH >= 2 || $res->WL12_MONTH_1 >= 2) {
                    // $POINT_WARNING12 = '-1';
                    $POINT_WARNING12 = ($res->WL12_MONTH * -1);
                }

                if ($res->WL_JOIN == 1 || $res->WL_JOIN_1 == 1) {
                    // $POINT_JOIN = '-5';
                    $POINT_JOIN = ($res->WL_JOIN * -5);
                } elseif ($res->WL_JOIN == 0 || $res->WL_JOIN_1 == 0) {
                    $POINT_JOIN = '0';
                } elseif ($res->WL_JOIN >= 2 || $res->WL_JOIN_1 >= 2) {
                    // $POINT_JOIN = '-1';
                    $POINT_JOIN = ($res->WL_JOIN * -1);
                }

                if ($res->WL12_MONTH == 1) {
                    // $POINT_REPROT = '-1';
                    $POINT_REPROT = ($res->WL12_MONTH * -1);
                } elseif ($res->WL12_MONTH == 2) {
                    // $POINT_REPROT = '-2';
                    $POINT_REPROT = ($res->WL12_MONTH * -2);
                } elseif ($res->WL12_MONTH == 3) {
                    // $POINT_REPROT = '-3';
                    $POINT_REPROT = ($res->WL12_MONTH * -3);
                } elseif ($res->WL12_MONTH == 0) {
                    $POINT_REPROT = '0';
                } elseif ($res->WL12_MONTH > 3) {
                    // $POINT_REPROT = '-5';
                    $POINT_REPROT = ($res->WL12_MONTH * -5);
                }

                $data['POINT_ATT'] = ($POINTS_UNPAID + $POINTS_MEDICAL + $POINTS_ABSENT);
                $data['POINT_WARNING'] = ($POINT_WARNING3 + $POINT_WARNING6 + $POINT_WARNING12 + $POINT_JOIN);
                $data['TOT'] = (($POINTS_UNPAID + $POINTS_MEDICAL + $POINTS_ABSENT) + ($POINT_WARNING3 + $POINT_WARNING6 + $POINT_WARNING12 + $POINT_JOIN) + $POINT_REPROT);
            }
        }
        return $data;
    }

    public function update_status($id, $status)
    {
        $query1 = "UPDATE TBLPERF_ASSESS SET STATUS='$status' WHERE ID = $id";
        if ($this->db->simple_query($query1)) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    public function view_assessment_modal($id, $status)
    {
        //$db2 = $this->load->database('tmi_ext', true);
?>
        <div class="modal fade" id="view_assessment_modal">
            <form method="post" accept-charset="utf-8" id="modal_assessment">
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
                                                <label for="assessment_status" class="col-sm-3 control-label">Change Status</label>
                                                <div class="col-md-6">
                                                    <select class="form-control select2" id="assessment_status" name="assessment_status" style="width: 100%;">
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
                            <button type="button" onclick="save_assessment()" class="btn btn-primary assessment_save"> Save </button>
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

    public function status_assessment($id, $status)
    {
        $q1 = $this->db->query("UPDATE TBLPERF_ASSESS SET STATUS = $status WHERE ID = $id");
        if ($q1) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
