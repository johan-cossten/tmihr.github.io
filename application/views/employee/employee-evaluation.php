<?php $this->db2 = $this->load->database('tmi_ext', true); ?>
<?php extract(array_merge($this->data, $_POST, $_GET));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("template/css-form"); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view("template/sidebar"); ?>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <?php $this->load->view("template/flashdata"); ?>
                </div>
            </div>
            <section class="invoice">
                <!-- title row -->
                <div class="printableArea">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> Training Evaluation
                            </h2>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-xs-12 invoice-col" id="preview_data">
                            <style>
                                BODY,
                                DIV,
                                table,
                                THEAD,
                                TBODY,
                                TFOOT,
                                TR,
                                TH,
                                TD,
                                P {
                                    font-family: "Arial";
                                    font-size: small
                                }
                            </style>
                            <table frame=void cellspacing=0 cols=0 rules=none border=0>
                                <colgroup>
                                    <col width=56>
                                    <col width=53>
                                    <col width=59>
                                    <col width=95>
                                    <col width=42>
                                    <col width=86>
                                    <col width=41>
                                    <col width=53>
                                    <col width=41>
                                    <col width=30>
                                    <col width=40>
                                    <col width=86>
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td colspan=4 rowspan=4 width=263 height=69 align=left>
                                            <img src="http://192.168.1.149/app_hr/theme/images/tmi/images.jpg" class="user-image" alt="Logo Company" width=174 height=39>
                                        </td>
                                        <td width=42 align=left></td>
                                        <td width=86 align=left></td>
                                        <td width=41 align=left></td>
                                        <td width=53 align=left></td>
                                        <td width=41 align=left></td>
                                        <td width=30 align=left></td>
                                        <td width=40 align=left></td>
                                        <td width=86 align=left></td>
                                    </tr>
                                    <tr>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=20 align=left></td>
                                        <td align=left></td>
                                        <td align=left><B><U>
                                                    <FONT FACE="Bahnschrift" SIZE=3>
                                                </U></B></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=5 height=20 align=left><B><U>
                                                    <FONT FACE="Bahnschrift" SIZE=3>TRAINING EVALUATION
                                                </U></B></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=20 align=left><B><U>
                                                    <FONT FACE="Bahnschrift" SIZE=3>
                                                </U></B></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 height=17 align=left>
                                            Name of Staff :
                                        </td>
                                        <td colspan=3 style="border-bottom: 1px solid #000000" align=left>
                                            <?= isset($employee_name) ? $employee_name : '' ?>
                                        </td>
                                        <td align=left></td>
                                        <td colspan=2 align=left>
                                            Department :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=3 align=left>
                                            <?= isset($department) ? $department : '' ?>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=3 height=17 align=left>
                                            Course / Training Title :
                                        </td>
                                        <td colspan=9 style="border-bottom: 1px solid #000000" align=left>
                                            <?= isset($topiccd) ? $topiccd : '' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 height=17 align=left>
                                            Conducted by :
                                        </td>
                                        <td colspan=3 style="border-bottom: 1px solid #000000" align=left>
                                            <?= isset($conducted) ? $conducted : '' ?>
                                        </td>
                                        <td align=left>

                                        </td>
                                        <td colspan=2 align=left>
                                            Cost (if any) :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=3 align=left>
                                            <?= isset($cost) ? $cost : '-' ?>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" align=left>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 height=17 align=left>Duration :</td>
                                        <td colspan=2 style="border-bottom: 1px solid #000000" align=left>
                                            <?= isset($qty) || isset($unit) ? $qty . ' ' . $unit : '' ?>
                                        </td>
                                        <td align=left>(from)</td>
                                        <td colspan=2 style="border-bottom: 1px solid #000000" colspan=2 align=left>
                                            <?= isset($fr_date) ? date('d-m-y', strtotime($fr_date)) : '' ?>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" align=left></td>
                                        <td align=center>(to)</td>
                                        <td align=center></td>
                                        <td colspan=3 style="border-bottom: 1px solid #000000" align=left>
                                            <?= isset($to_date) ? date('d-m-y', strtotime($to_date)) : '' ?>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=18 align=left><B>
                                                I.
                                            </B></td>
                                        <td colspan=4 align=left><B>
                                                Post Training / Course Comments
                                            </B></td>
                                        <td colspan=7 align=left>
                                            <FONT FACE="Bahnschrift" SIZE=1>(pls evaluate within 1 working week from date of completion)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=8 height=19 align=left>
                                            Was the cource content appropriate to the knowledge that you are seeking?
                                        </td>
                                        <td align=left>
                                            Yes
                                        </td>
                                        <td align=left>
                                            <FONT FACE="Wingdings">&uml;
                                        </td>
                                        <td align=left>
                                            No
                                        </td>
                                        <td align=left>
                                            <FONT FACE="Wingdings">&uml;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=3 height=17 align=left>
                                            If &ldquo;No&rdquo;, please comment :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=9 align=left></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #000000" colspan=12 height=17 align=left></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #000000" colspan=12 height=17 align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=8 height=19 align=left>
                                            Are you confident that the knowledge gained will be useful to your work ?
                                        </td>
                                        <td align=left>
                                            Yes
                                        </td>
                                        <td align=left>
                                            <FONT FACE="Wingdings">&uml;
                                        </td>
                                        <td align=left>
                                            No
                                        </td>
                                        <td align=left>
                                            <FONT FACE="Wingdings">&uml;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=3 height=17 align=left>
                                            If &ldquo;No&rdquo;, please comment :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=9 align=left></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #000000" colspan=12 height=17 align=left></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #000000" colspan=12 height=17 align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 height=17 align=left>
                                            Name of Staff :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=3 align=left>
                                            <?= isset($employee_name) ? $employee_name : '' ?>
                                        </td>
                                        <td align=left></td>
                                        <td colspan=3 align=left>
                                            Name of Evaluator :
                                        </td>
                                        <td align=left></td>
                                        <td style="border-bottom: 1px solid #000000" colspan=2 align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 height=17 align=left>
                                            Staff Signature :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=3 align=left></td>
                                        <td align=left></td>
                                        <td colspan=3 align=left>
                                            Evaluator Signature:
                                        </td>
                                        <td align=left></td>
                                        <td style="border-bottom: 1px solid #000000" colspan=2 align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left>
                                            Date :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=3 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left>
                                            Date :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=4 align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=18 align=left><B>
                                                II.
                                            </B></td>
                                        <td colspan=5 align=left><B>
                                                Evaluation of Effectiveness of Training / Course
                                            </B></td>
                                        <td colspan=6 align=left>
                                            <FONT FACE="Bahnschrift" SIZE=1>(pls evaluate within 1-3 month from above date)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=5 height=17 align=left>
                                            Evaluator, please rate the staff's performance :
                                        </td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=19 align=left></td>
                                        <td align=left>
                                            <FONT FACE="Wingdings">&uml;
                                        </td>
                                        <td colspan=6 align=left>
                                            Able to meet all the requirements of the job function
                                        </td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=19 align=left></td>
                                        <td align=left>
                                            <FONT FACE="Wingdings">&uml;
                                        </td>
                                        <td colspan=6 align=left>
                                            able to meet most requirements of the job function
                                        </td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=19 align=left></td>
                                        <td align=left>
                                            <FONT FACE="Wingdings">&uml;
                                        </td>
                                        <td colspan=6 align=left>
                                            *Unable to meet requirements of the job function
                                        </td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 height=17 align=left>
                                            Name of Staff :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=3 align=left>
                                            <?= isset($employee_name) ? $employee_name : '' ?>
                                        </td>
                                        <td align=left></td>
                                        <td colspan=3 align=left>
                                            Name of Evaluator :
                                        </td>
                                        <td align=left></td>
                                        <td style="border-bottom: 1px solid #000000" colspan=2 align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 height=17 align=left>
                                            Staff Signature :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=3 align=left></td>
                                        <td align=left></td>
                                        <td colspan=3 align=left>
                                            Evaluator Signature :
                                        </td>
                                        <td align=left></td>
                                        <td style="border-bottom: 1px solid #000000" colspan=2 align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left>
                                            Date :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=3 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left>
                                            Date :
                                        </td>
                                        <td style="border-bottom: 1px solid #000000" colspan=4 align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td colspan=9 height=17 align=left>
                                            *To re-evaluate suitability of job placement; to take additional action as appropriate
                                        </td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                    </tr>
                                    <tr>
                                        <td height=17 align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td align=left></td>
                                        <td colspan=3 ALIGN=RIGHT>
                                            CF/A//HR/003/04/B
                                        </td>
                                    </tr>
                                </TBODY>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="box-footer">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <div class="col-md-2 col-md-offset-2">
                                <button type="button" class=" btn btn-block btn-success" title="Print Data" id="print">Print</button>
                            </div>
                            <div class="col-sm-3">
                                <a href="<?= base_url() ?>employee/view">
                                    <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Back to Transaction</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>
<script>
    $(".employee-view-active-li").addClass("active");
</script>
<script>
    $(document).ready(function() {
        $("#print").click(function(event) {
            PrintMe("preview_data");
        });

        function PrintMe(DivID) {
            var disp_setting = "toolbar=yes,location=no,";
            disp_setting += "directories=yes,menubar=yes,";
            disp_setting += "scrollbars=yes,width=800, height=600, left=100, top=25";
            var content_vlue = document.getElementById(DivID).innerHTML;
            var docprint = window.open("", "", disp_setting);
            docprint.document.open();
            docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
            docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
            docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
            docprint.document.write('<head><title></title>');
            docprint.document.write('<style type="text/css">');
            docprint.document.write('@page {margin: 0.8cm;}');
            docprint.document.write('</style></head><body onLoad="self.print()"><div style="height: 100px;">');
            docprint.document.write(content_vlue);
            docprint.document.write('</div>');
            docprint.document.write('</body></html>');
            docprint.document.close();
            docprint.focus();
        }
    })
</script>