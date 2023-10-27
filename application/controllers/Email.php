<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        require APPPATH . 'libraries/phpmailer/src/Exception.php';
        require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH . 'libraries/phpmailer/src/SMTP.php';
    }

    public function index()
    {
        $query = $this->db->query("SELECT DISTINCT DEPTID, EMAIL FROM VIEW_HR_STATUS A INNER JOIN HR_USERS B ON A.DEPTID = B.DEPT
        WHERE B.ID <> 1  AND A.STATUS IN (1,2)");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $res) {
                $dept = $res->DEPTID;
                $email = $res->EMAIL;
                if ($dept == 1) {
                    $address = $email;
                    $subject = 'Reminde For Training Plan, Evaluation, And Performance Appraisal Status';
                    $detail = '';
                    $header = "<h3>Dear,</h3>
                        <p>Please Open Training Application, and Change Status for Training Plan, Evaluation, And Performance Appraisal</p> <br>
                        <table border='1'>
                            <thead>
                                <th>No</th>
                                <th>Transaction Type</th>
                                <th>Status</th>
                                <th>Department</th>
                                <th>Total</th>
                            </thead>";

                    $q1 = $this->db->query("SELECT COUNT(TRANSID) TOT_TRANS, TRANSACTIONCD, STATUS_NAME, DEPT 
                        FROM VIEW_HR_STATUS 
                        WHERE STATUS IN (1,2) 
                        GROUP BY TRANSACTIONCD, STATUS_NAME, DEPT ORDER BY TRANSACTIONCD ASC, DEPT ASC");
                    $i = 1;
                    if ($q1->num_rows() > 0) {
                        foreach ($q1->result() as $row) {
                            $detail .= '
                                    <tbody>
                                        <td>' . $i++ . '</td>
                                        <td>' . $row->TRANSACTIONCD . '</td>
                                        <td>' . $row->STATUS_NAME . '</td>
                                        <td>' . $row->DEPT . '</td>
                                        <td>' . $row->TOT_TRANS . '</td>
                                    </tbody>
                                ';
                        }
                    }
                    $footer = '</table>';
                    $message = $header . $detail . $footer;
                } elseif ($dept == 2) {
                    $address = $email;
                    $subject = 'Reminde For Training Plan, Evaluation, And Performance Appraisal Status';
                    $detail = '';
                    $header = "<h3>Dear,</h3>
                        <p>Please Open Training Application, and Change Status for Training Plan, Evaluation, And Performance Appraisal</p> <br>
                        <table border='1'>
                            <thead>
                                <th>No</th>
                                <th>Transaction Type</th>
                                <th>Status</th>
                                <th>Department</th>
                                <th>Total</th>
                            </thead>";

                    $q1 = $this->db->query("SELECT COUNT(TRANSID) TOT_TRANS, TRANSACTIONCD, STATUS_NAME, DEPT 
                        FROM VIEW_HR_STATUS 
                        WHERE STATUS IN (1,2)  AND DEPTID = $res->DEPTID
                        GROUP BY TRANSACTIONCD, STATUS_NAME, DEPT ORDER BY TRANSACTIONCD ASC, DEPT ASC");
                    $i = 1;
                    if ($q1->num_rows() > 0) {
                        foreach ($q1->result() as $row) {
                            $detail .= '
                                    <tbody>
                                        <td>' . $i++ . '</td>
                                        <td>' . $row->TRANSACTIONCD . '</td>
                                        <td>' . $row->STATUS_NAME . '</td>
                                        <td>' . $row->DEPT . '</td>
                                        <td>' . $row->TOT_TRANS . '</td>
                                    </tbody>
                                ';
                        }
                    }
                    $footer = '</table>';
                    $message = $header . $detail . $footer;
                }
            }
            $this->send_email($address, $message, $subject);
        }
    }

    function send_email($address, $message, $subject)
    {
        $response = false;
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host     = 'mail.teammetal.com';
        $mail->SMTPAuth = false;
        $mail->Username = 'johancossten@teammetal.com';
        $mail->Password = 'Teammetal123*';
        $mail->SMTPSecure = 'starttls';
        $mail->Port     = 26;

        $mail->setFrom('johancossten@teammetal.com', '');
        $mail->addReplyTo('johancossten@teammetal.com', '');
        $mail->addAddress($address);
        // $mail->Subject = 'Reminde For Training Plan, Evaluation, And Performance Appraisal Status';
        $mail->Subject = $subject;
        $mail->isHTML(true);

        $mail->Body = $message;
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }
}
