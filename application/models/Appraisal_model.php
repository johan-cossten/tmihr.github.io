<?php
class Appraisal_model extends CI_Model
{
    var $table = 'TBLPERF A';
    var $column_order = array('A.ID', 'A.CODE', 'A.EMPLOYEEID', 'A.PERF_DATE', 'A.FLEX01', 'A.FLEX02', 'A.TYPE', 'A.STATUS');
    var $column_search = array('A.ID', 'A.CODE', 'A.EMPLOYEEID', 'A.PERF_DATE', 'A.FLEX01', 'A.FLEX02', 'A.TYPE', 'A.STATUS');
    var $order = array('A.ID' => 'DESC');

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
            $init = 'AP';
            $q1 = $this->db->query("SELECT COALESCE(MAX(ID),0) + 1 AS MAXID FROM TMI.TBLPERF");
            $maxid = $q1->row()->MAXID;
            $code = $init . str_pad($maxid, 4, '0', STR_PAD_LEFT);

            $q2 = $this->db->query("INSERT INTO TMI.TBLPERF (CODE, EMPLOYEEID, FLEX01, FLEX02, TYPE) 
            VALUES ('$code','$EMPLOYEEID', '$FLEX01', '$FLEX02', $TYPE)");
            if ($q2) {
                $q3 = $this->db->query("SELECT ID FROM (SELECT ID FROM TMI.TBLPERF ORDER BY ID DESC) WHERE ROWNUM < 2");
                $appraisal_id = $q3->row()->ID;
                $q_id = $appraisal_id;
            } else {
                return 'failed';
                exit();
            }
        } elseif ($command == 'update') {
            $q3 = $this->db->query("UPDATE TMI.TBLPERF SET FLEX01 = '$FLEX01', FLEX02 = '$FLEX02' WHERE ID = '$q_id' AND TYPE = $TYPE ");
            $q5 = $this->db->query("DELETE FROM TMI.TBL_PERF_G WHERE ID = '$q_id' AND TYPE = $TYPE");
            if (!$q5) {
                return "failed";
            }
        }

        if ($TYPE == 0) {
            $q4 = $this->db->query("INSERT INTO TMI.TBL_PERF_G (ID, TYPE, ATTENDANCE, COMMITMENT, COOPERATION, DISCIPLINARY, JOB, MEETING, QUALITY, SUPPORT, WILLINGNESS, WORKING) VALUES ('$q_id', 0, '$attendance', '$commitment', '$cooperation', '$disciplinary', '$job', '$meeting', '$quality', '$support', '$spelingness', '$working') ");
        } else {
            $q4 = $this->db->query("INSERT INTO TBL_PERF_G (ID, TYPE, ABILITIES, TIME, CONTINUOUS, CREATING, EFFORTS, EFFECTIVENESS, ADVANCED, MEETINGGOALS, SPEED, TIMELY)
            VALUES ('$q_id', 1, '$abilities', '$time', '$continuous', '$Creating', '$efforts', '$effectiveness', '$function', '$objectives', '$speed', '$timely')");
        }
        if (!$q4) {
            return "failed";
        } else {
            $this->session->set_flashdata('success', 'Success, Record Saved Successfully!!');
            return "success";
        }
    }

