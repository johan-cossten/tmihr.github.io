<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('template/css-form.php'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('template/sidebar.php'); ?>
        <?php
        if (!isset($training_id)) {
            $training_id = $TR_SYS_ID = $TR_SYS_CODE = $TR_INSTITUTION =  $TR_DUR_UNIT = $TR_DUR = $REMARKS = $EMPLOYEE = $PLN_SYS_ID = '';
            $TR_ST_DT = $TR_END_DT = date("d-m-Y");
        }
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $page_title; ?>
                    <small>Add/Update Training</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?php echo $base_url; ?>department/view">Training</a></li>
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
                            <form class="form-horizontal" id="training-form" onkeypress="return event.keyCode != 13;">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                                <input type="hidden" id="ID" value="<?php echo isset($ID) ? $ID : '' ?>">
                                <input type="hidden" id='role' value="<?= $this->session->userdata('role_id'); ?>">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="TR_SYS_CODE" class="col-sm-2 control-label">Training Code<span class="text-danger">*</span></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="TR_SYS_CODE" name="TR_SYS_CODE" placeholder="" value="<?php echo isset($TR_SYS_CODE) ? $TR_SYS_CODE : '' ?>" readonly>
                                        </div>
                                        <label for="PLN_SYS_ID" class="col-sm-2 control-label">Training Topic<label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <!-- <div class="input-group"> -->
                                            <select class="form-control select2" id="PLN_SYS_ID" name="PLN_SYS_ID" style="width: 100%;" onchange="afterupdate_topic()">
                                                <?php
                                                $q2 = $this->db->query("SELECT * FROM TMI.HR_TRAIN_PLAN A INNER JOIN TMI.HR_DEPT B ON A.PLN_DEPT = B.DEPT_SYS_ID WHERE A.STATUS <> 5 ORDER BY A.PLN_YEAR DESC");
                                                if ($q2->num_rows() > 0) {
                                                    echo "<option value=''>-Select-</option>";
                                                    foreach ($q2->result() as $res1) {
                                                        if ((isset($PLN_SYS_ID) && !empty($PLN_SYS_ID)) && $PLN_SYS_ID == $res1->PLN_SYS_ID) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                        echo "<option $selected value='" . $res1->PLN_SYS_ID . "'>" . $res1->PLN_TOPIC . ' - ' . $res1->DEPT_SYS_CD . "</option>";
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
                                    <div class="form-group">
                                        <label for="TR_DR" class="col-sm-2 control-label">Duration</label>
                                        <div class="col-sm-3">
                                            <input type="number" step="any" class="form-control" id="TR_DUR" name="TR_DUR" placeholder="" value="<?php echo isset($TR_DUR) ? $TR_DUR : '' ?>">
                                        </div>
                                        <label for="TR_DUR_UNIT" class="col-sm-2 control-label">Unit Duration</label>
                                        <div class="col-sm-3">
                                            <select class="form-control select2" id="TR_DUR_UNIT" name="TR_DUR_UNIT" style="width: 100%;">

                                                <?php
                                                $q3 = $this->db->select("*")->get("TMI.HR_TR_UNIT_DR");
                                                if ($q3->num_rows() > 0) {
                                                    echo "<option value=''>-Select-</option>";
                                                    foreach ($q3->result() as $res2) {
                                                        if ((isset($TR_DUR_UNIT) && !empty($TR_DUR_UNIT)) && $TR_DUR_UNIT == $res2->CODE) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                        echo "<option $selected value='" . $res2->CODE . "'>" . $res2->CODE . "</option>";
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
                                    <div class="form-group">
                                        <label for="TR_ST_DT" class="col-sm-2 control-label">Starting Date <label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="TR_ST_DT" name="TR_ST_DT" readonly value="<?php echo isset($TR_ST_DT) ? date("d-m-Y", strtotime($TR_ST_DT)) : date('d-m-Y') ?>">
                                            </div>
                                        </div>
                                        <label for="TR_END_DT" class="col-sm-2 control-label">Ending Date <label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="TR_END_DT" name="TR_END_DT" readonly value="<?php echo isset($TR_END_DT) ? date("d-m-Y", strtotime($TR_END_DT)) : date('d-m-Y') ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="TR_INSTITUTION" class="col-sm-2 control-label">Training Institution</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="TR_INSTITUTION" name="TR_INSTITUTION" placeholder="" value="<?php echo isset($TR_INSTITUTION) ? $TR_INSTITUTION : '' ?>" autocomplete="off">
                                        </div>
                                        <label for="REMARKS" class="col-sm-2 control-label">Remark</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="REMARKS" name="REMARKS" placeholder="" value="<?php echo isset($REMARKS) ? $REMARKS : '' ?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="EMPLOYEE" class="col-sm-2 control-label">Partisipation</label>
                                        <div class="col-sm-8">
                                            <select class="form-control js-example-basic-multiple" name="EMPLOYEE[]" multiple="multiple">
                                                <?php
                                                $employee_id = explode(",", $EMPLOYEE);
                                                $this->db2 = $this->load->database('tmi_ext', true);
                                                $q4 = $this->db2->query("SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE SUBSTR(OVT_BADGED, 1, 1) IN (0,1,2,3,9) ORDER BY OVT_DEPT_EMP ASC");
                                                if ($q4->num_rows() > 0) {
                                                    echo "<option value=''>-Select-</option>";
                                                    foreach ($q4->result() as $res4) {
                                                        if (in_array($res4->OVT_BADGED, $employee_id)) $selected = "selected";
                                                        else $selected = "";
                                                        echo "<option $selected value='" . $res4->OVT_BADGED . "'>" . $res4->OVT_NAME_EMP . ' - ' . $res4->OVT_DEPT_EMP . "</option>";
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
                                <!-- /.box-footer -->
                                <div class="box-footer">
                                    <div class="col-sm-8 col-sm-offset-2 text-center">
                                        <!-- <div class="col-sm-4"></div> -->
                                        <?php
                                        if ($training_id != "") {
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
    <script src="<?php echo $theme_link; ?>js/training.js"></script>
    <script>
        $(".training-active-li").addClass("active");
    </script>
</body>

</html>