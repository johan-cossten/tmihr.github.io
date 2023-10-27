<?php
defined('BASEPATH') or exit('No direct script access allowed');

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Load_global();
        $this->load->model('dashboard_model', 'dashboard');
        $this->load->model('email_model', 'email');
    }

    public function board_values()
    {
        $data = $this->dashboard->board_values();
        return $data;
    }

    public function index()
    {
        $data1 = $this->data;
        $data2 = $this->board_values();
        $data = array_merge($data1, $data2);
        $data['page_title'] = 'Dashboard';
        $data['total_employee_active'] = $this->dashboard->countTotalEmployeeActive();

        if ($this->permission('dashboard_view')) {
            $this->load->view('dashboard', $data);
        } else {
            $this->load->view('template/dashboard_empty', $data);
        }
    }

    public function return_row_with_data()
    {
        echo $this->dashboard->list_training_experied();
    }

    public function trans_alert()
    {
        echo $this->dashboard->list_trans_alert();
    }

    public function list_notif()
    {
        $view = $this->input->post('view');
        $dept = $this->input->post('dept');
        $role = $this->session->userdata('role_id');
        echo $this->dashboard->push_notification($view, $dept, $role);
    }
}
