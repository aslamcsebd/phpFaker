<?php
   if(isset($_POST['dbConn'])){
      $localhost = $_POST['serverName'];   
      $userName = $_POST['userName'];
      $password = $_POST['password'];
      $dbName = $_POST['dbName'];
      
      $conn = mysqli_connect($localhost, $userName, $password, $dbName);
      
      if ($conn){
         $_SESSION['localhost'] = $localhost;
         $_SESSION['userName'] = $userName;
         $_SESSION['password'] = $password;
         $_SESSION['dbName'] = $dbName;

         $_SESSION['alertSuccess'] = 'Database connection successfully';
      }else{
         $_SESSION['alertFail'] = 'Database connection fail';
      }
      header("Location: index.php");
   }

   if (isset($_SESSION['dbName'])){
      $conn = mysqli_connect($_SESSION['localhost'], $_SESSION['userName'], $_SESSION['password'], $_SESSION['dbName']);
      $dbName = $_SESSION['dbName'];
      $sql = "SHOW TABLES FROM $dbName";
      $result = mysqli_query($conn, $sql);
   }

   if(isset($_POST['tableName'])){
      $_SESSION['tableName'] = $_POST['tableName'];
   }
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <?php if (isset($_SESSION['dbName'])){ ?>
      <div class="sidebar">
         <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
               <li class="nav-item menu-open">
                  <a href="#" class="nav-link active">
                     <i class="nav-icon fas fa-database"></i>
                     <p>
                        <i class="right fas fa-angle-left"></i>
                        DB : <?=$_SESSION['dbName']?>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <?php 
                     while($table = mysqli_fetch_array($result)){  ?>
                        <li class="nav-item">   
                           <form action="" method="post">
                              <a href="javascript:;" class="nav-link" onclick="this.parentNode.submit();"><?= $table[0]; ?></a>
                              <input type="hidden" name="tableName" value="<?= $table[0]; ?>"/>
                           </form>
                        </li>
                     <?php } ?>
                  </ul>
               </li>
            </ul>
         </nav>
      </div>
   <?php } ?>
</aside>
