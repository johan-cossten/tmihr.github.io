<?php
class Settings extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Load_global();
        $this->load->model('settings_model', 'settings');
    }

    public function password_reset()
    {
        $data = $this->data;
        $data['page_title'] = 'Change Password';
        $this->load->view('settings/change-pass', $data);
    }

    public function password_update()
    {
        if ($this->session->userdata('username') == 'admin') {
            echo "Restricted Admin Password Change";
            exit();
        }

        $data = $this->data;
        $currentpass = $this->input->post('currentpass');
        $newpass = $this->input->post('newpass');
        $result = $this->settings->password_update(md5($currentpass), md5($newpass), $data);
        echo $result;
    }

    public function change_status()
    {
        $data = $this->data;
        // $data['department'] = $this->settings->get_department($this->session->userdata('role_id'));
        $data['page_title'] = 'Change Status';
        $this->load->view('settings/change-status', $data);
    }

    // public function show_transaction()
    // {
    //     echo $this->settings->show_transaction();
    // }

    public function ajax_list()
    {
        $list = $this->settings->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $change) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" name="checkbox[]" value=' . $change->TRANSID . ' class="checkbox column_checkbox" >';
            $row[] = $change->TRANSACTIONCD;
            $row[] = $change->CODE;
            $row[] = $change->TRANSACTION_DATE;
            $row[] = $change->DEPT;
            $row[] = $change->STATUS_NAME;
            $row[] = '<input type="hidden" name="transtype" value=' . $change->TRANSACTIONID . '>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->settings->count_all(),
            "recordsFiltered" => $this->settings->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function multi_status()
    {
        // $this->permission_check_with_msg('change_status');
        $ids = implode(",", $_POST['checkbox']);
        $changeto = $_POST['changeto'];
        $transaction = $_POST['transactionid'];
        // $transaction = implode(",", $_POST['transtype']);
        return $this->settings->multi_change_status($ids, $changeto, $transaction);
    }
}
