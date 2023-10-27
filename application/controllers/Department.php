<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load_global();
        $this->load->model('department_model', 'department');
    }

    public function view()
    {
        $this->permission_check('department_view');
        $data = $this->data;
        $data['page_title'] = 'Department List';
        $this->load->view('department/department-view', $data);
    }

    public function add()
    {
        $this->permission_check('department_add');
        $data = $this->data;
        $data['page_title'] = "Department";
        $this->load->view('department/manage', $data);
    }

    public function newdepartment()
    {
        $this->form_validation->set_rules('department', 'Department', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $result = $this->department->verify_and_save();
            echo $result;
        } else {
            echo "Please Enter Department Name";
        }
    }

    public function update($id)
    {
        $this->permission_check('department_edit');
        $data = $this->data;
        $result = $this->department->get_details($id, $data);
        $data = array_merge($data, $result);
        $data['page_title'] = "Department";
        $this->load->view('department/manage', $data);
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
        $list = $this->department->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $department) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $department->DEPT_SYS_CD;
            $row[] = $department->DEPT_NAME;
            $str2 = '<div class="btn-group" title="View Account">
                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                            Action <span class="caret"></span>
                        </a>
                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">';

            if ($this->permission('department_edit'))
                $str2 .= '<li>
                            <a title="Update Record ?" href="update/' . $department->DEPT_SYS_ID . '">
                                <i class="fa fa-fw fa-edit text-blue"></i>Edit
                            </a>
                        </li>';
            if ($this->permission('department_delete'))
                $str2 .= '<li>
                            <a style="cursor:pointer" title="Delete Record ?" onclick="delete_department(\'' . $department->DEPT_SYS_ID . '\')">
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
            "recordsTotal" => $this->department->count_all(),
            "recordsFiltered" => $this->department->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function delete_department()
    {
        $this->permission_check_with_msg('department_delete');
        $id = $this->input->post('id');
        echo $this->department->delete_department($id);
    }
}
