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

  <body>
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
									<div class="table-responsive">
										<table class="table table-bordered" id="item_table">
											<thead>
												<tr>
													<td width="30%">Customer</td>
													<td width="20%">Total (Rs)</td>
													<td width="20%">Required Date</td>
													<td width="10%">Required Time</td>
													<td width="10%">Status</td>
													<td width="10%"></td>
												</tr>
											</thead>
											<tbody>
											<?php 
                								foreach($fetch_orderlist->result() as $row)
                								{
              								?>
              									<tr>
              										<td width="30%"><?php echo $row->customerID; ?></td>
													<td width="20%"><?php echo $row->total; ?></td>
													<td width="20%"><?php echo $row->requiredDate; ?></td>
													<td width="10%"><?php echo $row->requiredTime; ?></td>
													<td width="10%"><?php echo $row->status; ?></td>
													<td width="10%"><input type="button" name="view" value="View Details" id="<?php echo $row->ordID; ?>" class="view_details btn btn-info btn-xs" /></td>
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
	</section>

	<div id="orderDetailsModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Order Details</h4>
				</div>
				<div class="modal-body" id="order_details">
					<div class= "table-responsive">
						<table class="table table-bordered">
							<tr>
								<td>Item</td>
								<td>Quantity</td>
							</tr>';
							foreach($fetch_orderdetailslist as $row)
							{
								$output .= '
									<tr>
										<td>'.$row->name.'</td>
										<td>'.$row->quantity.'</td>
									</tr>
								';
							}

				$output .= '		
						</table>
					</div>
				</div>
				<div class="modal-footer"">
					<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
				</div>
			</div>
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
	});
</script>