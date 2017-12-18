
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>My Orders</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body>
    
    <?php include 'navigationbar.php'; ?>

    <div class="container">
    	<div class="row">
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
															<td width="20%">Total (Rs)</td>
															<td width="10%">Required Date</td>
															<td width="10%">Required Time</td>
															<td width="10%">Status</td>
															<td width="10%"></td>
														</tr>
													</thead>
													<tbody>
													<?php 
		                								foreach($fetch_pendingorderlist->result() as $row)
		                								{
		              								?>
		              									<tr>
															<td width="20%"><?php echo $row->total; ?></td>
															<td width="10%"><?php echo $row->requiredDate; ?></td>
															<td width="10%"><?php echo $row->requiredTime; ?></td>
															<td width="10%" class="alert alert-danger"><?php echo $row->status; ?></td>
													<td width="10%"><input type="button" name="view" value="View Details" id="<?php echo $row->ordID; ?>" class="view_cdetails btn btn-info btn-xs" /></td>
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
															<td width="20%">Total (Rs)</td>
															<td width="10%">Required Date</td>
															<td width="10%">Required Time</td>
															<td width="10%">Status</td>
															<td width="10%"></td>
														</tr>
													</thead>
													<tbody>
													<?php 
		                								foreach($fetch_readyorderlist->result() as $row2)
		                								{
		              								?>
		              									<tr>
															<td width="20%"><?php echo $row2->total; ?></td>
															<td width="10%"><?php echo $row2->requiredDate; ?></td>
															<td width="10%"><?php echo $row2->requiredTime; ?></td>
															<td width="10%" class="alert alert-success"><?php echo $row2->status; ?></td>
															<td width="10%"><input type="button" name="view" value="View Details" id="<?php echo $row2->ordID; ?>" class="view_details btn btn-info btn-xs" /></td>
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
						<!-- <input type="submit" name="submit" value="Update" id="update" class="btn main-color-bg"/> -->
						<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>     


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->

  </body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		// When view details button is clicked, this ajax method loads order details in to the Order details modal
		$('.view_cdetails').click(function(){
			var orderno = $(this).attr("id");
			// alert(orderno);
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
	});
</script>
