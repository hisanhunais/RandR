
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="<?php echo base_url(); ?>css/adminStyle.css" rel="stylesheet">

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRM5CCp0gytfOJaxkwmqxDmyy6-FPPIws"></script>
<style type="text/css">
          #map{ width:700px; height: 500px; }
        </style>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>css/carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body style="background:#f4f4f4;">
    
    <?php include 'navigationbar.php'; ?>

    <div class="container">
      <div class="row" style="margin-top: 10px;">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Order Details</h3>
          </div>
          <div class="panel-body" id="cart_details">
            <table class="table table-striped">
              <tr>
                <th width="40%">Item</th>
                <th width="15%">Quantity</th>
                <th width="15%">Price</th>
                <th width="15%">Total</th>
              </tr>
              <?php
                foreach($this->cart->contents() as $items)
                {
              ?>
              <tr>
                <td><?php echo $items["name"]; ?></td>
                <td><?php echo $items["qty"]; ?></td>
                <td><?php echo $items["price"]; ?></td>
                <td><?php echo $items["subtotal"]; ?></td>
              </tr>
              <?php    
                }
              ?>
              <tr>
                <td colspan="3" align="right">Total</td>
                <td><?php echo $this->cart->total(); ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>

      <div class="row">
        <form method="post" class="myform" action="<?php echo base_url();?>index.php/Welcome/addorder">
        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Date</span>
            <input type="date" class="form-control" placeholder="Required Date" name="requiredDate" id="requiredDate" aria-describedby="basic-addon1" required="">
          </div>
        </div>

        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Time</span>
            <input type="time" class="form-control" placeholder="Required Time" name="requiredTime" id="requiredTime" aria-describedby="basic-addon1" required="">
          </div>
        </div>

        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-addon">
              <input type="checkbox" id="delivery" name="deliveryRequired" id="deliveryRequired" value="Yes">
            </span>
            <input type="text" class="form-control" placeholder="Delivery Required" aria-describedby="basic-addon1" readonly>
          </div>
        </div>
      </div>

      <div class="row" id="deliverydetails" style="/*display: none;*/">
        <center>
          
        <div>
        
          <h2>Select Location</h2>
        
          <p>Click on a location on the map to select it. Drag the marker to change location.</p>
            
            <!--map div-->
            <div id="map"></div>

            <!--our form-->
            <h2>Chosen Location</h2>
            
                <input type="text" id="lat" name="lat" readonly="yes" class="form-control" required><br>
                <input type="text" id="lng" name="lng" readonly="yes" class="form-control" required><br>
                <a href = "index.php"><input type="button" id="back_btn" value="Back"/></a>
                
            
          
          </div>
          <input name="submit" type="submit" id="submitLoc" value="Confirm Order" class="btn btn-primary" />
          </center>
          </form>
          
            
      </div>

      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->

    <script type="text/javascript" src="<?php echo base_url(); ?>js/map.js"></script>
  </body>
</html>

<script>
$(document).ready(function(){
$('#delivery').click(function() {
    if( $(this).is(':checked')) {
        $("#deliverydetails").show();
    } else {
        $("#deliverydetails").hide();
    }
});    
});


</script>


