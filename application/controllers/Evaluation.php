<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluation extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load_global();
        $this->load->model('evaluation_model', 'evaluation');
    }

    public function index()
    {
        $this->permission_check('trainingevaluation_view');
        $data = $this->data;
        $data['eva_data'] = $this->evaluation->getData();
        // $data = array_merge($data1, $data2);
        $data['page_title'] = 'Training Evaluation List';
        $this->load->view('evaluation/evaluation-view', $data);
    }

    public function add()
    {
        $this->permission_check('trainingevaluation_add');
        $data = $this->data;
        $data['page_title'] = "Training Evaluation";
        $this->load->view('evaluation/manage', $data);
    }

    public function gettopic()
    {
        $this->permission_check_with_msg('trainingevaluation_add');
        echo $this->evaluation->gettopic();
    }

    public function get_duration()
    {
        $this->permission_check_with_msg('trainingevaluation_add');
        echo $this->evaluation->get_duration();
    }

    public function newevaluation()
    {
        $id = $this->input->post('command');
        if ($id == '') {
            $this->form_validation->set_rules('EMP_CODE', 'EMP_CODE', 'trim|required');
            $this->form_validation->set_rules('PLN_SYS_ID', 'PLN_SYS_ID', 'trim|required');
        } else {
            $this->form_validation->set_rules('PLN_SYS_ID', 'PLN_SYS_ID', 'trim|required');
        }
        if ($this->form_validation->run() == TRUE) {
            $result = $this->evaluation->verify_and_save();
            echo $result;
        } else {
            echo "Please Enter Employee Name";
        }
    }

    public function update($id)
    {
        $this->permission_check('trainingevaluation_edit');
        $data = $this->data;
        $result = $this->evaluation->get_details($id, $data);
        $data = array_merge($data, $result);
        $data['page_title'] = "Training Evaluation";
        $this->load->view('evaluation/manage', $data);
    }

    public function preview($id)
    {
        if (!$this->permission('trainingevaluation_preview')) {
            $this->show_access_denied_page();
        }
        $data = $this->data;
        $result = $this->evaluation->get_preview($id, $data);
        $data = array_merge($data, $result);
        $data['page_title'] = 'Training Evaluation';
        $this->load->view('evaluation/preview', $data);
    }

    public function ajax_list()
    {
        $list = $this->evaluation->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $evaluation) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date('d-m-Y', strtotime($evaluation->SYS_EVA_DT));
            $row[] = $evaluation->SYS_EVA_CODE;
            $row[] = $evaluation->EMP_NAME;
            $row[] = $evaluation->EMP_DEPT;
            $row[] = $evaluation->PLN_TOPIC;
            $str = "<span class='label label-primary' style=''>$evaluation->STATUS_NAME</span>";
            $row[] = $str;

            $str2 = '<div class="btn-group" title="View Account">
                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                            Action <span class="caret"></span>
                        </a>
                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">';
            if ($this->permission('trainingevaluation_edit'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Update Record ?" onclick="update_evaluation(\'' . $evaluation->SYS_EVA_ID . '\', \'' . $evaluation->STATUS . '\')">
                                <i class="fa fa-fw fa-edit text-blue"></i>Edit
                            </a>';
            if ($this->permission('trainingevaluation_preview'))
                $str2 .= '<li>
                        <a title="Preview Record ?" href="evaluation/preview/' . $evaluation->SYS_EVA_ID . '">
                            <i class="fa fa-fw fa-eye text-blue"></i>Preview
                        </a>
                    </li>';
            if ($this->permission('trainingevaluation_status'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Update Record ?" onclick="status_evaluation(\'' . $evaluation->SYS_EVA_ID . '\', \'' . $evaluation->STATUS . '\')">
                                <i class="fa fa-hourglass-2 text-blue"></i>Change Status
                            </a>
                        </li>';
            if ($this->permission('trainingevaluation_delete'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Delete Record ?" onclick="delete_evaluation(\'' . $evaluation->SYS_EVA_ID . '\', \'' . $evaluation->STATUS . '\')">
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
            "recordsTotal" => $this->evaluation->count_all(),
            "recordsFiltered" => $this->evaluation->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function delete_evaluation()
    {
        $this->permission_check_with_msg('trainingevaluation_delete');
        $id = $this->input->post('q_id');
        echo $this->evaluation->delete_evaluation($id);
    }

    public function update_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->evaluation->update_status($id, $status);
        return $result;
    }

    public function view_evaluation_modal()
    {
        $this->permission_check_with_msg('trainingevaluation_status');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        echo $this->evaluation->view_evaluation_modal($id, $status);
    }

    public function status_evaluation()
    {
        $this->permission_check_with_msg('trainingevaluation_status');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->evaluation->status_evaluation($id, $status);
        return $result;
    }
}
