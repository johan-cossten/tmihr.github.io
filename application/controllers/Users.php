<?php
class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Load_global();
    }

    public function index()
    {
        $this->permission_check('users_add');
        $data = $this->data;
        $data['page_title'] = 'Create Users';
        $this->load->view('users/users', $data);
    }

    public function save_or_update()
    {
        $data = $this->data;
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('dept', 'dept', 'required|trim');

        if ($this->input->post('command') == 'save') {
            $this->form_validation->set_rules('pass', 'Password', 'required|trim');
            $this->form_validation->set_rules('new_user', 'Usenname', 'required|trim');
            $this->form_validation->set_rules('role_id', 'Role', 'required|trim');
        }

        if ($this->form_validation->run() == TRUE) {
            $this->load->model('users_model');
            if ($this->input->post('command') != 'update') {
                $result = $this->users_model->verify_and_save();
            } else {
                $q_id = $this->input->post('q_id');
                $data['q_id'] = $q_id;
                $result = $this->users_model->verify_and_update($data);
            }

            echo $result;
        } else {
            echo validation_errors();
        }
    }

    public function view()
    {
        $this->permission_check('users_view');
        $data = $this->data;
        $data['page_title'] = 'Users List';
        $this->load->view('users/users-view', $data);
    }

    public function status_update()
    {
        $this->permission_check_with_msg('users_edit');
        $userid = $this->input->post('id');
        $status = $this->input->post('status');

        $this->load->model('users_model');
        $result = $this->users_model->status_update($userid, $status);
        return $result;
    }

    public function password_reset()
    {
        $data = $this->data;
        $data['page_title'] = 'Change Password';
        $this->load->view('users/change-pass', $data);
    }

    public function password_update()
    {
        if ($this->session->userdata('username') == 'admin') {
            echo "Restricted Admin Password Change";
            exit();
        }

        $data = $this->data;
        $currentpass = $this->input->post('currentpass');
        $newpass = $this->input->post('newpass');

        $this->load->model('users_model');
        $result = $this->users_model->password_update(md5($currentpass), md5($newpass), $data);
        echo $result;
    }

    public function edit($id)
    {
        // $this->permission_check('users_edit');
        $data = $this->data;
        $this->load->model('users_model');
        $data = $this->users_model->get_details($id);
        //print_r($data);exit();
        $data['page_title'] = 'Edit Users';
        $this->load->view('users/users', $data);
    }

    public function delete_user()
    {
        $this->permission_check_with_msg('users_delete');
        $this->load->model('users_model');
        $id = $this->input->post('q_id');
        $result = $this->users_model->delete_user($id);
        return $result;
    }
}
