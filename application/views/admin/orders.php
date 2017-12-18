<?php
	//session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin | R and R</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="<?php echo base_url(); ?>css/adminStyle.css" rel="stylesheet">
 
  </head>

  <body id="pageBody">
	<?php
		$this->load->view("admin/header");
	?>
	
	<section id="main">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-md-3">
	                <?php $this->load->view("admin/sidebar"); ?>
	            </div>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading main-color-bg">
							<h3 class="panel-title main-color-bg">Orders</h3>							
						</div>
						<div class="panel-body">
							<div class="row">
								<div class = "col-md-12" id="loadSection">
									<ul class="nav nav-tabs">
									  <li class="active"><a data-toggle="tab" href="#pending">Pending</a></li>
									  <li><a data-toggle="tab" href="#ready">Ready</a></li>
									  <li><a data-toggle="tab" href="#completed">Completed</a></li>
									</ul>
									<div class="tab-content" id="orderTabs">
									<br>
								  		<div id="pending" class="tab-pane fade in active">
											<div class="table-responsive">
												<table class="table table-bordered" id="item_table">
													<thead>
														<tr>
															<td width="20%">Customer</td>
															<td width="20%">Total (Rs)</td>
															<td width="10%">Required Date</td>
															<td width="10%">Required Time</td>
															<td width="10%">Status</td>
															<td width="10%"></td>
															<td width="10%"></td>
															<td width="10%"></td>
														</tr>
													</thead>
													<tbody>
													<?php 
		                								foreach($fetch_pendingorderlist->result() as $row)
		                								{
		              								?>
		              									<tr>
		              										<td width="20%"><?php echo $row->customerUsername; ?></td>
															<td width="20%"><?php echo $row->total; ?></td>
															<td width="10%"><?php echo $row->requiredDate; ?></td>
															<td width="10%"><?php echo $row->requiredTime; ?></td>
															<td width="10%" class="alert alert-danger"><?php echo $row->status; ?></td>
															<td width="10%"><input type="button" name="view" value="View Details" id="<?php echo $row->ordID; ?>" class="view_details btn btn-info btn-xs" /></td>
															<td width="10%"><input type="button" name="ready" value="Ready Order" id="<?php echo $row->ordID; ?>" class="ready_order btn btn-primary btn-xs" /></td>
															<td width="10%"><input type="button" name="cancel" value="Cancel Order" id="<?php echo $row->ordID; ?>" class="cancel_order btn btn-danger btn-xs" /></td>
		              									</tr> 
		              								<?php 
		              									}
		              								?> 
		              								</tbody>
												</table>
											</div>
										</div>

										<div id="ready" class="tab-pane fade">
											<div class="table-responsive">
												<table class="table table-bordered" id="item_table">
													<thead>
														<tr>
															<td width="20%">Customer</td>
															<td width="20%">Total (Rs)</td>
															<td width="10%">Required Date</td>
															<td width="10%">Required Time</td>
															<td width="10%">Status</td>
															<td width="10%"></td>
															<td width="10%"></td>
														</tr>
													</thead>
													<tbody>
													<?php 
		                								foreach($fetch_readyorderlist->result() as $row2)
		                								{
		              								?>
		              									<tr>
		              										<td width="20%"><?php echo $row2->customerUsername; ?></td>
															<td width="20%"><?php echo $row2->total; ?></td>
															<td width="10%"><?php echo $row2->requiredDate; ?></td>
															<td width="10%"><?php echo $row2->requiredTime; ?></td>
															<td width="10%" class="alert alert-success"><?php echo $row2->status; ?></td>
															<td width="10%"><input type="button" name="view" value="View Details" id="<?php echo $row2->ordID; ?>" class="view_details btn btn-info btn-xs" /></td>
															<td width="10%"><input type="button" name="complete" value="Complete Order" id="<?php echo $row2->ordID; ?>" class="complete_order btn btn-primary btn-xs" /></td>
		              									</tr> 
		              								<?php 
		              									}
		              								?> 
		              								</tbody>
												</table>
											</div>
										</div>

										<div id="completed" class="tab-pane fade">
											<div class="table-responsive">
												<table class="table table-bordered" id="item_table">
													<thead>
														<tr>
															<td width="20%">Customer</td>
															<td width="20%">Total (Rs)</td>
															<td width="10%">Required Date</td>
															<td width="10%">Required Time</td>
															<td width="10%">Status</td>
															<td width="10%"></td>
														</tr>
													</thead>
													<tbody>
													<?php 
		                								foreach($fetch_completeorderlist->result() as $row3)
		                								{
		              								?>
		              									<tr>
		              										<td width="20%"><?php echo $row3->customerUsername; ?></td>
															<td width="20%"><?php echo $row3->total; ?></td>
															<td width="10%"><?php echo $row3->requiredDate; ?></td>
															<td width="10%"><?php echo $row3->requiredTime; ?></td>
															<td width="10%" class="alert alert-info"><?php echo $row3->status; ?></td>
															<td width="10%"><input type="button" name="view" value="View Details" id="<?php echo $row3->ordID; ?>" class="view_details btn btn-info btn-xs" /></td>
		              									</tr> 
		              								<?php 
		              									}
		              								?> 
		              								</tbody>
												</table>
											</div>
										</div>
									</div>		
								</div>
							</div>
						</div>
					</div>
				</div>
	        </div>
	    </div>
	</section>

	<div id="orderDetailsModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="update_order_form">
				<div class="modal-content">
					<div class="modal-header"">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Order Details</h4>
					</div>
					<div class="modal-body" id="order_details">
					</div>
					<div class="modal-footer"">
						<input type="submit" name="submit" value="Update" id="update" class="btn main-color-bg"/>
						<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div id="readyOrder" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="ready_order_form">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Ready Order</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to make this Order Ready?</p>
						<input type="hidden" name="readydata" id="readydata">
					</div>
					<div class="modal-footer">
						<input type="submit" name="submit" value="Ready" id="ready" class="btn main-color-bg" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div id="completeOrder" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="complete_order_form">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Complete Order</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to Complete this Order?</p>
						<input type="hidden" name="completedata" id="completedata">
					</div>
					<div class="modal-footer">
						<input type="submit" name="submit" value="Complete" id="complete" class="btn main-color-bg" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>	

