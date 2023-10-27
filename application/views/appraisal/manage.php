<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('template/css-form.php'); ?>
    <style>
        #type-0 {
            display: none;
        }

        #type-1 {
            display: none;
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
            text-align: center;
        }

        .xl66 {
            font-family: Times New Roman;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('template/sidebar.php'); ?>
        <?php
        if (!isset($appraisal_id)) {
            $appraisal_id = $CODE = $EMPLOYEEID = $FLEX01 = $FLEX02 = '';
            $PERF_DATE = date("d-m-Y");
        }
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?= $page_title; ?>
                    <small>Add/Update Assessment</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?php echo $base_url; ?>department/view">Assessment</a></li>
                    <li class="active"><?= $page_title; ?></li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info ">
                            <div class="box-header with-border">
                                <h3 class="box-title">Please Enter Valid Data</h3>
                            </div>
                            <form class="form-horizontal" id="appraisal-form" onkeypress="return event.keyCode != 13;">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                                <input type="hidden" id="ID" value="<?php echo isset($appraisal_id) ? $appraisal_id : '' ?>">
                                <input type="hidden" id='role' value="<?= $this->session->userdata('role_id'); ?>">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="CODE" class="col-sm-4 control-label">Appraisal Code<span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="CODE" name="CODE" placeholder="" value="<?php echo isset($CODE) ? $CODE : '' ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="EMPLOYEEID" class="col-sm-4 control-label">Employee <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2" id="EMPLOYEEID" name="EMPLOYEEID" style="width: 100%;">
                                                        <?php
                                                        $this->db2 = $this->load->database('tmi_ext', true);
                                                        $q2 = $this->db2->select("*")->get("TMIEXT.OVT_OM_EMPLOYEES");
                                                        if ($q2->num_rows() > 0) {
                                                            echo "<option value=''>-Select-</option>";
                                                            foreach ($q2->result() as $res1) {
                                                                if ((isset($EMPLOYEEID) && !empty($EMPLOYEEID)) && $EMPLOYEEID == $res1->OVT_BADGED) {
                                                                    $selected = 'selected';
                                                                } else {
                                                                    $selected = '';
                                                                }
                                                                echo "<option $selected value='" . $res1->OVT_BADGED . "'>" . $res1->OVT_NAME_EMP . ' - ' . $res1->OVT_BADGED . "</option>";
                                                            }
                                                        } else {
                                                        ?>
                                                            <option value="">No Records Found</option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="TYPE" class="col-sm-4 control-label">Type Group <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2" id="TYPE" name="TYPE" style="width: 100%;" onchange="typeofgroup()">
                                                        <option <?php echo !isset($TYPE) ? 'selected' : '' ?> disabled></option>
                                                        <option value="0" <?php echo isset($TYPE) && $TYPE == "0" ? "selected" : "" ?>>Group A, B, C</option>
                                                        <option value="1" <?php echo isset($TYPE) && $TYPE == "1" ? "selected" : "" ?>>Group D, F, E</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" id="type-0">
                                    <div class="row">
                                        <table width="823,87" border="0" cellpadding="0" cellspacing="0" style='width:617.90pt;border-collapse:collapse;table-layout:fixed;'>
                                            <col width="64" span="2" style='width:20,00pt;' />
                                            <col width="371" />
                                            <col width="29,53" span="11" />
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" width="30" style='height:15.00pt;width:20.00pt;'></td>
                                                <td width="64" style='width:48.00pt;'></td>
                                                <td width="371" style='width:278.25pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" colspan="3" style='height:15.00pt;'></td>
                                                <td class="xl65" x:num><b>0</b></td>
                                                <td class="xl65" x:num><b>1</b></td>
                                                <td class="xl65" x:num><b>2</b></td>
                                                <td class="xl65" x:num><b>3</b></td>
                                                <td class="xl65" x:num><b>4</b></td>
                                                <td class="xl65" x:num><b>5</b></td>
                                                <td class="xl65" x:num><b>6</b></td>
                                                <td class="xl65" x:num><b>7</b></td>
                                                <td class="xl65" x:num><b>8</b></td>
                                                <td class="xl65" x:num><b>9</b></td>
                                                <td class="xl65" x:num><b>10</b></td>

                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>1</td>
                                                <td class="xl67" x:str>Attendance</td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-0" value="0" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "0" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-1" value="1" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "1" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-2" value="2" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "2" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-3" value="3" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "3" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-4" value="4" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "4" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-5" value="5" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "5" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-6" value="6" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "6" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-7" value="7" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "7" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-8" value="8" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "8" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-9" value="9" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "9" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="attendance" id="att-10" value="10" <?php echo isset($ATTENDANCE) && $ATTENDANCE == "10" ? "checked" : "" ?>>
                                                </td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>2</td>
                                                <td class="xl67" x:str>Commitment to duties assigned by superior</td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-0" value="0" <?php echo isset($COMMITMENT) && $COMMITMENT == "0" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-1" value="1" <?php echo isset($COMMITMENT) && $COMMITMENT == "1" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-2" value="2" <?php echo isset($COMMITMENT) && $COMMITMENT == "2" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-3" value="3" <?php echo isset($COMMITMENT) && $COMMITMENT == "3" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-4" value="4" <?php echo isset($COMMITMENT) && $COMMITMENT == "4" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-5" value="5" <?php echo isset($COMMITMENT) && $COMMITMENT == "5" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-6" value="6" <?php echo isset($COMMITMENT) && $COMMITMENT == "6" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-7" value="7" <?php echo isset($COMMITMENT) && $COMMITMENT == "7" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-8" value="8" <?php echo isset($COMMITMENT) && $COMMITMENT == "8" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-9" value="9" <?php echo isset($COMMITMENT) && $COMMITMENT == "9" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="commitment" id="com-10" value="10" <?php echo isset($COMMITMENT) && $COMMITMENT == "10" ? "checked" : "" ?>>
                                                </td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>3</td>
                                                <td class="xl67" x:str>Cooperation with other employee</td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-0" value="0" <?php echo isset($COOPERATION) && $COOPERATION == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-1" value="1" <?php echo isset($COOPERATION) && $COOPERATION == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-2" value="2" <?php echo isset($COOPERATION) && $COOPERATION == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-3" value="3" <?php echo isset($COOPERATION) && $COOPERATION == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-4" value="4" <?php echo isset($COOPERATION) && $COOPERATION == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-5" value="5" <?php echo isset($COOPERATION) && $COOPERATION == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-6" value="6" <?php echo isset($COOPERATION) && $COOPERATION == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-7" value="7" <?php echo isset($COOPERATION) && $COOPERATION == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-8" value="8" <?php echo isset($COOPERATION) && $COOPERATION == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-9" value="9" <?php echo isset($COOPERATION) && $COOPERATION == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="cooperation" id="con-10" value="10" <?php echo isset($COOPERATION) && $COOPERATION == "10" ? "checked" : "" ?>></td>

                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>4</td>
                                                <td class="xl67" x:str>disciplinary record (Including all accountanbility reports)</td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-0" value="0" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-1" value="1" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-2" value="2" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-3" value="3" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-4" value="4" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-5" value="5" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-6" value="6" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-7" value="7" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-8" value="8" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-9" value="9" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="disciplinary" id="dis-10" value="10" <?php echo isset($DISCIPLINARY) && $DISCIPLINARY == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>5</td>
                                                <td class="xl67" x:str>Job Knowledge</td>
                                                <td class="xl65"><input type="radio" name="job" id="job-0" value="0" <?php echo isset($JOB) && $JOB == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="job" id="job-1" value="1" <?php echo isset($JOB) && $JOB == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="job" id="job-2" value="2" <?php echo isset($JOB) && $JOB == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="job" id="job-3" value="3" <?php echo isset($JOB) && $JOB == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="job" id="job-4" value="4" <?php echo isset($JOB) && $JOB == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="job" id="job-5" value="5" <?php echo isset($JOB) && $JOB == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="job" id="job-6" value="6" <?php echo isset($JOB) && $JOB == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="job" id="job-7" value="7" <?php echo isset($JOB) && $JOB == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="job" id="job-8" value="8" <?php echo isset($JOB) && $JOB == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="job" id="job-9" value="9" <?php echo isset($JOB) && $JOB == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="job" id="job-10" value="10" <?php echo isset($JOB) && $JOB == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>6</td>
                                                <td class="xl67" x:str>Meeting company targets</td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-0" value="0" <?php echo isset($MEETING) && $MEETING == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-1" value="1" <?php echo isset($MEETING) && $MEETING == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-2" value="2" <?php echo isset($MEETING) && $MEETING == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-3" value="3" <?php echo isset($MEETING) && $MEETING == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-4" value="4" <?php echo isset($MEETING) && $MEETING == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-5" value="5" <?php echo isset($MEETING) && $MEETING == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-6" value="6" <?php echo isset($MEETING) && $MEETING == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-7" value="7" <?php echo isset($MEETING) && $MEETING == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-8" value="8" <?php echo isset($MEETING) && $MEETING == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-9" value="9" <?php echo isset($MEETING) && $MEETING == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="meeting" id="meet-10" value="10" <?php echo isset($MEETING) && $MEETING == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>7</td>
                                                <td class="xl67" x:str>Quality of Work</td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-0" value="0" <?php echo isset($QUALITY) && $QUALITY == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-1" value="1" <?php echo isset($QUALITY) && $QUALITY == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-2" value="2" <?php echo isset($QUALITY) && $QUALITY == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-3" value="3" <?php echo isset($QUALITY) && $QUALITY == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-4" value="4" <?php echo isset($QUALITY) && $QUALITY == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-5" value="5" <?php echo isset($QUALITY) && $QUALITY == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-6" value="6" <?php echo isset($QUALITY) && $QUALITY == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-7" value="7" <?php echo isset($QUALITY) && $QUALITY == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-8" value="8" <?php echo isset($QUALITY) && $QUALITY == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-9" value="9" <?php echo isset($QUALITY) && $QUALITY == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="quality" id="qua-10" value="10" <?php echo isset($QUALITY) && $QUALITY == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>8</td>
                                                <td class="xl67" x:str>Support company policies</td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-0" value="0" <?php echo isset($SUPPORT) && $SUPPORT == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-1" value="1" <?php echo isset($SUPPORT) && $SUPPORT == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-2" value="2" <?php echo isset($SUPPORT) && $SUPPORT == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-3" value="3" <?php echo isset($SUPPORT) && $SUPPORT == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-4" value="4" <?php echo isset($SUPPORT) && $SUPPORT == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-5" value="5" <?php echo isset($SUPPORT) && $SUPPORT == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-6" value="6" <?php echo isset($SUPPORT) && $SUPPORT == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-7" value="7" <?php echo isset($SUPPORT) && $SUPPORT == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-8" value="8" <?php echo isset($SUPPORT) && $SUPPORT == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-9" value="9" <?php echo isset($SUPPORT) && $SUPPORT == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="support" id="sup-10" value="10" <?php echo isset($SUPPORT) && $SUPPORT == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>9</td>
                                                <td class="xl67" x:str>Willingness to improve &amp; learn new skills</td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-0" value="0" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-1" value="1" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-2" value="2" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-3" value="3" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-4" value="4" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-5" value="5" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-6" value="6" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-7" value="7" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-8" value="8" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-9" value="9" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="spelingness" id="spel-10" value="10" <?php echo isset($WILLINGNESS) && $WILLINGNESS == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>10</td>
                                                <td class="xl67" x:str>Working Morale</td>
                                                <td class="xl65"><input type="radio" name="working" id="working-0" value="0" <?php echo isset($WORKING) && $WORKING == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="working" id="working-1" value="1" <?php echo isset($WORKING) && $WORKING == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="working" id="working-2" value="2" <?php echo isset($WORKING) && $WORKING == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="working" id="working-3" value="3" <?php echo isset($WORKING) && $WORKING == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="working" id="working-4" value="4" <?php echo isset($WORKING) && $WORKING == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="working" id="working-5" value="5" <?php echo isset($WORKING) && $WORKING == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="working" id="working-6" value="6" <?php echo isset($WORKING) && $WORKING == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="working" id="working-7" value="7" <?php echo isset($WORKING) && $WORKING == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="working" id="working-8" value="8" <?php echo isset($WORKING) && $WORKING == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="working" id="working-9" value="9" <?php echo isset($WORKING) && $WORKING == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="working" id="working-10" value="10" <?php echo isset($WORKING) && $WORKING == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="box-footer" id="type-1">
                                    <div class="row">
                                        <table width="823,87" border="0" cellpadding="0" cellspacing="0" style='width:617.90pt;border-collapse:collapse;table-layout:fixed;'>
                                            <col width="64" span="2" style='width:20,00pt;' />
                                            <col width="371" />
                                            <col width="29,53" span="11" />
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" width="30" style='height:15.00pt;width:20.00pt;'></td>
                                                <td width="64" style='width:48.00pt;'></td>
                                                <td width="371" style='width:278.25pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                                <td width="29,53" style='width:22.15pt;'></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" colspan="3" style='height:15.00pt;'></td>
                                                <td class="xl65" x:num><b>0</b></td>
                                                <td class="xl65" x:num><b>1</b></td>
                                                <td class="xl65" x:num><b>2</b></td>
                                                <td class="xl65" x:num><b>3</b></td>
                                                <td class="xl65" x:num><b>4</b></td>
                                                <td class="xl65" x:num><b>5</b></td>
                                                <td class="xl65" x:num><b>6</b></td>
                                                <td class="xl65" x:num><b>7</b></td>
                                                <td class="xl65" x:num><b>8</b></td>
                                                <td class="xl65" x:num><b>9</b></td>
                                                <td class="xl65" x:num><b>10</b></td>

                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>1</td>
                                                <td class="xl67" x:str>Abilities to execute & follow up task assigned diligently</td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-0" value="0" <?php echo isset($ABILITIES) && $ABILITIES == "0" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-1" value="1" <?php echo isset($ABILITIES) && $ABILITIES == "1" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-2" value="2" <?php echo isset($ABILITIES) && $ABILITIES == "2" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-3" value="3" <?php echo isset($ABILITIES) && $ABILITIES == "3" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-4" value="4" <?php echo isset($ABILITIES) && $ABILITIES == "4" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-5" value="5" <?php echo isset($ABILITIES) && $ABILITIES == "5" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-6" value="6" <?php echo isset($ABILITIES) && $ABILITIES == "6" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-7" value="7" <?php echo isset($ABILITIES) && $ABILITIES == "7" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-8" value="8" <?php echo isset($ABILITIES) && $ABILITIES == "8" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-9" value="9" <?php echo isset($ABILITIES) && $ABILITIES == "9" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="abilities" id="abi-10" value="10" <?php echo isset($ABILITIES) && $ABILITIES == "10" ? "checked" : "" ?>>
                                                </td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>2</td>
                                                <td class="xl67" x:str>Time & Work organizational skills</td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-0" value="0" <?php echo isset($TIME) && $TIME == "0" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-1" value="1" <?php echo isset($TIME) && $TIME == "1" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-2" value="2" <?php echo isset($TIME) && $TIME == "2" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-3" value="3" <?php echo isset($TIME) && $TIME == "3" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-4" value="4" <?php echo isset($TIME) && $TIME == "4" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-5" value="5" <?php echo isset($TIME) && $TIME == "5" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-6" value="6" <?php echo isset($TIME) && $TIME == "6" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-7" value="7" <?php echo isset($TIME) && $TIME == "7" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-8" value="8" <?php echo isset($TIME) && $TIME == "8" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-9" value="9" <?php echo isset($TIME) && $TIME == "9" ? "checked" : "" ?>>
                                                </td>
                                                <td class="xl65">
                                                    <input type="radio" name="time" id="time-10" value="10" <?php echo isset($TIME) && $TIME == "10" ? "checked" : "" ?>>
                                                </td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>3</td>
                                                <td class="xl67" x:str>Continuous improvement plans</td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-0" value="0" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-1" value="1" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-2" value="2" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-3" value="3" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-4" value="4" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-5" value="5" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-6" value="6" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-7" value="7" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-8" value="8" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-9" value="9" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="continuous" id="continuous-10" value="10" <?php echo isset($CONTINUOUS) && $CONTINUOUS == "10" ? "checked" : "" ?>></td>

                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>4</td>
                                                <td class="xl67" x:str>Creating better or new initiatives</td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-0" value="0" <?php echo isset($CREATING) && $CREATING == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-1" value="1" <?php echo isset($CREATING) && $CREATING == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-2" value="2" <?php echo isset($CREATING) && $CREATING == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-3" value="3" <?php echo isset($CREATING) && $CREATING == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-4" value="4" <?php echo isset($CREATING) && $CREATING == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-5" value="5" <?php echo isset($CREATING) && $CREATING == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-6" value="6" <?php echo isset($CREATING) && $CREATING == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-7" value="7" <?php echo isset($CREATING) && $CREATING == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-8" value="8" <?php echo isset($CREATING) && $CREATING == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-9" value="9" <?php echo isset($CREATING) && $CREATING == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="Creating" id="creating-10" value="10" <?php echo isset($CREATING) && $CREATING == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>5</td>
                                                <td class="xl67" x:str>Efforts to cooperatives & built team spirit</td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-0" value="0" <?php echo isset($EFFORTS) && $EFFORTS == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-1" value="1" <?php echo isset($EFFORTS) && $EFFORTS == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-2" value="2" <?php echo isset($EFFORTS) && $EFFORTS == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-3" value="3" <?php echo isset($EFFORTS) && $EFFORTS == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-4" value="4" <?php echo isset($EFFORTS) && $EFFORTS == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-5" value="5" <?php echo isset($EFFORTS) && $EFFORTS == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-6" value="6" <?php echo isset($EFFORTS) && $EFFORTS == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-7" value="7" <?php echo isset($EFFORTS) && $EFFORTS == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-8" value="8" <?php echo isset($EFFORTS) && $EFFORTS == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-9" value="9" <?php echo isset($EFFORTS) && $EFFORTS == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="efforts" id="efforts-10" value="10" <?php echo isset($EFFORTS) && $EFFORTS == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>6</td>
                                                <td class="xl67" x:str>Effectiveness in carrying out own functions</td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-0" value="0" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-1" value="1" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-2" value="2" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-3" value="3" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-4" value="4" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-5" value="5" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-6" value="6" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-7" value="7" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-8" value="8" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-9" value="9" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="effectiveness" id="effectiveness-10" value="10" <?php echo isset($EFFECTIVENESS) && $EFFECTIVENESS == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>7</td>
                                                <td class="xl67" x:str>Advanced planning in own functions</td>
                                                <td class="xl65"><input type="radio" name="function" id="func-0" value="0" <?php echo isset($ADVANCED) && $ADVANCED == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="function" id="func-1" value="1" <?php echo isset($ADVANCED) && $ADVANCED == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="function" id="func-2" value="2" <?php echo isset($ADVANCED) && $ADVANCED == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="function" id="func-3" value="3" <?php echo isset($ADVANCED) && $ADVANCED == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="function" id="func-4" value="4" <?php echo isset($ADVANCED) && $ADVANCED == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="function" id="func-5" value="5" <?php echo isset($ADVANCED) && $ADVANCED == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="function" id="func-6" value="6" <?php echo isset($ADVANCED) && $ADVANCED == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="function" id="func-7" value="7" <?php echo isset($ADVANCED) && $ADVANCED == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="function" id="func-8" value="8" <?php echo isset($ADVANCED) && $ADVANCED == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="function" id="func-9" value="9" <?php echo isset($ADVANCED) && $ADVANCED == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="function" id="func-10" value="10" <?php echo isset($ADVANCED) && $ADVANCED == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>8</td>
                                                <td class="xl67" x:str>Meeting company goals & objectives</td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-0" value="0" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-1" value="1" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-2" value="2" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-3" value="3" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-4" value="4" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-5" value="5" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-6" value="6" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-7" value="7" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-8" value="8" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-9" value="9" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="objectives" id="obj-10" value="10" <?php echo isset($MEETINGGOALS) && $MEETINGGOALS == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>9</td>
                                                <td class="xl67" x:str>Speed in rectifying issues</td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-0" value="0" <?php echo isset($SPEED) && $SPEED == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-1" value="1" <?php echo isset($SPEED) && $SPEED == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-2" value="2" <?php echo isset($SPEED) && $SPEED == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-3" value="3" <?php echo isset($SPEED) && $SPEED == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-4" value="4" <?php echo isset($SPEED) && $SPEED == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-5" value="5" <?php echo isset($SPEED) && $SPEED == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-6" value="6" <?php echo isset($SPEED) && $SPEED == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-7" value="7" <?php echo isset($SPEED) && $SPEED == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-8" value="8" <?php echo isset($SPEED) && $SPEED == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-9" value="9" <?php echo isset($SPEED) && $SPEED == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="speed" id="speed-10" value="10" <?php echo isset($SPEED) && $SPEED == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                            <tr height="20" style='height:15.00pt;'>
                                                <td height="20" style='height:15.00pt;'></td>
                                                <td class="xl66" x:num>10</td>
                                                <td class="xl67" x:str>Timely & good decision making</td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-0" value="0" <?php echo isset($TIMELY) && $TIMELY == "0" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-1" value="1" <?php echo isset($TIMELY) && $TIMELY == "1" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-2" value="2" <?php echo isset($TIMELY) && $TIMELY == "2" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-3" value="3" <?php echo isset($TIMELY) && $TIMELY == "3" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-4" value="4" <?php echo isset($TIMELY) && $TIMELY == "4" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-5" value="5" <?php echo isset($TIMELY) && $TIMELY == "5" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-6" value="6" <?php echo isset($TIMELY) && $TIMELY == "6" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-7" value="7" <?php echo isset($TIMELY) && $TIMELY == "7" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-8" value="8" <?php echo isset($TIMELY) && $TIMELY == "8" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-9" value="9" <?php echo isset($TIMELY) && $TIMELY == "9" ? "checked" : "" ?>></td>
                                                <td class="xl65"><input type="radio" name="timely" id="timely-10" value="10" <?php echo isset($TIMELY) && $TIMELY == "10" ? "checked" : "" ?>></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="box-body">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="FLEX01" class="col-sm-2 control-label">Comments from Appraiser:</label>
                                                    <div class="col-sm-4">
                                                        <textarea type="text" class="form-control" id="FLEX01" name="FLEX01" placeholder=""><?php echo isset($FLEX01) ? $FLEX01 : '' ?></textarea>
                                                        <span id="FLEX01" style="display:none" class="text-danger"></span>
                                                    </div>
                                                    <!-- </div>
                                    <div class="form-group"> -->
                                                    <label for="FLEX02" class="col-sm-2 control-label">Comments from Management:</label>
                                                    <div class="col-sm-4">
                                                        <textarea type="text" class="form-control" id="FLEX02" name="FLEX02" placeholder=""><?php echo isset($FLEX02) ? $FLEX02 : '' ?></textarea>
                                                        <span id="FLEX02" style="display:none" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-footer -->
                                <div class="box-footer">
                                    <div class="col-sm-8 col-sm-offset-2 text-center">
                                        <!-- <div class="col-sm-4"></div> -->
                                        <?php
                                        if ($appraisal_id != "") {
                                            $btn_name = "Update";
                                            $btn_id = "update";
                                            echo '<input type="hidden" name="command" id="command" value="update" />';
                                        ?>
                                            <input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id; ?>" />
                                        <?php
                                        } else {
                                            $btn_name = "Save";
                                            $btn_id = "save";
                                            echo '<input type="hidden" name="command" id="command" value="save" />';
                                        }
                                        ?>

                                        <div class="col-md-3 col-md-offset-3">
                                            <button type="button" id="<?php echo $btn_id; ?>" class=" btn btn-block btn-success" title="Save Data"><?php echo $btn_name; ?></button>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Close</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-footer -->
                            </form>
                        </div>
                        <!-- /.box -->

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php $this->load->view("template/footer"); ?>
        <div class="control-sidebar-bg"></div>
    </div>
    <?php $this->load->view("template/js-form"); ?>
    <script src="<?php echo $theme_link; ?>js/appraisal.js"></script>
    <script>
        $(".appraisal-active-li").addClass("active");
    </script>
</body>

</html>
<script>
    $(document).ready(function() {
        var Appraisal_ID = document.getElementById("ID").value;
        var typegorup = document.getElementById("TYPE").value;
        console.log(Appraisal_ID);
        if (Appraisal_ID) {
            // toastr["error"](console.log(Appraisal_ID));

            if (typegorup == 0) {
                document.getElementById("type-0").style.display = "block";
                document.getElementById("type-1").style.display = "none";
            } else if (typegorup == 1) {
                document.getElementById("type-0").style.display = "none";
                document.getElementById("type-1").style.display = "block";
            } else {
                document.getElementById("type-0").style.display = "none";
                document.getElementById("type-1").style.display = "none";
            }
        }
    });
</script>