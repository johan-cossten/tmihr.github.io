<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("template/css-form"); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view("template/sidebar"); ?>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <?php $this->load->view("template/flashdata"); ?>
                </div>
            </div>
            <section class="invoice">
                <!-- title row -->
                <div class="printableArea">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> Perfomance Assessment
                            </h2>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" id="preview_data">
                            <style>
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

                                .xl66 {
                                    text-align: left;
                                }

                                .xl67 {
                                    border-left: 1.0pt solid windowtext;
                                    border-top: 1.0pt solid windowtext;
                                }

                                .xl68 {
                                    border-top: 1.0pt solid windowtext;
                                }

                                .xl69 {
                                    border-left: 1.0pt solid windowtext;
                                }

                                .xl70 {
                                    text-align: left;
                                    font-size: 12.0pt;
                                    font-weight: 700;
                                }

                                .xl71 {
                                    text-align: left;
                                    font-size: 12.0pt;
                                    font-weight: 700;
                                }

                                .xl72 {
                                    text-align: left;
                                    font-size: 10.0pt;
                                }

                                .x170 {
                                    text-align: left;
                                    border: .5pt solid windowtext;
                                }

                                .xl73 {
                                    text-align: left;
                                    border: .5pt solid windowtext;
                                }

                                .xl74 {
                                    text-align: center;
                                    font-size: 10.0pt;
                                }

                                .xl75 {
                                    text-align: center;
                                    border: .5pt solid windowtext;
                                }

                                .xl76 {
                                    text-align: left;
                                    font-size: 10.0pt;
                                }

                                .xl77 {
                                    text-align: center;
                                }

                                .xl79 {
                                    text-align: left;
                                    font-size: 8.0pt;
                                    font-style: italic;
                                }

                                .xl80 {
                                    border-bottom: .5pt dashed windowtext;
                                }

                                .xl81 {
                                    font-size: 10.0pt;
                                }

                                .xl82 {
                                    font-size: 10.0pt;
                                    border-left: 1.0pt solid windowtext;
                                }

                                .xl83 {
                                    text-align: left;
                                    font-size: 10.0pt;
                                    border-bottom: .5pt solid windowtext;
                                }

                                .xl84 {
                                    text-align: left;
                                    font-size: 11.0pt;
                                    border: .5pt solid windowtext;
                                }

                                .xl841 {
                                    text-align: center;
                                    font-size: 11.0pSt;
                                    border: .5pt solid windowtext;
                                }

                                .xl85 {
                                    text-align: center;
                                    font-size: 10.0pt;
                                }

                                .xl86 {
                                    text-align: center;
                                    font-size: 10.0pt;
                                    border-left: .5pt solid windowtext;
                                    border-top: .5pt solid windowtext;
                                    border-bottom: .5pt solid windowtext;
                                }

                                .xl87 {
                                    text-align: center;
                                    font-size: 10.0pt;
                                    border-top: .5pt solid windowtext;
                                    border-bottom: .5pt solid windowtext;
                                }

                                .xl88 {
                                    font-size: 10.0pt;
                                }

                                .xl89 {
                                    text-align: center;
                                    border-bottom: .5pt dashed windowtext;
                                }

                                .xl90 {
                                    text-align: left;
                                    font-size: 10.0pt;
                                    border-left: .5pt solid windowtext;
                                    border-top: .5pt solid windowtext;
                                    border-bottom: .5pt solid windowtext;
                                }

                                .xl901 {
                                    text-align: center;
                                    font-size: 10.0pt;
                                    border-left: .5pt solid windowtext;
                                    border-top: .5pt solid windowtext;
                                    border-bottom: .5pt solid windowtext;
                                }

                                .xl91 {
                                    font-size: 10.0pt;
                                }

                                .xl92 {
                                    text-align: center;
                                    font-size: 10.0pt;
                                    border-top: .5pt solid windowtext;
                                    border-right: .5pt solid windowtext;
                                    border-bottom: .5pt solid windowtext;
                                }

                                .xl93 {
                                    font-size: 10.0pt;
                                }

                                .xl94 {
                                    text-align: right;
                                    font-size: 10.0pt;
                                }

                                .xl95 {
                                    text-align: right;
                                    font-size: 10.0pt;
                                }

                                .xl96 {
                                    border-top: 1.0pt solid windowtext;
                                    border-right: 1.0pt solid windowtext;
                                }

                                .xl97 {
                                    border-right: 1.0pt solid windowtext;
                                }

                                .xl98 {
                                    text-align: left;
                                    font-size: 10.0pt;
                                    border-top: .5pt solid windowtext;
                                    border-bottom: .5pt solid windowtext;
                                }

                                .xl99 {
                                    font-size: 10.0pt;
                                    border-top: .5pt solid windowtext;
                                    border-right: .5pt solid windowtext;
                                    border-bottom: .5pt solid windowtext;
                                }

                                .xl100 {
                                    font-size: 10.0pt;
                                    border-right: 1.0pt solid windowtext;
                                }

                                .xl101 {
                                    text-align: left;
                                    font-size: 10.0pt;
                                    border-top: .5pt solid windowtext;
                                    border-right: .5pt solid windowtext;
                                    border-bottom: .5pt solid windowtext;
                                }

                                .xl102 {
                                    font-size: 10.0pt;
                                    border: .5pt solid windowtext;
                                }

                                .xl103 {
                                    border-left: 1.0pt solid windowtext;
                                    border-bottom: 1.0pt solid windowtext;
                                }

                                .xl104 {
                                    border-bottom: 1.0pt solid windowtext;
                                }

                                .xl105 {
                                    border-right: 1.0pt solid windowtext;
                                    border-bottom: 1.0pt solid windowtext;
                                }
                            </style>
                            <table width="1020" border="0" cellpadding="0" cellspacing="0" style='border-collapse:collapse;table-layout:fixed;'>
                                <col width="4,93" />
                                <col width="17" />
                                <col width="18" />
                                <col width="34" />
                                <col width="85" />
                                <col width="51" />
                                <col width="57" />
                                <col width="47" />
                                <col width="64" />
                                <col width="27" />
                                <col width="116" />
                                <col width="74" />
                                <col width="64" />
                                <col width="41" />
                                <col width="15" />
                                <col width="64" />
                                <col width="86" />
                                <col width="17" />
                                <col width="31" />
                                <col width="88" />
                                <col width="17" />
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" width="4,93" style='height:15.00pt;width:3.70pt;'></td>
                                    <td width="17" style='width:12.75pt;'></td>
                                    <td width="18" style='width:13.50pt;'></td>
                                    <td width="34" style='width:25.50pt;'></td>
                                    <td width="85" style='width:63.75pt;'></td>
                                    <td width="51" style='width:38.25pt;'></td>
                                    <td width="57" style='width:42.75pt;'></td>
                                    <td width="47" style='width:35.25pt;'></td>
                                    <td width="64" style='width:48.00pt;'></td>
                                    <td width="27" style='width:20.25pt;'></td>
                                    <td width="116" style='width:87.00pt;'></td>
                                    <td width="74" style='width:55.50pt;'></td>
                                    <td width="64" style='width:48.00pt;'></td>
                                    <td width="41" style='width:30.75pt;'></td>
                                    <td width="15" style='width:11.25pt;'></td>
                                    <td width="64" style='width:48.00pt;'></td>
                                    <td width="86" style='width:64.50pt;'></td>
                                    <td width="17" style='width:12.75pt;'></td>
                                    <td width="31" style='width:23.25pt;'></td>
                                    <td width="88" style='width:66.00pt;'></td>
                                    <td width="17" style='width:12.75pt;'></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl66" colspan="19" rowspan="3" style='border-right:none;border-bottom:none;' x:str>
                                        <img src="<?php echo $theme_link ?>images/tmi/images2.png" class="user-image" alt="Logo Company" width="215" height="50">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" colspan="2" style='height:15.00pt;'></td>
                                    <td colspan="19"></td>
                                </tr>
                                <tr height="10,67" style='height:8.00pt;'>
                                    <td height="10,67" style='height:8.00pt;'></td>
                                    <td class="xl67"></td>
                                    <td class="xl68" colspan="18"></td>
                                    <td class="xl96"></td>
                                </tr>
                                <tr height="21" style='height:15.75pt;'>
                                    <td height="21" style='height:15.75pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl70" colspan="9" style='border-right:none;border-bottom:none;' x:str>PERFORMANCE ASSESSMENT</td>
                                    <td></td>
                                    <td class="xl72" colspan="2" style='border-right:none;border-bottom:none;' x:str>Date</td>
                                    <td class="xl74" x:str>:</td>
                                    <td class="xl84" colspan="5" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'><?= isset($DATEASSESS) ? date('d-m-Y', strtotime($DATEASSESS)) : '' ?></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="4" class="xl65" style='height:3.00pt;'>
                                    <td class="xl65" height="4" style='height:3.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl71" colspan="9"></td>
                                    <td class="xl65"></td>
                                    <td class="xl76" colspan="2"></td>
                                    <td class="xl85" colspan="6"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl72" colspan="3" style='border-right:none;border-bottom:none;' x:str>Name :</td>
                                    <td class="xl73" colspan="6" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'><?= isset($employee) ? $employee : '' ?></td>
                                    <td></td>
                                    <td class="xl72" colspan="2" style='border-right:none;border-bottom:none;' x:str>Department</td>
                                    <td class="xl74" x:str>:</td>
                                    <td class="xl84" colspan="5" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'><?= isset($department) ? $department : '' ?></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="4" style='height:3.00pt;'>
                                    <td height="4" style='height:3.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl74" colspan="18" style='border-right:none;border-bottom:none;'></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl72" colspan="3" style='border-right:none;border-bottom:none;' x:str>Employee Number :</td>
                                    <td class="x170" colspan="2" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'><?= isset($ovt_group) ? $ovt_group : '' ?></td>
                                    <td class="xl73" colspan="4" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'><?= isset($employee_code) ? $employee_code : '' ?></td>
                                    <td></td>
                                    <td class="xl72" colspan="2" style='border-right:none;border-bottom:none;' x:str>Position</td>
                                    <td class="xl74" x:str>:</td>
                                    <td class="xl84" colspan="5" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'><?= isset($position) ? $position : '' ?></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="4" style='height:3.00pt;'>
                                    <td height="4" style='height:3.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl74" colspan="18" style='border-right:none;border-bottom:none;'></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl72" colspan="3" style='border-right:none;border-bottom:none;' x:str>Period of Assessment :</td>
                                    <td class="xl73" colspan="2" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'><?= isset($DATEPERIODFR) ? date('d-m-Y', strtotime($DATEPERIODFR)) : '' ?></td>
                                    <td class="xl75">TO</td>
                                    <td class="xl73" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'><?= isset($DATEPERIODTO) ? date('d-m-Y', strtotime($DATEPERIODTO)) : '' ?></td>
                                    <td></td>
                                    <td class="xl72" colspan="2" style='border-right:none;border-bottom:none;' x:str>Date Joined</td>
                                    <td class="xl74" x:str>:</td>
                                    <td class="xl84" colspan="5" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'><?= isset($joined) ? date('d-m-Y', strtotime($joined)) : '' ?></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="4" style='height:3.00pt;'>
                                    <td height="4" style='height:3.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl76" colspan="3"></td>
                                    <td class="xl77" colspan="2"></td>
                                    <td class="xl78"></td>
                                    <td class="xl77" colspan="3"></td>
                                    <td class="xl65"></td>
                                    <td class="xl76" colspan="2"></td>
                                    <td class="xl85" colspan="6"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl72" colspan="3" style='border-right:none;border-bottom:none;' x:str>Purpose of Assessment :</td>
                                    <td class="xl79" colspan="6" style='border-right:none;border-bottom:none;' x:str>(Please checked with (x) to column selected)</td>
                                    <td></td>
                                    <td class="xl841" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:str><?php echo $PURPOSE == 0 ? '<b>Annual</b>' : 'Annual' ?></td>
                                    <td class="xl841" colspan="2" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:str><?php echo $PURPOSE == 1 ? '<b>Promotion</b>' : 'Promotion' ?></td>
                                    <td class="xl841" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:str><?php echo $PURPOSE == 2 ? '<b>Others</b>' : 'Others' ?></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="12" style='height:9.00pt;'>
                                    <td height="12" style='height:9.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl80" colspan="18"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl79" colspan="3" style='border-right:none;border-bottom:none;' x:str>(To be filled by HR Dept.)</td>
                                    <td colspan="15"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl72" colspan="9" style='border-right:none;border-bottom:none;' x:str>Status of Employee : Permanent / Contract (if on contract, date of contract expiry)</td>
                                    <td colspan="4"></td>
                                    <td class="xl90" colspan="2" style='border-right:none;border-bottom:.5pt solid windowtext;' x:str>c</td>
                                    <td class="xl99" x:str>/</td>
                                    <td class="xl86" colspan="2" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'><?= isset($joined) ? date('d-m-Y', strtotime($joined)) : '' ?></td>
                                    <td class="xl100"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td colspan="13"></td>
                                    <td class="xl81" colspan="5"></td>
                                    <td class="xl100"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl72" colspan="3" style='border-right:none;border-bottom:none;' x:str>Disciplinary Case</td>
                                    <td class="xl81" colspan="15"></td>
                                    <td class="xl100"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl72" x:str>1.</td>
                                    <td class="xl72" colspan="4" style='border-right:none;border-bottom:none;' x:str>Attendance Record</td>
                                    <td class="xl81" colspan="13"></td>
                                    <td class="xl100"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl81"></td>
                                    <td class="xl74" x:str>1)</td>
                                    <td class="xl72" colspan="2" style='border-right:none;border-bottom:none;' x:str>No. of Unpaid Leave</td>
                                    <td class="xl74" x:num><?= isset($ATT_UNPAID) ? $ATT_UNPAID : '' ?></td>
                                    <td class="xl74" x:str>days</td>
                                    <td class="xl74" colspan="2"></td>
                                    <td class="xl81" colspan="10"></td>
                                    <td class="xl100"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl81"></td>
                                    <td class="xl74" x:str>2)</td>
                                    <td class="xl72" colspan="2" style='border-right:none;border-bottom:none;' x:str>No. of Medical Leave</td>
                                    <td class="xl74" x:num><?= isset($ATT_MEDICAL) ? $ATT_MEDICAL : '' ?></td>
                                    <td class="xl74" x:str>days</td>
                                    <td class="xl74" colspan="2"></td>
                                    <td class="xl81" colspan="5"></td>
                                    <td class="xl90" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:str>SCORE :</td>
                                    <td class="xl81"></td>
                                    <td class="xl841" x:num><?= isset($POINT_ATT) ? $POINT_ATT : '' ?></td>
                                    <td class="xl100"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl81"></td>
                                    <td class="xl74" x:str>3)</td>
                                    <td class="xl72" colspan="2" style='border-right:none;border-bottom:none;' x:str>No. of Absent</td>
                                    <td class="xl74" x:num><?= isset($ATT_ABSENT) ? $ATT_ABSENT : '' ?></td>
                                    <td class="xl74" x:str>days</td>
                                    <td class="xl74" colspan="2"></td>
                                    <td class="xl81" colspan="10"></td>
                                    <td class="xl100"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl81" colspan="18"></td>
                                    <td class="xl100"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl81" x:str>2.</td>
                                    <td class="xl72" colspan="3" style='border-right:none;border-bottom:none;' x:str>No. of Warning Letters</td>
                                    <td class="xl81" colspan="14"></td>
                                    <td class="xl100"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl81" colspan="2"></td>
                                    <td class="xl74" x:num><?= isset($WL3_MONTH) ? $WL3_MONTH : '' ?></td>
                                    <td class="xl74" colspan="2" style='border-right:none;border-bottom:none;' x:str>(due to absent)</td>
                                    <td class="xl74" x:num><?= isset($WL3_MONTH_1) ? $WL3_MONTH_1 : '' ?></td>
                                    <td class="xl72" colspan="5" style='border-right:none;border-bottom:none;' x:str>(due to others) in the last 3 months</td>
                                    <td class="xl81" colspan="7"></td>
                                    <td class="xl100"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td colspan="2"></td>
                                    <td class="xl74" x:num><?= isset($WL6_MONTH) ? $WL6_MONTH : '' ?></td>
                                    <td class="xl74" colspan="2" style='border-right:none;border-bottom:none;' x:str>(due to absent)</td>
                                    <td class="xl74" x:num><?= isset($WL6_MONTH_1) ? $WL6_MONTH_1 : '' ?></td>
                                    <td class="xl72" colspan="5" style='border-right:none;border-bottom:none;' x:str>(due to others) in the last 6 months</td>
                                    <td colspan="2"></td>
                                    <td class="xl90" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:str>SCORE :</td>
                                    <td class="xl81"></td>
                                    <td class="xl841" x:num><?= isset($POINT_WARNING) ? $POINT_WARNING : '' ?></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td colspan="2"></td>
                                    <td class="xl74" x:num><?= isset($WL12_MONTH) ? $WL12_MONTH : '' ?></td>
                                    <td class="xl74" colspan="2" style='border-right:none;border-bottom:none;' x:str>(due to absent)</td>
                                    <td class="xl74" x:num><?= isset($WL12_MONTH_1) ? $WL12_MONTH_1 : '' ?></td>
                                    <td class="xl72" colspan="5" style='border-right:none;border-bottom:none;' x:str>(due to others) in the last 12 months</td>
                                    <td colspan="7"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td colspan="2"></td>
                                    <td class="xl74" x:num><?= isset($WL_JOIN) ? $WL_JOIN : '' ?></td>
                                    <td class="xl74" colspan="2" style='border-right:none;border-bottom:none;' x:str>(due to absent)</td>
                                    <td class="xl74" x:num><?= isset($WL_JOIN_1) ? $WL_JOIN_1 : '' ?></td>
                                    <td class="xl72" colspan="5" style='border-right:none;border-bottom:none;' x:str>(due to others) since joined</td>
                                    <td colspan="7"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td></td>
                                    <td colspan="17"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81" x:str>3.</td>
                                    <td class="xl74" colspan="3" style='border-right:none;border-bottom:none;' x:str>No. of Accountability Report</td>
                                    <td class="xl74" x:num><?= isset($REASON_ACCOUN) ? $REASON_ACCOUN : '' ?></td>
                                    <td class="xl72" colspan="4" style='border-right:none;border-bottom:none;' x:str>in the last 12 months</td>
                                    <td class="xl91" colspan="2"></td>
                                    <td class="xl81" colspan="7"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81"></td>
                                    <td class="xl72" colspan="4" style='border-right:none;border-bottom:none;' x:str>Reason of Accountability report :</td>
                                    <td class="xl81" colspan="8"></td>
                                    <td class="xl90" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:str>SCORE :</td>
                                    <td class="xl81"></td>
                                    <td class="xl841" x:num><?= isset($POINT_REPROT) ? $POINT_REPROT : 0 ?></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81"></td>
                                    <td class="xl81" x:str>1)</td>
                                    <td class="xl83" colspan="5" style='border-right:none;border-bottom:.5pt solid windowtext;'><?= isset($FLEX03) ? $FLEX03 : '' ?></td>
                                    <td class="xl74"></td>
                                    <td class="xl81" colspan="10"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81"></td>
                                    <td class="xl81" x:str>2)</td>
                                    <td class="xl83" colspan="5" style='border-right:none;border-bottom:.5pt solid windowtext;'><?= isset($FLEX04) ? $FLEX04 : '' ?></td>
                                    <td class="xl74"></td>
                                    <td class="xl81" colspan="10"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81"></td>
                                    <td class="xl81" x:str>3)</td>
                                    <td class="xl83" colspan="5" style='border-right:none;border-bottom:.5pt solid windowtext;'><?= isset($FLEX05) ? $FLEX05 : '' ?></td>
                                    <td class="xl74"></td>
                                    <td class="xl81" colspan="10"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81" colspan="13"></td>
                                    <td class="xl90" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:str>TOTAL SCORE :</td>
                                    <td class="xl81"></td>
                                    <td class="xl841" x:num><?= isset($TOT) ? $TOT : '' ?></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl80" colspan="18"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl79" colspan="4" style='border-right:none;border-bottom:none;' x:str>(Filled by Accounts Dept.)</td>
                                    <td class="xl81" colspan="14"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl72" colspan="4" style='border-right:none;border-bottom:none;' x:str>Current Salary Basic</td>
                                    <td class="xl84" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl74"></td>
                                    <td class="xl72" x:str>Fixed Allow</td>
                                    <td class="xl73" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl81"></td>
                                    <td class="xl72" colspan="3" style='border-right:none;border-bottom:none;' x:str>Var-Allow</td>
                                    <td class="xl81"></td>
                                    <td class="xl102"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="4" style='height:3.00pt;'>
                                    <td height="4" style='height:3.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl76" colspan="4"></td>
                                    <td class="xl85" colspan="4"></td>
                                    <td class="xl76"></td>
                                    <td class="xl77" colspan="3"></td>
                                    <td class="xl88"></td>
                                    <td class="xl76" colspan="3"></td>
                                    <td class="xl88" colspan="2"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl72" colspan="4" style='border-right:none;border-bottom:none;' x:str>Prev. Increment Basic</td>
                                    <td class="xl84" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl74"></td>
                                    <td class="xl72" x:str>Fixed Allow</td>
                                    <td class="xl73" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl81"></td>
                                    <td class="xl72" colspan="3" style='border-right:none;border-bottom:none;' x:str>Var-Allow</td>
                                    <td class="xl81"></td>
                                    <td class="xl102"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="4" style='height:3.00pt;'>
                                    <td height="4" style='height:3.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl76" colspan="4"></td>
                                    <td class="xl85" colspan="4"></td>
                                    <td class="xl76"></td>
                                    <td class="xl77" colspan="3"></td>
                                    <td class="xl88"></td>
                                    <td class="xl76" colspan="3"></td>
                                    <td class="xl88" colspan="2"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl72" colspan="4" style='border-right:none;border-bottom:none;' x:str>Date of prev increment</td>
                                    <td class="xl84" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl74"></td>
                                    <td class="xl72"></td>
                                    <td colspan="2"></td>
                                    <td class="xl91"></td>
                                    <td class="xl81" colspan="6"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="4" style='height:3.00pt;'>
                                    <td height="4" style='height:3.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl76" colspan="4"></td>
                                    <td class="xl85" colspan="4"></td>
                                    <td class="xl72"></td>
                                    <td colspan="2"></td>
                                    <td class="xl91"></td>
                                    <td class="xl81" colspan="6"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl72" colspan="4" style='border-right:none;border-bottom:none;' x:str>Recorded by</td>
                                    <td class="xl84" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl74"></td>
                                    <td class="xl72" x:str>Sign</td>
                                    <td class="xl73" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl81"></td>
                                    <td class="xl72" colspan="2" style='border-right:none;border-bottom:none;' x:str>Date</td>
                                    <td class="xl81" colspan="2"></td>
                                    <td class="xl102"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl80" colspan="18"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl79" colspan="4" style='border-right:none;border-bottom:none;' x:str>(Filled by Management)</td>
                                    <td class="xl81" colspan="14"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81" x:str>1.</td>
                                    <td class="xl74" colspan="3" style='border-right:none;border-bottom:none;' x:str>Normal - Yearly Increment</td>
                                    <td class="xl81" colspan="14"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="4" style='height:3.00pt;'>
                                    <td height="4" style='height:3.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81"></td>
                                    <td class="xl74" colspan="3"></td>
                                    <td class="xl81" colspan="14"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81"></td>
                                    <td class="xl81" colspan="2" x:str>New Salary Basic</td>
                                    <td class="xl81"></td>
                                    <td class="xl86" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl93"></td>
                                    <td class="xl76" x:str>Fixed Allow</td>
                                    <td class="xl86" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl81" colspan="6"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81" x:str>2.</td>
                                    <td class="xl74" colspan="4" style='border-right:none;border-bottom:none;' x:str>Promotion increment - if any</td>
                                    <td class="xl81" colspan="13"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81"></td>
                                    <td class="xl74" colspan="4"></td>
                                    <td class="xl81" colspan="13"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81"></td>
                                    <td class="xl81" colspan="2" x:str>Promoted to :</td>
                                    <td class="xl81"></td>
                                    <td class="xl84" colspan="5" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl81"></td>
                                    <td class="xl94" colspan="3" style='border-right:none;border-bottom:none;' x:str>Effective Date :</td>
                                    <td class="xl81" colspan="4"></td>
                                    <td class="xl102"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="4" style='height:3.00pt;'>
                                    <td height="4" style='height:3.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl88" colspan="4"></td>
                                    <td class="xl85" colspan="5"></td>
                                    <td class="xl88"></td>
                                    <td class="xl95" colspan="3"></td>
                                    <td class="xl88" colspan="5"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81"></td>
                                    <td class="xl81" colspan="2" x:str>New Salary Basic</td>
                                    <td class="xl81" x:str>+</td>
                                    <td class="xl84" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl93"></td>
                                    <td class="xl76" x:str>Fixed Allow</td>
                                    <td class="xl84" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td class="xl81"></td>
                                    <td class="xl72" colspan="3" style='border-right:none;border-bottom:none;' x:str>Var-Allow</td>
                                    <td class="xl81"></td>
                                    <td class="xl102"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="6,67" style='height:5.00pt;'>
                                    <td height="6,67" style='height:5.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl81" colspan="18"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl72" colspan="3" style='border-right:none;border-bottom:none;' x:str>Remarks :</td>
                                    <td class="xl81" colspan="15"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl89" colspan="18" style='border-right:none;border-bottom:.5pt dashed windowtext;'></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl89" colspan="18" style='border-right:none;border-bottom:.5pt dashed windowtext;'></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl82"></td>
                                    <td class="xl89" colspan="18" style='border-right:none;border-bottom:.5pt dashed windowtext;'></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl89" colspan="18" style='border-right:none;border-bottom:.5pt dashed windowtext;'></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="6,67" class="xl65" style='height:5.00pt;'>
                                    <td class="xl65" height="6,67" style='height:5.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl77" colspan="18"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td class="xl66" colspan="3" style='border-right:none;border-bottom:none;' x:str>Approved by :</td>
                                    <td></td>
                                    <td class="xl73" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td></td>
                                    <td x:str>Sign</td>
                                    <td class="xl73" colspan="3" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;'></td>
                                    <td></td>
                                    <td x:str>Date</td>
                                    <td colspan="3"></td>
                                    <td class="xl102"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" style='height:15.00pt;'></td>
                                    <td class="xl69"></td>
                                    <td colspan="18"></td>
                                    <td class="xl97"></td>
                                </tr>
                                <tr height="21" style='height:15.75pt;'>
                                    <td height="21" style='height:15.75pt;'></td>
                                    <td class="xl103"></td>
                                    <td class="xl104" colspan="18"></td>
                                    <td class="xl105"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" colspan="17" style='height:15.00pt;'></td>
                                    <td colspan="4"></td>
                                </tr>
                                <tr height="20" style='height:15.00pt;'>
                                    <td height="20" colspan="17" style='height:15.00pt;'></td>
                                    <td class="xl66" colspan="4" style='border-right:none;border-bottom:none;' x:str>CF/A/HR/004/01/C</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="box-footer">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <div class="col-md-2 col-md-offset-2">
                                <button type="button" class=" btn btn-block btn-success" title="Print Data" id="print">Print</button>
                            </div>
                            <div class="col-sm-3">
                                <a href="<?= base_url() ?>assessment">
                                    <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Back to Transaction</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>
