<script type="text/javascript">
    if (theme_skin != 'skin-blue') {
        $("body").addClass(theme_skin);
        $("body").removeClass('skin-blue');
    }
    if (sidebar_collapse == 'true') {
        $("body").addClass('sidebar-collapse');
    }
</script>

<?php
$CI = &get_instance();
?>

<header class="main-header">
    <a href="<?php echo $base_url; ?>dashboard" class="logo">
        <span class="logo-mini"><b>TMI</b></span>
        <span class="logo-lg"><b><?php echo $site_title; ?></b></span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="text-center hidden-xs" id="">
                    <a title="Dashboard" href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard "></i> Dashboard</a>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Click To View Notifications">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning count"></span>
                    </a>
                    <ul class="dropdown-menu list_notif">
                        <!-- <li class="header">You have 10 notifications</li> -->

                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if ($profile_picture !== base_url()) { ?>
                            <img src="<?php echo $profile_picture; ?>" class="user-image" alt="User Image">
                        <?php } else { ?>
                            <img src="<?php echo base_url() . 'theme/dist/img/avatar5.png' ?>" class="user-image" alt="User Image">
                        <?php } ?>

                        <span class="hidden-xs"><?php print ucfirst($this->session->userdata('username')); ?> </span>
                    </a>

                    <ul class="dropdown-menu">

                        <li class="user-header">
                            <?php if ($profile_picture !== base_url()) { ?>
                                <img src="<?php echo $profile_picture; ?>" class="img-circle" alt="User Image">
                            <?php } else { ?>
                                <img src="<?php echo base_url() . 'theme/dist/img/avatar5.png' ?>" class="img-circle" alt="User Image">
                            <?php } ?>

                            <p><?php print ucfirst($this->session->userdata('username')); ?></p>
                            <p><?php print ucfirst($this->session->userdata('role_name')); ?></p>
                        </li>

                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo $base_url; ?>users/edit/<?= $this->session->userdata('user_id'); ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo $base_url; ?>logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="hidden-xs">
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<aside class="main-sidebar">

    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">

                <?php if ($profile_picture !== base_url()) { ?>
                    <img src="<?php echo $profile_picture; ?>" class="img-circle" alt="User Image">
                <?php } else { ?>
                    <img src="<?php echo base_url() . 'theme/dist/img/avatar5.png' ?>" class="img-circle" alt="User Image">
                <?php } ?>
            </div>
            <div class="pull-left info">
                <p><?php print ucfirst($this->session->userdata('username')); ?><i class="fa fa-fw fa-check-circle text-aqua"></i></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">

            <li class="dashboard-active-li ">
                <a href="<?php echo $base_url; ?>dashboard">
                    <i class="fa fa-dashboard text-aqua"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php if ($CI->permission('employee_record') || $CI->permission('employee_view') || $CI->permission('employee_evaluation') || $CI->permission('employee_transfer')) { ?>
                <li class="employee-view-active-li employee-record-active-li treeview">
                    <a href="#">
                        <i class="fa fa-user-o text-aqua"></i> <span>Employee</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if ($CI->permission('employee_view')) { ?>
                            <li class="employee-view-active-li employee-record-active-li">
                                <a href="<?php echo $base_url; ?>employee/view">
                                    <i class="fa fa-list "></i>
                                    <span>Employee List</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($CI->permission('department_add') || $CI->permission('department_view')) { ?>
                <li class="department-view-active-li department-active-li treeview">
                    <a href="#">
                        <i class="fa fa-building-o text-aqua"></i> <span>Department</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if ($CI->permission('department_add')) { ?>
                            <li class="department-active-li">
                                <a href="<?php echo $base_url; ?>department/add">
                                    <i class="fa fa-plus-square-o "></i> <span>New Department</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('department_view')) { ?>
                            <li class="department-view-active-li">
                                <a href="<?php echo $base_url; ?>department/view">
                                    <i class="fa fa-list "></i> <span>Department List</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($CI->permission('assessment_add') || $CI->permission('assessment_view') || $CI->permission('appraisal_add') || $CI->permission('appraisal_view')) { ?>
                <li class="assessment-view-active-li assessment-active-li appraisal-view-active-li appraisal-active-li treeview">
                    <a href="#">
                        <i class="fa fa-book text-aqua"></i> <span>Performance</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if ($CI->permission('assessment_add')) { ?>
                            <li class="assessment-active-li">
                                <a href="<?php echo $base_url; ?>assessment/add">
                                    <i class="fa fa-plus-square-o "></i> <span>New Assesment</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('assessment_view')) { ?>
                            <li class="assessment-view-active-li">
                                <a href="<?php echo $base_url; ?>assessment">
                                    <i class="fa fa-list "></i> <span>Assesment List</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('appraisal_add')) { ?>
                            <li class="appraisal-active-li">
                                <a href="<?php echo $base_url; ?>appraisal/add">
                                    <i class="fa fa-plus-square-o "></i> <span>New Appraisal</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('appraisal_view')) { ?>
                            <li class="appraisal-view-active-li">
                                <a href="<?php echo $base_url; ?>appraisal">
                                    <i class="fa fa-list "></i> <span>Appraisal List</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($CI->permission('trainingrecord_add') || $CI->permission('trainingrecord_view') || $CI->permission('trainingevaluation_add') || $CI->permission('trainingevaluation_view')) { ?>
                <li class="training-view-active-li training-active-li evaluation-view-active-li evaluation-active-li plan-view-active-li plan-active-li treeview">
                    <a href="#">
                        <i class="fa fa-list-alt text-aqua"></i> <span>Training</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if ($CI->permission('trainingrecord_add')) { ?>
                            <li class="training-active-li">
                                <a href="<?php echo $base_url; ?>training/add">
                                    <i class="fa fa-plus-square-o "></i> <span>New Training</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('trainingrecord_view')) { ?>
                            <li class="training-view-active-li">
                                <a href="<?php echo $base_url; ?>training">
                                    <i class="fa fa-list "></i> <span>Training Record List</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('trainingevaluation_add')) { ?>
                            <li class="evaluation-active-li">
                                <a href="<?php echo $base_url; ?>evaluation/add">
                                    <i class="fa fa-plus-square-o "></i> <span>New Training Evaluation</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('trainingevaluation_view')) { ?>
                            <li class="evaluation-view-active-li">
                                <a href="<?php echo $base_url; ?>evaluation">
                                    <i class="fa fa-list "></i> <span>Training Evaluation List</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('trainingplan_add')) { ?>
                            <li class="plan-active-li">
                                <a href="<?php echo $base_url; ?>planning/add">
                                    <i class="fa fa-plus-square-o "></i> <span>New Training Plan</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('trainingplan_view')) { ?>
                            <li class="plan-view-active-li">
                                <a href="<?php echo $base_url; ?>planning">
                                    <i class="fa fa-list "></i> <span>Training Plan List</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <li class="report-training-plan-active-li treeview">
                <a href="#">
                    <i class="fa fa-bar-chart text-aqua"></i> <span>Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="report-training-plan-active-li">
                        <a href="<?php echo $base_url; ?>report/training_plan">
                            <i class="fa fa-copy"></i>
                            <span>Report Training Plan</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php if ($CI->permission('users_add') || $CI->permission('users_view') || $CI->permission('roles_view')) { ?>
                <li class="users-view-active-li users-active-li roles-list-active-li role-active-li treeview">
                    <a href="#">
                        <i class="fa fa-users text-aqua"></i> <span>Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if ($CI->permission('users_add')) { ?>
                            <li class="users-active-li">
                                <a href="<?php echo $base_url; ?>users/">
                                    <i class="fa fa-plus-square-o "></i> <span>New User</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('users_view')) { ?>
                            <li class="users-view-active-li">
                                <a href="<?php echo $base_url; ?>users/view">
                                    <i class="fa fa-list "></i> <span>User List</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($CI->permission('roles_view')) { ?>
                            <li class="roles-list-active-li role-active-li">
                                <a href="<?php echo $base_url; ?>roles/view">
                                    <i class="fa fa-list "></i>
                                    <span>Role List</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <li class=" change-pass-active-li change-status-active-li treeview">
                <a href="#">
                    <i class="fa fa-gears text-aqua"></i> <span>Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="change-status-active-li"><a href="<?php echo $base_url; ?>settings/change_status"><i class="fa fa-exchange "></i> <span>Change Status</span></a></li>
                    <li class="change-pass-active-li"><a href="<?php echo $base_url; ?>settings/password_reset"><i class="fa fa-lock "></i> <span>Change Password</span></a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>