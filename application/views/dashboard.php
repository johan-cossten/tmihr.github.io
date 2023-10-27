<!DOCTYPE html>
<html>

<head>
    <!-- FORM CSS CODE -->
    <?php include "template/css-datatable.php"; ?>
    <!-- </copy> -->
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo $theme_link; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <style type="text/css">
        #chart_container {
            min-width: 320px;
            max-width: 600px;
            margin: 0 auto;
        }

        .list_notif {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
        }


        /* .oo_alert.active,
        .msg_notif.active {
            background: #718fe6;
        }

        .oo_alert.active .datetime,
        .oo_alert.active .msg {
            color: white;
        } */
    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include "template/sidebar.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper ">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $page_title; ?>
                    <small>Overall Information on Single Screen</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Home</li>
                </ol>
            </section><br />
            <div class="row">
                <div class="col-md-12">
                    <!-- ********** ALERT MESSAGE START******* -->
                    <?php include "template/flashdata.php"; ?>
                    <!-- ********** ALERT MESSAGE END******* -->
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <!-- /.row -->
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>
                                    <?php echo $tot_emp ?>
                                </h3>
                                <p>Total Employee</p>
                                <p><b><?php echo $total_employee_active; ?> Total Employee Active</b></p>

                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="<?php echo base_url('employee/view') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?php echo $tot_dept ?></h3>

                                <p>Total Department</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-hashtag"></i>
                            </div>
                            <a href="<?php echo base_url('department/view') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3><?php echo $tot_users; ?></h3>

                                <p>Total Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion-person-stalker"></i>
                            </div>
                            <a href="<?php echo base_url('users/view') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="ion ion-clipboard"></i></span>
                            <div class="info-box-content">
                                <span class="text-bold text-uppercase">Total Training Record</span>
                                <span class="info-box-number"><?php echo $tot_tr; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="ion ion-clipboard"></i></span>
                            <div class="info-box-content">
                                <span class="text-bold text-uppercase">Total Training Evaluation</span>
                                <span class="info-box-number"><?php echo $tot_eva; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="ion ion-clipboard"></i></span>
                            <div class="info-box-content">
                                <span class="text-bold text-uppercase">Total Training Plan</span>
                                <span class="info-box-number"><?php echo $tot_plan; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title text-uppercase">Training Record Employee Training Expired Alert</h3>
                            </div>
                            <div class="box-body table-responsive">
                                <form method="post">
                                    <input type="hidden" id="base_url" value="<?php echo base_url()  ?>">
                                    <style>
                                        td {
                                            word-break: break-all;
                                        }
                                    </style>
                                    <table class="table table-bordered table-striped" width="100%" id="training_table">
                                        <colgroup>
                                            <col width="2%">
                                            <col width="15%">
                                            <col width="15%">
                                            <col width="20%">
                                            <col width="5%">
                                            <col width="5%">
                                            <col width="5%">
                                            <col width="5%">
                                        </colgroup>
                                        <thead class="bg-primary ">
                                            <tr>
                                                <th>#</th>
                                                <th style="word-wrap:break-word">Emp Code</th>
                                                <th style="word-wrap:break-word">Emp Name</th>
                                                <th>Training Topic</th>
                                                <th>Duration</th>
                                                <th>Duration Unit</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title text-uppercase">Training Record Bar Chart</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="barChart" style="height:230px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title text-uppercase">Transaction Status Alert</h3>
                            </div>
                            <div class="box-body table-responsive">
                                <table class="table table-bordered table-responsive" id="transaction_table">
                                    <tr class='bg-blue'>
                                        <td>#</td>
                                        <td>Trans Type</td>
                                        <td>Trans Code</td>
                                        <td>Trans Status</td>
                                    </tr>
                                    <tbody id="body_transaction">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-center"><a href="<?php echo $base_url; ?>setting/change_status" class="uppercase">View All</a></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row">
                    <div class=" col-sm-12 col-md-12 col-lg-12 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-body ">
                                <div id="bar_container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                //BARCHART

                $hr_pln = $al_pln = $pe_pln = $cl_pln = $ml_pln = $so_pln = $as_pln = $pl_pln = $hv_pln = $qa_pln = $lg_pln = $eg_pln = $mt_pln = $mg_pln = $ac_pln = $pc_pln = $it_pln = 0;
                $hr_tr = $al_tr = $pe_tr = $cl_tr = $ml_tr = $so_tr = $as_tr = $pl_tr = $hv_tr = $qa_tr = $lg_tr = $eng_tr = $mt_tr = $mg_tr = $ac_tr = $pc_tr = $it_tr = 0;

                $q1 = $this->db->query("SELECT COUNT (DISTINCT PLN_SYS_ID) AS TOT_PLN, A.DEPT_SYS_CD FROM TMI.HR_DEPT A
			LEFT JOIN TMI.HR_TRAIN_PLAN B ON A.DEPT_SYS_ID = B.PLN_DEPT AND B.PLN_YEAR = 2023
			WHERE A.DEPT_SYS_ID NOT IN (18, 21, 22, 23)
			GROUP BY A.DEPT_SYS_CD");
                if ($q1->num_rows() > 0) {
                    foreach ($q1->result() as $res1) {
                        if ($res1->DEPT_SYS_CD == 'HR') {
                            $hr_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'AL') {
                            $al_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'PE') {
                            $pe_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'CL') {
                            $cl_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'ML') {
                            $ml_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'SO') {
                            $so_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'AS') {
                            $as_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'PL') {
                            $pl_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'HV') {
                            $hv_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'QA') {
                            $qa_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'LG') {
                            $lg_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'EG') {
                            $eg_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'MT') {
                            $mt_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'MG') {
                            $mg_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'AC') {
                            $ac_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'PC') {
                            $pc_pln = $res1->TOT_PLN;
                        } else if ($res1->DEPT_SYS_CD == 'IT') {
                            $it_pln = $res1->TOT_PLN;
                        }
                    }
                }

                //DONAT CHART
                $q2 = $this->db->query("SELECT COUNT (DISTINCT C.PLN_SYS_ID) AS TOT, A.DEPT_SYS_CD FROM TMI.HR_DEPT A
			LEFT JOIN TMI.HR_TRAIN_PLAN B ON A.DEPT_SYS_ID = B.PLN_DEPT AND B.PLN_YEAR = 2023
			LEFT JOIN TMI.HR_TRAINING_RCD C ON B.PLN_SYS_ID = C.PLN_SYS_ID 
			WHERE A.DEPT_SYS_ID NOT IN (18, 21, 22, 23)
			GROUP BY A.DEPT_SYS_CD");
                if ($q2->num_rows() > 0) {
                    foreach ($q2->result() as $res2) {
                        if ($res2->DEPT_SYS_CD == 'HR') {
                            $hr_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'AL') {
                            $al_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'PE') {
                            $pe_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'CL') {
                            $cl_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'ML') {
                            $ml_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'SO') {
                            $so_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'AS') {
                            $as_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'PL') {
                            $pl_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'HV') {
                            $hv_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'QA') {
                            $qa_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'LG') {
                            $lg_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'EG') {
                            $eng_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'MT') {
                            $mt_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'MG') {
                            $mg_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'AC') {
                            $ac_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'PC') {
                            $pc_tr = $res2->TOT;
                        } else if ($res2->DEPT_SYS_CD == 'IT') {
                            $it_tr = $res2->TOT;
                        }
                    }
                }
                ?>
                <!-- ############################# GRAPHS END############################## -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php $this->load->view('template/footer'); ?>
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->
    <?php include "template/js-datatable.php"; ?>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo $theme_link; ?>plugins/chartjs/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo $theme_link; ?>plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo $theme_link; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo $theme_link; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- BAR CHART -->
    <script src="<?php echo $theme_link; ?>plugins/highcharts/highcharts.js"></script>
    <script src="<?php echo $theme_link; ?>plugins/highcharts/highcharts-more.js"></script>
    <script src="<?php echo $theme_link; ?>plugins/highcharts/exporting.js"></script>
    <!-- BAR CHART END -->
    <!-- PIE CHART -->
    <script src="<?php echo $theme_link; ?>plugins/highcharts/export-data.js"></script>
    <!-- PIE CHART END -->

    <!-- Make sidebar menu hughlighter/selector -->
    <script>
        $(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
    </script>
    <script>
        $(document).ready(function() {
            $(function() {
                $('#example2,#example3').DataTable({
                    "pageLength": 5,
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function load_unseen_notification(view = '') {
                var role = <?php echo $this->session->userdata('role_id') ?>;
                $.ajax({
                    url: 'dashboard/list_notif',
                    method: 'POST',
                    data: {
                        view: view,
                        role: role
                    },
                    dataType: "json",
                    success: function(data) {
                        // console.log(data);
                        $('.list_notif').html(data.notification);
                        $('.count').html(data.unseen_notification);
                        // $('.count').show();
                        // if (data.unseen_notification > 0) {
                        //     $('.count').html(data.unseen_notification);
                        // } else if (data.unseen_notification == '') {
                        //     $('.count').hide();
                        // }
                    }
                })
            }

            load_unseen_notification();

            $(document).on('click', '.dropdown-toggle', function() {
                $('.count').html('');
                load_unseen_notification('yes')
            })

            setInterval(function() {
                load_unseen_notification();
            }, 3600000)
        })
    </script>
    <script>
        $(document).ready(function() {
            var base_url = $("#base_url").val().trim();
            $("#dashboardMainMenu").addClass('active');
            $.post("dashboard/return_row_with_data", {}, function(result) {
                $('#training_table tbody').append(result);
            });

            $.post("dashboard/trans_alert", {}, function(result) {
                $('#body_transaction').append(result);
            });

            $(function() {
                var barChartData = {
                    <?php
                    $department = array();
                    $q3 = $this->db->query("SELECT * FROM TMI.HR_DEPT WHERE DEPT_SYS_ID NOT IN (18, 21, 22, 23) ORDER BY DEPT_SYS_ID");
                    if ($q3->num_rows() > 0) {
                        foreach ($q3->result() as $res3) {
                            $department[] = $res3->DEPT_SYS_CD;
                        }
                    }

                    ?>
                    labels: [<?php echo '"' . implode('", "', $department) . '"' ?>],
                    datasets: [{
                            label: "Training Plan",
                            fillColor: "rgba(210, 214, 222, 1)",
                            strokeColor: "rgba(210, 214, 222, 1)",
                            pointColor: "rgba(210, 214, 222, 1)",
                            pointStrokeColor: "#c1c7d1",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [<?php echo $hr_pln; ?>, <?php echo $al_pln; ?>, <?php echo $pe_pln; ?>, <?php echo $cl_pln; ?>, <?php echo $ml_pln; ?>,
                                <?php echo $so_pln; ?>, <?php echo $as_pln; ?>, <?php echo $pl_pln; ?>, <?php echo $hv_pln; ?>, <?php echo $qa_pln; ?>,
                                <?php echo $lg_pln; ?>, <?php echo $eg_pln; ?>, <?php echo $mt_pln; ?>, <?php echo $mg_pln; ?>, <?php echo $ac_pln; ?>, <?php echo $pc_pln; ?>, <?php echo $it_pln; ?>
                            ]
                        },
                        {
                            label: "Training Record",
                            fillColor: "rgba(210, 214, 222, 1)",
                            strokeColor: "rgba(210, 214, 222, 1)",
                            pointColor: "rgba(210, 214, 222, 1)",
                            pointStrokeColor: "#c1c7d1",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [<?php echo $hr_tr; ?>, <?php echo $al_tr; ?>, <?php echo $pe_tr; ?>, <?php echo $cl_tr; ?>, <?php echo $ml_tr; ?>,
                                <?php echo $so_tr; ?>, <?php echo $as_tr; ?>, <?php echo $pl_tr; ?>, <?php echo $hv_tr; ?>, <?php echo $qa_tr; ?>,
                                <?php echo $lg_tr; ?>, <?php echo $eng_tr; ?>, <?php echo $mt_tr; ?>, <?php echo $mg_tr; ?>, <?php echo $ac_tr; ?>, <?php echo $pc_tr; ?>, <?php echo $it_tr; ?>
                            ]
                        }
                    ]
                };
                var barChartCanvas = $("#barChart").get(0).getContext("2d");
                var barChart = new Chart(barChartCanvas);
                barChartData.datasets[1].fillColor = "#00a65a";
                barChartData.datasets[1].strokeColor = "#00a65a";
                barChartData.datasets[1].pointColor = "#00a65a";
                var barChartOptions = {
                    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                    scaleBeginAtZero: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: true,
                    //String - Colour of the grid lines
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - If there is a stroke on each bar
                    barShowStroke: true,
                    //Number - Pixel width of the bar stroke
                    barStrokeWidth: 2,
                    //Number - Spacing between each of the X value sets
                    barValueSpacing: 5,
                    //Number - Spacing between data sets within X values
                    barDatasetSpacing: 1,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                    //Boolean - whether to make the chart responsive
                    responsive: true,
                    maintainAspectRatio: true
                };
                barChartOptions.datasetFill = false;
                barChart.Bar(barChartData, barChartOptions);
            });
            /* PIE CHART*/

            $(document).ready(function() {
                Highcharts.chart('bar_container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Training Complete Percentange'
                    },
                    tooltip: {
                        /*pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'*/
                        pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.0f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Item',
                        colorByPoint: true,
                        data: [
                            <?php
                            $q4 = $this->db->query("SELECT COUNT(DISTINCT C.PLN_SYS_ID) AS TOT, COUNT(DISTINCT B.PLN_SYS_ID) AS TOT_PLN, A.DEPT_SYS_CD, 
						CASE WHEN NULLIF(COUNT(DISTINCT C.PLN_SYS_ID),0) / NULLIF(COUNT(DISTINCT B.PLN_SYS_ID),0) IS NULL 
						THEN 0 ELSE NULLIF(COUNT(DISTINCT C.PLN_SYS_ID),0) / NULLIF(COUNT(DISTINCT B.PLN_SYS_ID),0) END AS GRAND_TOT 
						FROM TMI.HR_DEPT A
						LEFT JOIN TMI.HR_TRAIN_PLAN B ON A.DEPT_SYS_ID = B.PLN_DEPT AND B.PLN_YEAR = 2023
						LEFT JOIN TMI.HR_TRAINING_RCD C ON B.PLN_SYS_ID = C.PLN_SYS_ID 
						WHERE A.DEPT_SYS_ID NOT IN (18, 21, 22, 23)
						GROUP BY A.DEPT_SYS_CD");
                            if ($q4->num_rows() > 0) {
                                foreach ($q4->result() as $res4) {
                                    echo "{name:'" . $res4->DEPT_SYS_CD . "', y:" . $res4->GRAND_TOT . "},";
                                }
                            }
                            ?>
                        ]
                    }]
                });
            });
        });
        /* PIE CHART END*/
    </script>
</body>

</html>