<!DOCTYPE html>
<html>

<head>
	<!-- FORM CSS CODE -->
	<?php $this->load->view('template/css-datatable'); ?>
	<!-- </copy> -->

</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php
		$this->load->view('template/sidebar');
		?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
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
			<div class="col-md-12">
				<!-- ********** ALERT MESSAGE START******* -->
				<?php $this->load->view('template/flashdata'); ?>
				<!-- ********** ALERT MESSAGE END******* -->
			</div>

		</div>
		<!-- /.content-wrapper -->

		<?php $this->load->view('template/footer'); ?>
		<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>

	</div>
	<!-- ./wrapper -->

	<!-- TABLES CODE -->
	<?php $this->load->view('template/js-datatable'); ?>
	<!-- bootstrap datepicker -->
	<script>
		$(document).ready(function() {
			function load_unseen_notification(view = '') {
				var dept = <?php echo $this->session->userdata('dept_id') ?>;
				$.ajax({
					url: 'dashboard/list_notif',
					method: 'POST',
					data: {
						view: view,
						dept: dept
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
</body>

</html>