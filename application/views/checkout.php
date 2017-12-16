
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

      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


  </body>
</html>


