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
                                    <label for="from_date" class="col-sm-2 control-label">From Date</label>
                                    <div class="col-sm-3">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="from_date" name="from_date" onkeyup="shift_cursor(event, 'to_date')" value="<?php echo date('d-m-Y') ?>">
                                        </div>
                                    </div>
                                    <label for="to_date" class="col-sm-2 control-label">To Date</label>
                                    <div class="col-sm-3">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="to_date" name="to_date" onkeyup="shift_cursor(event, 'transactionid')" value="<?php echo date('d-m-Y') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="transactionid" class="col-sm-2 control-label">Transaction</label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2" name="transactionid" id="transactionid" style="width: 100%;" onkeyup="shift_cursor(event, 'departmentid')">
                                            <option value="">-All-</option>
                                            <?php
                                            if ($ROLEID !== 1 || $ROLEID !== 2) : ?>
                                                <option value="1">Appraisal</option>
                                                <option value="2">Training Plan</option>
                                                <option value="3">Training Evaluation</option>
                                            <?php else : ?>
                                                <option value="0">Assessment</option>
                                                <option value="1">Appraisal</option>
                                                <option value="2">Training Plan</option>
                                                <option value="3">Training Evaluation</option>
                                                <option value="4">Training Record</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <label for="departmentid" class="col-sm-2 control-label">Department</label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2" name="departmentid" id="departmentid" style="width: 100%;" onkeyup="shift_cursor(event, 'statusid')">
                                            <?php
                                            if ($ROLEID == 1 || $ROLEID == 2) {
                                                echo "<option value=''>-All-</option>";
                                                $q1 = $this->db->query("SELECT * FROM HR_DEPT");
                                            } else {
                                                $q1 = $this->db->query("SELECT * FROM HR_DEPT A INNER JOIN HR_USERS B 
                                                ON A.DEPT_SYS_ID = B.DEPT 
                                                WHERE ROLE_ID = $ROLEID");
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
                                <div class="form-group">
                                    <label for="statusid" class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2" name="statusid" id="statusid" style="width: 100%;">
                                            <option value="">-All-</option>
                                            <?php
                                            $q1 = $this->db->query("SELECT * FROM HR_STATUS WHERE STATUSID NOT IN (5,6)");
                                            if ($q1->num_rows() > 0) {
                                                foreach ($q1->result() as $res) {
                                                    echo "<option value='" . $res->STATUSID . "'>" . $res->STATUS_NAME . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No Record Found</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label for="changeto" class="col-sm-2 control-label">Change To Status</label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2" name="changeto" id="changeto" style="width: 100%;">
                                            <option value="">-All-</option>
                                            <?php
                                            $q1 = $this->db->query("SELECT * FROM HR_STATUS WHERE STATUSID NOT IN (5,6)");
                                            if ($q1->num_rows() > 0) {
                                                foreach ($q1->result() as $res) {
                                                    echo "<option value='" . $res->STATUSID . "'>" . $res->STATUS_NAME . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No Record Found</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <!-- <div class="box-header">
                                <h3 class="box-title">Records Table</h3>
                                <button type="button" class="btn btn-info pull-right btnExport" title="Change Status">Change Status</button>
                            </div> -->
                            <input type="hidden" id='base_url' value="<?= $base_url; ?>">
                            <div class="box-body table-rensponsive">
                                <table id="example2" class="table table-bordered table-striped" width="100%">
                                    <colgroup>
                                        <col style="width: 2%;">
                                        <col style="width: 10%;">
                                        <col style="width: 10%;">
                                        <col style="width: 10%;">
                                        <col style="width: 10%;">
                                        <col style="width: 8%;">
                                    </colgroup>
                                    <thead>
                                        <tr class="bg-blue">
                                            <th class="text-center">
                                                <input type="checkbox" class="group_check checkbox">
                                            </th>
                                            <th>Transaction Type</th>
                                            <th>Transaction Code</th>
                                            <th>Transaction Date</th>
                                            <th>Department</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="transcation-status">

                                    </tbody>
                                </table>
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
    <script src="<?php echo $theme_link; ?>js/changestatus.js"></script>
    <script>
        $(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
    </script>
</body>

</html>
<script type="text/javascript">
    function load_datatable() {
        var from_date = document.getElementById("from_date").value.trim();
        var to_date = document.getElementById("to_date").value.trim();
        var transaction = document.getElementById("transactionid").value.trim();
        var department = document.getElementById("departmentid").value.trim();
        var status = document.getElementById("statusid").value.trim();
        var changeto = document.getElementById("changeto").value.trim();

        if (this.id == "view_all") {
            var view_all = 'yes';
        } else {
            var view_all = 'no';
        }

        //datatables
        var table = $('#example2').DataTable({
            /* FOR EXPORT BUTTONS START*/
            dom: '<"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr><"pull-right margin-left-10 "B>>>tip',
            /* dom:'<"row"<"col-sm-12"<"pull-left"B><"pull-right">>> <"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr>>>tip',*/
            buttons: {
                buttons: [{
                    className: 'btn bg-blue color-palette btn-flat hidden delete_btn pull-left',
                    text: 'Change Status',
                    action: function(e, dt, node, config) {
                        change_status();
                    }
                }, ]
            },
            /* FOR EXPORT BUTTONS END */

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "responsive": true,
            language: {
                processing: '<div class="text-primary bg-primary" style="position: relative;z-index:100;overflow: visible;">Processing...</div>'
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('settings/ajax_list') ?>",
                "type": "POST",
                "data": {
                    from_date: from_date,
                    to_date: to_date,
                    transaction: transaction,
                    department: department,
                    status: status,
                    view_all: view_all,
                },

                complete: function(data) {
                    $('.column_checkbox').iCheck({
                        checkboxClass: 'icheckbox_square-orange',
                        /*uncheckedClass: 'bg-white',*/
                        radioClass: 'iradio_square-orange',
                        increaseArea: '10%' // optional
                    });
                    call_code();
                    //$(".delete_btn").hide();
                },

            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                    "targets": [0], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                {
                    "targets": [0],
                    "className": "text-center",
                },

            ],
        });
        new $.fn.dataTable.FixedHeader(table);
    };
    $(document).ready(function() {
        //datatables
        load_datatable();
    });
    $("#from_date,#to_date,#transactionid,#departmentid,#statusid").change(function() {
        $('#example2').DataTable().destroy();
        load_datatable();
    });
</script>
<script type="text/javascript">
    //Date picker
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        todayHighlight: true
    });
</script>