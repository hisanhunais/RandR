
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
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="http://demos.maxoffsky.com/shop-reviews/js/starrr.js"></script>
	
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
    <link href="<?php echo base_url(); ?>css/itemPage.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    
    <?php include 'navigationbar.php'; ?>

    <div class="container">
      <div class="row" style="margin-top: 10px;">
        <div class = "col-md-12" id="loadSection">
          <div class="panel">
            <div class="panel-body">
              <?php 
                foreach($fetch_item->result() as $row)
                {
              ?>
              <div class="col-md-12">
                <div class="thumbnail">
                  <img src="<?php echo base_url(); ?><?php echo $row->image;?>" onerror="this.src='http://placehold.it/820x320'" alt="Image">
                  <div class="caption-full">
                    <h4 class="pull-right">Rs.<?php echo $row->price; ?></h4>
                    <h4><?php echo $row->name; ?></h4>
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
                </div>
              </div>
              <?php
                }
              ?>
            </div>
          </div>
        </div>  
      </div>

      <div class="row">
        <div class="col-md-12">
          <form method="POST" action="<?php echo base_url() ?>index.php/Welcome/add_reviews" accept-charset="UTF-8">  
            <input name="_token" type="hidden" value="judkeKLbcKuAcR3yyrIfwcfvVXJ398ZnpQJZmxKV">                  
            <input id="ratings-hidden" name="rating" type="hidden">                  
            <textarea rows="5" id="new-review" class="form-control animated" placeholder="Enter your review here..." name="comment" cols="50"></textarea>                  
            <div class="text-right">
              <div class="stars starrr" data-rating="0"></div>
              <button name="commentBtn" class="btn btn-success" type="submit">Comment</button>
            </div>
          </form> 
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <?php 
                foreach($fetch_reviews->result() as $row)
                {
              ?>
              <?php echo $row->username; ?>
              <?php
              $stars = round($row->rating);
              $nostars = 5 - $stars;
              for($i=0;$i<$stars;$i++)
              {
                echo "<span class='glyphicon glyphicon-star'></span>";
              }
              for($j=0;$j<$nostars;$j++)
              {
                echo "<span class='glyphicon glyphicon-star-empty'></span>";
              }
              ?>
              <p><?php echo $row->comment; ?></p>
              <hr />
             <?php 
               }
             ?>
            </div>
          </div>
        </div>
      </div>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://demos.maxoffsky.com/shop-reviews/js/starrr.js"></script>
    <script src="http://demos.maxoffsky.com/shop-reviews/js/expanding.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $(function(){
      var ratingsField = $('#ratings-hidden');
      $('.starrr').on('starrr:change', function(e, value){
        ratingsField.val(value);
      });
    });
  </script>
    <!--<script src="../../dist/js/bootstrap.min.js"></script>-->
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!--<script src="../../assets/js/vendor/holder.min.js"></script>-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
  </body>
</html>
