<?php $this->db2 = $this->load->database('tmi_ext', true); ?>
<!DOCTYPE html>
<html lang="en">
<?php
$CI = &get_instance();
?>

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
                                <i class="fa fa-globe"></i> Training Record
                            </h2>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" id="preview_data">
                            <?php
                            $q1 = $this->db2->query("SELECT * FROM TMIEXT.OVT_OM_EMPLOYEES WHERE OVT_BADGED ='$id'");
                            $res = $q1->row();
                            $OVT_DEPT_EMP = $res->OVT_DEPT_EMP;
                            $OVT_BADGED = $res->OVT_BADGED;
                            $OVT_NAME_EMP = $res->OVT_NAME_EMP;
                            $OVT_POSITION = $res->OVT_POSITION;
                            ?>
                            <style>
                                td {
                                    padding-top: 1px;
                                    padding-right: 1px;
                                    padding-left: 1px;
                                    text-align: general;
                                    vertical-align: middle;
                                }

                                .xl65 {
                                    text-align: center;
                                    font-family: Tahoma;
                                }

                                .xl66 {
                                    font-family: Tahoma;
                                }

                                .xl67 {
                                    text-align: left;
                                    font-family: Tahoma;
                                    border-left: .5pt solid #C0C0C0;
                                    border-top: .5pt solid #C0C0C0;
                                }

                                .xl68 {
                                    text-align: center;
                                    font-family: Tahoma;
                                    border-top: .5pt solid #C0C0C0;
                                }

                                .xl69 {
                                    font-family: Tahoma;
                                    border-top: .5pt solid #C0C0C0;
                                }

                                .xl70 {
                                    font-family: Tahoma;
                                    border-top: .5pt solid #C0C0C0;
                                    border-right: .5pt solid #C0C0C0;
                                }

                                .xl71 {
                                    text-align: center;
                                    font-family: Tahoma;
                                    border-left: .5pt solid #C0C0C0;
                                }

                                .xl72 {
                                    font-family: Tahoma;
                                    border-right: .5pt solid #C0C0C0;
                                }

                                .xl73 {
                                    text-align: left;
                                    font-family: Tahoma;
                                    border-left: .5pt solid #C0C0C0;
                                }

                                .xl74 {
                                    text-align: left;
                                    font-family: Tahoma;
                                }

                                .xl75 {
                                    font-family: Tahoma;
                                    border-left: .5pt solid #C0C0C0;
                                }

                                .xl76 {
                                    text-align: center;
                                    font-size: 14.0pt;
                                    font-weight: 700;
                                    font-family: Tahoma;
                                }

                                .xl77 {
                                    text-align: center;
                                    font-size: 14.0pt;
                                    font-weight: 700;
                                    font-family: Tahoma;
                                }

                                .xl78 {
                                    text-align: center;
                                    font-size: 14.0pt;
                                    font-weight: 700;
                                    font-family: Tahoma;
                                    border-right: .5pt solid #C0C0C0;
                                }

                                .xl79 {
                                    font-family: Tahoma;
                                    border-left: .5pt solid #C0C0C0;
                                }

                                .xl80 {
                                    font-family: Tahoma;
                                }

                                .xl81 {
                                    font-family: Tahoma;
                                    border-right: .5pt solid #C0C0C0;
                                }

                                .xl82 {
                                    text-align: left;
                                    vertical-align: top;
                                    font-family: Tahoma;
                                    border: .5pt solid #C0C0C0;
                                }

                                .xl83 {
                                    text-align: left;
                                    vertical-align: top;
                                    font-family: Tahoma;
                                    border: .5pt solid #C0C0C0;
                                }

                                .xl84 {
                                    text-align: left;
                                    vertical-align: top;
                                    font-family: Tahoma;
                                    border-left: .5pt solid #C0C0C0;
                                    border-top: .5pt solid #C0C0C0;
                                    border-right: .5pt solid #C0C0C0;
                                }

                                .xl85 {
                                    text-align: center;
                                    font-family: Tahoma;
                                    border: .5pt solid #C0C0C0;
                                }

                                .xl86 {
                                    text-align: center;
                                    white-space: normal;
                                    font-family: Tahoma;
                                    border: .5pt solid #C0C0C0;
                                }

                                .xl87 {
                                    font-family: Tahoma;
                                    border: .5pt solid #C0C0C0;
                                }

                                .xl88 {
                                    text-align: right;
                                    font-family: Tahoma;

                                }
                            </style>
                            <table width="1250" border="0" cellpadding="2" cellspacing="0" style="width:1200pt;border-collapse:collapse;table-layout:fixed;">
                                <colgroup>
                                    <col width="26" class="xl66">
                                    <col width="29" class="xl66">
                                    <col width="400" class="xl66">
                                    <col width="110" class="xl66">
                                    <col width="103" class="xl66">
                                    <col width="103" class="xl66">
                                    <col width="132" class="xl66">
                                    <col width="120" span="16377">
                                </colgroup>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" width="26" style='height:14.25pt;width:19.50pt;'></td>
                                    <td class="xl66" width="29" style='width:21.75pt;'></td>
                                    <td class="xl66" width="300" style='width:193.50pt;'></td>
                                    <td class="xl66" width="101" style='width:75.75pt;'></td>
                                    <td class="xl66" width="103" style='width:77.25pt;'></td>
                                    <td class="xl66" width="92" style='width:69.00pt;'></td>
                                    <td class="xl66" width="132" style='width:99.00pt;'></td>
                                    <td class="xl66" width="64" style='width:48.00pt;'></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl67" colspan="3" rowspan="4" style='border-right:none;border-bottom:none;' x:str>
                                        &nbsp;&nbsp;<img src="<?php echo $theme_link; ?>images/tmi/images.jpg" class="user-image" alt="Logo Company" width="40%">
                                    </td>
                                    <td class="xl69" colspan="3"></td>
                                    <td class="xl70"></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl66" colspan="3"></td>
                                    <td class="xl72"></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl66" colspan="3"></td>
                                    <td class="xl72"></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl66" colspan="3"></td>
                                    <td class="xl72"></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl73" colspan="3" style='border-right:none;border-bottom:none;' x:str>&nbsp;&nbsp;<b>PT. TEAM METAL INDONESIA</b></td>
                                    <td class="xl66" colspan="3"></td>
                                    <td class="xl72"></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl75"></td>
                                    <td class="xl66" colspan="5"></td>
                                    <td class="xl72"></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl75"></td>
                                    <td class="xl76" colspan="6" rowspan="2" style='border-right:.5pt solid #C0C0C0;border-bottom:none;' x:str>LIST OF TRAINING REOCRD</td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl75"></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl79"></td>
                                    <td class="xl80" colspan="5"></td>
                                    <td class="xl81"></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl82" colspan="3" rowspan="3" style='border-right:.5pt solid #C0C0C0;border-bottom:.5pt solid #C0C0C0;' x:str>Department : <?= isset($OVT_DEPT_EMP) ? $OVT_DEPT_EMP : '' ?></td>
                                    <td class="xl82" colspan="4" rowspan="3" style='border-right:.5pt solid #C0C0C0;border-bottom:.5pt solid #C0C0C0;' x:str>Employee No. : <?= isset($OVT_BADGED) ? $OVT_BADGED : '' ?></td>
                                </tr>
                                <tr height="19" class="xl65" style='height:14.25pt;'>
                                    <td class="xl65" height="19" style='height:14.25pt;'></td>
                                </tr>
                                <tr height="19" class="xl65" style='height:14.25pt;'>
                                    <td class="xl65" height="19" style='height:14.25pt;'></td>
                                </tr>
                                <tr height="19" class="xl65" style='height:14.25pt;'>
                                    <td class="xl65" height="19" style='height:14.25pt;'></td>
                                    <td class="xl83" colspan="3" rowspan="3" style='border-right:.5pt solid #C0C0C0;border-bottom:none;' x:str>Name : <?= isset($OVT_NAME_EMP) ? $OVT_NAME_EMP : '' ?></td>
                                    <td class="xl83" colspan="4" rowspan="3" style='border-right:.5pt solid #C0C0C0;border-bottom:none;' x:str>Position : <?= isset($OVT_POSITION) ? $OVT_POSITION : '' ?></td>
                                </tr>
                                <tr height="19" class="xl65" style='height:14.25pt;'>
                                    <td class="xl65" height="19" style='height:14.25pt;'></td>
                                </tr>
                                <tr height="19" class="xl65" style='height:14.25pt;'>
                                    <td class="xl65" height="19" style='height:14.25pt;'></td>
                                </tr>
                                <tr height="38" class="xl65" style='height:28.50pt;'>
                                    <td class="xl65" height="38" style='height:28.50pt;'></td>
                                    <td class="xl85" x:str style="text-align: center;">No.</td>
                                    <td class="xl85" x:str>Training Topics</td>
                                    <td class="xl85" x:str>Duration</td>
                                    <td class="xl85" x:str>Starting Date</td>
                                    <td class="xl85" x:str>Ending Date</td>
                                    <td class="xl86" x:str>Name of Training Instution</td>
                                    <td class="xl85" x:str>Remark</td>
                                </tr>
                                <?php
                                if (isset($id)) {
                                    $q2 = $this->db->query("SELECT * FROM TMI.HR_TRAINING_RCD A INNER JOIN TMI.HR_TRAIN_PLAN B ON A.PLN_SYS_ID = B.PLN_SYS_ID WHERE A.EMPLOYEE LIKE '%$OVT_BADGED%' ORDER BY TR_ST_DT ASC");
                                    if ($q2->num_rows() > 0) {
                                        $i = 1;
                                        foreach ($q2->result() as $res2) {
                                ?>
                                            <tr height="19" style='height:14.25pt;'>
                                                <td class="xl66" height="19" style='height:14.25pt;'></td>
                                                <td class="xl87" style="text-align: center;"><?php echo $i++; ?></td>
                                                <td class="xl87"><?php echo $res2->PLN_TOPIC ?></td>
                                                <td class="xl87"><?php echo $res2->PLN_PLAN_QTY . ' ' . $res2->PLN_PLAN_UNIT ?></td>
                                                <td class="xl87" style="text-align: center;"><?php echo date("d/m/y", strtotime($res2->TR_ST_DT)) ?></td>
                                                <td class="xl87" style="text-align: center;"><?php echo date("d/m/y", strtotime($res2->TR_END_DT)) ?></td>
                                                <td class="xl87" style="text-align: center;"><?php echo $res2->TR_INSTITUTION ?></td>
                                                <td class="xl87" style="text-align: center;"><?php echo $res2->REMARKS ?></td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" style='height:14.25pt;'></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                    <td class="xl87"></td>
                                </tr>
                                <tr height="19" style='height:14.25pt;'>
                                    <td class="xl66" height="19" colspan="6" style='height:14.25pt;'></td>
                                    <td class="xl88" colspan="2" style='border-right:none;border-bottom:none;' x:str>CF/A/HR/003/07/B</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="box-footer">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <?php if ($CI->permission('trainingrecord_print')) { ?>
                                <div class="col-md-2 col-md-offset-2">
                                    <button type="button" class=" btn btn-block btn-success" title="Print Data" id="print">Print</button>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-2 col-md-offset-2">
                                    <button type="button" class=" btn btn-block btn-success" title="Print Data" id="print" disabled>Print</button>
                                </div>
                            <?php } ?>
                            <div class="col-sm-3">
                                <a href="<?= base_url() ?>employee/view">
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