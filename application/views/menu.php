<?php

?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a id="addDevice" class="navbar-brand" href="#" onclick="add_device()"><i class="glyphicon glyphicon-plus"></i></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Setting <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>index.php/Main/form/device">Device</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/Main/form/kategori">Category</a></li>
          </ul>
        </li>
        <li><a href="#">How To Use</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a><span class="glyphicon glyphicon-log-in"></span> V1.0.0</a></li>
      </ul>
    </div>
  </div>
</nav>
<br>
<br>
<br>
<div class="container">