
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

    <title>Carousel Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">-->
	<!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>css/carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    
    <?php include 'navigationbar.php'; ?>

    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <div id="imaginary_container"> 
            <div class="input-group stylish-input-group">
              <input type="text" class="form-control"  placeholder="Search"   id="search" >
              <span class="input-group-addon">
              <button type="submit">
              <!--<i class="fa fa-search" aria-hidden="true"></i>-->
              <!--<span class="glyphicon glyphicon-search"></span>-->
              <i class="fa fa-search" aria-hidden="true"></i>
              </button>  
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="row" style="margin-top: 10px;">
        <div class = "col-md-9" id="loadSection">
          <div class="panel">
            <div class="panel-body" id="itemContent"> 
              <?php 
                foreach($fetch_data->result() as $row)
                {
              ?>
              <div class="col-md-4" id="oneitem">
                <div class="thumbnail">
                  <img class="img-thumbnail" src="<?php echo base_url(); ?><?php echo $row->image; ?>" onerror="this.src='http://placehold.it/320x150'" alt="http://placehold.it/320x150">
                  <div class="caption">
                    <h4 class="pull-right">Rs.<?php echo $row->price; ?></h4>
                    <h4><a href="<?php echo base_url(); ?>index.php/Welcome/menu_item/<?php echo $row->itemID; ?>"><?php echo $row->name; ?></a></h4>
                    <p><?php echo $row->description;?></p>
                  </div>
                  <div class="ratings">
                    <p class="pull-right">15 reviews</p>
                    <p>
                      <span class="glyphicon glyphicon-star"></span>
                      <span class="glyphicon glyphicon-star"></span>
                      <span class="glyphicon glyphicon-star"></span>
                      <span class="glyphicon glyphicon-star"></span>
                      <span class="glyphicon glyphicon-star"></span>
                    </p>
                  </div>
                  <center>
                  <input type="number" name="quantity" class="quantity" id="<?php echo $row->itemID.'q'; ?>">
                  <input type="hidden" name="name" value="<?php echo $row->name; ?>" id="<?php echo $row->itemID.'n'; ?>">
                  <input type="hidden" name="name" value="<?php echo $row->price; ?>" id="<?php echo $row->itemID.'p'; ?>">
                  <!-- <input type="hidden" name="name" value="<?php echo $row->name; ?>" id="<?php echo $row->itemID; ?>"> -->
                  <?php
                  //echo '<button type="button" name="add_cart" class="btn btn-success add_cart" data-name = "'.$row->name.'" data-price = "'.$row->price.'" data-itemID = "'.$row->itemID.'">Add to Cart</button>';
                  ?>
                  <button type="button" name="add_cart" class="btn btn-success add_cart" id="<?php echo $row->itemID; ?>">Add to Card</button>
                  <!-- <button type="button" name="add_cart" class="btn btn-success add_cart" data-name = "<?php echo $row->name; ?>" data-price = "<?php echo $row->price; ?>" data-itemID = "<?php echo $row->itemID; ?>">Add to Cart</button> -->
                  </center>
                </div>
              </div>
              <?php
                }
              ?>
            </div>
          </div>
        </div>

        <!-- <div class="col-md-3">
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Cart</h3>
             </div>
            </div>
            <div class="panel-body" id="cart_details">
              <h3>Cart is Empty</h3>
            </div>
          </div>
        </div> --> 

        <div class="col-md-3">
          <div id="cart_details">
            <h3 align="center">Cart is Empty</h3>
          </div>
        </div>

      </div>  
      

          <!--<div id="livesearch">
          <?php 

          foreach($fetch_data->result() as $row)
          {
           
          ?>       
              
          

        
        <div class="col-md-3 col-sm-6 "  style="margin-bottom: 20px;">
          <div class="card h-100">
            
            <img class="card-img-top" src=<?php echo $row->image; ?> alt="Image"></a>
            <div class="card-body">
              <h4 class="card-title">
                
              <?php echo $row->name; ?>
              </h4>
          
              <p class="card-text"><?php echo $row->description; ?></p>
              <p class="card-text"><?php echo $row->price; ?></p>
            </div>
          </div>
        </div>
        
        <?php } ?>
       </div>
        </div>-->
      </div>

      


      


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
    <!--<script src="../../dist/js/bootstrap.min.js"></script>-->
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!--<script src="../../assets/js/vendor/holder.min.js"></script>-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
  </body>
</html>

<!--<script>
  $(document).ready(function()
  {
    $('#search').keyup(function()
      { 
        var txt = document.getElementById('search').value;

            $.ajax(
              {
                url:"<?php echo base_url(); ?>index.php/Welcome/menu_item_byname",
                method:"post",
                data:{searchData:txt},
                dataType:"json",
                success:function(data)
                {
                  $('#itemContent').html("");
                  var obj = JSON.parse(response);
                  if(obj.length>0)
                  {
                    try
                    {
                      var items[];
                      $.each(obj, function(i,val){
                        items.push
                      });  
                    }                    
                  }
                }
              });
        
      });
  });
</script>-->

<script>
  $(document).ready(function(){
    $('.searchBox').on('keyup',function(){
      var searchVal = $(this).val().toLowerCase();
      $('#itemContent #oneitem').each(function(){
        var trVal = $(this).text().toLowerCase();
        if(trVal.indexOf(searchVal) === -1)
        {
          $(this).hide();
        }
        else
        {
          $(this).show();
        }
      });
    });
  });
</script>

<script>
  $(document).ready(function(){
    $('.add_cart').click(function(){
      var itemID = $(this).attr("id");
      var name = $('#' + itemID + 'n').val();
      var price = $('#' + itemID + 'p').val();
      var quantity = $('#' + itemID + 'q').val();

      if(quantity != '' && quantity > 0)
      {
        $.ajax({
          url:"<?php echo base_url(); ?>/index.php/Welcome/add",
          method: "POST",
          data:{itemID:itemID,name:name,price:price,quantity:quantity},
          success:function(data)
          {
            //alert("Item added to Cart");
            $('#cart_details').html(data);
            $('#' + itemID + 'q').val('');
          }
        });
      }
      else
      {
        alert("Please Enter a Valid Quantity");
      }
    });

    $('#cart_details').load("<?php echo base_url(); ?>index.php/Welcome/load");

    $(document).on('click','.remove_inventory',function(){
      var row_id = $(this).attr("id");
      if(confirm("Are you sure you want to remove this item?"))
      {
        $.ajax({
          url:"<?php echo base_url(); ?>index.php/Welcome/remove",
          method:"POST",
          data:{row_id:row_id},
          success:function(data)
          {
            //alert("Item removed from Cart");
            $('#cart_details').html(data);
          }
        });
      }
      else
      {
        return false;
      }
    });
  

  $(document).on('click','#clear_cart',function(){
      var row_id = $(this).attr("id");
      if(confirm("Are you sure you want to clear cart?"))
      {
        $.ajax({
          url:"<?php echo base_url(); ?>index.php/Welcome/clear",
          success:function(data)
          {
            //alert("Your cart has been cleared.");
            $('#cart_details').html(data);
          }
        });
      }
      else
      {
        return false;
      }
    });
  });
</script>
