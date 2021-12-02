
<nav id="navbar_top" class="navbar navbar-expand-md navbar-light navbar-muted shadow-sm">   
   <a class="navbar-brand" href="index.php">Php faker</a>
   <button class="navbar-toggler text-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
   <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto pushmenu ">
         <a class="hamburger sidebar-toggle" data-widget="pushmenu" href="#" role="button">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
            <span class="minimize">Minimize</span>
         </a>
      </ul>
      <ul class="navbar-nav ml-auto">
         <li class="nav-item">
            <!-- <a class="nav-link btn btn-sm btn-primary text-light" data-toggle="modal" data-original-title="test" data-target="#addFaker">Add faker</a> -->
         </li>
         <h4>Victory Loves Preparation</h4>  
      </ul>
      <ul class="navbar-nav ml-auto">
         <?php if(!isset($_SESSION['connectFaker'])){ ?>
            <li class="nav-item">
               <a class="nav-link btn btn-sm btn-primary text-light" data-toggle="modal" data-original-title="test" data-target="#fakerConnection">Faker Connection</a>
            </li>
         <?php } ?>

         <?php if (!isset($_SESSION['dbName'])) { ?>
            <li class="nav-item">
               <a class="nav-link btn btn-sm btn-danger text-light" data-toggle="modal" data-original-title="test" data-target="#dbConnection">Database Connection</a>
            </li>
         <?php }else{ ?>
            <li class="nav-item">
               <a class="nav-link btn btn-sm btn-info text-light" href="includes/logout.php">Logout Database</a>
            </li>
         <?php } ?>
      </ul>
   </div>
</nav>
