<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles_model extends CI_Model
{

	var $table = 'HR_ROLE';
	var $column_order = array('ROLE_NAME', 'DESCRIPTION', 'STATUS'); //set column field database for datatable orderable
	var $column_search = array('ROLE_NAME', 'DESCRIPTION', 'STATUS'); //set column field database for datatable searchable 
	var $order = array('ID' => 'DESC'); // default order 

	private function _get_datatables_query()
	{

		$this->db->from($this->table);

		$i = 0;

		foreach ($this->column_search as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}

			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	public function verify_and_save()
	{
		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));
		$query = $this->db->query("SELECT * FROM HR_ROLE WHERE UPPER(ROLE_NAME)=UPPER('$ROLE_NAME')");
		if ($query->num_rows() > 0) {
			return "This Role Name Name already Exist.";
		} else {
			$query1 = "INSERT INTO HR_ROLE(ROLE_NAME,DESCRIPTION,STATUS) VALUES('$ROLE_NAME','$DESCRIPTION',1)";
			// if ($this->db->query($query1) && $this->set_persmissions($this->db->insert_id())) {
			if ($this->db->query($query1)) {
				$q1 = "SELECT ID FROM (SELECT * FROM TMI.HR_ROLE ORDER BY ID DESC) WHERE ROWNUM < 2";
				$idrole = $this->db->query($q1);
				$r1 = $idrole->row_array();
				$role_id = $r1['ID'];
				if ($this->set_persmissions($role_id)) {
					$this->session->set_flashdata('success', 'Success!! New Role Name Added Successfully!');
					return "success";
				} else {
					return "failed";
				}
			} else {
				return "failed";
			}
		}
	}

	public function get_details($id, $data)
	{
		$query = $this->db->query("SELECT * FROM HR_ROLE WHERE UPPER(ID)=UPPER('$id')");
		if ($query->num_rows() == 0) {
			show_404();
			exit;
		} else {
			$query = $query->row();
			$data['q_id'] = $query->ID;
			$data['ROLE_NAME'] = $query->ROLE_NAME;
			$data['DESCRIPTION'] = $query->DESCRIPTION;
			$data['STATUS'] = $query->STATUS;
			return $data;
		}
	}

	public function get_permission($id, $data)
	{
		$permission_name = array();
		$query = $this->db->query("SELECT * FROM HR_PERMISSION WHERE UPPER(ROLE_ID)=UPPER('$id')");
		if ($query->num_rows() == 0) {
			show_404();
			exit;
		} else {
			// $query = $query->row();
			foreach ($query->result() as $res) {
				$permission_name[] = $res->PERMISSION;
			}
			// $data['q_id'] = $query->ID;
			$data['PERMISSION'] = $permission_name;
			return $data;
		}
	}

	public function update_role()
	{
		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));
		// $query = $this->db->query("SELECT * FROM HR_ROLE WHERE UPPER(ROLE_NAME) = UPPER('$ROLE_NAME') AND ID<>$q_id");
		// if ($query->num_rows() > 0) {
		// 	return "This Role Name Name already Exist.";
		// } else {
		$query1 = "UPDATE HR_ROLE SET DESCRIPTION='$DESCRIPTION' WHERE ID=$q_id";
		if ($this->db->simple_query($query1) && $this->set_persmissions($q_id)) {
			$this->session->set_flashdata('success', 'Success!! Role Updated Successfully!');
			return "success";
		} else {
			return "failed";
		}
		// }
	}
	public function update_status($id, $status)
	{
		if ($id == 1) {
			echo "Restricted! Can't Update this User Status!";
			exit();
		}
		$query1 = "UPDATE HR_ROLE SET STATUS='$status' WHERE ID=$id";
		if ($this->db->simple_query($query1)) {
			echo "success";
		} else {
			echo "failed";
		}
	}

	public function delete_roles_from_table($ids)
	{
		if ($ids == 1) {
			echo "Restricted! Can't Delete this User!";
			exit();
		}
		$query1 = $this->db->query("DELETE FROM HR_ROLE WHERE ID in($ids)");
		$query2 = $this->db->query("DELETE FROM HR_PERMISSION WHERE ROLE_ID in ($ids)");
		if ($query1 && $query2) {
			echo "success";
		} else {
			echo "failed";
		}
	}

	function get_selected($role_id = 0, $permissions_array)
	{
		$info = array();
		foreach ($permissions_array as $key => $value) {
			if (isset($_POST['permission'][$value])) {
				array_push($info, array('PERMISSION'  =>  $value, 'ROLE_ID'   =>  $role_id));
			}
		}
		return $info;
	}

	public function set_persmissions($role_id = 0)
	{
		//echo "<pre>"; print_r($this->security->xss_clean(html_escape(array_merge($_POST))));exit;
		$result = array();
		//PERMISSIONS KEY FROM FRONT END
		$result = ($this->get_selected($role_id, array(
			'users_add',
			'users_edit',
			'users_delete',
			'users_view',
			'users_status',
			'roles_add',
			'roles_edit',
			'roles_delete',
			'roles_view',
			'roles_status',
			'dashboard_view',
			'employee_record',
			// 'employee_evaluation',
			'employee_transfer',
			'employee_view',
			'department_add',
			'department_edit',
			'department_delete',
			'department_view',
			'department_status',
			'assessment_add',
			'assessment_edit',
			'assessment_delete',
			'assessment_view',
			'assessment_preview',
			'assessment_print',
			'assessment_status',
			'appraisal_add',
			'appraisal_edit',
			'appraisal_delete',
			'appraisal_view',
			'appraisal_preview',
			'appraisal_print',
			'appraisal_status',
			'trainingrecord_add',
			'trainingrecord_edit',
			'trainingrecord_delete',
			'trainingrecord_view',
			'trainingrecord_preview',
			'trainingrecord_print',
			'trainingrecord_status',
			'trainingplan_add',
			'trainingplan_view',
			'trainingplan_edit',
			'trainingplan_delete',
			'trainingplan_preview',
			'trainingplan_print',
			'trainingplan_status',
			'trainingevaluation_add',
			'trainingevaluation_edit',
			'trainingevaluation_delete',
			'trainingevaluation_view',
			'trainingevaluation_print',
			'trainingevaluation_preview',
			'trainingevaluation_status',
			'report_trainingplan',
		)));



		//BEFORE SAVING DELETE ALL PERSMISSIONS OF THE SPESIFIED ROLE
		$this->db->delete('HR_PERMISSION', array('ROLE_ID' => $role_id));

		//SAVE PERSMISSIONS
		$q1 = $this->db->insert_batch('HR_PERMISSION', $result);
		if (!$q1) {
			return false;
		}
		return true;
	}
}
