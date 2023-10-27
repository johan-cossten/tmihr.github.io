<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    var $table = 'VIEW_HR_STATUS';
    var $column_order = array('TRANSID', 'TRANSACTIONID', 'TRANSACTIONCD', 'CODE', 'TRANSACTION_DATE', 'DEPTID', 'DEPT', 'STATUS_NAME', 'STATUS');
    var $column_search = array('TRANSID', 'TRANSACTIONID', 'TRANSACTIONCD', 'CODE', 'TRANSACTION_DATE', 'DEPTID', 'DEPT', 'STATUS_NAME', 'STATUS');
    var $order = array('TRANSACTIONCD' => 'DESC');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $from_date = date("d-m-Y", strtotime($this->input->post('from_date')));
        $to_date = date("d-m-Y", strtotime($this->input->post('to_date')));
        $transaction = $this->input->post('transaction');
        $department = $this->input->post('department');
        $status = $this->input->post('status');
        $view_all = $this->input->post('view_all');

        if ($transaction != '') {
            $WHERE_TRANSACTION = " AND TRANSACTIONID = $transaction";
        } else {
            $WHERE_TRANSACTION = " ";
        }

        if ($status != '') {
            $WHERE_STATUS = " AND STATUS = $status";
        } else {
            $WHERE_STATUS = " ";
        }

        if ($department != '') {
            $WHERE_DEPARTMENT = " AND DEPTID = $department";
        } else {
            $WHERE_DEPARTMENT = " ";
        }

        $this->db->select($this->column_order);
        $this->db->from($this->table);
        $this->db->where("TRANSACTION_DATE >= TO_DATE('$from_date', 'DD/MM/YYYY') AND TRANSACTION_DATE <= TO_DATE('$to_date', 'DD/MM/YYYY') $WHERE_TRANSACTION$WHERE_STATUS$WHERE_DEPARTMENT");

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
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

    public function password_update($currentpass, $newpass, $data)
    {

        $query = $this->db->query("SELECT * FROM HR_USERS WHERE PASSWORD='$currentpass' AND ID=" . $data['cur_userid']);
        if ($query->num_rows() == 1) {

            $query1 = "UPDATE HR_USERS SET PASSWORD='$newpass' WHERE ID=" . $data['cur_userid'];
            if ($this->db->simple_query($query1)) {
                return "success";
            } else {
                return "failed";
            }
        } else {
            return "Invalid Current Password!";
        }
    }

    public function multi_change_status($ids, $changeto, $transaction)
    {
        $this->db->trans_begin();
        if ($transaction == 0) {
            $q1 = $this->db->query("UPDATE TBLPERF_ASSESS SET STATUS = $changeto WHERE ID IN ($ids)");
        } elseif ($transaction == 1) {
            $q1 = $this->db->query("UPDATE TBLPERF SET STATUS = $changeto WHERE ID IN ($ids)");
        } elseif ($transaction == 2) {
            $q1 = $this->db->query("UPDATE HR_EVALUATION SET STATUS = $changeto WHERE SYS_EVA_ID IN ($ids)");
        } elseif ($transaction == 3) {
            $q1 = $this->db->query("UPDATE HR_TRAIN_PLAN SET STATUS = $changeto WHERE PLN_SYS_ID IN ($ids)");
        } elseif ($transaction == 4) {
            $q1 = $this->db->query("UPDATE HR_TRAINING_RCD SET STATUS = $changeto WHERE TR_SYS_ID IN ($ids)");
        }
        if ($q1) {
            $this->db->trans_commit();
            echo "success";
        } else {
            echo "failed";
        }
    }

    public function get_department($roleid)
    {
        $q1 = $this->db->query("SELECT DEPT FROM HR_USERS WHERE ROLE_ID = $roleid");
        return $q1->result_array();
    }
}
