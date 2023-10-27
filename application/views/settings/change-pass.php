<!DOCTYPE html>
<html>

<head>

	<?php $this->load->view("template/css-form"); ?>
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
			<section class="content">
				<div class="row">
					<?php $this->load->view("template/flashdata"); ?>
					<div class="col-md-12">
						<div class="box box-info ">
							<div class="box-header with-border">
								<h3 class="box-title">Please Enter Valid Data</h3>
							</div>
							<form class="form-horizontal" id="category-form" onkeypress="return event.keyCode != 13;">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<div class="box-body">
									<div class="form-group">
										<label for="current_pass" class="col-sm-2 control-label">Current Password<label class="text-danger">*</label></label>
										<div class="col-sm-4">
											<input type="password" class="form-control input-sm" id="current_pass" name="current_pass" placeholder="" onkeyup="shift_cursor(event,'pass')" autofocus>
											<span id="category_msg" style="display:none" class="text-danger"></span>
										</div>
									</div>
									<div class="form-group">
										<label for="pass" class="col-sm-2 control-label">New Password<label class="text-danger">*</label></label>
										<div class="col-sm-4">
											<input type="password" class="form-control input-sm" id="pass" name="pass" placeholder="" onkeyup="shift_cursor(event,'confirm')">
											<span id="category_msg" style="display:none" class="text-danger"></span>
										</div>
									</div>
									<div class="form-group">
										<label for="confirm" class="col-sm-2 control-label">Confirm New Password<label class="text-danger">*</label></label>
										<div class="col-sm-4">
											<input type="password" class="form-control input-sm" id="confirm" name="confirm" placeholder="">
											<span id="category_msg" style="display:none" class="text-danger"></span>
										</div>
									</div>

								</div>
								<div class="box-footer">
									<div class="col-sm-8 col-sm-offset-2 text-center">
										<div class="col-md-3 col-md-offset-3">
											<button type="button" id="save" class=" btn btn-block btn-success" title="Save Data">Save</button>
										</div>
										<div class="col-sm-3">
											<a href="<?= base_url('dashboard'); ?>">
												<button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Close</button>
											</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("template/footer"); ?>
		<div class="control-sidebar-bg"></div>
	</div>

	<?php $this->load->view("template/js-form"); ?>
	<script src="<?php echo $theme_link; ?>js/changepass.js"></script>
	<script>
		$(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
	</script>
</body>

</html>