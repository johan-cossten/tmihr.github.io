<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Planning extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load_global();
        $this->load->model('planning_model', 'planning');
    }

    public function index()
    {
        $this->permission_check('trainingplan_view');
        $data = $this->data;
        $data['page_title'] = 'Training Planning List';
        $this->load->view('planning/plan-view', $data);
    }

    public function add()
    {
        $this->permission_check('trainingplan_add');
        $data = $this->data;
        $data['page_title'] = "Training Planning";
        $this->load->view('planning/manage', $data);
    }

    public function newplanning()
    {
        $this->form_validation->set_rules('PLN_DEPT', 'PLN_DEPT', 'trim|required');
        $this->form_validation->set_rules('PLN_PLAN_QTY', 'PLN_PLAN_QTY', 'trim|required');
        $this->form_validation->set_rules('PLN_PLAN_UNIT', 'PLN_PLAN_UNIT', 'trim|required');
        $this->form_validation->set_rules('PLN_TOPIC', 'PLN_TOPIC', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $result = $this->planning->verify_and_save();
            echo $result;
        } else {
            echo "You have Missed Something to Fillup!";
        }
    }

    public function update($id)
    {
        $this->permission_check('trainingplan_edit');
        $data = $this->data;
        $result = $this->planning->get_details($id, $data);
        $data = array_merge($data, $result);
        $data['page_title'] = "Training Planning";
        $this->load->view('planning/manage', $data);
    }

    public function preview($id)
    {
        if (!$this->permission('trainingplan_preview')) {
            $this->show_access_denied_page();
        }
        $data = $this->data;
        $result = $this->planning->get_preview($id, $data);
        $data = array_merge($data, $result);
        $data['page_title'] = 'Training Planning';
        $this->load->view('planning/preview', $data);
    }

    public function ajax_list()
    {
        $list = $this->planning->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $planning) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $planning->PLN_YEAR;
            $row[] = $planning->PLN_SYS_CD;
            $row[] = $planning->PLN_TOPIC;
            $row[] = $planning->DEPT_NAME;
            // $row[] = $planning->STATUS_NAME;
            $str = "<span class='label label-primary' style=''>$planning->STATUS_NAME</span>";
            $row[] = $str;
            // if ($planning->STATUS == 0) {
            //     $str = "<span id='span_" . $planning->PLN_SYS_ID . "'  class='label label-primary' style='cursor:pointer'>Entry </span>";
            // } elseif ($planning->STATUS == 1) {
            //     $str = "<span id='span_" . $planning->PLN_SYS_ID . "'  class='label label-success' style='cursor:pointer'>Approve </span>";
            // } else {
            //     $str = "<span class='label label-danger' style=''>Close </span>";
            // }

            // $row[] = $str;

            $str2 = '<div class="btn-group" title="View Account">
                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                            Action <span class="caret"></span>
                        </a>
                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">';

            if ($this->permission('trainingplan_edit'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Update Record ?" onclick="update_planning(\'' . $planning->PLN_SYS_ID . '\', \'' . $planning->STATUS . '\')">
                                <i class="fa fa-fw fa-edit text-blue"></i>Edit
                            </a>
                        </li>';
            if ($this->permission('trainingplan_status'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Update Record ?" onclick="status_planning(\'' . $planning->PLN_SYS_ID . '\', \'' . $planning->STATUS . '\')">
                                <i class="fa fa-hourglass-2 text-blue"></i>Change Status
                            </a>
                        </li>';
            if ($this->permission('trainingplan_delete'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Delete Record ?" onclick="delete_planning(\'' . $planning->PLN_SYS_ID . '\', \'' . $planning->STATUS . '\')">
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
            "recordsTotal" => $this->planning->count_all(),
            "recordsFiltered" => $this->planning->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function delete_planning()
    {
        $this->permission_check_with_msg('trainingplan_delete');
        $id = $this->input->post('q_id');
        echo $this->planning->delete_planning($id);
    }

    public function update_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->planning->update_status($id, $status);
        return $result;
    }

    public function view_planning_modal()
    {
        $this->permission_check_with_msg('trainingplan_status');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        echo $this->planning->view_planning_modal($id, $status);
    }

    public function status_planning()
    {
        $this->permission_check_with_msg('trainingplan_status');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->planning->status_planning($id, $status);
        return $result;
    }
}