<?php //include 'footer.php'; ?>

	
 
  </body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		// When view details button is clicked, this ajax method loads order details in to the Order details modal
		$('.view_details').click(function(){
			var orderno = $(this).attr("id");
			$.ajax({
				url:"<?php echo base_url() . 'index.php/Admin/order_details' ?>",
				method:"post",
				data:{orderno:orderno}, 
         		cache:false,
				success:function(data){
					$('#order_details').html(data);
					$('#orderDetailsModal').modal("show");
				}
			});	
		});

		// When complete order button is clicked, this method set the hidden field of confirmation message modal with the order number
		$(document).on('click', '.complete_order', function(){
			var com_ordID = $(this).attr("id");
			$('#completedata').val(com_ordID);
			$('#completeOrder').modal('show');
		});

		// When submit button of confirmation message modal is clicked, this method will be called
		$('#complete_order_form').on('submit',function(event){
			event.preventDefault();
			$.ajax({
				url:"<?php echo base_url() . 'index.php/Admin/update_order_status/Completed' ?>",
				method:"POST",
				data:$('#complete_order_form').serialize(),
				success:function(data)
				{
					$('#complete_order_form')[0].reset();
					$('#completeOrder').modal('hide');
					location.reload();
					// $('#pageBody').html(data);
				}
			});
		});

		// When ready order button is clicked, this method set the hidden field of confirmation message modal with the order number
		$(document).on('click', '.ready_order', function(){
			var ready_ordID = $(this).attr("id");
			$('#readydata').val(ready_ordID);
			$('#readyOrder').modal('show');
		});

		// When submit button of confirmation message modal is clicked, this method will be called
		$('#ready_order_form').on('submit',function(event){
			event.preventDefault();
			$.ajax({
				url:"<?php echo base_url() . 'index.php/Admin/update_order_status/Ready' ?>",
				method:"POST",
				data:$('#ready_order_form').serialize(),
				success:function(data)
				{
					$('#ready_order_form')[0].reset();
					$('#readyOrder').modal('hide');
					location.reload();
					// $('#pageBody').html(data);
				}
			});
		});

		// When submit button of order details modal is clicked, this method will be called
		$('#update_order_form').on('submit',function(event){
			event.preventDefault();
			$.ajax({
				url:"<?php echo base_url() . 'index.php/Admin/update_order' ?>",
				method:"POST",
				data:$('#update_order_form').serialize(),
				success:function(data)
				{
					$('#update_order_form')[0].reset();
					$('#orderDetailsModal').modal('hide');
					location.reload();
					// $('#pageBody').html(data);
				}
			});
		});
	});
</script>