<?php

// Initializing variables.
$homeActive =  $itemsActive = $ordersActive = $customersActive = '';
$active = "active main-color-bg";

switch($this->uri->segment(2,"home")) {
    case 'home':
        $homeActive = $active;
    break;

    case 'items':
        $itemsActive = $active;
    break;

    case 'orders':
        $ordersActive = $active;
    break;

    case 'customers':
        $customersActive = $active;
    break;

    // By default, we assume you will be at index.php (setting $homeActive).
    //default:
    //    $homeActive = $active;
    //break;
}
?>

<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
  
<link href="<?php echo base_url(); ?>css/adminStyle.css" rel="stylesheet">

<div class="list-group">
    <a href="<?php echo base_url(); ?>index.php/Admin" class="list-group-item <?php echo $homeActive; ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
    <a href="<?php echo base_url(); ?>index.php/Admin/items" class="list-group-item <?php echo $itemsActive; ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Items</a>
    <a href="<?php echo base_url(); ?>index.php/Admin/orders" class="list-group-item <?php echo $ordersActive; ?>"><span class="glyphicon glyphicon-plane" aria-hidden="true"></span> Orders</a>
    <a href="<?php echo base_url(); ?>index.php/Admin/customers" class="list-group-item <?php echo $customersActive; ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Customer</a>
</div>