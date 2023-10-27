<?php
class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function board_values()
    {
        $db2 = $this->load->database('tmi_ext', true);
        $q1 = "SELECT * FROM TMI.HR_TRAINING_RCD";
        $total_training = $this->db->query($q1)->num_rows();

        $q2 = "SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE SUBSTR(OVT_BADGED, 1, 1) IN (0,1,2,3,9)";
        $total_employee = $db2->query($q2)->num_rows();

        $q3 = "SELECT * FROM TMI.HR_DEPT";
        $total_dept = $this->db->query($q3)->num_rows();

        $q4 = "SELECT * FROM TMI.HR_EVALUATION";
        $total_training_eva = $this->db->query($q4)->num_rows();

        $q5 = "SELECT * FROM TMI.HR_TRAIN_PLAN";
        $total_training_plan = $this->db->query($q5)->num_rows();

        $q6 = "SELECT * FROM TMI.HR_USERS";
        $total_users = $this->db->query($q6)->num_rows();


        $data['tot_tr'] = $total_training;
        $data['tot_emp'] = $total_employee;
        $data['tot_dept'] = $total_dept;
        $data['tot_eva'] = $total_training_eva;
        $data['tot_plan'] = $total_training_plan;
        $data['tot_users'] = $total_users;
        return $data;
    }

    public function list_training_experied()
    {
        $id_tr = array();
        $year = date("Y");
        $q1 = $this->db->query("SELECT TR_SYS_ID, TR_ST_DT, TR_END_DT FROM TMI.HR_TRAIN_PLAN A
        INNER JOIN TMI.HR_TRAINING_RCD B ON A.PLN_SYS_ID = B.PLN_SYS_ID
        WHERE A.PLN_YEAR = $year ");
        foreach ($q1->result() as $res) {
            date_default_timezone_set('Asia/Jakarta');
            $date1 = new DateTime(date("d-m-Y"));
            $date2 = new DateTime(date("d-m-Y", strtotime($res->TR_END_DT)));
            $interval = $date1->diff($date2);
            $alert = $interval->days;
            if ($alert >= 80) {
                if ($alert <= 90) {
                    $id_tr[] = $res->TR_SYS_ID;
                }
            }
        }
        $i = 1;
        $id = implode(", ", $id_tr);
        if ($id) {
            $q2 = $this->db->query("SELECT * FROM TMI.HR_TRAIN_PLAN A
        INNER JOIN TMI.HR_TRAINING_RCD B ON A.PLN_SYS_ID = B.PLN_SYS_ID
        WHERE B.TR_SYS_ID IN ($id)");
            foreach ($q2->result() as $res2) {
                $info['NO'] = $i++;
                $info['EMP'] = $res2->EMPLOYEE;
                $info['TOPIC'] = $res2->PLN_TOPIC;
                $info['DUR'] = $res2->TR_DUR;
                $info['DUR_UNIT'] = $res2->TR_DUR_UNIT;
                $info['ST_DT'] = $res2->TR_ST_DT;
                $info['END_DT'] = $res2->TR_END_DT;
                echo $this->get_training($info);
            }
        }
    }

    function get_training($info)
    {
        extract($info);
        $employee_name = array();
        $db2 = $this->load->database('tmi_ext', true);
        $q3 = $db2->query("SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_BADGED IN ($EMP)");
        foreach ($q3->result() as $res3) {
            $employee_name[] = $res3->OVT_NAME_EMP;
        }
?>
        <tr>
            <td> <?php echo $NO ?> </td>
            <td> <?php echo $EMP ?> </td>
            <td> <?php echo implode(", ", $employee_name) ?> </td>
            <td> <?php echo $TOPIC ?> </td>
            <td> <?php echo $DUR ?> </td>
            <td> <?php echo $DUR_UNIT ?> </td>
            <td> <?php echo date('d-m-Y', strtotime($ST_DT))  ?> </td>
            <td> <?php echo date('d-m-Y', strtotime($END_DT)) ?> </td>
        </tr>
    <?php
    }

    public function countTotalEmployeeActive()
    {
        $db2 = $this->load->database('tmi_ext', true);
        $db2->select('*');
        $db2->from('TMIEXT.OVT_OM_EMPLOYEES');
        $db2->where('OVT_CODE IS NULL');
        $employee = $db2->get();
        return $employee->num_rows();

        // $q1 = "SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES";
        // $employee_active = $db2->query($q1)->get()->num_rows();
        // return $employee_active;
    }

    public function list_trans_alert()
    {
        $i = 1;
        $query = $this->db->query("SELECT * FROM VIEW_HR_STATUS WHERE STATUS IN (1,2) AND ROWNUM < 6 ");
        foreach ($query->result() as $row) {
            $data['NO'] = $i++;
            $data['TransCD'] = $row->TRANSACTIONCD;
            $data['Code'] = $row->CODE;
            $data['Status_name'] = $row->STATUS_NAME;
            echo $this->get_transaction($data);
        }
    }

    function get_transaction($data)
    {
        extract($data);
    ?>
        <tr>
            <td> <?php echo $NO ?> </td>
            <td> <?php echo $TransCD ?> </td>
            <td> <?php echo $Code ?> </td>
            <td> <?php echo $Status_name ?> </td>
        </tr>
<?php
    }

    public function push_notification($view, $dept, $role)
    {
        $output = '';
        if ($role == 1 || $role == 2) {
            $q1 = $this->db->query("SELECT COUNT(TRANSID) TOT_TRANS, TRANSACTIONCD, STATUS_NAME, DEPT FROM VIEW_HR_STATUS WHERE STATUS IN (1,2)  GROUP BY TRANSACTIONCD, STATUS_NAME, DEPT");
        } else {
            $q1 = $this->db->query("SELECT COUNT(TRANSID) TOT_TRANS, TRANSACTIONCD, STATUS_NAME, DEPT 
            FROM VIEW_HR_STATUS WHERE STATUS IN (1,2) AND DEPTID = $dept
            AND TRANSACTIONID IN (1,2,3) GROUP BY TRANSACTIONCD, STATUS_NAME, DEPT
            ");
        }

        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $row) {
                $output .= '<li  class="user-body">
                                <a href="#">
                                    <strong>' . $row->DEPT . ' - ' . $row->TOT_TRANS . ' ' . $row->TRANSACTIONCD . '</strong> <br /> <small><em>Status : ' . $row->STATUS_NAME . ' Need Action</em></small>
                                </a>
                            </li>';
            }
        } else {
            $output .= '<li><a href="#" class="text-bold text-italic"> No Noti Found </a></li>';
        }
        $count = $q1->num_rows();
        $data = array('notification' => $output, 'unseen_notification' => $count);
        return json_encode($data);
    }
}
