<?php 
   session_start();
   $conn2 =mysqli_connect('localhost', 'root', '', 'php_faker');
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
   <!-- <meta http-equiv="refresh" content="3"/> -->
      <?php include('includes/head.php'); ?>
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">      
      <?php 
         include('includes/header.php');
         include('includes/leftside.php');
         include('includes/alert.php');

         if(isset($_SESSION['dbName'])){
            $conn = mysqli_connect($_SESSION['localhost'], $_SESSION['userName'], $_SESSION['password'], $_SESSION['dbName']);
         }

         if (isset($_SESSION['dbName']) && isset($_SESSION['tableName'])){
            $tableName = $_SESSION['tableName'];
         }
      ?>
      
      <div class="content-wrapper">
         <div class="content-header float-right">
            <ol class="breadcrumb">
               <?php if (isset($_SESSION['dbName']) && isset($_SESSION['tableName'])) { ?>
                  <li class="breadcrumb-item"><a href="#"><?=$_SESSION['dbName'];?></a></li>
                  <li class="breadcrumb-item active pr-1"><?=$_SESSION['tableName']?></li>
               <?php } ?>
            </ol>
         </div>
      
         <div class="container-fluid">

            <header class="panel-heading panel-heading-gray custom-tab py-3 m-auto">
               <ul class="nav nav-tabs" id="tabMenu">
                  <?php if (isset($_SESSION['dbName']) && isset($_SESSION['tableName'])){ ?>
                     <li class="nav-item ml-1">
                        <a href="#tableData" data-toggle="tab" class="active p-2 bg-info text-light"><i class="fas fa-eye"></i>&nbsp; Table data</a>
                     </li>
                     <li class="nav-item mx-1">
                        <a href="#column" data-toggle="tab" class="p-2 bg-success text-light">All Column</a>
                     </li>                  
                     <li class="nav-item mx-1">
                        <a href="#addColumn" data-toggle="tab" class="p-2 bg-secondary text-light"><i class="fas fa-plus-circle"></i>&nbsp; Add column</a>
                     </li>
                     <li class="nav-item mx-1">
                        <a href="#addData" data-toggle="tab" class="p-2 bg-primary text-light"><i class="fas fa-plus-circle"></i>&nbsp; Add faker data</a>
                     </li>
                  <?php } ?>
                  <li class="nav-item mx-1">
                     <a href="#" class="p-2 bg-info text-light" data-toggle="modal" data-original-title="test" data-target="#addFaker"><i class="fas fa-plus-circle"></i>&nbsp; Add faker</a>
                  </li>     
                  <li class="nav-item mx-1">
                     <a href="#fakerList" data-toggle="tab" class="p-2 bg-secondary text-light"><i class="fas fa-list-ul"></i>&nbsp; Faker list</a>
                  </li>
               </ul>               
            </header>

            <div class="panel-body">
               <div class="tab-content">

                  <!-- tableData -->
                  <?php if(isset($_SESSION['dbName']) && isset($_SESSION['tableName'])){ ?>
                     <div class="tab-pane active" id="tableData">
                        <?php
                           // $tableName = $_SESSION['tableName'];
                           $column = "SHOW columns FROM $tableName";
                           $columnResult = mysqli_query($conn, $column);

                           $table = "select * FROM $tableName";
                           $tableResult = mysqli_query($conn, $table);
                           $count = mysqli_num_rows($tableResult);
                        ?>
                        <p class="bg-info text-center mb-2">Table Name : <?= $_SESSION['tableName']; ?></p>
                        <table id="example1" class="table table-bordered table-striped">
                           <thead>
                              <tr class="text-center">
                                 <?php
                                    while($columnName = mysqli_fetch_array($columnResult)){?>
                                       <th><?=$columnName['Field'];?></th>
                                 <?php } ?>
                                 <th class="bg-warning">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $loop=1; while($tableRow = mysqli_fetch_assoc($tableResult)){?>
                                 <tr>
                                    <?php
                                       $columnResult = mysqli_query($conn, $column);
                                       while($columnName = mysqli_fetch_array($columnResult)){?>
                                          <td><?=$tableRow[$columnName['Field']];?></td>
                                    <?php } ?>
                                    <td class="text-center">
                                       <div class="btn-group">                                          
                                          <a class="btn btn-sm btn-danger" href="action.php?id=<?=$tableRow['id']; ?>">Delete</a>
                                          <?php if ($loop=='1'){?>
                                             <a class="btn btn-sm btn-warning" href="action.php?allRow=<?=$tableRow['id']; ?>">Delete all data</a>
                                          <?php } $loop++; ?>
                                       </div>
                                    </td>
                                 <tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  <?php } ?>

                  <!-- All Column -->
                  <?php if(isset($_SESSION['tableName'])){ ?>
                     <div class="tab-pane" id="column">
                        <p class="bg-success text-center mb-2"><?= $_SESSION['tableName']; ?>'s [columns]</p>
                        <?php
                           // $tableName = $_SESSION['tableName'];
                           $column = "SHOW columns FROM $tableName";
                           $columnResult = mysqli_query($conn, $column);
                           $TotalColumn = mysqli_num_rows($columnResult);
                           $col_4 = 1;
                           $loop = 1;
                           $headFirst = 1;
                        ?>
                        <form action="action.php" method="POST">
                           <div class="row">
                              <?php while($row = mysqli_fetch_array($columnResult)){ ?>
                                 <?php if($col_4=='1'){ ?>
                                    <table id="example1" class="table table-bordered table-striped col-4 mb-0">
                                       <?php if($headFirst=='1'){?>
                                          <thead>
                                             <tr class="text-center">
                                                <th class="bg-secondary">No</th>
                                                <th>Column name</th>
                                                <th>Action</th>
                                             </tr>
                                          </thead>
                                       <?php } ?>
                                       <tbody>
                                          <tr>
                                             <td width="20%" class="bg-secondary text-center"><?= $loop; ?></td>
                                             <td width="auto"><?= $row['Field']; ?></td>
                                             <?php if($row['Field']!='id') {?>
                                                <td width="20%" class="text-center"><a class="btn btn-sm btn-danger" href="action.php?columnName=<?=$row['Field']; ?>&tab=column">Delete</a></td>
                                             <?php }else{ ?>
                                                <td width="20%" class="bg-warning text-center p-0">
                                                   Primary key can't delete
                                                </td>
                                             <?php } ?>
                                          <tr>                                           
                                       </tbody>
                                    </table>
                                 <?php }elseif($col_4=='2'){ ?>
                                    <table id="example1" class="table table-bordered table-striped col-4 mb-0">
                                       <?php if($headFirst=='2'){?>
                                          <thead>
                                             <tr class="text-center">
                                                <th class="bg-secondary">No</th>                                                
                                                <th>Column name</th>
                                                <th>Action</th>
                                             </tr>
                                          </thead>
                                       <?php } ?>
                                       <tbody>
                                          <tr>
                                             <td width="20%" class="bg-secondary text-center"><?= $loop; ?></td>
                                             <td width="auto"><?= $row['Field']; ?></td>
                                             <?php if($row['Field']!='id') {?>
                                                <td width="25%" class="text-center"><a class="btn btn-sm btn-danger" href="action.php?columnName=<?=$row['Field']; ?>&tab=column">Delete</a></td>
                                             <?php }else{ ?>
                                                <td width="25%" class="bg-warning text-center p-0">
                                                   Primary key can't delete
                                                </td>
                                             <?php } ?>
                                          <tr>
                                       </tbody>
                                    </table>
                                 <?php }else{ ?>
                                    <table id="example1" class="table table-bordered table-striped col-4 mb-0">
                                       <?php if($headFirst=='3'){?>
                                          <thead>
                                             <tr class="text-center">
                                                <th class="bg-secondary">No</th>                                                
                                                <th>Column name</th>
                                                <th>Action</th>
                                             </tr>
                                          </thead>
                                       <?php } ?>
                                       <tbody>
                                          <tr>
                                             <td width="20%" class="bg-secondary text-center"><?= $loop; ?></td>                                            
                                             <td width="auto"><?= $row['Field']; ?></td>
                                             <?php if($row['Field']!='id') {?>
                                                <td width="20%" class="text-center"><a class="btn btn-sm btn-danger" href="action.php?columnName=<?=$row['Field']; ?>&tab=column">Delete</a></td>
                                             <?php }else{ ?>
                                                <td width="20%" class="bg-warning text-center p-0">
                                                   Primary key can't delete
                                                </td>
                                             <?php } ?>
                                          <tr>
                                       </tbody>
                                    </table>
                                 <?php } ?>
                              <?php (($col_4=='1'||'2') ?  $col_4++ : $col_4='1' ); $loop++; $headFirst++; } ?>              
                           </div>
                        </form>
                     </div>
                  <?php } ?>

                  <!-- Add column -->
                  <?php if(isset($_SESSION['tableName'])){ ?>
                     <div class="tab-pane" id="addColumn">
                        <p class="bg-secondary text-center">Table Name : <?= $_SESSION['tableName']; ?></p>
                        <div class="row justify-content-center">
                           <div class="col-10">
                              <fieldset>
                                 <legend>Add Column</legend>
                                 <form action="action.php" method="POST">
                                    <div class="row justify-content-center">
                                       <label for="column" class="col-2 pt-2 pl-0">Column name :</label>
                                       <input type="text" id="column" class="form-control col-3 mx-1" name="column" placeholder="name, age, date etc" required>
                                       <select class="form-control col-2 pt-1 mx-1" name="type" required>
                                          <option value="">Data type</option>      
                                          <?php
                                             $category = "select * FROM data_type";
                                             $result = mysqli_query($conn, $category);
                                             while($row = mysqli_fetch_array($result)) {?>
                                                <option value="<?=$row['value'];?>"><?=$row['type'];?></option>
                                             <?php } ?>
                                       </select>
                                       <select name="null" class="form-control col-2 pt-1 mx-1" required>
                                          <option value="not null" selected>not null</option>  
                                          <option value="null">null</option>  
                                          <option value="NOT NULL AUTO_INCREMENT">AUTO_INCREMENT</option>  
                                       </select> 
                                       <button type="submit" class="btn btn-primary col-2 mx-1 py-1" name="addColumn">Add Now</button>
                                    </div>
                                 </form>
                              </fieldset>
                           </div>
                        </div>
                     </div>
                  <?php } ?>

                  <!-- Add faker data -->
                  <?php if(isset($_SESSION['tableName'])){ ?>
                     <div class="tab-pane" id="addData">
                        <p class="bg-primary text-center mb-2">Table Name : <?= $_SESSION['tableName']; ?></p>
                        <?php
                           require_once 'vendor/autoload.php';
                           $faker2 = Faker\Factory::create();
                           
                           $column = "SHOW columns FROM $tableName";
                           $columnResult = mysqli_query($conn, $column);
                           $TotalColumn = mysqli_num_rows($columnResult);
                           $loop = 1;
                           $headFirst = 1;

                           $categorySql = "select * from faker_category where status='1'";
                        ?>
                        <form action="action.php" method="POST">
                           <div class="row m-1">
                              <?php while($row = mysqli_fetch_array($columnResult)){ ?>
                                 <?php if($loop%2 !=0) {?>
                                    <table id="example1" class="table table-bordered table-striped col-6 mb-0">
                                       <?php if($headFirst=='1'){?>
                                          <thead>
                                             <tr class="text-center">
                                                <th class="bg-secondary">No</th> 
                                                <th>Column name</th>
                                                <th>Faker Type</th>
                                             </tr>
                                          </thead>
                                       <?php } ?>
                                       <tbody>
                                          <tr>
                                             <td width="10%" class="bg-secondary text-center"><?= $loop; ?></td>
                                             <td width="auto"><?= $row['Field']; ?></td>
                                             <td width="50%">
                                                <input type="hidden" name="fields[]" value="<?=$row['Field'];?>">
                                                <?php if($row['Field']=='id'){?>
                                                   <select name="fakers[]" class="form-control">
                                                      <option value="null">&nbsp; &nbsp; null</option>
                                                   </select>                                           
                                                <?php }else{ ?>
                                                   <select name="fakers[]" class="form-control" required>
                                                      <option value="">Select faker type</option>      
                                                      <?php 
                                                         $categoryName = mysqli_query($conn2, $categorySql);
                                                         while($category = mysqli_fetch_array($categoryName)) {?>
                                                            <option disabled class="bg-info" title="Category name"><?=$category['name'];?></option>
                                                            <?php
                                                               $categoryId = $category['id'];
                                                               $fakerSql = "select * from faker_type where category_id='$categoryId' and status='1'";
                                                               $fakerName = mysqli_query($conn2, $fakerSql);
                                                               while($fakerType = mysqli_fetch_assoc($fakerName)) {?>      
                                                                  <!-- <option value="<?="$"."faker->".$fakerType['name'];?>" -->
                                                                  <option value="<?=$fakerType['name'];?>"
                                                                     <?=($fakerType['name']==$row['Field']) ? 'selected' : ''?> title="<?php $type=$fakerType['name']; echo $faker2->$type; ?>">
                                                                     &nbsp; &nbsp; <?=$fakerType['name'];?>
                                                                  </option>
                                                               <?php } ?>
                                                         <?php } ?>
                                                   </select>                                           
                                                <?php } ?>
                                             </td>
                                          <tr>                                             
                                       </tbody>
                                    </table>
                                 <?php }else{ ?>
                                    <table id="example1" class="table table-bordered table-striped col-6 mb-0">
                                       <?php if($headFirst=='2'){?>
                                          <thead>
                                             <tr class="text-center">
                                                <th class="bg-secondary">No</th>
                                                <th>Column name</th>
                                                <th>Faker Type</th>
                                             </tr>
                                          </thead>
                                       <?php } ?>
                                       <tbody>
                                          <tr>
                                             <td width="10%" class="bg-secondary text-center"><?= $loop; ?></td>
                                             <td width="auto"><?= $row['Field']; ?></td>
                                             <td width="50%">
                                                <input type="hidden" name="fields[]" value="<?= $row['Field']; ?>">
                                                <select name="fakers[]" class="form-control" required>
                                                      <option value="">Select faker type</option>      
                                                      <?php 
                                                         $categoryName = mysqli_query($conn2, $categorySql);
                                                         while($category = mysqli_fetch_array($categoryName)) {?>
                                                            <option disabled class="bg-info" title="Category name"><?=$category['name'];?></option>
                                                            <?php
                                                               $categoryId = $category['id'];
                                                               $fakerSql = "select * from faker_type where category_id='$categoryId' and status='1'";
                                                               $fakerName = mysqli_query($conn2, $fakerSql);
                                                               while($fakerType = mysqli_fetch_assoc($fakerName)) {?>
                                                                  <!-- <option value="<?="$"."faker->".$fakerType['name'];?>" -->
                                                                  <option value="<?=$fakerType['name'];?>"
                                                                     <?=($fakerType['name']==$row['Field']) ? 'selected' : ''?> title="<?php $type=$fakerType['name']; echo $faker2->$type; ?>">
                                                                     &nbsp; &nbsp; <?=$fakerType['name'];?>
                                                                  </option>
                                                               <?php } ?>
                                                         <?php } ?>
                                                   </select>     
                                             </td>
                                          <tr>
                                       </tbody>
                                    </table>
                                 <?php } ?>
                              <?php $loop++; $headFirst++; } ?>              
                           </div>
                           <div class="row">
                              <div class="col-sm-3 ml-1">
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <div class="input-group-text">Total row insert</div>
                                    </div>
                                    <input type="text" class="form-control" name="addNumber" value="10" placeholder="Enter Number">
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <button type="submit" class="btn btn-primary" name="addData">Add now</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  <?php } ?>
                  
                  <!-- Faker list -->
                  <div class="tab-pane mt-2" id="fakerList">
                     <?php 
                        require_once 'vendor/autoload.php';
                        $faker = Faker\Factory::create();

                        $sql = "select * from faker_category";
                        $fakerCategory = mysqli_query($conn2, $sql);
                        $fakerCategoryCount = mysqli_num_rows($fakerCategory);

                        $sql2 = "select * from faker_type";
                        $fakerType2 = mysqli_query($conn2, $sql2);
                        $fakerTypeCount = mysqli_num_rows($fakerType2);

                     ?>
                     <fieldset id="accordion" class="p-1">
                        <legend class="bg-secondary">All Faker category & type [<?=$fakerCategoryCount;?>][<?=$fakerTypeCount;?>]</legend>
                        <div class="row">
                           <div class="col">
                              <table id="table" class="table table-bordered">
                                 <thead class="text-center table-striped" style="display:none;">
                                    <tr>
                                       <th>All Category</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr >
                                       <td>
                                          <?php while($row = mysqli_fetch_array($fakerCategory)){ ?>
                                             <?php
                                                $category_id = $row['id'];
                                                $sql2 = "select faker_type.id, faker_type.name, faker_type.status
                                                   from faker_type inner join faker_category
                                                   on faker_type.category_id = faker_category.id where faker_category.status='1' and faker_type.category_id='$category_id'";
                                                $faker_type = mysqli_query($conn2, $sql2);

                                                // Total faker type
                                                $sql3 = "select * from faker_type where category_id='$category_id'";
                                                $totalFaker2 = mysqli_query($conn2, $sql3);
                                                $totalFaker = mysqli_num_rows($totalFaker2);
                                             ?>
                                             <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingTwo">
                                                   <h6 class="panel-title row">
                                                      <a class="collapsed col-10" role="button" class="text-danger" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$row['id'];?>" aria-expanded="false" aria-controls="collapse<?=$row['id'];?>"><?=$row['name'];?></a>                                      
                                                      <div class="btn-group col row" role="group" aria-label="Basic example">
                                                         <?php if($row['status']==true){ ?>
                                                            <a class="btn btn-sm btn-primary p-1 col-6" href="action.php?categoryId=<?=$row['id'];?>&status=<?=$row['status'];?>" title="Click for inactive">Active</a>      
                                                         <?php }else{ ?>                                                                        
                                                            <a class="btn btn-sm btn-secondary p-1 col-6" href="action.php?categoryId=<?=$row['id'];?>&status=<?=$row['status'];?>" title="Click for active">Inactive</a>      
                                                         <?php } ?>                                                   
                                                         <span class="col-6 pt-2">Total : <?= ($totalFaker <10) ? '0'.$totalFaker : $totalFaker;?></span>
                                                         <!-- ($totalFaker!=0 && $totalFaker <10) -->
                                                      </div>
                                                   </h6>
                                                </div>

                                                <div id="collapse<?=$row['id'];?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                   <div class="panel-body row">
                                                      <div class="col">
                                                         <div class="tab-pane active">
                                                           <?php
                                                               $loop = 1;
                                                               $headFirst = 1;
                                                            ?>
                                                            <div class="row my-1 mx-0">
                                                               <?php while($row2 = mysqli_fetch_array($faker_type)){ ?>
                                                                  <?php if($loop%2 !=0) {?>
                                                                     <table id="example1" class="table table2 table-bordered table-striped col-6 mb-0">
                                                                        <?php if($headFirst=='1'){?>
                                                                           <thead>
                                                                              <tr class="text-center">
                                                                                 <th>Faker_Type</th>
                                                                                 <th>Output</th>
                                                                                 <th>Action</th>
                                                                              </tr>
                                                                           </thead>
                                                                        <?php } ?>
                                                                        <tbody>
                                                                           <tr>
                                                                              <td width="30%"><?= $title = $row2['name']; ?></td>
                                                                              <td width="auto"><?= $faker->$title;?></td>
                                                                              <td width="5%" class="p-0">
                                                                                 <div class="btn-group p-1" role="group" aria-label="Basic example">
                                                                                    <?php if($row2['status']==true){ ?>
                                                                                       <a class="btn btn-sm btn-primary" href="action.php?fakerId=<?=$row2['id']; ?>&status=<?=$row2['status'];?>">Active</a>      
                                                                                    <?php }else{ ?>                                                       
                                                                                       <a class="btn btn-sm btn-secondary" href="action.php?fakerId=<?=$row2['id']; ?>&status=<?=$row2['status'];?>">Inactive</a>      
                                                                                    <?php } ?>
                                                                                    <a class="btn btn-sm btn-danger" href="action.php?fakerDeleteId=<?=$row2['id']; ?>" onclick="return confirm('Are you want to delete this?')">Delete</a>
                                                                                 </div> 
                                                                              </td>
                                                                           <tr>                                             
                                                                        </tbody>
                                                                     </table>
                                                                  <?php }else{ ?>
                                                                     <table id="example1" class="table table2 table-bordered table-striped col-6 mb-0" id="table2">
                                                                        <?php if($headFirst=='2'){?>
                                                                           <thead>
                                                                              <tr class="text-center">
                                                                                 <th>Faker_Type</th>
                                                                                 <th>Output</th>
                                                                                 <th>Action</th>
                                                                              </tr>
                                                                           </thead>
                                                                        <?php } ?>
                                                                        <tbody>
                                                                           <tr>
                                                                              <td width="30%"><?= $title = $row2['name']; ?></td>
                                                                              <td width="auto"><?= $faker->$title;?></td>
                                                                              <td width="5%" class="p-0">
                                                                                 <div class="btn-group p-1" role="group" aria-label="Basic example">
                                                                                    <?php if($row2['status']==true){ ?>
                                                                                       <a class="btn btn-sm btn-primary" href="action.php?fakerId=<?=$row2['id']; ?>&status=<?=$row2['status'];?>">Active</a>      
                                                                                    <?php }else{ ?>                                                     
                                                                                       <a class="btn btn-sm btn-secondary" href="action.php?fakerId=<?=$row2['id']; ?>&status=<?=$row2['status'];?>">Inactive</a>      
                                                                                    <?php } ?>
                                                                                    <a class="btn btn-sm btn-danger" href="action.php?fakerDeleteId=<?=$row2['id']; ?>" onclick="return confirm('Are you want to delete this?')">Delete</a>
                                                                                 </div> 
                                                                              </td>
                                                                           <tr>                                             
                                                                        </tbody>
                                                                     </table>
                                                                  <?php } ?>
                                                               <?php $loop++; $headFirst++; } ?>              
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          <?php } ?>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </fieldset>
                  </div>

               </div>
            </div>
         </div>
      </div>

      <?php include('includes/modal.php'); ?>
      <?php include('includes/footer.php'); ?>
   </body>
</html>
