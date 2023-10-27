<?php
class Report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Load_global();
        $this->load->model('report_model', 'report');
    }

    public function training_plan()
    {
        $data = $this->data;
        $data['page_title'] = 'Training Plan Report';
        $this->load->view('report/training-plan', $data);
    }
}