    public function get_details($id, $data)
    {
        $query = $this->db->query("SELECT A.ID, EMPLOYEEID, PERF_DATE, FLEX01, FLEX02, CODE, A.TYPE, ATTENDANCE, COMMITMENT, COOPERATION, DISCIPLINARY, JOB, MEETING, QUALITY, SUPPORT, WILLINGNESS, WORKING, ABILITIES, TIME, CONTINUOUS, CREATING, EFFORTS, EFFECTIVENESS, ADVANCED, MEETINGGOALS, SPEED, TIMELY 
        FROM TBLPERF A INNER JOIN TBL_PERF_G B ON A.ID = B.ID WHERE UPPER(A.ID)=UPPER('$id')");
        if ($query->num_rows() == 0) {
            show_404();
            exit;
        } else {
            $query = $query->row();
            $data['q_id'] = $query->ID;
            $data['appraisal_id'] = $query->ID;
            $data['CODE'] = $query->CODE;
            $data['EMPLOYEEID'] = $query->EMPLOYEEID;
            $data['PERF_DATE'] = $query->PERF_DATE;
            $data['FLEX01'] = $query->FLEX01;
            $data['FLEX02'] = $query->FLEX02;
            $data['ATTENDANCE'] = $query->ATTENDANCE;
            $data['COMMITMENT'] = $query->COMMITMENT;
            $data['COOPERATION'] = $query->COOPERATION;
            $data['DISCIPLINARY'] = $query->DISCIPLINARY;
            $data['JOB'] = $query->JOB;
            $data['MEETING'] = $query->MEETING;
            $data['QUALITY'] = $query->QUALITY;
            $data['SUPPORT'] = $query->SUPPORT;
            $data['WILLINGNESS'] = $query->WILLINGNESS;
            $data['WORKING'] = $query->WORKING;
            $data['ABILITIES'] = $query->ABILITIES;
            $data['TIME'] = $query->TIME;
            $data['CONTINUOUS'] = $query->CONTINUOUS;
            $data['CREATING'] = $query->CREATING;
            $data['EFFORTS'] = $query->EFFORTS;
            $data['EFFECTIVENESS'] = $query->EFFECTIVENESS;
            $data['ADVANCED'] = $query->ADVANCED;
            $data['MEETINGGOALS'] = $query->MEETINGGOALS;
            $data['SPEED'] = $query->SPEED;
            $data['TIMELY'] = $query->TIMELY;
            $data['TYPE'] = $query->TYPE;

            return $data;
        }
    }

    // public function update_category()
    // {
    //     extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));

    //     $query = $this->db->query("SELECT * FROM TMI.HR_DEPT WHERE UPPER(DEPT_SYS_CD) = UPPER('$department') AND DEPT_SYS_ID <> $q_id");
    //     if ($query->num_rows() > 0) {
    //         return "This Department Name already Exist.";
    //     } else {
    //         $query1 = "UPDATE TMI.HR_DEPT SET DEPT_SYS_CD = '$department', DEPT_NAME = '$description' WHERE DEPT_SYS_ID = $q_id";
    //         if ($this->db->simple_query($query1)) {
    //             $this->session->set_flashdata('success', 'Success!! Department Updated Successfully!');
    //             return "success";
    //         } else {
    //             return "failed";
    //         }
    //     }
    // }

    public function delete_appraisal($id)
    {
        $this->db->trans_begin();
        // $query1 = "DELETE FROM TBLPERF WHERE ID = $id";
        // if ($this->db->simple_query($query1)) {
        //     echo "success";
        //     $this->session->set_flashdata('success', 'Success!! Department Deleted Succssfully!');
        // } else {
        //     echo "failed";
        // }
        $q1 = $this->db->query("DELETE FROM TMI.TBLPERF WHERE ID = $id");
        $q2 = $this->db->query("DELETE FROM TMI.TBL_PERF_G WHERE ID = $id");

        if ($q1 != 1 || $q2 != 1) {
            $this->db->trans_rollback();
            return "failed";
        } else {
            $this->db->trans_commit();
            return "success";
        }
    }

    public function get_data_preview($id)
    {
        $this->db2 = $this->load->database('tmi_ext', true);
        $q1 = $this->db->query("SELECT A.ID, EMPLOYEEID, PERF_DATE, FLEX01, FLEX02, CODE, A.TYPE, ATTENDANCE, COMMITMENT, COOPERATION, DISCIPLINARY, JOB, MEETING, QUALITY, SUPPORT, WILLINGNESS, WORKING, ABILITIES, TIME, CONTINUOUS, CREATING, EFFORTS, EFFECTIVENESS, ADVANCED, MEETINGGOALS, SPEED, TIMELY 
        FROM TBLPERF A INNER JOIN TBL_PERF_G B ON A.ID = B.ID WHERE UPPER(A.ID)=UPPER('$id')");
        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $query) {
                $q2 = $this->db2->query("SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_BADGED = '$query->EMPLOYEEID'");
                $r1 = $q2->row();
                $data['employee'] = $r1->OVT_NAME_EMP;
                $data['employee_code'] = $r1->OVT_BADGED;
                $data['ovt_group'] = $r1->OVT_GROUP;
                $data['department'] = $r1->OVT_DEPT_EMP;
                $data['position'] = $r1->OVT_POSITION;
                $data['joined'] = $r1->OVT_JOIN_DATE;
                $data['q_id'] = $query->ID;
                $data['appraisal_id'] = $query->ID;
                $data['CODE'] = $query->CODE;
                $data['EMPLOYEEID'] = $query->EMPLOYEEID;
                $data['PERF_DATE'] = $query->PERF_DATE;
                $data['FLEX01'] = $query->FLEX01;
                $data['FLEX02'] = $query->FLEX02;
                $data['ATTENDANCE'] = $query->ATTENDANCE;
                $data['COMMITMENT'] = $query->COMMITMENT;
                $data['COOPERATION'] = $query->COOPERATION;
                $data['DISCIPLINARY'] = $query->DISCIPLINARY;
                $data['JOB'] = $query->JOB;
                $data['MEETING'] = $query->MEETING;
                $data['QUALITY'] = $query->QUALITY;
                $data['SUPPORT'] = $query->SUPPORT;
                $data['WILLINGNESS'] = $query->WILLINGNESS;
                $data['WORKING'] = $query->WORKING;
                $data['ABILITIES'] = $query->ABILITIES;
                $data['TIME'] = $query->TIME;
                $data['CONTINUOUS'] = $query->CONTINUOUS;
                $data['CREATING'] = $query->CREATING;
                $data['EFFORTS'] = $query->EFFORTS;
                $data['EFFECTIVENESS'] = $query->EFFECTIVENESS;
                $data['ADVANCED'] = $query->ADVANCED;
                $data['MEETINGGOALS'] = $query->MEETINGGOALS;
                $data['SPEED'] = $query->SPEED;
                $data['TIMELY'] = $query->TIMELY;
                $data['TYPE'] = $query->TYPE;
            }
        }
        return $data;
    }

    public function update_status($id, $status)
    {
        $query1 = "UPDATE TBLPERF SET STATUS='$status' WHERE ID = $id";
        if ($this->db->simple_query($query1)) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    public function view_appraisal_modal($id, $status)
    {
        //$db2 = $this->load->database('tmi_ext', true);
?>
        <div class="modal fade" id="view_appraisal_modal">
            <form method="post" accept-charset="utf-8" id="modal_appraisal">
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
                                                <label for="appraisal_status" class="col-sm-3 control-label">Change Status</label>
                                                <div class="col-md-6">
                                                    <select class="form-control select2" id="appraisal_status" name="appraisal_status" style="width: 100%;">
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
                            <button type="button" onclick="save_appraisal()" class="btn btn-primary appraisal_save"> Save </button>
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

    public function status_appraisal($id, $status)
    {
        $q1 = $this->db->query("UPDATE TBLPERF SET STATUS = $status WHERE ID = $id");
        if ($q1) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
