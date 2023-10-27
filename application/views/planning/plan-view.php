<!DOCTYPE html>
<html>

<head>
    <!-- TABLES CSS CODE -->
    <?php $this->load->view("template/css-datatable"); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view("template/sidebar"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Training Planning List
                    <small>View/Search Training Planning</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Training Planning List</li>
                </ol>
            </section>
            <?php
            $CI = &get_instance();
            ?>
            <div class="view_planning_modal">
            </div>
            <!-- Main content -->
            <?= form_open('#', array('class' => '', 'id' => 'table_form')); ?>
            <input type="hidden" id='base_url' value="<?= $base_url; ?>">
            <input type="hidden" id='role' value="<?= $this->session->userdata('role_id'); ?>">
            <section class="content">
                <div class="row">
                    <?php $this->load->view("template/flashdata"); ?>
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $page_title; ?></h3>
                                <?php if ($CI->permission('trainingplan_add')) { ?>
                                    <div class="box-tools">
                                        <a class="btn btn-block btn-info" href="<?php echo $base_url; ?>planning/add">
                                            <i class="fa fa-plus"></i> Add Planning</a>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-striped" width="100%">
                                    <colgroup>
                                        <col style="width: 2%;">
                                        <col style="width: 2%;">
                                        <col style="width: 5%;">
                                        <col style="width: 15%;">
                                        <col style="width: 3%;">
                                        <col style="width: 4%;">
                                        <col style="width: 4%;">
                                    </colgroup>
                                    <thead class="bg-primary ">
                                        <tr>
                                            <th>#</th>
                                            <th>Period</th>
                                            <th>Training Code</th>
                                            <th>Training Topic</th>
                                            <th>Department</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
            <?= form_close(); ?>
        </div>
        <!-- /.content-wrapper -->
        <?php $this->load->view("template/footer"); ?>
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- TABLES CODE -->
    <?php $this->load->view("template/js-datatable"); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            //datatables
            var table = $('#example2').DataTable({

                /* FOR EXPORT BUTTONS START*/
                dom: '<"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr><"pull-right margin-left-10 "B>>>tip',
                /* dom:'<"row"<"col-sm-12"<"pull-left"B><"pull-right">>> <"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr>>>tip',*/
                buttons: {
                    buttons: [{
                            className: 'btn bg-red color-palette btn-flat hidden delete_btn pull-left',
                            text: 'Delete',
                            action: function(e, dt, node, config) {
                                multi_delete();
                            }
                        },
                        {
                            extend: 'copy',
                            className: 'btn bg-teal color-palette btn-flat',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excel',
                            className: 'btn bg-teal color-palette btn-flat',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdf',
                            className: 'btn bg-teal color-palette btn-flat',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn bg-teal color-palette btn-flat',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csv',
                            className: 'btn bg-teal color-palette btn-flat',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'colvis',
                            className: 'btn bg-teal color-palette btn-flat',
                            text: 'Columns'
                        },

                    ]
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
                    "url": "<?php echo site_url('planning/ajax_list') ?>",
                    "type": "POST",

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
                        "targets": [0, 6], //first column / numbering column
                        "orderable": false, //set not orderable
                    },
                    {
                        "targets": [0],
                        "className": "text-center",
                    },

                ],
            });
            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
    <script src="<?php echo $theme_link; ?>js/planning.js"></script>
    <script>
        $(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
    </script>

</body>

</html>