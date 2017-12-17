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
							<h3 class="panel-title main-color-bg">Home</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class = "col-md-12" id="loadSection">
									<div class="col-md-3">
				                    	<div class ="well dash-box" style="text-align: center;">
				                        	<h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
				                        		<?php 
				                        			foreach($userCount->result() as $row)
				                        			{
				                        				echo $row->usercount;
				                        			}
				                        		 ?>
				                        	</h2>
				                        	<h4> Users </h4><h6>Currently registered</h6>
				                      	</div>
				                    </div>

				                    <div class="col-md-3">
				                    	<div class ="well dash-box" style="text-align: center;">
				                    		<h2><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
				                    			<?php 
				                        			foreach($pendingCount->result() as $row)
				                        			{
				                        				echo $row->pendingcount;
				                        			}
				                        		 ?>
				                    		</h2>
				                    		<h4> Orders </h4><h6>Currently Pending</h6>
				                     	</div>
				                    </div>

				                    <div class="col-md-3">
				                    	<div class ="well dash-box" style="text-align: center;">
				                       		<h2><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
				                       			<?php 
				                        			foreach($readyCount->result() as $row)
				                        			{
				                        				echo $row->readycount;
				                        			}
				                        		 ?>
				                       		</h2>
				                        	<h4> Orders </h4><h6>Currently Ready</h6>
				                      	</div>
				                    </div>

				                    <div class="col-md-3">
				                    	<div class ="well dash-box" style="text-align: center;">
				                       		<h2><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
				                       			<?php 
				                        			foreach($itemCount->result() as $row)
				                        			{
				                        				echo $row->itemcount;
				                        			}
				                        		 ?>
				                       		</h2>
				                        	<h4> Items </h4><h6>Currently Available</h6>
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

<?php //include 'footer.php'; ?>

  </body>
</html>
