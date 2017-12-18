<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Signup / Registration form using Material Design - Demo by W3lessons</title>
   <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url().'/assets/vendor/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  


<body>

<?php include 'navigationbar.php'; ?>


   <div id="signupbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info" style="margin-top: 50px;">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="<?php echo site_url('Login');?>">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form" method="post" action="<?php echo site_url('Register/register_user'); ?>">
                                <?php
                                  $error_msg=$this->session->flashdata('error_msg');
                                  if($error_msg){
                                    echo '<div id="signupalert" style="" class="alert alert-danger">
                                                    <p>Error:'. $error_msg.'</p>
                                                    <span></span>
                                                </div>';
                                  }
                                ?>
                        
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="username" placeholder="Email Address" required>
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Phone Number</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="phonenumber" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id ="password" class="form-control" name="password" placeholder="Password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Comfirm Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id ="cpassword" class="form-control" name="passconf" placeholder="Password" required>
                                    </div>
                                </div>
                                <p id ="msg" style="margin-left: 160px;"></p>
                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>&nbsp Sign Up</button>
                                    
                                    </div>
                                </div>
                

                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 


 
  <!-- jQuery Library -->
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script>

$('#cpassword').keyup(function() {
  //alert("rg");
  var cpassword = $('#cpassword').val();
  var password  =  $('#password').val();
  if(password === cpassword) {
    $('#msg').html("");
     $('#btn-signup').prop('disabled', false);
  } else {
    $('#msg').html("not matching");
     $('#btn-signup').prop('disabled', true);
  }
});
 </script>
</body>

</html>