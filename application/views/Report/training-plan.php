<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view("template/css-datatable"); ?>
    <?php $ROLEID = $this->session->userdata('role_id') ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view("template/sidebar"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?= $page_title; ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><?= $page_title; ?></li>
                </ol>
            </section>
            <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'table_form')); ?>
            <section class="content">
                <div class="row">
                    <?php $this->load->view("template/flashdata"); ?>
                    <div class="col-md-12">
                        <div class="box box-info ">
                            <div class="box-header with-border">
                                <h3 class="box-title">Please Enter Valid Information</h3>
                            </div>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="periode" class="col-sm-2 control-label">Periode</label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2 " id="periode" name="periode">
                                            <option value="-1">-All-</option>
                                            <?php
                                            $already_selected_value = $PLN_YEAR;
                                            $earliest_year = 2000;
                                            foreach (range(date('Y'), $earliest_year) as $x) {
                                                print '<option value="' . $x . '"' . ($x === $already_selected_value ? ' selected="selected"' : '') . '>' . $x . '</option>';
                                            }
                                            ?>
                                            <!-- <option value="<?php echo $row['CODE'] ?>" <?php echo isset($PLN_ACT_UNIT) && $PLN_ACT_UNIT == $row['CODE'] ? "selected" : "" ?>><?php echo $row['CODE'] ?></option> -->
                                        </select>
                                    </div>
                                    <label for="departmentid" class="col-sm-2 control-label">Department</label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2" name="departmentid" id="departmentid" style="width: 100%;" onkeyup="shift_cursor(event, 'statusid')">
                                            <?php
                                            if ($ROLEID !== 1 || $ROLEID !== 2) {
                                                $q1 = $this->db->query("SELECT * FROM HR_DEPT A INNER JOIN HR_USERS B 
                                                ON A.DEPT_SYS_ID = B.DEPT 
                                                WHERE ROLE_ID = $ROLEID");
                                            } else {
                                                echo "<option value=''>-All-</option>";
                                                $q1 = $this->db->query("SELECT * FROM HR_DEPT");
                                            }

                                            if ($q1->num_rows() > 0) {
                                                foreach ($q1->result() as $res) {
                                                    echo "<option value='" . $res->DEPT_SYS_ID . "'>" . $res->DEPT_NAME . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No Record Found</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="col-sm-8 col-sm-offset-2 text-center">
                                    <div class="col-md-3 col-md-offset-3">
                                        <button type="submit" name="view" class=" btn btn-block btn-success" title="Save Data">Show</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="<?= base_url() ?>">
                                            <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Close</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?= form_close(); ?>
        </div>
        <?php $this->load->view("template/footer"); ?>
        <div class="control-sidebar-bg"></div>
    </div>

    <?php $this->load->view("template/js-datatable"); ?>
    <!-- <script src="<?php echo $theme_link; ?>js/changestatus.js"></script> -->
    <script>
        $(".report-training-plan-active-li").addClass("active");
    </script>
</body>

</html>
<script type="text/javascript">
    //Date picker
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        todayHighlight: true
    });
</script>
<script>
    $(".close_btn").on("click", function() {
        if (confirm('Are you sure you want to navigate away from this page?')) {
            window.location = '<?php echo base_url() ?>';
        }
    });
</script>