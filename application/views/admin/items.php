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

	<script type="text/javascript">
		function PreviewImage()
		{
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("userfile").files[0]);
			oFReader.onload = function(oFREvent)
			{
				document.getElementById("uploadPreview").src = oFREvent.target.result;
			};
		};
	</script>
 
  </head>

  <body id="itemBody">
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
													<td width="10%"><input type="button" name="edit" value="Edit" id="<?php echo $row->itemID; ?>" class="btn btn-info btn-xs edit_data" ></td>
													<td width="10%"><input type="button" name="delete" value="Delete" id="<?php echo $row->itemID; ?>" class="btn btn-info btn-xs delete_data" ></td>
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

<div id="addItem" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="add_item_form" enctype="multipart/form-data">
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
					<label>Image</label>
					<center>
					<input type="file" id="userfile" name="userfile" accept=".jpg,.jpeg,.png" onchange="PreviewImage();">
					<br>
					
					<div>
						<img id="uploadPreview" src="http://placehold.it/500x300" alt="" width="500px" height="300px">
						<input type="hidden" name="attachdata" id="attachdata">
					</div>
					</center>
				</div>
				<div class="modal-footer">
					<input type="submit" name="submit" value="Submit" class="btn main-color-bg" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div id="editItem" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="edit_item_form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Update Item</h4>
				</div>
				<div class="modal-body">
					<label>Item Name</label>
					<input type="text" name="item_name1" id="item_name1" class="form-control" readonly="true" />					
					<br>
					<label>Description</label>
					<input type="number" name="item_qty1" id="item_qty1" class="form-control" readonly="true" />
					<br>
					<label>Price (Rs)</label>
					<input type="number" name="item_price1" id="item_price1" class="form-control" required="" />
					<br>
					<!--<label>Image</label>
					<input type="file" name="file_name" id="item_image" />-->
					<input type="hidden" name="updatedata" id="updatedata">
				</div>
				<div class="modal-footer">
					<input type="submit" name="submit" value="Update" id="update" class="btn main-color-bg" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div id="deleteItem" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="delete_item_form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delete Item</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this item?</p>
					<input type="hidden" name="deletedata" id="deletedata">
				</div>
				<div class="modal-footer">
					<input type="submit" name="submit" value="Delete" id="delete" class="btn main-color-bg" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>	

<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		// $(document).on('submit','#add_item_form',function(event){
		// 	event.preventDefault(); // Prevent Form Data From Submitting
		// 	var itemName = $('#item_name').val();
		// 	var itemDescription = $('#item_description').val();
		// 	var itemPrice = $('#item_price').val();
		// 	var extension = $('#item_image').val().split('.').pop().toLowerCase();
		// 	var itemImage = $('#item_image').val();
		// 	var sendData = $('#add_item_form').serialize();
		// 	if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
		// 	{
		// 		alert("Invalid Image File");
		// 		$('#item_image').val('');
		// 		return false;
		// 	}

		// 	$.ajax({
		// 		url:"<?php echo base_url() . 'index.php/Admin/add_item' ?>",
		// 		method:'POST',
		// 		data:sendData,
		// 		contentType:false,
		// 		processingData:false,
		// 		success:function(data)
		// 		{
		// 			alert(data);
		// 			$('#add_item_form')[0].reset();
		// 			$('#addItem').modal('hide');
		// 		} 
		// 	});

		// 	$.ajax({
		// 		type:'ajax',
		// 		url:"<?php echo base_url() . 'index.php/Admin/add_item' ?>",
		// 		method:'POST',
		// 		data:sendData,
		// 		async:false,
		// 		success:function(data)
		// 		{
		// 			alert(data);
		// 			$('#add_item_form')[0].reset();
		// 			$('#addItem').modal('hide');
		// 		} 
		// 	});
		// });
		$('#add_item_form').on('submit',function(e){
			e.preventDefault();
			if($('#userfile').val() == '')
			{
				alert("Please Select a File");
			}
			else
			{
				$.ajax({
					url:"<?php echo base_url() . 'index.php/Admin/add_item' ?>",
					method:'POST',
					data:new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success:function(data)
					{
						$('#add_item_form')[0].reset();
						$('#addItem').modal('hide');
						location.reload();
					} 
				});
			}
		});

		$(document).on('click', '.edit_data', function(){
			var paddyID = $(this).attr("id");
			$.ajax({
				url:"fetch_stock.php",
				method:"POST",
				data:{paddyID:paddyID},
				dataType:"json",
				success:function(data)
				{
					$('#item_name1').val(data.Paddy_type);
					$('#item_qty1').val(data.Paddy_quantity);
					$('#item_qty2').val(0);
					$('#item_price1').val(data.Paddy_price);
					//$('#item_price').val(data.Paddy_price);
					$('#paddyID1').val(data.Paddy_ID);
					$('#editStock').modal('show');
				}

			});
		});

		$('#edit_stock_form').on('submit',function(event){
			event.preventDefault();
			$.ajax({
				url:"add_stock.php",
				method:"POST",
				data:$('#edit_stock_form').serialize(),
				success:function(data)
				{
					$('#edit_stock_form')[0].reset();
					$('#editStock').modal('hide');
					$('#stock_table').html(data);
				}
			});
		});

		$(document).on('click', '.delete_data', function(){
			var del_itemID = $(this).attr("id");
			$('#deletedata').val(del_itemID);
			$('#deleteItem').modal('show');
		});

		$('#delete_item_form').on('submit',function(event){
			event.preventDefault();
			$.ajax({
				url:"<?php echo base_url() . 'index.php/Admin/delete_item' ?>",
				method:"POST",
				data:$('#delete_item_form').serialize(),
				success:function(data)
				{
					$('#delete_item_form')[0].reset();
					$('#deleteItem').modal('hide');
					location.reload();
				}
			});
		});
	});
</script>
