<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('template/css-form.php'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('template/sidebar.php'); ?>
        <?php
        if (!isset($assessment_id)) {
            $assessment_id = $CODE = $EMPLOYEEID =  $PURPOSE = '';
            $REASON_ACCOUN = $ATT_UNPAID = $ATT_MEDICAL = $ATT_ABSENT = $WL3_MONTH = $WL6_MONTH = $WL12_MONTH = $WL_JOIN = $WL3_MONTH_1 = $WL6_MONTH_1 = $WL12_MONTH_1 = $WL_JOIN_1 = 0;
            $FLEX03 = $FLEX04 = $FLEX05 = '';
            $DATEASSESS = $DATEPERIODFR = $DATEPERIODTO = date("d-m-Y");
        }
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
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

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- right column -->
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="box box-info ">
                            <div class="box-header with-border">
                                <h3 class="box-title">Please Enter Valid Data</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form class="form-horizontal" id="assessment-form" onkeypress="return event.keyCode != 13;">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                                <input type="hidden" id="ID" value="<?php echo isset($ID) ? $ID : '' ?>">
                                <input type="hidden" id='role' value="<?= $this->session->userdata('role_id'); ?>">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="employeeid" class="col-sm-4 control-label">Employee </label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2" id="employeeid" name="employeeid" style="width: 100%;">
                                                        <?php
                                                        $this->db2 = $this->load->database('tmi_ext', true);
                                                        // $q2 = $this->db2->select("*")->get("TMIEXT.OVT_OM_EMPLOYEES");
                                                        $q2 = $this->db2->query("SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_CODE IS NULL");
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
                                                <label for="date_assessment" class="col-sm-4 control-label">Date </label>
                                                <div class="col-sm-8">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right datepicker" value="<?php echo isset($DATEASSESS) ? date('d-m-Y', strtotime($DATEASSESS)) : date('d-m-Y'); ?>" id="date_assessment" name="date_assessment" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="period_assessment" class="col-sm-4 control-label">Period of Assessment </label>
                                                <div class="col-sm-8">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right datepicker" value="<?php echo isset($DATEPERIODFR) ? date('d-m-Y', strtotime($DATEPERIODFR)) : date('d-m-Y'); ?>" id="period_assessment" name="period_assessment" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="to_period_assessment" class="col-sm-4 control-label">To</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right datepicker" value="<?php echo isset($DATEPERIODTO) ? date('d-m-Y', strtotime($DATEPERIODTO)) : date('d-m-Y'); ?>" id="to_period_assessment" name="to_period_assessment" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="PURPOSE" class="col-sm-4 control-label">Purpose of Assessment </label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2" id="PURPOSE" name="PURPOSE" style="width: 100%;">
                                                        <option <?php echo !isset($PURPOSE) ? 'selected' : '' ?> disabled></option>
                                                        <option value="0" <?php echo isset($PURPOSE) && $PURPOSE == "0" ? "selected" : "" ?>>Annual</option>
                                                        <option value="1" <?php echo isset($PURPOSE) && $PURPOSE == "1" ? "selected" : "" ?>>Promotion</option>
                                                        <option value="2" <?php echo isset($PURPOSE) && $PURPOSE == "2" ? "selected" : "" ?>>Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive" style="width: 100%">
                                            <style type="text/css">
                                                .tg {
                                                    border-collapse: collapse;
                                                    border-spacing: 0;
                                                }

                                                .tg td {
                                                    border-color: black;
                                                    border-style: solid;
                                                    border-width: 0px;
                                                    font-family: Arial, sans-serif;
                                                    font-size: 14px;
                                                    overflow: hidden;
                                                    padding: 10px 5px;
                                                    word-break: normal;
                                                }

                                                .tg .tg-cly1 {
                                                    text-align: left;
                                                    vertical-align: middle
                                                }
                                            </style>
                                            <table class="tg" table-layout: fixed; width: 652px">
                                                <colgroup>
                                                    <col style="width: 150px">
                                                    <col style="width: 130px">
                                                    <col style="width: 150px">
                                                    <col style="width: 120px">
                                                    <col style="width: 150px">
                                                    <col style="width: 120px">
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th class="tg-cly1" colspan="6">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;1. Attandance Record</label>
                                                                </div>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="tg-cly1">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-12 control-label">Unpaid Leave</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="unpaid_score" name="unpaid_score" placeholder="" value="<?php echo isset($ATT_UNPAID) ? $ATT_UNPAID : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-sm-12 control-label">Medical Leave</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="medical_score" name="medical_score" placeholder="" value="<?php echo isset($ATT_MEDICAL) ? $ATT_MEDICAL : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-8 control-label">Absent</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="absent_score" name="absent_score" placeholder="" value="<?php echo isset($ATT_ABSENT) ? $ATT_ABSENT : '' ?>">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-cly1" colspan="6">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;2. No of Warning Letters</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="warning01" name="warning01" placeholder="" value="<?php echo isset($WL3_MONTH) ? $WL3_MONTH : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <label class="col-sm-14 control-label">(due to absent)</label>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="warning02" name="warning02" placeholder="" value="<?php echo isset($WL3_MONTH_1) ? $WL3_MONTH_1 : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1" colspan="3">
                                                            <label class="col-sm-14 control-label">(due to others) in the last 3 months</label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="warning03" name="warning03" placeholder="" value="<?php echo isset($WL6_MONTH) ? $WL6_MONTH : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <label class="col-sm-14 control-label">(due to absent)</label>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="warning04" name="warning04" placeholder="" value="<?php echo isset($WL6_MONTH_1) ? $WL6_MONTH_1 : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1" colspan="3">
                                                            <label class="col-sm-14 control-label">(due to others) in the last 6 months</label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="warning05" name="warning05" placeholder="" value="<?php echo isset($WL12_MONTH) ? $WL12_MONTH : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <label class="col-sm-14 control-label">(due to absent)</label>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="warning06" name="warning06" placeholder="" value="<?php echo isset($WL12_MONTH_1) ? $WL12_MONTH_1 : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1" colspan="3">
                                                            <label class="col-sm-14 control-label">(due to others) in the last 12 months</label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="warning07" name="warning07" placeholder="" value="<?php echo isset($WL_JOIN) ? $WL_JOIN : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <label class="col-sm-14 control-label">(due to absent)</label>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="warning08" name="warning08" placeholder="" value="<?php echo isset($WL_JOIN_1) ? $WL_JOIN_1 : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1" colspan="3">
                                                            <label class="col-sm-14 control-label">(due to others) since joined</label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-cly1" colspan="2">
                                                            <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;3. No of Accountability Report</label>
                                                        </td>
                                                        <td class="tg-cly1">
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" id="account_score" name="account_score" placeholder="" value="<?php echo isset($REASON_ACCOUN) ? $REASON_ACCOUN : '' ?>">
                                                            </div>
                                                        </td>
                                                        <td class="tg-cly1" colspan="3">
                                                            <label class="col-sm-14 control-label">in the last 12 months</label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-cly1" colspan="2">
                                                            <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Reason of Accountability report :</label>
                                                        </td>
                                                        <td class="tg-cly1"></td>
                                                        <td class="tg-cly1"></td>
                                                        <td class="tg-cly1"></td>
                                                        <td class="tg-cly1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-cly1" colspan="6">
                                                            <div class="col-md-10">
                                                                <div class="form-group">
                                                                    <label class="col-sm-1 control-label">1</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="reason1" name="reason1" placeholder="" value="<?php echo isset($FLEX03) ? $FLEX03 : '' ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-cly1" colspan="6">
                                                            <div class="col-md-10">
                                                                <div class="form-group">
                                                                    <label class="col-sm-1 control-label">2</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="reason2" name="reason2" placeholder="" value="<?php echo isset($FLEX04) ? $FLEX04 : '' ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-cly1" colspan="6">
                                                            <div class="col-md-10">
                                                                <div class="form-group">
                                                                    <label class="col-sm-1 control-label">3</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="reason3" name="reason3" placeholder="" value="<?php echo isset($FLEX05) ? $FLEX05 : '' ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-footer -->
                                <div class="box-footer">
                                    <div class="col-sm-8 col-sm-offset-2 text-center">
                                        <!-- <div class="col-sm-4"></div> -->
                                        <?php
                                        if ($assessment_id != "") {
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
                                            <a href="<?= base_url('assessment'); ?>">
                                                <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Close</button>
                                            </a>
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
    <script src="<?php echo $theme_link; ?>js/assessment.js"></script>
    <script>
        $(".assessment-active-li").addClass("active");
    </script>
</body>

</html>