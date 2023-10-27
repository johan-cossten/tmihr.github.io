<?php

use PhpOffice\PhpSpreadsheet\Worksheet\Row;

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function verify_credentials($username, $password)
    {
        $username = $this->security->xss_clean(html_escape($username));
        $password = $this->security->xss_clean(html_escape($password));

        $q1 = $this->db->query("SELECT A.USERNAME, A.PASSWORD, A.ID, A.ROLE_ID, B.ROLE_NAME, A.DEPT FROM TMI.HR_USERS A INNER JOIN TMI.HR_ROLE B ON A.ROLE_ID = B.ID
        WHERE A.USERNAME = '$username' AND PASSWORD = '" . md5($password) . "' AND A.STATUS = 1");
        if ($q1->num_rows() == 1) {
            $logdata = array(
                'username' => $q1->row()->USERNAME,
                'user_id'   => $q1->row()->ID,
                'logged_in' => true,
                'role_id'   => $q1->row()->ROLE_ID,
                'role_name' => $q1->row()->ROLE_NAME,
                'dept_id'      => $q1->row()->DEPT,
            );
            $this->session->set_userdata($logdata);
            $this->session->set_flashdata('success', 'Welcome ' . ucfirst($q1->row()->USERNAME) . " !");
            return true;
        } else {
            return false;
        }
    }
}