<script>
    $(".employee-view-active-li").addClass("active");
</script>
<script>
    $(document).ready(function() {
        $("#print").click(function(event) {
            PrintMe("preview_data");
        });

        function PrintMe(DivID) {
            var disp_setting = "toolbar=yes,location=no,";
            disp_setting += "directories=yes,menubar=yes,";
            disp_setting += "scrollbars=yes,width=800, height=600, left=100, top=25";
            var content_vlue = document.getElementById(DivID).innerHTML;
            var docprint = window.open("", "", disp_setting);
            docprint.document.open();
            docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
            docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
            docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
            docprint.document.write('<head><title></title>');
            docprint.document.write('<style type="text/css">');
            docprint.document.write('@page {margin: 1cm;}');
            docprint.document.write('</style></head><body onLoad="self.print()"><div style="height: 100px;">');
            docprint.document.write(content_vlue);
            docprint.document.write('</div>');
            // docprint.document.write('<div class="page-footer-space"></div>');
            // docprint.document.write('<div class="page-footer">CF/A/HR/003/07/B</div>');
            // docprint.document.write('<div class="footer"><span style="margin-left: 850px;">CF/A/HR/003/07/B</span></div>');
            docprint.document.write('</body></html>');
            docprint.document.close();
            docprint.focus();
        }
    })
</script>