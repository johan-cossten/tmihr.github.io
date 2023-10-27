<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appraisal extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load_global();
        $this->load->model('appraisal_model', 'appraisal');
    }

    public function index()
    {
        $this->permission_check('appraisal_view');
        $data = $this->data;
        $data['page_title'] = 'Appraisal List';
        $this->load->view('appraisal/view', $data);
    }

    public function add()
    {
        $this->permission_check('appraisal_add');
        $data = $this->data;
        $data['page_title'] = "Appraisal";
        $this->load->view('appraisal/manage', $data);
    }

    public function newappraisal()
    {
        $this->form_validation->set_rules('EMPLOYEEID', 'Employee', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $result = $this->appraisal->verify_and_save();
            echo $result;
        } else {
            echo "Please Enter Employee Name";
        }
    }

    public function update($id)
    {
        $this->permission_check('appraisal_edit');
        $data = $this->data;
        $result = $this->appraisal->get_details($id, $data);
        $data = array_merge($data, $result);
        $data['page_title'] = "Appraisal";
        $this->load->view('appraisal/manage', $data);
    }

    public function update_appraisal()
    {
        $this->form_validation->set_rules('EMPLOYEE', 'Employee', 'trim|required');
        $this->form_validation->set_rules('q_id', '', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $result = $this->appraisal->update_appraisal();
            echo $result;
        } else {
            echo "Please Enter Employee Code.";
        }
    }

    public function ajax_list()
    {
        $list = $this->appraisal->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $appraisal) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date("d-m-Y", strtotime($appraisal->PERF_DATE));
            $row[] = $appraisal->CODE;
            $row[] = $this->appraisal->employee_name($appraisal->EMPLOYEEID);

            if ($appraisal->TYPE == 0) {
                $str = '<span class="label label-info" style="cursor:pointer">Group A, B, C </span>';
            } else {
                $str = '<span class="label label-warning" style="cursor:pointer">Group D, E, F </span>';
            }
            $row[] = $str;
            $str1 = "<span class='label label-primary' style=''>$appraisal->STATUS_NAME</span>";
            $row[] = $str1;

            $str2 = '<div class="btn-group" title="View Account">
                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                            Action <span class="caret"></span>
                        </a>
                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">';
            if ($this->permission('appraisal_preview'))
                $str2 .= '<li>
                            <a title="Preview Record ?" href="appraisal/preview/' . $appraisal->ID . '">
                                <i class="fa fa-fw fa-eye text-blue"></i>Preview
                            </a>
                        </li>';
            if ($this->permission('appraisal_edit'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Update Record ?" onclick="update_appraisal(\'' . $appraisal->ID . '\', \'' . $appraisal->STATUS . '\')">
                                <i class="fa fa-fw fa-edit text-blue"></i>Edit
                            </a>
                        </li>';
            if ($this->permission('appraisal_status'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Update Record ?" onclick="status_appraisal(\'' . $appraisal->ID . '\', \'' . $appraisal->STATUS . '\')">
                                <i class="fa fa-hourglass-2 text-blue"></i>Change Status
                            </a>
                        </li>';
            if ($this->permission('appraisal_delete'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Delete Record ?" onclick="delete_appraisal(\'' . $appraisal->ID . '\', \'' . $appraisal->STATUS . '\')">
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
            "recordsTotal" => $this->appraisal->count_all(),
            "recordsFiltered" => $this->appraisal->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function delete_appraisal()
    {
        $this->permission_check_with_msg('appraisal_delete');
        $id = $this->input->post('id');
        echo $this->appraisal->delete_appraisal($id);
    }

    public function preview($id)
    {
        if (!$this->permission('appraisal_view') && !$this->permission('appraisal_preview')) {
            $this->show_access_denied_page();
        }
        $data1 = $this->data;
        $data1 = array_merge($data1, array('id' => $id));
        $data2 = $this->appraisal->get_data_preview($id);
        $data = array_merge($data1, $data2);
        $data['page_title'] = 'Perfomance Appraisal';
        $this->load->view('appraisal/preview', $data);
    }

    public function update_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->appraisal->update_status($id, $status);
        return $result;
    }

    public function view_appraisal_modal()
    {
        $this->permission_check_with_msg('appraisal_status');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        echo $this->appraisal->view_appraisal_modal($id, $status);
    }

    public function status_appraisal()
    {
        $this->permission_check_with_msg('appraisal_status');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->appraisal->status_appraisal($id, $status);
        return $result;
    }
}
