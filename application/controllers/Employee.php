<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load_global();
        $this->load->model('employee_model', 'employee');
    }

    public function view()
    {
        $this->permission_check('employee_view');
        $data = $this->data;
        $data['page_title'] = 'Employee List';
        $this->load->view('employee/employee-view', $data);
    }

    public function training_record($id)
    {
        if (!$this->permission('employee_view') && !$this->permission('employee_record')) {
            $this->show_access_denied_page();
        }
        $data = $this->data;
        $data = array_merge($data, array('id' => $id));
        $data['page_title'] = 'Training Record';
        $this->load->view('employee/employee-record', $data);
    }

    public function ajax_list()
    {
        $list = $this->employee->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $employee) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $employee->OVT_BADGED;
            $row[] = $employee->OVT_NAME_EMP;
            $row[] = $employee->OVT_DEPT_EMP;
            if ($employee->OVT_CODE == 'D') {
                $str = "<span class='label label-danger'>Inactive </span>";
            } else {
                $str = "<span class='label label-success'>Active </span>";
            }

            $row[] = $str;
            $row[] = $employee->OVT_POSITION;

            $str2 = '<div class="btn-group" title="View Account">
                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                            Action <span class="caret"></span>
                        </a>
                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">';
            if ($this->permission('employee_record'))
                $str2 .= '<li>
                            <a title="Preview Training Record ?" href="training_record/' . $employee->OVT_BADGED . '">
                            <i class="fa fa-fw fa-eye text-blue"></i>Preview Training Record
                            </a>
                        </li>';
            if ($this->permission('employee_transfer'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Transfer Training ?" onclick="transfer(' . $employee->OVT_BADGED . ')" >
                            <i class="fa fa-fw fa-exchange text-blue"></i>Transfer Training
                            </a>
                        </li>
                        
                    </ul>
                </div>';
            $row[] =  $str2;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->count_all(),
            "recordsFiltered" => $this->employee->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function view_transfer_modal()
    {
        $this->permission_check_with_msg('employee_view');
        $id = $this->input->post('id');
        echo $this->employee->view_transfer_modal($id);
    }

    public function save_transfer()
    {
        $this->permission_check_with_msg('employee_transfer');
        echo $this->employee->save_transfer();
    }

    public function view_evaluation_modal()
    {
        $this->permission_check_with_msg('employee_view');
        $badged = $this->input->post('id');
        echo $this->employee->view_evaluation_modal($badged);
    }

    public function get_duration()
    {
        $this->permission_check_with_msg('employee_evaluation');
        echo $this->employee->get_duration();
    }

    public function preview_evaluation()
    {
        $this->permission_check_with_msg('employee_evaluation');
        $data = $this->data;
        $id = $this->input->post('id');
        $name = $this->input->post('employee_name');
        $department = $this->input->post('department');
        $topic = $this->input->post('topic_id');
        $conducted = $this->input->post('conducted');
        $cost = $this->input->post('cost_con');
        $fr_date = $this->input->post('fr_date');
        $to_date = $this->input->post('to_date');
        $data1 = array_merge($data, array('id' => $id, 'name' => $name, 'department' => $department, 'topic' => $topic, 'conducted' => $conducted, 'cost' => $cost, 'fr_date' => $fr_date, 'to_date' => $to_date));
        $data2 = $this->employee->preview_evaluation();
        $data = array_merge($data1, $data2);

        $data['page_title'] = 'Training Evaluation';
        $this->load->view('employee/employee-evaluation', $data);
    }
}
