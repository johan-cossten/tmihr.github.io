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
		if (!isset($username)) {
			$username = $email = $q_id = $role_id = $pass = '';
			$disabled = '';
			$profile_picture = '';
			$command = 'save';
		} else {
			$disabled = 'disabled="disabled"';
			$command = 'update';
		}
		if (empty($profile_picture)) {
			$profile_picture = 'theme/dist/img/avatar5.png';
		}
		if ($q_id == 1) {
			$disabled = 'disabled';
		}
		// $disabled = ($q_id == 1) ? 'disabled' : '';

		?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?= $page_title; ?>
					<small>Enter User Information</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="<?php echo $base_url; ?>users/view">View Users</a></li>
					<li class="active"><?= $page_title; ?></li>
				</ol>
			</section>
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- ********** ALERT MESSAGE START******* -->
					<?php $this->load->view("template/flashdata"); ?>
					<!-- ********** ALERT MESSAGE END******* -->
					<!-- right column -->
					<div class="col-md-12">
						<!-- Horizontal Form -->
						<div class="box box-info ">
							<!-- /.box-header -->
							<!-- form start -->

							<?= form_open('#', array('class' => 'form-horizontal', 'id' => 'users-form', 'enctype' => 'multipart/form-data', 'method' => 'POST')); ?>
							<input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
							<input type="hidden" name="command" value="<?php echo $command;; ?>">
							<input type="hidden" name="userid" id="userid" value="<?= $this->session->userdata('user_id'); ?>">
							<div class="box-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="new_user" class="col-sm-4 control-label">UserName<label class="text-danger">*</label></label>
											<div class="col-sm-8">
												<input type="text" class="form-control input-sm" id="new_user" name="new_user" placeholder="" value="<?php print $username; ?>" <?= $disabled; ?> autofocus>
												<span id="new_user_msg" style="display:none" class="text-danger"></span>
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="col-sm-4 control-label">Email<label class="text-danger">*</label></label>
											<div class="col-sm-8">
												<input type="text" class="form-control input-sm" value="<?php print $email; ?>" id="email" name="email" placeholder="" onkeyup="shift_cursor(event,'pass')">
												<span id="email_msg" style="display:none" class="text-danger"></span>
											</div>
										</div>
										<div class="form-group">
											<label for="dept" class="col-sm-4 control-label">Department <label class="text-danger">*</label></label>
											<div class="col-sm-8">
												<select class="form-control select2" id="dept" name="dept" style="width: 100%;" autofocus>
													<?php
													$q2 = $this->db->select("*")->get("TMI.HR_DEPT");
													if ($q2->num_rows() > 0) {
														echo "<option value=''>-Select-</option>";
														foreach ($q2->result() as $res1) {
															if ((isset($dept) && !empty($dept)) && $dept == $res1->DEPT_SYS_ID) {
																$selected = 'selected';
															} else {
																$selected = '';
															}
															echo "<option $selected value='" . $res1->DEPT_SYS_ID . "'>" . $res1->DEPT_NAME . "</option>";
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
											<label for="role_id" class="col-sm-4 control-label">Role<label class="text-danger">*</label> </label>
											<div class="col-sm-8">
												<select class="form-control select2" <?= $disabled; ?> id="role_id" name="role_id" style="width: 100%;">
													<?php
													if ($role_id != 1) {
														$this->db->where("ID!=1");
													}
													$q2 = $this->db->select("*")->where("STATUS", 1)->get("HR_ROLE");
													if ($q2->num_rows() > 0) {
														echo "<option value=''>-Select-</option>";
														foreach ($q2->result() as $res1) {
															if ((isset($role_id) && !empty($role_id)) && $role_id == $res1->ID) {
																$selected = 'selected';
															} else {
																$selected = '';
															}
															echo "<option " . $selected . " value='" . $res1->ID . "'>" . $res1->ROLE_NAME . "</option>";
														}
													} else {
													?>
														<option value="">No Records Found</option>
													<?php
													}
													?>
												</select>
												<span id="role_id_msg" style="display:none" class="text-danger"></span>
											</div>
										</div>
										<div class="form-group">
											<label for="pass" class="col-sm-4 control-label">Password<label class="text-danger">*</label></label>
											<div class="col-sm-8">
												<input type="password" class="form-control input-sm" id="pass" name="pass" placeholder="" onkeyup="shift_cursor(event,'confirm')" value="<?php print $pass ?>" <?php print $disabled; ?>>
												<span id="pass_msg" style="display:none" class="text-danger"></span>
											</div>
										</div>
										<div class="form-group">
											<label for="confirm" class="col-sm-4 control-label">Confirm Password<label class="text-danger">*</label></label>
											<div class="col-sm-8">
												<input type="password" class="form-control input-sm" id="confirm" name="confirm" placeholder="" value="<?php print $pass ?>" <?php print $disabled; ?>>
												<span id="confirm_msg" style="display:none" class="text-danger"></span>
											</div>
										</div>
										<!-- ########### -->
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="address" class="col-sm-4 control-label">Profile <Picture></Picture></label>
											<div class="col-sm-8">
												<input type="file" id="profile_picture" name="profile_picture">
												<span id="logo_msg" style="display:block;" class="text-danger">Max Width/Height: 500px * 500px & Size: 500Kb </span>
											</div>
										</div>
									</div>
									<div class="col-md-6 ">
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-4">
												<img width="200px" height="200px" class='img-responsive' style='border:3px solid #d2d6de;' src="<?php echo base_url($profile_picture); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<div class="col-sm-8 col-sm-offset-2 text-center">
									<!-- <div class="col-sm-4"></div> -->
									<?php
									if ($username != "") {
										$btn_name = "Update";
										$btn_id = "update";
									} else {
										$btn_name = "Save";
										$btn_id = "save";
									}

									?>
									<input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id; ?>" />
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
							<?= form_close(); ?>
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
		<!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->
	<!-- TABLES CODE -->
	<?php $this->load->view("template/js-form"); ?>
	<script src="<?php echo $theme_link; ?>js/users.js"></script>
	<!-- Make sidebar menu hughlighter/selector -->
	<script>
		$(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
	</script>
</body>

</html>