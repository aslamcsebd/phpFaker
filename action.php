 <?php
 // row delete
   session_start();

   if (isset($_SESSION['dbName']) && isset($_SESSION['tableName'])){
      $conn = mysqli_connect($_SESSION['localhost'], $_SESSION['userName'], $_SESSION['password'], $_SESSION['dbName']);
      $tableName = $_SESSION['tableName'];
   }
   
   // Single row delete
   if (isset($_GET['id'])){
      $id = $_GET['id'];
      $sql = "delete from $tableName where id='$id'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
         $_SESSION['alertSuccess'] = 'Single row delete successfully';
      }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   // All row delete
   if (isset($_GET['allRow'])){
      $sql = "DELETE FROM $tableName";
      $result = mysqli_query($conn, $sql);
      if ($result) {
         $_SESSION['alertSuccess'] = 'All row delete successfully';
      }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   // Column delete
   if (isset($_GET['columnName'])){
      $columnName = $_GET['columnName'];
      $tab = $_GET['tab'];
      $sql = "ALTER TABLE $tableName DROP $columnName";
      $result = mysqli_query($conn, $sql);
      if ($result){
         $_SESSION['alertSuccess'] ="'".$columnName."'".' column delete successfully';
      }else{
         $_SESSION['alertFail'] = "'".$columnName."'".' column delete fail';
      }
      header('Location: ' . $_SERVER['HTTP_REFERER']."?tab=".$tab);
   }

   // Column create
   if (isset($_POST['addColumn'])){
      $columnName = $_POST['column'];
      $type = $_POST['type'];
      $null = $_POST['null'];
      $sql = "ALTER TABLE $tableName add $columnName $type $null";
      $result = mysqli_query($conn,$sql);
      
      if($result){
         $_SESSION['alertSuccess'] = "'".$columnName."'"." column create successfully";
      }else{
         $_SESSION['alertFail'] = "'".$columnName."'".' column create fail';
      }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   // Add faker data
   if(isset($_POST['addData'])){
      require_once 'vendor/autoload.php';
      $faker = Faker\Factory::create();

      $addNumber = $_POST['addNumber'];
      $fields = $_POST['fields'];
      $fakerNames = $_POST['fakers'];

      $array = [];
      $serial = 0;
      
      foreach ($fields as $field) {
         $array[$serial] = $field;
         $serial = $serial + 1;
      }      
      $field = "(".implode(', ', $array).")";

      $loop = 1;
      foreach (range(1, $addNumber) as $value){

         $array = [];
         $serial = 0;
         
         foreach ($fakerNames as $fakerName) {
            if ($fakerName=='null') {
               $array[$serial] = $fakerName;
               $serial = $serial + 1;
            }else{
               $array[$serial] = '"'.$faker->$fakerName.'"';
               $serial = $serial + 1;
            }
         }
      
         $fakerName = "(".implode(', ', $array) .")";

         $sql ="insert into admin $field values $fakerName";         
         $result= mysqli_query($conn, $sql);         
         if ($result){
            $_SESSION['alertSuccess'] = "Total ".$loop. " row insert successfully";
         }
         $loop++;
      }
      // $sql = "ALTER TABLE users add $columnName VARCHAR (255) NOT NULL";
      // mysqli_query($conn,$sql);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   // Add faker category
   if (isset($_POST['addFakerCategory'])){
      $conn =mysqli_connect('localhost', 'root', '', 'php_faker');
      $name = $_POST['fakerCategory'];
      $sql = "select * from faker_category where name='$name'";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
      if ($count>0) {
         $_SESSION['alertFail'] = "This category already exists";
      }else{
         $sql2 = "insert into faker_category values (null, '$name', '1')";
         mysqli_query($conn, $sql2);

         $result2 = mysqli_query($conn, $sql);
         $count2 = mysqli_num_rows($result2);
         if($count2>0) {
            $_SESSION['alertSuccess'] = "Category add successfully";
         }  
      }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   // Add faker
   if (isset($_POST['addFaker'])){
      $conn =mysqli_connect('localhost', 'root', '', 'php_faker');

      $categoryId = $_POST['categoryId'];
      $fakerName = $_POST['fakerName'];

      $sql = "select * from faker_type where name='$fakerName'";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
      if ($count>0) {
         $_SESSION['alertFail'] = "This faker title already exists";
      }else{
         $sql2 = "insert into faker_type values (null, '$categoryId', '$fakerName', '1')";
         mysqli_query($conn, $sql2);

         $result2 = mysqli_query($conn, $sql);
         $count2 = mysqli_num_rows($result2);
         if($count2>0) {
            $_SESSION['alertSuccess'] = "Faker title add successfully";
         }  
      }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   //Facker category status change
   if (isset($_GET['categoryId'])){
      $conn =mysqli_connect('localhost', 'root', '', 'php_faker');      
      $id = $_GET['categoryId'];
      ($_GET['status']==0 ? $status = 1 : $status = 0);
      $sql = "update faker_category set status='$status' where id='$id'";
      mysqli_query($conn, $sql);
      ($status==0 ? $status = 'inactive' : $status = 'active');
      $_SESSION['alertSuccess'] = "Faker category ".$status. " now";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   //Facker title status change
   if (isset($_GET['fakerId'])){
      $conn =mysqli_connect('localhost', 'root', '', 'php_faker');
      $id = $_GET['fakerId'];
      ($_GET['status']==0 ? $status = 1 : $status = 0);
      $sql = "update faker_type set status='$status' where id='$id'";
      mysqli_query($conn, $sql);
      ($status==0 ? $status = 'inactive' : $status = 'active');
      $_SESSION['alertSuccess'] = "Faker title ".$status. " now";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   //Facker title delete
   if (isset($_GET['fakerDeleteId'])){
      $conn =mysqli_connect('localhost', 'root', '', 'php_faker');
      $id = $_GET['fakerDeleteId'];
      $sql = "delete from faker_type where id='$id'";      
      mysqli_query($conn, $sql);
      $_SESSION['alertSuccess'] = "Faker title delete successfully";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }
