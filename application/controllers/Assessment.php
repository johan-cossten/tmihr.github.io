<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load_global();
        $this->load->model('assessment_model', 'assessment');
    }

    public function index()
    {
        $this->permission_check('assessment_view');
        $data = $this->data;
        $data['page_title'] = 'Assessment List';
        $this->load->view('assessment/view', $data);
    }

    public function add()
    {
        $this->permission_check('assessment_add');
        $data = $this->data;
        $data['page_title'] = "Assessment";
        $this->load->view('assessment/manage', $data);
    }

    public function newassessment()
    {
        $this->form_validation->set_rules('employeeid', 'Employee', 'trim|required');
        $this->form_validation->set_rules('PURPOSE', 'PURPOSE', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $result = $this->assessment->verify_and_save();
            echo $result;
        } else {
            echo "Please Enter Assessment Name";
        }
    }

    public function update($id)
    {
        $this->permission_check('assessment_edit');
        $data = $this->data;
        $result = $this->assessment->get_details($id, $data);
        $data = array_merge($data, $result);
        $data['page_title'] = "Assessment";
        $this->load->view('assessment/manage', $data);
    }

    public function update_departmnet()
    {
        $this->form_validation->set_rules('department', 'Department', 'trim|required');
        $this->form_validation->set_rules('q_id', '', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $result = $this->departmen_model->update_departmnet();
            echo $result;
        } else {
            echo "Please Enter Department Code.";
        }
    }

    public function ajax_list()
    {
        $list = $this->assessment->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $assessment) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date("d-m-Y", strtotime($assessment->DATEASSESS));
            $row[] = $assessment->CODE;
            $row[] = $this->assessment->employee_name($assessment->EMPLOYEEID);

            if ($assessment->PURPOSE == 0) {
                $str = '<span  class="label label-default" disabled="disabled">Annual</span>';
            } elseif ($assessment->PURPOSE == 1) {
                $str = '<span class="label label-info">Promotion </span>';
            } else {
                $str = '<span class="label label-warning"> Other </span>';
            }

            $row[] = $str;

            $str1 = "<span class='label label-primary' style=''>$assessment->STATUS_NAME</span>";
            $row[] = $str1;

            $str2 = '<div class="btn-group" title="View Account">
                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                            Action <span class="caret"></span>
                        </a>
                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">';
            if ($this->permission('assessment_preview'))
                $str2 .= '<li>
                            <a title="Preview Record ?" href="assessment/preview/' . $assessment->ID . '">
                                <i class="fa fa-fw fa-eye text-blue"></i>Preview
                            </a>
                        </li>';
            if ($this->permission('assessment_edit'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Update Record ?" onclick="update_assessment(\'' . $assessment->ID . '\', \'' . $assessment->STATUS . '\')">
                                <i class="fa fa-fw fa-edit text-blue"></i>Edit
                            </a>
                        </li>';
            if ($this->permission('assessment_status'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Update Record ?" onclick="status_assessment(\'' . $assessment->ID . '\', \'' . $assessment->STATUS . '\')">
                                <i class="fa fa-hourglass-2 text-blue"></i>Change Status
                            </a>
                        </li>';
            if ($this->permission('assessment_delete'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Delete Record ?" onclick="delete_assessment(\'' . $assessment->ID . '\', \'' . $assessment->STATUS . '\')">
                                <i class="fa fa-fw fa-trash text-red"></i>Delete
                            </a>
                        </li>	                                                                                   
                    </ul>
                </div>';

            $row[] =  $str2;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->assessment->count_all(),
            "recordsFiltered" => $this->assessment->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function delete_assessment()
    {
        $this->permission_check_with_msg('assessment_delete');
        $id = $this->input->post('id');
        echo $this->assessment->delete_assessment($id);
    }

    public function preview($id)
    {
        if (!$this->permission('assessment_view') && !$this->permission('assessment_preview')) {
            $this->show_access_denied_page();
        }
        $data1 = $this->data;
        $data1 = array_merge($data1, array('id' => $id));
        $data2 = $this->assessment->get_data_preview($id);
        $data = array_merge($data1, $data2);
        $data['page_title'] = 'Perfomance Assessment';
        $this->load->view('assessment/preview', $data);
    }

    public function update_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->assessment->update_status($id, $status);
        return $result;
    }

    public function view_assessment_modal()
    {
        $this->permission_check_with_msg('assessment_status');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        echo $this->assessment->view_assessment_modal($id, $status);
    }

    public function status_assessment()
    {
        $this->permission_check_with_msg('assessment_status');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->assessment->status_assessment($id, $status);
        return $result;
    }
}
