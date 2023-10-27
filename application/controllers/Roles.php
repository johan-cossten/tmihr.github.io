<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load_global();
		$this->load->model('roles_model', 'roles');
	}

	public function adds()
	{
		$this->permission_check('roles_add');
		$data = $this->data;
		$data['page_title'] = "New Role";
		$this->load->view('roles/role', $data);
	}
	public function newrole()
	{
		$this->form_validation->set_rules('ROLE_NAME', 'Role Name', 'trim|required');
		if ($this->form_validation->run() == TRUE) {

			$this->load->model('roles_model');
			$result = $this->roles_model->verify_and_save();
			echo $result;
		} else {
			echo "You have Missed Something to Fillup!";
		}
	}
	public function update($id)
	{
		if ($id == 11) {
			$this->session->set_flashdata('error', "Restricted!! Admin Permissions Can't Update!");
			redirect(base_url('roles/view'), 'refresh');
		}
		$this->permission_check('roles_edit');
		$data = $this->data;

		$this->load->model('roles_model');
		$result = $this->roles_model->get_details($id, $data);
		$result1 = $this->roles_model->get_permission($id, $data);
		$data = array_merge($data, $result);
		$data['page_title'] = 'Role';
		$data['permissionrole'] = $result1;
		$this->load->view('roles/role', $data);
	}

	public function update_role()
	{
		$this->form_validation->set_rules('ROLE_NAME', 'Role Name', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$this->load->model('roles_model');
			$result = $this->roles->update_role();
			echo $result;
		} else {
			echo "Please Enter Role Name.";
		}
	}
	public function view()
	{
		$this->permission_check('roles_view');
		$data = $this->data;
		$data['page_title'] = "Role List";
		$this->load->view('roles/roles-list', $data);
	}

	public function ajax_list()
	{
		$list = $this->roles->get_datatables();

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $roles) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $roles->ROLE_NAME;
			$row[] = $roles->DESCRIPTION;
			if ($roles->ID == 1) {
				$str = "<span class='label label-warning' style=''> Restricted </span>";
			} else {
				if ($roles->STATUS == 1) {
					$str = "<span onclick='update_status(" . $roles->ID . ",0)' id='span_" . $roles->ID . "'  class='label label-success' style='cursor:pointer'>Active </span>";
				} else {
					$str = "<span onclick='update_status(" . $roles->ID . ",1)' id='span_" . $roles->ID . "'  class='label label-danger' style='cursor:pointer'> Inactive </span>";
				}
			}

			$row[] = $str;

			$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

			if ($this->permission('roles_edit'))
				$str2 .= '<li>
												<a title="Edit Record ?" href="update/' . $roles->ID . '">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';

			if ($this->permission('roles_delete'))
				$str2 .= '<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_roles(' . $roles->ID . ')">
													<i class="fa fa-fw fa-trash text-red"></i>Delete
												</a>
											</li>
											
										</ul>
									</div>';

			$row[] = ($roles->ID == 11) ? '--' : $str2;


			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->roles->count_all(),
			"recordsFiltered" => $this->roles->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function update_status()
	{
		$this->permission_check_with_msg('roles_edit');
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$this->load->model('roles_model');
		$result = $this->roles_model->update_status($id, $status);
		return $result;
	}

	public function delete_roles()
	{
		$this->permission_check_with_msg('roles_delete');
		$id = $this->input->post('q_id');
		return $this->roles->delete_roles_from_table($id);
	}
	public function multi_delete()
	{
		$this->permission_check_with_msg('roles_delete');
		$ids = implode(",", $_POST['checkbox']);
		return $this->roles->delete_roles_from_table($ids);
	}
}
