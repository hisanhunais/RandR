<?php
	//session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin | R and R</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
	
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
							<h3 class="panel-title main-color-bg">Items</h3>
						 </div>
						<div class="panel-body">
							<div class="row">
								<div class = "col-md-12" id="loadSection">
									<div class="table-responsive">
										<button type="button" class="btn btn-md main-color-bg">
											<span class="glyphicon glyphicon-plus-sign"> Add
										</button>
										<br><br>
										<table class="table table-bordered">
											<thead>
												<tr>
													<td width="20%">Name</td>
													<td width="40%">Description</td>
													<td width="10%">Price (Rs)</td>
													<td width="10%">Image</td>
													<td width="10%"></td>
													<td width="10%"></td>
												</tr>
											</thead>
											<tbody>
											<?php 
                								foreach($fetch_itemlist->result() as $row)
                								{
                									$imgsrc = base_url().$row->image;
                									/*echo base_url(); ?>images/<?php echo $row->image;<img src="<?php echo $imgsrc; ?>" width="50" height="35" class="img-thumbnail">*/
              								?>
              									<tr>
              										<td width="20%"><?php echo $row->name; ?></td>
													<td width="40%"><?php echo $row->description; ?></td>
													<td width="10%"><?php echo $row->price; ?></td>
													<td width="10%"><img src="<?php echo $imgsrc; ?>" width="50" height="35" class="img-thumbnail" alt="image"></td>
													<td width="10%">Edit</td>
													<td width="10%">Delete</td>
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

	
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
