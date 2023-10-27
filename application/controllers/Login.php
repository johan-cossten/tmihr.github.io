<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Load_info();
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') == 1) {
            redirect(base_url() . 'dashboard', 'refresh');
        }
        $data = $this->data;
        $this->load->view('login', $data);
    }

    public function verify_data()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('failed', 'Please enter username & password!');
            redirect('login');
        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->model('login_model'); //Model
            if ($this->login_model->verify_credentials($username, $password)) { //Model->Method
                redirect(base_url() . 'dashboard');
            } else {
                $this->session->set_flashdata('failed', 'Invalid username & password.');
                redirect('login');
            }
        }
    }
}
