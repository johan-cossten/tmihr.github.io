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
					User List
					<small>Add/Update Users</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">User List</li>
				</ol>
			</section>
			<?php
			$CI = &get_instance();
			?>
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<?php $this->load->view("template/flashdata"); ?>
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">User List</h3>
								<?php if ($CI->permission('users_add')) { ?>
									<div class="box-tools">
										<a class="btn btn-block btn-info" href="<?php echo $base_url; ?>users/">
											<i class="fa fa-plus"></i> New User</a>
									</div>
								<?php }
								?>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<table id="example2" class="table table-bordered table-striped" width="100%">
									<thead class="bg-primary ">
										<tr>
											<th>#</th>
											<th>UserName</th>
											<th>Email</th>
											<th>Department</th>
											<th>Role</th>
											<th>Create On</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										$qs1 = "SELECT A.ID, A.USERNAME, A.EMAIL, A.CREATE_DATE, A.STATUS, B.ROLE_NAME, A.DEPT, C.DEPT_NAME FROM HR_USERS A INNER JOIN HR_ROLE B ON A.ROLE_ID = B.ID LEFT JOIN HR_DEPT C ON A.DEPT = C.DEPT_SYS_ID";
										$q1 = $this->db->query($qs1);
										if ($q1->num_rows() > 0) {
											foreach ($q1->result() as $res1) {
										?>
												<tr>
													<td> <?php echo $i++; ?> </td>
													<td> <?php echo $res1->USERNAME; ?> </td>
													<td> <?php echo $res1->EMAIL; ?> </td>
													<td> <?php echo $res1->DEPT_NAME; ?> </td>
													<td> <?php echo $res1->ROLE_NAME; ?> </td>
													<td> <?php echo $res1->CREATE_DATE; ?> </td>
													<td>
														<?php
														if ($res1->ID == 1)                   //1=Active, 0=Inactive
														{
															echo "  <span  class='label label-default' disabled='disabled' style='cursor:disabled'>Restricted</span>";
														} else if ($res1->STATUS == 1)                   //1=Active, 0=Inactive
														{
															echo "  <span onclick='update_status(" . $res1->ID . ",0)' id='span_" . $res1->ID . "'  class='label label-success' style='cursor:pointer'>Active </span>";
														} else {
															echo "<span onclick='update_status(" . $res1->ID . ",1)' id='span_" . $res1->ID . "'  class='label label-danger' style='cursor:pointer'> Inactive </span>";
														}
														?>
													</td>
													<td>
														<div class="btn-group" title="View Account">
															<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
																Action <span class="caret"></span>
															</a>
															<ul role="menu" class="dropdown-menu dropdown-light pull-right">
																<?php if ($CI->permission('users_edit')) {
																?>
																	<li>
																		<a title="Update Record ?" href="<?= $base_url; ?>users/edit/<?= $res1->ID; ?>">
																			<i class="fa fa-fw fa-edit text-blue"></i>Edit
																		</a>
																	</li>
																<?php }
																?>
																<?php if ($CI->permission('users_delete') && $res1->ID != 1) {
																?>
																	<li>
																		<a style="cursor:pointer" title="Delete Record ?" onclick="delete_user(<?= $res1->ID; ?>)">
																			<i class="fa fa-fw fa-trash text-red"></i>Delete
																		</a>
																	</li>
																<?php }
																?>
															</ul>
														</div>

													</td>
												</tr>
										<?php
											}
										}
										?>
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

	<script src="<?php echo $theme_link; ?>js/users.js"></script>


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
								columns: [0, 1, 2, 3, 4, 5, 6]
							}
						},
						{
							extend: 'excel',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [0, 1, 2, 3, 4, 5, 6]
							}
						},
						{
							extend: 'pdf',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [0, 1, 2, 3, 4, 5, 6]
							}
						},
						{
							extend: 'print',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [1, 2, 3, 4, 5, 6]
							}
						},
						{
							extend: 'csv',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [0, 1, 2, 3, 4, 5, 6]
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
				"serverSide": false, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
				"responsive": true,
				language: {
					processing: '<div class="text-primary bg-primary" style="position: relative;z-index:100;overflow: visible;">Processing...</div>'
				},
				// Load data for the table's content from an Ajax source

				//Set column definition initialisation properties.
				"columnDefs": [{
						"targets": [6], //first column / numbering column
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
	<script>
		$(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
	</script>
</body>

</html>