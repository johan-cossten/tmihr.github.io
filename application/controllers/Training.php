<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Training extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load_global();
        $this->load->model('training_model', 'training');
        $this->db2 = $this->load->database('tmi_ext', true);
    }

    public function index()
    {
        $this->permission_check('trainingrecord_view');
        $data = $this->data;
        $data['page_title'] = 'Training Record List';
        $this->load->view('training/view', $data);
    }

    public function add()
    {
        $this->permission_check('trainingrecord_add');
        $data = $this->data;
        $data['page_title'] = "Training Record";
        $this->load->view('training/manage', $data);
    }

    public function newtrainingrecord()
    {
        $this->form_validation->set_rules('PLN_SYS_ID', 'PLN_SYS_ID', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $result = $this->training->verify_and_save();
            echo $result;
        } else {
            echo "Please Enter Training Record Name";
        }
    }

    public function update($id)
    {
        $this->permission_check('trainingrecord_edit');
        $data = $this->data;
        $result = $this->training->get_details($id, $data);
        $data = array_merge($data, $result);
        $data['page_title'] = "Training Record";
        $this->load->view('training/manage', $data);
    }

    public function ajax_list()
    {
        $list = $this->training->get_datatables();
        $data = array();
        $badged = array();
        $no = $_POST['start'];

        foreach ($list as $training) {
            $badged =  $training->EMPLOYEE;
            $q1 = $this->db2->query("SELECT OVT_NAME_EMP, OVT_DEPT_EMP FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_BADGED IN ($badged)");
            $array = $q1->result_array();
            $employee = array_column($array, "OVT_NAME_EMP");

            $q2 = $this->db2->query("SELECT DISTINCT OVT_DEPT_EMP FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_BADGED IN ($badged)");
            $array1 = $q2->result_array();
            $dept = array_column($array1, "OVT_DEPT_EMP");

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $training->TR_SYS_CODE;
            $row[] = $training->PLN_TOPIC;
            $row[] = $employee;
            $row[] = $dept;
            // $row[] = implode(", ", $employee);
            $row[] = date("d-m-Y", strtotime($training->TR_ST_DT));
            $row[] = $training->PLN_YEAR;

            $str = "<span class='label label-primary' style=''>$training->STATUS_NAME</span>";
            $row[] = $str;

            // if ($training->STATUS == 0) {
            //     $str = "<span onclick='update_status(" . $training->TR_SYS_ID . ",1)' id='span_" . $training->TR_SYS_ID . "'  class='label label-primary' style='cursor:pointer'>Entry </span>";
            // } elseif ($training->STATUS == 1) {
            //     $str = "<span onclick='update_status(" . $training->TR_SYS_ID . ",5)' id='span_" . $training->TR_SYS_ID . "'  class='label label-success' style='cursor:pointer'>Approve </span>";
            // } else {
            //     $str = "<span class='label label-danger' style=''>Close </span>";
            // }

            // $row[] = $str;

            $str2 = '<div class="btn-group" title="View Account">
                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                            Action <span class="caret"></span>
                        </a>
                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">';
            if ($this->permission('trainingrecord_edit'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Update Record ?" onclick="update_training(\'' . $training->TR_SYS_ID . '\', \'' . $training->STATUS . '\')">
                                <i class="fa fa-fw fa-edit text-blue"></i>Edit
                            </a>
                        </li>';
            if ($this->permission('trainingrecord_status'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Update Record ?" onclick="status_training(\'' . $training->PLN_SYS_ID . '\', \'' . $training->STATUS . '\')">
                                <i class="fa fa-hourglass-2 text-blue"></i>Change Status
                            </a>
                        </li>';
            if ($this->permission('trainingrecord_delete'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Delete Record ?" onclick="delete_training(\'' . $training->TR_SYS_ID . '\')">
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
            "recordsTotal" => $this->training->count_all(),
            "recordsFiltered" => $this->training->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function delete_training()
    {
        $this->permission_check_with_msg('trainingrecord_delete');
        $id = $this->input->post('id');
        echo $this->training->delete_training($id);
    }

    public function update_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->training->update_status($id, $status);
        return $result;
    }

    public function preview($id)
    {
        if (!$this->permission('trainingrecord_view') && !$this->permission('trainingrecord_preview')) {
            $this->show_access_denied_page();
        }
        $data1 = $this->data;
        $data1 = array_merge($data1, array('id' => $id));
        $data2 = $this->training->get_data_preview($id);
        $data = array_merge($data1, $data2);
        $data['page_title'] = 'Perfomance Training Record';
        $this->load->view('training/preview', $data);
    }

    public function get_plan()
    {
        $this->permission_check_with_msg('trainingrecord_view');
        echo $this->training->get_plan();
    }

    public function view_training_modal()
    {
        $this->permission_check_with_msg('trainingrecord_status');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        echo $this->training->view_training_modal($id, $status);
    }

    public function status_training()
    {
        $this->permission_check_with_msg('trainingrecord_status');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->training->status_training($id, $status);
        return $result;
    }
}
