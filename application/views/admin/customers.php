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
							<h3 class="panel-title main-color-bg">Registered Customers</h3>							
						  </div>
						<div class="panel-body">
							<div class="row">
								<div class = "col-md-12" id="loadSection">
									<div class="table-responsive">
										<table class="table table-bordered" id="customer_table">
											<thead>
												<tr>
													<td width="20%">Customer ID</td>
													<td width="25%">First Name</td>
													<td width="25%">Last Name</td>
													<td width="30%">Email</td>
												</tr>
											</thead>
											<tbody>
											<?php 
                								foreach($fetch_customerlist->result() as $row)
                								{
              								?>
              									<tr>
              										<td width="20%"><?php echo $row->id; ?></td>
													<td width="25%"><?php echo $row->firstname; ?></td>
													<td width="25%"><?php echo $row->lastname; ?></td>
													<td width="30%"><?php echo $row->username; ?></td>
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

<?php //include 'footer.php'; ?>

  </body>
</html>
