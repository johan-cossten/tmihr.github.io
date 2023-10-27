<!DOCTYPE html>
<html>

<head>
	<!-- TABLES CSS CODE -->
	<?php $this->load->view("template/css-form"); ?>
	<!-- </copy> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view("template/sidebar"); ?>
		<?php
		if (!isset($ROLE_NAME)) {
			$ROLE_NAME = $DESCRIPTION = "";
		}
		?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?= $page_title; ?>
					<small>Add/Update Role</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="<?php echo $base_url; ?>roles/view">Role List</a></li>
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
							<form class="form-horizontal" id="roles-form" onkeypress="return event.keyCode != 13;">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
								<div class="box-body">
									<div class="form-group">
										<label for="ROLE_NAME" class="col-sm-2 control-label">Role Name<label class="text-danger">*</label></label>
										<div class="col-sm-4">
											<input type="text" class="form-control input-sm" id="ROLE_NAME" name="ROLE_NAME" placeholder="" value="<?php print $ROLE_NAME; ?>" autofocus>
											<span id="ROLE_NAME_MSG" style="display:none" class="text-danger"></span>
										</div>
									</div>
									<div class="form-group">
										<label for="DESCRIPTION" class="col-sm-2 control-label">Description</label>
										<div class="col-sm-4">
											<textarea type="text" class="form-control" id="DESCRIPTION" name="DESCRIPTION" placeholder=""><?php print $DESCRIPTION; ?></textarea>
											<span id="DESCRIPTION_MSG" style="display:none" class="text-danger"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<table class="table table-bordered">
												<thead class="bg-primary">
													<tr>
														<th>#</th>
														<th>Modules</th>
														<th>Select All</th>
														<th>Permissions</th>
													</tr>
												</thead>
												<tbody>
													<?php $i = 1; ?>
													<!-- USERS -->
													<tr>
														<td><?= $i++; ?></td>
														<td>Users</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="users"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[users]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="users_all" id='users_add' name="permission[users_add]" <?php echo isset($permissionrole['users_add']) == 'users_add' ? 'checked' : '' ?>> Add
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="users_all" id='users_edit' name="permission[users_edit]" <?php echo isset($permissionrole['users_edit']) == 'users_edit' ? 'checked' : '' ?>> Edit
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="users_all" id='users_delete' name="permission[users_delete]" <?php echo isset($permissionrole['users_delete']) == 'users_delete' ? 'checked' : '' ?>> Delete
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="users_all" id='users_view' name="permission[users_view]" <?php echo isset($permissionrole['users_view']) == 'users_view' ? 'checked' : '' ?>> View
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="users_all" id='users_status' name="permission[users_status]" <?php echo isset($permissionrole['users_status']) == 'users_status' ? 'checked' : '' ?>> Change Status
																</label>
															</div>
														</td>
													</tr>
													<!-- Roles -->

													<tr>
														<td><?= $i++; ?></td>
														<td>Roles</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="roles"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[roles]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="roles_all" id='roles_add' name="permission[roles_add]" <?php echo isset($permissionrole['roles_add']) == 'roles_add' ? 'checked' : '' ?>> Add
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="roles_all" id='roles_edit' name="permission[roles_edit]" <?php echo isset($permissionrole['roles_edit']) == 'roles_edit' ? 'checked' : '' ?>> Edit
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="roles_all" id='roles_delete' name="permission[roles_delete]" <?php echo isset($permissionrole['roles_delete']) == 'roles_delete' ? 'checked' : '' ?>> Delete
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="roles_all" id='roles_view' name="permission[roles_view]" <?php echo isset($permissionrole['roles_view']) == 'roles_view' ? 'checked' : '' ?>> View
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="roles_all" id='roles_status' name="permission[roles_status]" <?php echo isset($permissionrole['roles_status']) == 'roles_status' ? 'checked' : '' ?>> Change Status
																</label>
															</div>
														</td>
													</tr>
													<!--DASHBOARD  -->
													<tr>
														<td><?= $i++; ?></td>
														<td>Dashboard</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="dashboard"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[dashboard]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="dashboard_all" id='dashboard_view' name="permission[dashboard_view]" <?php echo isset($permissionrole['dashboard_view']) == 'dashboard_view' ? 'checked' : '' ?>> View Dashboard Data
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td><?= $i++; ?></td>
														<td>Employee</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="employee"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[employee]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="employee_all" id='employee_record' name="permission[employee_record]" <?php echo isset($permissionrole['employee_record']) == 'employee_record' ? 'checked' : '' ?>> Preview Training Record
																</label>
															</div>
															<!-- <div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="employee_all" id='employee_evaluation' name="permission[employee_evaluation]" <?php echo isset($permissionrole['employee_transfer']) == 'employee_transfer' ? 'checked' : '' ?>> Preview Training Evaluation
																</label>
															</div> -->
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="employee_all" id='employee_transfer' name="permission[employee_transfer]" <?php echo isset($permissionrole['employee_transfer']) == 'employee_transfer' ? 'checked' : '' ?>> Transfer Training
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="employee_all" id='employee_view' name="permission[employee_view]" <?php echo isset($permissionrole['employee_view']) == 'employee_view' ? 'checked' : '' ?>> View
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td><?= $i++; ?></td>
														<td>Department</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="department"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[department]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="department_all" id='department_add' name="permission[department_add]" <?php echo isset($permissionrole['department_add']) == 'department_add' ? 'checked' : '' ?>> Add
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="department_all" id='department_edit' name="permission[department_edit]" <?php echo isset($permissionrole['department_edit']) == 'department_edit' ? 'checked' : '' ?>> Edit
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="department_all" id='department_delete' name="permission[department_delete]" <?php echo isset($permissionrole['department_delete']) == 'department_delete' ? 'checked' : '' ?>> Delete
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="department_all" id='department_view' name="permission[department_view]" <?php echo isset($permissionrole['department_view']) == 'department_view' ? 'checked' : '' ?>> View
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="department_all" id='department_status' name="permission[department_status]" <?php echo isset($permissionrole['department_status']) == 'department_status' ? 'checked' : '' ?>> Change Status
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td><?= $i++; ?></td>
														<td>Assessment</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="assessment"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[assessment]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="assessment_all" id='assessment_add' name="permission[assessment_add]" <?php echo isset($permissionrole['assessment_add']) == 'assessment_add' ? 'checked' : '' ?>> Add
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="assessment_all" id='assessment_edit' name="permission[assessment_edit]" <?php echo isset($permissionrole['assessment_edit']) == 'assessment_edit' ? 'checked' : '' ?>> Edit
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="assessment_all" id='assessment_delete' name="permission[assessment_delete]" <?php echo isset($permissionrole['assessment_delete']) == 'assessment_delete' ? 'checked' : '' ?>> Delete
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="assessment_all" id='assessment_view' name="permission[assessment_view]" <?php echo isset($permissionrole['assessment_view']) == 'assessment_view' ? 'checked' : '' ?>> View
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="assessment_all" id='assessment_preview' name="permission[assessment_preview]" <?php echo isset($permissionrole['assessment_preview']) == 'assessment_preview' ? 'checked' : '' ?>> Preview
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="assessment_all" id='assessment_print' name="permission[assessment_print]" <?php echo isset($permissionrole['assessment_print']) == 'assessment_print' ? 'checked' : '' ?>> Print
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="assessment_all" id='assessment_status' name="permission[assessment_status]" <?php echo isset($permissionrole['assessment_status']) == 'assessment_status' ? 'checked' : '' ?>> Change Status
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td><?= $i++; ?></td>
														<td>Appraisal</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="appraisal"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[appraisal]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="appraisal_all" id='appraisal_add' name="permission[appraisal_add]" <?php echo isset($permissionrole['appraisal_add']) == 'appraisal_add' ? 'checked' : '' ?>> Add
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="appraisal_all" id='appraisal_edit' name="permission[appraisal_edit]" <?php echo isset($permissionrole['appraisal_edit']) == 'appraisal_edit' ? 'checked' : '' ?>> Edit
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="appraisal_all" id='appraisal_delete' name="permission[appraisal_delete]" <?php echo isset($permissionrole['appraisal_delete']) == 'appraisal_delete' ? 'checked' : '' ?>> Delete
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="appraisal_all" id='appraisal_view' name="permission[appraisal_view]" <?php echo isset($permissionrole['appraisal_view']) == 'appraisal_view' ? 'checked' : '' ?>> View
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="appraisal_all" id='appraisal_preview' name="permission[appraisal_preview]" <?php echo isset($permissionrole['appraisal_preview']) == 'appraisal_preview' ? 'checked' : '' ?>> Preview
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="appraisal_all" id='appraisal_print' name="permission[appraisal_print]" <?php echo isset($permissionrole['appraisal_print']) == 'appraisal_print' ? 'checked' : '' ?>> Print
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="aappraisal_all" id='appraisal_status' name="permission[appraisal_status]" <?php echo isset($permissionrole['appraisal_status']) == 'appraisal_status' ? 'checked' : '' ?>> Change Status
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td><?= $i++; ?></td>
														<td>Training Record</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="trainingrecord"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[trainingrecord]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingrecord_all" id='trainingrecord_add' name="permission[trainingrecord_add]" <?php echo isset($permissionrole['trainingrecord_add']) == 'trainingrecord_add' ? 'checked' : '' ?>> Add
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingrecord_all" id='trainingrecord_edit' name="permission[trainingrecord_edit]" <?php echo isset($permissionrole['trainingrecord_edit']) == 'trainingrecord_edit' ? 'checked' : '' ?>> Edit
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingrecord_all" id='trainingrecord_delete' name="permission[trainingrecord_delete]" <?php echo isset($permissionrole['trainingrecord_delete']) == 'trainingrecord_delete' ? 'checked' : '' ?>> Delete
																</label>
															</div>
															<div class="checkbox icheck"><label>
																	<input type="checkbox" class="trainingrecord_all" id='trainingrecord_view' name="permission[trainingrecord_view]" <?php echo isset($permissionrole['trainingrecord_view']) == 'trainingrecord_view' ? 'checked' : '' ?>> View
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingrecord_all" id='trainingrecord_preview' name="permission[trainingrecord_preview]" <?php echo isset($permissionrole['trainingrecord_preview']) == 'trainingrecord_preview' ? 'checked' : '' ?>> Preview
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingrecord_all" id='trainingrecord_print' name="permission[trainingrecord_print]" <?php echo isset($permissionrole['trainingrecord_print']) == 'trainingrecord_print' ? 'checked' : '' ?>> Print
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingrecord_all" id='trainingrecord_status' name="permission[trainingrecord_status]" <?php echo isset($permissionrole['trainingrecord_status']) == 'trainingrecord_status' ? 'checked' : '' ?>> Change Status
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td><?= $i++; ?></td>
														<td>Training Plan</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="trainingplan"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[trainingplan]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingplan_all" id='trainingplan_add' name="permission[trainingplan_add]" <?php echo isset($permissionrole['trainingplan_add']) == 'trainingplan_add' ? 'checked' : '' ?>> Add
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingplan_all" id='trainingplan_edit' name="permission[trainingplan_edit]" <?php echo isset($permissionrole['trainingplan_edit']) == 'trainingplan_edit' ? 'checked' : '' ?>> Edit
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingplan_all" id='trainingplan_delete' name="permission[trainingplan_delete]" <?php echo isset($permissionrole['trainingplan_delete']) == 'trainingplan_delete' ? 'checked' : '' ?>> Delete
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingplan_all" id='trainingplan_view' name="permission[trainingplan_view]" <?php echo isset($permissionrole['trainingplan_view']) == 'trainingplan_view' ? 'checked' : '' ?>> View
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingplan_all" id='trainingplan_preview' name="permission[trainingplan_preview]" <?php echo isset($permissionrole['trainingplan_preview']) == 'trainingplan_preview' ? 'checked' : '' ?>> Preview
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingplan_all" id='trainingplan_print' name="permission[trainingplan_print] " <?php echo isset($permissionrole['trainingplan_print']) == 'trainingplan_print' ? 'checked' : '' ?>> Print
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingplan_all" id='trainingplan_status' name="permission[trainingplan_status]" <?php echo isset($permissionrole['trainingplan_status']) == 'trainingplan_status' ? 'checked' : '' ?>> Change Status
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td><?= $i++; ?></td>
														<td>Training Evaluation</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="trainingevaluation"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[trainingevaluation]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingevaluation_all" id='trainingevaluation_add' name="permission[trainingevaluation_add]" <?php echo isset($permissionrole['trainingevaluation_edit']) == 'trainingevaluation_add' ? 'checked' : '' ?>> Add
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingevaluation_all" id='trainingevaluation_edit' name="permission[trainingevaluation_edit]" <?php echo isset($permissionrole['trainingevaluation_edit']) == 'trainingevaluation_edit' ? 'checked' : '' ?>> Edit
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingevaluation_all" id='trainingevaluation_delete' name="permission[trainingevaluation_delete]" <?php echo isset($permissionrole['trainingevaluation_delete']) == 'trainingevaluation_delete' ? 'checked' : '' ?>> Delete
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingevaluation_all" id='trainingevaluation_view' name="permission[trainingevaluation_view]" <?php echo isset($permissionrole['trainingevaluation_view']) == 'trainingevaluation_view' ? 'checked' : '' ?>> View
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingevaluation_all" id='trainingevaluation_preview' name="permission[trainingevaluation_preview]" <?php echo isset($permissionrole['trainingevaluation_preview']) == 'trainingevaluation_preview' ? 'checked' : '' ?>> Preview
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingevaluation_all" id='trainingevaluation_print' name="permission[trainingevaluation_print]" <?php echo isset($permissionrole['trainingevaluation_print']) == 'trainingevaluation_print' ? 'checked' : '' ?>> Print
																</label>
															</div>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="trainingevaluation_all" id='trainingevaluation_status' name="permission[trainingevaluation_status]" <?php echo isset($permissionrole['trainingevaluation_status']) == 'trainingevaluation_status' ? 'checked' : '' ?>> Change Status
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td><?= $i++; ?></td>
														<td>Report</td>
														<td>
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="change_me" id="report"> Select All
																</label>
															</div>
														</td>
														<td>
															<input type="hidden" name="module[report]" value="on">
															<div class="checkbox icheck">
																<label>
																	<input type="checkbox" class="report_all" id='report_trainingplan' name="permission[report_trainingplan]" <?php echo isset($permissionrole['report_trainingplan']) == 'report_trainingplan' ? 'checked' : '' ?>> Add
																</label>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>

								</div>
								<!-- /.box-footer -->
								<div class="box-footer">
									<div class="col-sm-8 col-sm-offset-2 text-center">
										<!-- <div class="col-sm-4"></div> -->
										<?php
										if ($ROLE_NAME != "") {
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
											<a href="<?= base_url('dashboard'); ?>">
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
		<?php $this->load->view("template/footer.php"); ?>
		<!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->
	<!-- TABLES CODE -->
	<?php $this->load->view("template/js-form"); ?>
	<script src="<?php echo $theme_link; ?>js/roles.js"></script>
	<!-- SELECT THE CHECKBOX'S -->
	<script type="text/javascript">
		<?php
		$str = '';
		if (isset($q_id) && !empty($q_id)) {
			$q1 = $this->db->query("SELECT PERMISSION FROM HR_permission WHERE ROLE_ID=" . $q_id);
			if ($q1->num_rows() > 0) {
				foreach ($q1->result() as $res1) {
					if (empty($str)) {
						$str = ' #' . $res1->PERMISSION;
					} else {
						$str = $str . ', #' . $res1->PERMISSION;
					}
				}
			}
		}
		?>
		$('<?php echo $str; ?>').prop("checked", true).iCheck('update');
	</script>
	<!-- Make sidebar menu hughlighter/selector -->
	<script>
		$(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.change_me').on('ifChanged', function(event) {
				var id = this.id;
				if (event.target.checked) {
					$("." + id + "_all").prop("checked", true).iCheck('update');
				} else {
					$("." + id + "_all").prop("checked", false).iCheck('update');
				}
			});
		});
	</script>
</body>

</html>