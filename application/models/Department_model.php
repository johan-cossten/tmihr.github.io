<?php
class Department_model extends CI_Model
{
    var $table = 'HR_DEPT';
    var $column_order = array('DEPT_SYS_ID', 'DEPT_SYS_CD', 'DEPT_NAME'); //set column field database for datatable orderable
    var $column_search = array('DEPT_SYS_ID', 'DEPT_SYS_CD', 'DEPT_NAME'); //set column field database for datatable searchable 
    var $order = array('DEPT_SYS_CD' => 'ASC'); // default order 

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select($this->column_order);
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

    public function xss_html_filter($input)
    {
        return $this->security->xss_clean(html_escape($input));
    }

    public function verify_and_save()
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));

        $query = $this->db->query("SELECT * FROM TMI.HR_DEPT WHERE UPPER(DEPT_SYS_CD)=upper('$department')");
        if ($query->num_rows() > 0) {
            return "This Department Code already Exist.";
        } else {
            $query1 = "INSERT INTO HR_DEPT (DEPT_SYS_CD, DEPT_NAME) VALUES ('$department', '$description')";
            if ($this->db->simple_query($query1)) {
                $this->session->set_flashdata('success', 'Success!! New Departmen Added Successfully!');
                return "success";
            } else {
                return "failed";
            }
        }
    }

    public function get_details($id, $data)
    {
        $query = $this->db->query("SELECT * FROM HR_DEPT WHERE UPPER(DEPT_SYS_ID)=UPPER('$id')");
        if ($query->num_rows() == 0) {
            show_404();
            exit;
        } else {
            $query = $query->row();
            $data['q_id'] = $query->DEPT_SYS_ID;
            $data['DEPT_SYS_CD'] = $query->DEPT_SYS_CD;
            $data['DEPT_NAME'] = $query->DEPT_NAME;
            return $data;
        }
    }

    public function update_category()
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));

        $query = $this->db->query("SELECT * FROM TMI.HR_DEPT WHERE UPPER(DEPT_SYS_CD) = UPPER('$department') AND DEPT_SYS_ID <> $q_id");
        if ($query->num_rows() > 0) {
            return "This Department Name already Exist.";
        } else {
            $query1 = "UPDATE TMI.HR_DEPT SET DEPT_SYS_CD = '$department', DEPT_NAME = '$description' WHERE DEPT_SYS_ID = $q_id";
            if ($this->db->simple_query($query1)) {
                $this->session->set_flashdata('success', 'Success!! Department Updated Successfully!');
                return "success";
            } else {
                return "failed";
            }
        }
    }

    public function delete_department($id)
    {
        $query1 = "DELETE FROM HR_DEPT WHERE DEPT_SYS_ID = $id";
        if ($this->db->simple_query($query1)) {
            echo "success";
            $this->session->set_flashdata('success', 'Success!! Department Deleted Succssfully!');
        } else {
            echo "failed";
        }
    }
}
