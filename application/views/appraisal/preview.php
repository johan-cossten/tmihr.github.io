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
                <?= form_open('#', array('class' => '', 'id' => 'table_form')); ?>
                <input type="hidden" id='base_url' value="<?= $base_url; ?>">
                <input type="hidden" id='role' value="<?= $this->session->userdata('role_id'); ?>">
                <!-- title row -->
                <div class="printableArea">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> Perfomance Appraisal
                            </h2>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" id="preview_data">
                            <?php if ($TYPE == 0) : ?>
                                <style>
                                    @page {
                                        margin: 0, 30in 0, 05in 0, 24in 0, 11in;
                                        mso-header-margin: 0, 50in;
                                        mso-footer-margin: 0, 50in;
                                        mso-horizontal-page-align: center;
                                        mso-vertical-page-align: center;
                                        mso-page-orientation: landscape;
                                    }

                                    td {
                                        padding-top: 1px;
                                        padding-right: 1px;
                                        padding-left: 1px;
                                        text-align: general;
                                        vertical-align: middle;
                                        white-space: nowrap;
                                        color: #000000;
                                        font-size: 11.0pt;
                                        font-weight: 400;
                                        font-style: normal;
                                        text-decoration: none;
                                        font-family: Calibri;
                                        border: none;
                                    }

                                    .xl65 {
                                        font-family: Times New Roman;
                                    }

                                    .xl66 {
                                        font-family: Times New Roman;
                                    }

                                    .xl67 {

                                        text-align: center;
                                        font-size: 24.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;
                                        border-left: 1.0pt solid #000000;
                                        border-top: 1.0pt solid #000000;
                                    }

                                    .xl68 {

                                        text-align: center;
                                        font-size: 24.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                    }

                                    .xl69 {

                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                    }

                                    .xl70 {

                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                    }

                                    .xl71 {

                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                    }

                                    .xl72 {

                                        text-align: center;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                        border: 1.0pt solid #000000;
                                    }

                                    .xl73 {

                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                        border-top: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl74 {

                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl75 {

                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                        border-right: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl76 {

                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-weight: 700;
                                        font-style: italic;
                                        font-family: Times New Roman;

                                    }

                                    .xl77 {

                                        text-align: left;
                                        font-family: Times New Roman;

                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl78 {

                                        font-family: Times New Roman;

                                        border-bottom: 1.5pt solid windowtext;
                                    }

                                    .xl79 {

                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl80 {

                                        text-align: center;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl81 {

                                        font-family: Times New Roman;

                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl82 {

                                        text-align: left;
                                        color: #333333;
                                        font-size: 12.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                    }

                                    .xl83 {

                                        text-align: center;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                        border-top: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl84 {

                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl85 {

                                        text-align: center;
                                        font-weight: bold;
                                        font-family: Times New Roman;

                                        border: 1.0pt solid #000000;
                                    }

                                    .xl86 {

                                        font-family: Times New Roman;

                                        border-right: 1.0pt solid #000000;
                                    }

                                    .xl87 {

                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                    }

                                    .xl88 {

                                        font-family: Times New Roman;

                                    }

                                    .xl89 {

                                        font-family: Times New Roman;

                                        border-bottom: 1.5pt solid windowtext;
                                    }

                                    .xl90 {

                                        text-align: center;
                                        font-size: 14.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-left: 1pt solid windowtext;
                                        border-top: 1pt solid windowtext;
                                        border-right: 1pt solid windowtext;
                                        border-bottom: 1pt solid windowtext;
                                    }

                                    .xl91 {

                                        text-align: center;
                                        font-size: 14.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-left: .5pt solid windowtext;
                                        border-top: 1.5pt solid windowtext;
                                        border-right: .5pt solid windowtext;
                                        border-bottom: 1.5pt solid windowtext;
                                    }

                                    .xl92 {

                                        text-align: center;
                                        font-size: 14.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-left: .5pt solid windowtext;
                                        border-top: 1.5pt solid windowtext;
                                        border-right: 1.5pt solid windowtext;
                                        border-bottom: 1.5pt solid windowtext;
                                    }

                                    .xl93 {

                                        text-align: center;
                                        color: #333333;
                                        font-size: 12.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                    }

                                    .xl94 {

                                        /* mso-number-format: "mmm\\-yy"; */
                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                    }

                                    .xl95 {

                                        text-align: right;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                    }

                                    .xl96 {

                                        text-align: center;
                                        font-size: 24.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                        border-right: 1.0pt solid #000000;
                                    }

                                    .xl97 {

                                        font-size: 24.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                    }

                                    .xl98 {

                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                        border-right: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl99 {

                                        font-family: Times New Roman;

                                        border-right: 1.0pt solid #000000;
                                    }

                                    .xl100 {

                                        font-family: Times New Roman;

                                        border-right: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }
                                </style>
                                <table width="1762,47" border="0" cellpadding="0" cellspacing="0" style='width:1321.85pt;border-collapse:collapse;table-layout:fixed;'>
                                    <col width="10,47" class="xl65" />
                                    <col width="13" class="xl65" />
                                    <col width="33,93" class="xl65" />
                                    <col width="25,80" class="xl65" />
                                    <col width="64" span="5" class="xl65" />
                                    <col width="75,27" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" span="16351" class="xl65" />
                                    <tr height="20" style='height:15.00pt;'>
                                        <td class="xl66" height="20" width="10,47" style='height:15.00pt;width:7.85pt;'></td>
                                        <td class="xl66" width="13" style='width:9.75pt;'></td>
                                        <td class="xl66" width="33,93" style='width:25.45pt;'></td>
                                        <td class="xl66" width="25,80" style='width:19.35pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="75,27" style='width:56.45pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl65" width="64" style='width:48.00pt;'></td>
                                        <td class="xl65" width="64" style='width:48.00pt;'></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" colspan="35" style='height:15.75pt;'></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="40" style='height:30.00pt;'>
                                        <td class="xl66" height="40" style='height:30.00pt;'></td>
                                        <td class="xl67" colspan="32" style='border-right:1.0pt solid #000000;border-bottom:none;' x:str>PERFORMANCE APPRAISAL (GROUP A, B, C)</td>
                                        <td class="xl97"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="20" style='height:15.00pt;'>
                                        <td class="xl66" height="20" style='height:15.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl66" colspan="30"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="22" style='height:16.50pt;'>
                                        <td class="xl66" height="22" style='height:16.50pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl70" colspan="2" style='border-right:none;border-bottom:none;' x:str>Name :</td>
                                        <td class="xl71" colspan="6" style='border-right:none;border-bottom:none;' x:str>
                                            <?= isset($employee) ? $employee : '' ?>
                                        </td>
                                        <td class="xl70" colspan="4" style='border-right:none;border-bottom:none;' x:str>Employee Number :</td>
                                        <td class="xl65"></td>
                                        <td class="xl82" colspan="3" style='border-right:none;border-bottom:none;' x:num>
                                            <?= isset($employee_code) ? $employee_code : '' ?>
                                        </td>
                                        <td class="xl66"></td>
                                        <td class="xl70" colspan="2" style='border-right:none;border-bottom:none;' x:str>Designation:</td>
                                        <td class="xl71" colspan="3" style='border-right:none;border-bottom:none;' x:str>
                                            <?= isset($position) ? $position : '' ?>
                                        </td>
                                        <td class="xl70" colspan="3" style='border-right:none;border-bottom:none;' x:str>Department :</td>
                                        <td class="xl93" x:str>
                                            <?= isset($department) ? $department : '' ?>
                                        </td>
                                        <td class="xl65"></td>
                                        <td class="xl70" x:str>Date :</td>
                                        <td class="xl94" colspan="2" style='border-right:none;border-bottom:none;' x:num="45078,">
                                            <?= date('M-y') ?>
                                        </td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" rowspan="3" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>NO</td>
                                        <td class="xl72" colspan="7" rowspan="3" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>CRITERIA</td>
                                        <td class="xl83" colspan="22" style='border-right:none;border-bottom:1.0pt solid #000000;' x:str>SCORE MARK</td>
                                        <td class="xl98"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="22" style='height:16.50pt;'>
                                        <td class="xl66" height="22" style='height:16.50pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl84" colspan="5" style='border-right:none;border-bottom:1.0pt solid #000000;' x:str>Poor &gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;</td>
                                        <td class="xl84" colspan="3" x:str>Fair &gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;</td>
                                        <td class="xl74"></td>
                                        <td class="xl84" colspan="4" x:str>Average&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;</td>
                                        <td class="xl74"></td>
                                        <td class="xl84" colspan="4" x:str>Good&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;</td>
                                        <td class="xl74"></td>
                                        <td class="xl84" colspan="2" style='border-right:none;border-bottom:1.0pt solid #000000;' x:str>Perfect</td>
                                        <td class="xl98"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="22" style='height:16.50pt;'>
                                        <td class="xl66" height="22" style='height:16.50pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>0</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>1</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>2</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>3</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>4</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>5</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>6</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>7</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>8</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>9</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>10</td>
                                        <td class="xl85"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>1</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Attendance</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ATTENDANCE) && $ATTENDANCE == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>2</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Commitment to duties assigned by superior</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COMMITMENT) && $COMMITMENT == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>3</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Cooperation with other employee</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($COOPERATION) && $COOPERATION == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>4</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Disciplinary record (Including all accountability reports)</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($DISCIPLINARY) && $DISCIPLINARY == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>5</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Job Knowledge</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($JOB) && $JOB == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>6</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Meeting company targets</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETING) && $MEETING == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>7</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Quality of work</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($QUALITY) && $QUALITY == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>8</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Support company policies</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SUPPORT) && $SUPPORT == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>9</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Willingness to improve &amp; learn new skills</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WILLINGNESS) && $WILLINGNESS == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>10</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Working Morale</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($WORKING) && $WORKING == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="22" style='height:16.50pt;'>
                                        <td class="xl66" height="22" style='height:16.50pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" colspan="8" rowspan="3" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>TOTAL SCORE :</td>
                                        <td class="xl69"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="22" style='height:16.50pt;'>
                                        <td class="xl66" height="22" style='height:16.50pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl87"></td>
                                        <td class="xl66" colspan="8"></td>
                                        <td class="xl90" colspan="5" style='border-right:1.5pt solid windowtext;border-bottom:1.5pt solid windowtext;' x:num>
                                            <?php echo  $ATTENDANCE + $COMMITMENT + $COOPERATION + $DISCIPLINARY + $JOB + $MEETING + $QUALITY + $SUPPORT + $WILLINGNESS + $WORKING  ?>
                                        </td>
                                        <td class="xl66" colspan="8"></td>
                                        <td class="xl99"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="29,33" style='height:22.00pt;'>
                                        <td class="xl66" height="29,33" style='height:22.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl79"></td>
                                        <td class="xl81" colspan="21"></td>
                                        <td class="xl100"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="20" style='height:15.00pt;'>
                                        <td class="xl66" height="20" style='height:15.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl66" colspan="30"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl76" colspan="4" x:str>Comments from Appraiser :</td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'><?php echo isset($FLEX01) ? $FLEX01 : '' ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="20" style='height:15.00pt;'>
                                        <td class="xl66" height="20" style='height:15.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl66" colspan="30"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl76" colspan="5" x:str>Comments from Management :</td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'><?php echo isset($FLEX02) ? $FLEX02 : '' ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="20" style='height:15.00pt;'>
                                        <td class="xl66" height="20" style='height:15.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl66" colspan="30"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl78" colspan="5"></td>
                                        <td class="xl66" colspan="3"></td>
                                        <td class="xl88"></td>
                                        <td class="xl89" colspan="6"></td>
                                        <td class="xl66" colspan="15"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl79"></td>
                                        <td class="xl80" colspan="5" style='border-right:none;border-bottom:1.0pt solid #000000;' x:str>Name &amp; Signature of Appraiser</td>
                                        <td class="xl81" colspan="3"></td>
                                        <td class="xl80" colspan="7" style='border-right:none;border-bottom:1.0pt solid #000000;' x:str>Name &amp; Signature of Appraiser</td>
                                        <td class="xl81" colspan="15"></td>
                                        <td class="xl100"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" colspan="26" style='height:15.75pt;'></td>
                                        <td class="xl95" colspan="7" style='border-right:none;border-bottom:none;' x:str>CF/A/HR/004/02/C</td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                </table>
                            <?php else : ?>
                                <style>
                                    @page {
                                        margin: 0, 30in 0, 05in 0, 24in 0, 11in;
                                        mso-header-margin: 0, 50in;
                                        mso-footer-margin: 0, 50in;
                                        mso-horizontal-page-align: center;
                                        mso-vertical-page-align: center;
                                        mso-page-orientation: landscape;
                                    }

                                    td {

                                        padding-top: 1px;
                                        padding-right: 1px;
                                        padding-left: 1px;

                                        text-align: general;
                                        vertical-align: middle;
                                        white-space: nowrap;

                                        color: #000000;
                                        font-size: 11.0pt;
                                        font-weight: 400;
                                        font-style: normal;
                                        text-decoration: none;
                                        font-family: Calibri;


                                        border: none;

                                    }

                                    .xl65 {

                                        font-family: Times New Roman;

                                    }

                                    .xl66 {

                                        font-family: Times New Roman;

                                    }

                                    .xl67 {

                                        text-align: center;
                                        font-size: 24.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                        border-top: 1.0pt solid #000000;
                                    }

                                    .xl68 {

                                        text-align: center;
                                        font-size: 24.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                    }

                                    .xl69 {

                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                    }

                                    .xl70 {

                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                    }

                                    .xl71 {

                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                    }

                                    .xl72 {

                                        text-align: center;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                        border: 1.0pt solid #000000;
                                    }

                                    .xl73 {

                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                        border-top: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl74 {

                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl75 {

                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                        border-right: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl76 {

                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-weight: 700;
                                        font-style: italic;
                                        font-family: Times New Roman;

                                    }

                                    .xl77 {

                                        text-align: left;
                                        font-family: Times New Roman;

                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl78 {

                                        font-family: Times New Roman;

                                        border-bottom: 1.5pt solid windowtext;
                                    }

                                    .xl79 {

                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl80 {

                                        text-align: center;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl81 {

                                        font-family: Times New Roman;

                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl82 {

                                        text-align: left;
                                        color: #333333;
                                        font-size: 12.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                    }

                                    .xl83 {

                                        text-align: center;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                        border-top: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl84 {

                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl85 {

                                        text-align: center;
                                        font-weight: bold;
                                        font-family: Times New Roman;

                                        border: 1.0pt solid #000000;
                                    }

                                    .xl86 {

                                        font-family: Times New Roman;

                                        border-right: 1.0pt solid #000000;
                                    }

                                    .xl87 {

                                        font-family: Times New Roman;

                                        border-left: 1.0pt solid #000000;
                                    }

                                    .xl88 {

                                        font-family: Times New Roman;

                                    }

                                    .xl89 {

                                        font-family: Times New Roman;

                                        border-bottom: 1.5pt solid windowtext;
                                    }

                                    .xl90 {

                                        text-align: center;
                                        font-size: 14.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-left: 1pt solid windowtext;
                                        border-top: 1pt solid windowtext;
                                        border-right: 1pt solid windowtext;
                                        border-bottom: 1pt solid windowtext;
                                    }

                                    .xl91 {

                                        text-align: center;
                                        font-size: 14.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-left: .5pt solid windowtext;
                                        border-top: 1.5pt solid windowtext;
                                        border-right: .5pt solid windowtext;
                                        border-bottom: 1.5pt solid windowtext;
                                    }

                                    .xl92 {

                                        text-align: center;
                                        font-size: 14.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-left: .5pt solid windowtext;
                                        border-top: 1.5pt solid windowtext;
                                        border-right: 1.5pt solid windowtext;
                                        border-bottom: 1.5pt solid windowtext;
                                    }

                                    .xl93 {

                                        text-align: center;
                                        color: #333333;
                                        font-size: 12.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                    }

                                    .xl94 {

                                        /* mso-number-format: "mmm\\-yy"; */
                                        text-align: left;
                                        font-size: 12.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                    }

                                    .xl95 {

                                        text-align: right;
                                        font-size: 12.0pt;
                                        font-family: Times New Roman;

                                    }

                                    .xl96 {

                                        text-align: center;
                                        font-size: 24.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                        border-right: 1.0pt solid #000000;
                                    }

                                    .xl97 {

                                        font-size: 24.0pt;
                                        font-weight: 700;
                                        font-family: Times New Roman;

                                    }

                                    .xl98 {

                                        font-family: Times New Roman;

                                        border-top: 1.0pt solid #000000;
                                        border-right: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }

                                    .xl99 {

                                        font-family: Times New Roman;

                                        border-right: 1.0pt solid #000000;
                                    }

                                    .xl100 {

                                        font-family: Times New Roman;

                                        border-right: 1.0pt solid #000000;
                                        border-bottom: 1.0pt solid #000000;
                                    }
                                </style>
                                <table width="1762,47" border="0" cellpadding="0" cellspacing="0" style='width:1321.85pt;border-collapse:collapse;table-layout:fixed;'>
                                    <col width="10,47" class="xl65" />
                                    <col width="13" class="xl65" />
                                    <col width="33,93" class="xl65" />
                                    <col width="25,80" class="xl65" />
                                    <col width="64" span="5" class="xl65" />
                                    <col width="75,27" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" class="xl65" />
                                    <col width="27" class="xl65" />
                                    <col width="64" span="16351" class="xl65" />
                                    <tr height="20" style='height:15.00pt;'>
                                        <td class="xl66" height="20" width="10,47" style='height:15.00pt;width:7.85pt;'></td>
                                        <td class="xl66" width="13" style='width:9.75pt;'></td>
                                        <td class="xl66" width="33,93" style='width:25.45pt;'></td>
                                        <td class="xl66" width="25,80" style='width:19.35pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="75,27" style='width:56.45pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="27" style='width:20.25pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl66" width="64" style='width:48.00pt;'></td>
                                        <td class="xl65" width="64" style='width:48.00pt;'></td>
                                        <td class="xl65" width="64" style='width:48.00pt;'></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" colspan="35" style='height:15.75pt;'></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="40" style='height:30.00pt;'>
                                        <td class="xl66" height="40" style='height:30.00pt;'></td>
                                        <td class="xl67" colspan="32" style='border-right:1.0pt solid #000000;border-bottom:none;' x:str>PERFORMANCE APPRAISAL (GROUP D, E, F)</td>
                                        <td class="xl97"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="20" style='height:15.00pt;'>
                                        <td class="xl66" height="20" style='height:15.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl66" colspan="30"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="22" style='height:16.50pt;'>
                                        <td class="xl66" height="22" style='height:16.50pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl70" colspan="2" style='border-right:none;border-bottom:none;' x:str>Name :</td>
                                        <td class="xl71" colspan="6" style='border-right:none;border-bottom:none;' x:str>
                                            <?= isset($employee) ? $employee : '' ?>
                                        </td>
                                        <td class="xl70" colspan="4" style='border-right:none;border-bottom:none;' x:str>Employee Number :</td>
                                        <td class="xl65"></td>
                                        <td class="xl82" colspan="3" style='border-right:none;border-bottom:none;' x:num>
                                            <?= isset($employee_code) ? $employee_code : '' ?>
                                        </td>
                                        <td class="xl66"></td>
                                        <td class="xl70" colspan="2" style='border-right:none;border-bottom:none;' x:str>Designation:</td>
                                        <td class="xl71" colspan="3" style='border-right:none;border-bottom:none;' x:str>
                                            <?= isset($position) ? $position : '' ?>
                                        </td>
                                        <td class="xl70" colspan="3" style='border-right:none;border-bottom:none;' x:str>Department :</td>
                                        <td class="xl93" x:str>
                                            <?= isset($department) ? $department : '' ?>
                                        </td>
                                        <td class="xl65"></td>
                                        <td class="xl70" x:str>Date :</td>
                                        <td class="xl94" colspan="2" style='border-right:none;border-bottom:none;' x:num="45078,">
                                            <?= date('M-y') ?>
                                        </td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" rowspan="3" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>NO</td>
                                        <td class="xl72" colspan="7" rowspan="3" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>CRITERIA</td>
                                        <td class="xl83" colspan="22" style='border-right:none;border-bottom:1.0pt solid #000000;' x:str>SCORE MARK</td>
                                        <td class="xl98"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="22" style='height:16.50pt;'>
                                        <td class="xl66" height="22" style='height:16.50pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl84" colspan="5" style='border-right:none;border-bottom:1.0pt solid #000000;' x:str>Poor &gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;</td>
                                        <td class="xl84" colspan="3" x:str>Fair &gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;</td>
                                        <td class="xl74"></td>
                                        <td class="xl84" colspan="4" x:str>Average&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;</td>
                                        <td class="xl74"></td>
                                        <td class="xl84" colspan="4" x:str>Good&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;</td>
                                        <td class="xl74"></td>
                                        <td class="xl84" colspan="2" style='border-right:none;border-bottom:1.0pt solid #000000;' x:str>Perfect</td>
                                        <td class="xl98"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="22" style='height:16.50pt;'>
                                        <td class="xl66" height="22" style='height:16.50pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>0</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>1</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>2</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>3</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>4</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>5</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>6</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>7</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>8</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>9</td>
                                        <td class="xl85"></td>
                                        <td class="xl72" x:num>10</td>
                                        <td class="xl85"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>1</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Abilities to execute & follow up task assigned diligently</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ABILITIES) && $ABILITIES == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>2</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Time & work organizational skills</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIME) && $TIME == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>3</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Continuous improvement plans</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CONTINUOUS) && $CONTINUOUS == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>4</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Creating better or new initiatives</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($CREATING) && $CREATING == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>5</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Efforts to cooperatives & built team spirit</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFORTS) && $EFFORTS == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>6</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Effectiveness in carrying out own function</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>7</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Advanced planning in own functions</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($ADVANCED) && $ADVANCED == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>8</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Meeting company goals & objectives</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($MEETINGGOALS) && $MEETINGGOALS == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>9</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Speed in rectifying issues</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($SPEED) && $SPEED == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="9,33" style='height:7.00pt;'>
                                        <td class="xl66" height="9,33" style='height:7.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl73"></td>
                                        <td class="xl74" colspan="5"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl861"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" x:num>10</td>
                                        <td class="xl75" colspan="7" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>Timely & good decision making</td>
                                        <td class="xl69"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 0 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 1 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 2 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 3 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 4 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 5 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 6 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 7 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 8 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 9 ? "&#10003;" : "" ?></td>
                                        <td class="xl66"></td>
                                        <td class="xl85"><?php echo isset($TIMELY) && $TIMELY == 10 ? "&#10003;" : "" ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="22" style='height:16.50pt;'>
                                        <td class="xl66" height="22" style='height:16.50pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl72" colspan="8" rowspan="3" style='border-right:1.0pt solid #000000;border-bottom:1.0pt solid #000000;' x:str>TOTAL SCORE :</td>
                                        <td class="xl69"></td>
                                        <td class="xl66" colspan="21"></td>
                                        <td class="xl86"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="22" style='height:16.50pt;'>
                                        <td class="xl66" height="22" style='height:16.50pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl87"></td>
                                        <td class="xl66" colspan="8"></td>
                                        <td class="xl90" colspan="5" style='border-right:1.5pt solid windowtext;border-bottom:1.5pt solid windowtext;' x:num>
                                            <?php echo  $ABILITIES + $TIME + $CONTINUOUS + $CREATING + $EFFORTS + $EFFECTIVENESS + $ADVANCED + $MEETINGGOALS + $SPEED + $TIMELY  ?>
                                        </td>
                                        <td class="xl66" colspan="8"></td>
                                        <td class="xl99"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="29,33" style='height:22.00pt;'>
                                        <td class="xl66" height="29,33" style='height:22.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl79"></td>
                                        <td class="xl81" colspan="21"></td>
                                        <td class="xl100"></td>
                                        <td class="xl88"></td>
                                        <td class="xl66"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="20" style='height:15.00pt;'>
                                        <td class="xl66" height="20" style='height:15.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl66" colspan="30"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl76" colspan="4" x:str>Comments from Appraiser :</td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'><?php echo isset($FLEX01) ? $FLEX01 : '' ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="20" style='height:15.00pt;'>
                                        <td class="xl66" height="20" style='height:15.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl66" colspan="30"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl76" colspan="5" x:str>Comments from Management :</td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl66"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'><?php echo isset($FLEX02) ? $FLEX02 : '' ?></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl77" colspan="30" style='border-right:none;border-bottom:1.0pt solid #000000;'></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="20" style='height:15.00pt;'>
                                        <td class="xl66" height="20" style='height:15.00pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl66" colspan="30"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" style='height:15.75pt;'></td>
                                        <td class="xl69"></td>
                                        <td class="xl78" colspan="5"></td>
                                        <td class="xl66" colspan="3"></td>
                                        <td class="xl88"></td>
                                        <td class="xl89" colspan="6"></td>
                                        <td class="xl66" colspan="15"></td>
                                        <td class="xl86"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="23" style='height:17.25pt;'>
                                        <td class="xl66" height="23" style='height:17.25pt;'></td>
                                        <td class="xl79"></td>
                                        <td class="xl80" colspan="5" style='border-right:none;border-bottom:1.0pt solid #000000;' x:str>Name &amp; Signature of Appraiser</td>
                                        <td class="xl81" colspan="3"></td>
                                        <td class="xl80" colspan="7" style='border-right:none;border-bottom:1.0pt solid #000000;' x:str>Name &amp; Signature of Appraiser</td>
                                        <td class="xl81" colspan="15"></td>
                                        <td class="xl100"></td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                    <tr height="21" style='height:15.75pt;'>
                                        <td class="xl66" height="21" colspan="26" style='height:15.75pt;'></td>
                                        <td class="xl95" colspan="7" style='border-right:none;border-bottom:none;' x:str>CF/A/HR/004/02/C</td>
                                        <td class="xl66" colspan="2"></td>
                                        <td class="xl65" colspan="2"></td>
                                    </tr>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
                <div class="row no-print">
                    <div class="box-footer">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <div class="col-md-2 col-md-offset-2">
                                <button type="button" class=" btn btn-block btn-success" title="Print Data" id="print">Print</button>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Back to Transaction</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php $this->load->view("template/footer"); ?>
    </div>
</body>

</html>
<script>
    $(".appraisal-view-active-li").addClass("active");
</script>
<script src="<?php echo $theme_link; ?>js/appraisal.js"></script>
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
            docprint.document.write('@page {margin: 1cm;}');
            docprint.document.write('</style></head><body onLoad="self.print()"><div style="height: 100px;">');
            docprint.document.write(content_vlue);
            docprint.document.write('</div>');
            // docprint.document.write('<div class="page-footer-space"></div>');
            // docprint.document.write('<div class="page-footer">CF/A/HR/003/07/B</div>');
            // docprint.document.write('<div class="footer"><span style="margin-left: 850px;">CF/A/HR/003/07/B</span></div>');
            docprint.document.write('</body></html>');
            docprint.document.close();
            docprint.focus();
        }
    })
</script>