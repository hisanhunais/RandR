
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

    <style>
    #map{
        height :400px;
        width : 100%;

    }
</style>


    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>css/carousel.css" rel="stylesheet">
  </head>

  <body>
    
    <?php include 'navigationbar.php'; ?>

    <div class="container">
        <div class="jumbotron">
            <hr>
           <h3>Contact Us!</h3>
            Call Us 011-2728585 <br/>
            Messenger @RnRfoodies <br/>
            Facebook 'RnR Sweets & Savouries' <br/>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <form action="form.php" method="post">
                    <div class="col-md-6">
                       <ul> 
                        Name    : <br/><input type="text" name="name"/><br/><br/>
                        Email   : <br/><input type="email" name="eMail"/><br/><br/>
                        Phone   : <br/><input type="phone" name="phone"/><br/><br/>
                        Subject : <br/><input type="subject" name="subject"/><br/><br/> 
                        </ul>
                    </div>
                    <div class="col-md-6">
                        Message: <textarea rows="6" cols="30" name="message"> </textarea><br/><br/>
                    </div>
                    <input type="submit" name="submit" value="send"/>

                    </form>
                </div>
      
            </div>
            <div class="col-md-6">
                        

            <div class="container-fluid" id = map>


                <div id="map"></div>
                <script>
                    function initMap(){
                        // Map options
                        var options = {
                            zoom:13,
                            center:{lat : 6.894070, lng: 79.902481}
                        }

                        // New map
                        var map = new google.maps.Map(document.getElementById('map'), options);




                        // Array of markers
                        var markers = [
                            {
                                coords:{lat : 7.290572, lng: 80.633728},
                                content:'<h2>Kandy</h2>'
                            },
                            {
                                coords:{lat : 6.927079, lng: 79.861244},
                                content:'<h2>Colombo MA</h2>'
                            },
                            {
                                coords:{lat : 6.894070, lng: 79.902481}
                            }
                        ];

                        // Loop through markers
                        for(var i = 0;i < markers.length;i++){
                            // Add marker
                            addMarker(markers[i]);
                        }

                        // Add Marker Function
                        function addMarker(props){
                            var marker = new google.maps.Marker({
                                position:props.coords,
                                map:map,
                                //icon:props.iconImage
                            });

                            // Check for customicon
                            if(props.iconImage){
                                // Set icon image
                                marker.setIcon(props.iconImage);
                            }

                            // Check content
                            if(props.content){
                                var infoWindow = new google.maps.InfoWindow({
                                    content:props.content
                                });

                                marker.addListener('click', function(){
                                    infoWindow.open(map, marker);
                                });
                            }
                        }
                    }
                </script>
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZqgB95gjNr18bqMG7TFjFTLuJr6OMRAY&callback=initMap">

                </script>

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
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--<script src="../../dist/js/bootstrap.min.js"></script>-->
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!--<script src="../../assets/js/vendor/holder.min.js"></script>-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
  </body>
</html>
