<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('template/css-form.php'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('template/sidebar.php'); ?>
        <?php
        if (!isset($DEPT_SYS_CD)) {
            $DEPT_SYS_CD = $DEPT_NAME = "";
        }
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $page_title; ?>
                    <small>Add/Update Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?php echo $base_url; ?>department/view">Department</a></li>
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
                            <form class="form-horizontal" id="department-form" onkeypress="return event.keyCode != 13;">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" id="base_url" value="<?php echo $base_url; ?>">
                                <input type="hidden" id='role' value="<?= $this->session->userdata('role_id'); ?>">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="department" class="col-sm-2 control-label">Department Code<label class="text-danger">*</label></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control input-sm" id="department" name="department" placeholder="" onkeyup="shift_cursor(event,'description')" value="<?php print $DEPT_SYS_CD; ?>" autofocus>
                                            <span id="department_msg" style="display:none" class="text-danger"></span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label">Department Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control input-sm" id="description" name="description" placeholder="" value="<?php print $DEPT_NAME; ?>" autofocus>
                                            <span id="description_msg" style="display:none" class="text-danger"></span>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-footer -->
                                <div class="box-footer">
                                    <div class="col-sm-8 col-sm-offset-2 text-center">
                                        <!-- <div class="col-sm-4"></div> -->
                                        <?php
                                        if ($DEPT_SYS_CD != "") {
                                            $btn_name = "Update";
                                            $btn_id = "update";
                                        ?>
                                            <input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id; ?>" />
                                        <?php
                                        } else {
                                            $btn_name = "Save";
                                            $btn_id = "save";
                                        }
                                        ?>

                                        <div class="col-md-3 col-md-offset-3">
                                            <button type="button" id="<?php echo $btn_id; ?>" class=" btn btn-block btn-success" title="Save Data"><?php echo $btn_name; ?></button>
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- <a href="<?= base_url('dashboard'); ?>"> -->
                                            <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Close</button>
                                            <!-- </a> -->
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
    <script src="<?php echo $theme_link; ?>js/department.js"></script>
    <script>
        $(".-active-li").addClass("active");
    </script>
</body>

</html>