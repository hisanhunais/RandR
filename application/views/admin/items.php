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
										<button type="button" class="btn btn-md main-color-bg" data-toggle="modal" data-target="#addItem">
											<span class="glyphicon glyphicon-plus-sign"> Add
										</button>
										<br><br>
										<table class="table table-bordered" id="item_table">
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
    <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
  </body>
</html>

<div id="addItem" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="add_item_form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Item</h4>
				</div>
				<div class="modal-body">
					<label>Item Name</label>
					<input type="text" name="item_name" id="item_name" class="form-control" required="" />
					<br>
					<label>Description</label>
					<input type="text" name="item_description" id="item_description" class="form-control" required="" />
					<br>
					<label>Price</label>
					<input type="number" name="item_price" id="item_price" class="form-control" required="" />
					<br>
					<!--<label>Image</label>
					<input type="file" name="item_image" id="item_image" />-->
				</div>
				<div class="modal-footer">
					<input type="submit" name="submit" value="Submit" class="btn main-color-bg" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		$(document).on('submit','#add_item_form',function(event){
			event.preventDefault(); // Prevent Form Data From Submitting
			var itemName = $('#item_name').val();
			var itemDescription = $('#item_description').val();
			var itemPrice = $('#item_price').val();
			var extension = $('#item_image').val().split('.').pop().toLowerCase();
			var itemImage = $('#item_image').val();
			var sendData = $('#add_item_form').serialize();
			if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
			{
				alert("Invalid Image File");
				$('#item_image').val('');
				return false;
			}

			/*$.ajax({
				url:"<?php echo base_url() . 'index.php/Admin/add_item' ?>",
				method:'POST',
				data:sendData,
				contentType:false,
				processingData:false,
				success:function(data)
				{
					alert(data);
					$('#add_item_form')[0].reset();
					$('#addItem').modal('hide');
				} 
			});*/

			$.ajax({
				type:'ajax',
				url:"<?php echo base_url() . 'index.php/Admin/add_item' ?>",
				method:'POST',
				data:sendData,
				async:false,
				success:function(data)
				{
					alert(data);
					$('#add_item_form')[0].reset();
					$('#addItem').modal('hide');
				} 
			});
		});
	});
</script>
