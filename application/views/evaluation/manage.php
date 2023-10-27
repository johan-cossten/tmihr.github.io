<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('template/css-form.php'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('template/sidebar.php'); ?>
        <?php
        if (!isset($evaluation_id)) {
            $evaluation_id = $EMP_CODE = $PLN_SYS_ID =  $CONDUCTED = '';
            $COST_EVA = $FIELDCHECK1 = $FIELDTEXT1 = $FIELDCHECK2 = $FIELDTEXT2 = $PLN_PLAN_QTY = $PLN_PLAN_UNIT = '';
        }

        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $page_title; ?>
                    <small>Add/Update Training Evaluation</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?php echo $base_url; ?>evaluation/view">Training Evaluation</a></li>
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
                            <form class="form-horizontal" id="evaluation-form" onkeypress="return event.keyCode != 13;">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                                <input type="hidden" id="ID" value="<?php echo isset($ID) ? $ID : '' ?>">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="EMP_CODE" class="col-sm-2 control-label">Employee</label>
                                        <div class="col-sm-3">
                                            <?php if ($EMP_CODE !== '') : ?>
                                                <select class="form-control select2" id="EMP_CODE" name="EMP_CODE" style="width: 100%;" onchange="add_topic()" disabled>
                                                <?php else : ?>
                                                    <select class="form-control select2" id="EMP_CODE" name="EMP_CODE" style="width: 100%;" onchange="add_topic()">
                                                    <?php endif; ?>
                                                    <?php

                                                    $dept_id = $this->session->userdata('dept_id');
                                                    $role_id = $this->session->userdata('role_id');

                                                    $this->db2 = $this->load->database('tmi_ext', true);
                                                    if ($role_id == 1 || $role_id == 141) {
                                                        $q2 = $this->db2->query("SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_CODE IS NULL");
                                                    } else {
                                                        $r1 = $this->db->query("SELECT * FROM HR_DEPT WHERE DEPT_SYS_ID = " . $dept_id);
                                                        $dept_name = $r1->row()->DEPT_NAME;
                                                        $q2 = $this->db2->query("SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_CODE IS NULL AND OVT_DEPT_EMP='$dept_name'");
                                                    }

                                                    if ($q2->num_rows() > 0) {
                                                        echo "<option value=''>-Select-</option>";
                                                        foreach ($q2->result() as $res1) {
                                                            if ((isset($EMP_CODE) && !empty($EMP_CODE)) && $EMP_CODE == $res1->OVT_BADGED) {
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
                                        <label for="PLN_SYS_ID" class="col-sm-2 control-label">Training Topic<label class="text-danger">*</label></label>
                                        <div class="col-sm-3">
                                            <select class="form-control select2" id="PLN_SYS_ID" name="PLN_SYS_ID" style="width: 100%;" onchange="updateduration()">
                                                <?php
                                                $dept_id = $this->session->userdata('dept_id');
                                                $role_id = $this->session->userdata('role_id');
                                                if ($role_id == 1 || $role_id == 141) {
                                                    $q2 = $this->db->query("SELECT * FROM TMI.HR_TRAIN_PLAN ORDER BY PLN_YEAR DESC");
                                                } else {
                                                    $q2 = $this->db->query("SELECT * FROM TMI.HR_TRAIN_PLAN WHERE PLN_DEPT = $dept_id ORDER BY PLN_YEAR DESC");
                                                }
                                                // $q2 = $this->db->select("*")->get("TMI.HR_TRAIN_PLAN");
                                                if ($q2->num_rows() > 0) {
                                                    echo "<option value=''>-Select-</option>";
                                                    foreach ($q2->result() as $res1) {
                                                        if ((isset($PLN_SYS_ID) && !empty($PLN_SYS_ID)) && $PLN_SYS_ID == $res1->PLN_SYS_ID) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                        echo "<option $selected value='" . $res1->PLN_SYS_ID . "'>" . $res1->PLN_TOPIC . "</option>";
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
                                        <label for="CONDUCTED" class="col-sm-2 control-label">Conducted</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="CONDUCTED" name="CONDUCTED" placeholder="" value="<?php echo isset($CONDUCTED) ? $CONDUCTED : '' ?>" autocomplete="off">
                                        </div>
                                        <label for="COST_EVA" class="col-sm-2 control-label">Cost ( if any )</label>
                                        <div class="col-sm-3">
                                            <input type="number" class="form-control" id="COST_EVA" name="COST_EVA" min="0" step="1.00" max="1000000000" value="<?php echo isset($COST_EVA) ? $COST_EVA : 0 ?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="plan_qty" class="col-sm-2 control-label">Plan Duration</label>
                                        <div class="col-sm-3">
                                            <input type="number" step="any" class="form-control" id="plan_qty" name="plan_qty" placeholder="" min="0" value="<?php echo isset($PLN_PLAN_QTY) ? $PLN_PLAN_QTY : '' ?>" disabled>
                                        </div>
                                        <label for="plan_unit" class="col-sm-2 control-label">Plan Unit</label>
                                        <div class="col-sm-3">
                                            <select class="form-control select2" id="plan_unit" name="plan_unit" style="width: 100%;" disabled>
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
                                        <label class="control-label col-sm-5">Was the courde content appropriate to knowledge that you seeking ?</label>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label><input type="radio" name="FIELDCHECK1" id="optionsRadios1" value="1" <?php echo isset($FIELDCHECK1) && $FIELDCHECK1 == "1" ? "checked" : "" ?>> Yes</label>
                                                <label><input type="radio" name="FIELDCHECK1" id="optionsRadios2" value="0" <?php echo isset($FIELDCHECK1) && $FIELDCHECK1 == "0" ? "checked" : "" ?>> No Reason</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" value="<?php echo isset($FIELDTEXT1) ? $FIELDTEXT1 : '' ?>" name="FIELDTEXT1" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Are you confident that the knowledge gained will be useful to your work ?</label>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label><input type="radio" name="FIELDCHECK2" id="optionsRadios3" value="1" <?php echo isset($FIELDCHECK2) && $FIELDCHECK2 == "1" ? "checked" : "" ?>> Yes</label>
                                                <label><input type="radio" name="FIELDCHECK2" id="optionsRadios4" value="0" <?php echo isset($FIELDCHECK2) && $FIELDCHECK2 == "0" ? "checked" : "" ?>> No Reason</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="FIELDTEXT2" autocomplete="off" value="<?php echo isset($FIELDTEXT2) ? $FIELDTEXT2 : '' ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-footer -->
                                <div class="box-footer">
                                    <div class="col-sm-8 col-sm-offset-2 text-center">
                                        <!-- <div class="col-sm-4"></div> -->
                                        <?php
                                        if ($evaluation_id != "") {
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
                                            <a href="<?= base_url('evaluation'); ?>">
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
    <script src="<?php echo $theme_link; ?>js/evaluation.js"></script>
    <script>
        $(".evaluation-active-li").addClass("active");
    </script>
</body>

</html>