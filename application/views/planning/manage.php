<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('template/css-form.php'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('template/sidebar.php'); ?>
        <?php
        if (!isset($planning_id)) {
            $planning_id = $PLN_DEPT = $PLN_TOPIC =  $PLN_PLAN_UNIT = '';
            $PLN_REMARK = $PLN_PLAN_QTY = '';
            $PLN_YEAR = date("Y");
            $PLN_ST_DT = $PLN_EN_DT = date('d-m-Y');
        }

        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $page_title; ?>
                    <small>Add/Update Training Planning</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?php echo $base_url; ?>planning/view">Training Planning</a></li>
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
                            <form class="form-horizontal" id="planning-form" onkeypress="return event.keyCode != 13;">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                                <input type="hidden" id="ID" value="<?php echo isset($ID) ? $ID : '' ?>">
                                <input type="hidden" id='role' value="<?= $this->session->userdata('role_id'); ?>">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="PLN_YEAR" class="col-sm-2 control-label">Periode <label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <select class="form-control select2" id="PLN_YEAR" name="PLN_YEAR" style="width: 100%;">
                                                <option <?php echo !isset($PLN_YEAR) ? 'selected' : '' ?> disabled></option>
                                                <?php
                                                $already_selected_value = $PLN_YEAR;
                                                $earliest_year = 2000;
                                                foreach (range(date('Y'), $earliest_year) as $x) {
                                                    print '<option value="' . $x . '"' . ($x == $already_selected_value ? ' selected="selected"' : '') . '>' . $x . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <label for="PLN_DEPT" class="col-sm-2 control-label">Department <label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <select class="form-control select2" id="PLN_DEPT" name="PLN_DEPT" style="width: 100%;" autofocus>
                                                <?php
                                                $q2 = $this->db->select("*")->get("TMI.HR_DEPT");
                                                if ($q2->num_rows() > 0) {
                                                    echo "<option value=''>-Select-</option>";
                                                    foreach ($q2->result() as $res1) {
                                                        if ((isset($PLN_DEPT) && !empty($PLN_DEPT)) && $PLN_DEPT == $res1->DEPT_SYS_ID) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                        echo "<option $selected value='" . $res1->DEPT_SYS_ID . "'>" . $res1->DEPT_NAME . "</option>";
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
                                        <label for="PLN_ST_DT" class="col-sm-2 control-label">Starting Date <label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="PLN_ST_DT" name="PLN_ST_DT" readonly value="<?php echo isset($PLN_ST_DT) ? date("d-m-Y", strtotime($PLN_ST_DT)) : date('d-m-Y') ?>">
                                            </div>
                                        </div>
                                        <label for="PLN_EN_DT" class="col-sm-2 control-label">Ending Date <label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="PLN_EN_DT" name="PLN_EN_DT" readonly value="<?php echo isset($PLN_EN_DT) ? date("d-m-Y", strtotime($PLN_EN_DT)) : date('d-m-Y') ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="PLN_PLAN_QTY" class="col-sm-2 control-label">Duration <label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <input type="number" step="any" class="form-control" id="PLN_PLAN_QTY" name="PLN_PLAN_QTY" placeholder="" min="0" value="<?php echo isset($PLN_PLAN_QTY) ? $PLN_PLAN_QTY : '' ?>">
                                        </div>
                                        <label for="PLN_PLAN_UNIT" class="col-sm-2 control-label">Unit <label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <select class="form-control select2" id="PLN_PLAN_UNIT" name="PLN_PLAN_UNIT" style="width: 100%;">
                                                <?php
                                                $q2 = $this->db->select("*")->get("TMI.HR_TR_UNIT_DR");
                                                if ($q2->num_rows() > 0) {
                                                    echo "<option value=''>-Select-</option>";
                                                    foreach ($q2->result() as $res1) {
                                                        if ((isset($PLN_PLAN_UNIT) && !empty($PLN_PLAN_UNIT)) && $PLN_PLAN_UNIT == $res1->CODE) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                        echo "<option $selected value='" . $res1->CODE . "'>" . $res1->CODE . "</option>";
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
                                        <label for="PLN_TOPIC" class="col-sm-2 control-label">Topic <label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <textarea type="text" class="form-control" id="PLN_TOPIC" name="PLN_TOPIC" placeholder=""><?php echo isset($PLN_TOPIC) ? $PLN_TOPIC : '' ?></textarea>
                                        </div>


                                        <label for="PLN_REMARK" class="col-sm-2 control-label">Remark</label>
                                        <div class="col-sm-3">
                                            <textarea type="text" class="form-control col-sm-2" id="PLN_REMARK" name="PLN_REMARK" placeholder=""><?php echo isset($PLN_REMARK) ? $PLN_REMARK : '' ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-footer -->
                                <div class="box-footer">
                                    <div class="col-sm-8 col-sm-offset-2 text-center">
                                        <!-- <div class="col-sm-4"></div> -->
                                        <?php
                                        // $planning_id = '';
                                        if ($planning_id != "") {
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
    <script src="<?php echo $theme_link; ?>js/planning.js"></script>
    <script>
        $(".plan-active-li").addClass("active");
    </script>
</body>

</html>