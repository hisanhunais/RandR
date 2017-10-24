<?php

// Initializing variables.
$homeActive =  $aboutActive = $contactActive = $menuActive = '';
$active = "active";

switch(basename($_SERVER['PHP_SELF'])) {
    case 'home.php':
        $homeActive = $active;
    break;

    case 'about.php':
        $aboutActive = $active;
    break;

    case 'contact.php':
        $contactActive = $active;
    break;

    case 'menu.php':
        $menuActive = $active;
    break;

    // By default, we assume you will be at index.php (setting $homeActive).
    //default:
    //    $homeActive = $active;
    //break;
}
?>

<!--<div class="navbar-wrapper">-->
      <div class="container">

        <nav class="navbar navbar-inverse">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">R and R</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="<?php echo $homeActive;?>"><a href="<?php echo base_url(); ?>index.php/Welcome/index">Home</a></li>
                <li class="<?php echo $aboutActive;?>"><a href="<?php echo base_url(); ?>index.php/Welcome/about">About</a></li>
                <li class="<?php echo $menuActive;?>"><a href="<?php echo base_url(); ?>index.php/Welcome/menu">Menu</a></li>
                <li class="<?php echo $contactActive;?>"><a href="<?php echo base_url(); ?>index.php/Welcome/contact">Contact</a></li> 
              </ul>
            </div>
          </div>
        </nav>

      </div>
    <!--</div>-->