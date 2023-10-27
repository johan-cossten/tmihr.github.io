<?php
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Load_info()
    {
        $id = $this->session->userdata('user_id');
        $profile_picture = '';
        if ($id) {
            // $q1 = $this->db->SELECT('PROFILE_PICTURE')->WHERE("ID", $this->session->userdata('userid'))->get('HR_USERS')->row()->profile_picture;
            $q1 = $this->db->query('SELECT PROFILE_PICTURE FROM TMI.HR_USERS WHERE ID =' . $id)->row();
            if ($q1 === null) {
                // $profile_picture = base_url("theme/dist/img/avatar5.png");
                $profile_picture = '';
            } else {
                $profile_picture = base_url($q1->PROFILE_PICTURE);
            }
        }

        $this->data = array(
            'theme_link'    => base_url() . 'theme/',
            'base_url'      => base_url(),
            'dist_link'     => base_url() . 'dist/',
            'site_title'    => 'PT.Team Metal Indonesia',
            'cur_date'      => date("Y-m-d"),
            'profile_picture' => $profile_picture,
            'system_ip'     => $_SERVER['REMOTE_ADDR'],
            'system_name'   => gethostbyaddr($_SERVER['REMOTE_ADDR']),
            'cur_name'  => $this->session->userdata('username'),
            'cur_userid'    => $this->session->userdata('user_id'),
        );
    }

    public function Load_global()
    {
        if ($this->session->userdata('logged_in') != 1) {
            redirect(base_url() . 'logout', 'refresh');
        }
        $this->load_info();
    }

    public function permission($permission = '')
    {
        if ($this->session->userdata('user_id') == 1) {
            return true;
        }

        // $tot = $this->db->query("SELECT COUNT(*) as tot FROM TMI.HR_PERMISSION WHERE PERMISSION = '" . $permission . "' AND ROLE_ID =" . $this->session->userdata('role_id'))->row()->tot;
        $q1 = "SELECT *  FROM TMI.HR_PERMISSION WHERE PERMISSION = '" . $permission . "' AND ROLE_ID =" . $this->session->userdata('role_id');
        $tot = $this->db->query($q1);
        if ($tot->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function permission_check($value = '')
    {
        if (!$this->permission($value)) {
            show_error("Access Denied", 403, $heading = "You Don't Enough Permission!!");
        }
        return true;
    }

    public function permission_check_with_msg($value = '')
    {
        if (!$this->permission($value)) {
            echo "You Don't Have Enough Permission for this Operation!";
        }
        return true;
    }

    public function show_access_denied_page()
    {
        show_error("Access Denied", 403, $heading = "You Don't Have Enough Permission!!");
    }
}
