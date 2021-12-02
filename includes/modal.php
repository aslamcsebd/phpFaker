<?php if(isset($_SESSION['connectFaker'])){ ?>
   <div class="modal fade" id="addFaker" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header py-2">
               <h5 class="modal-title text-center" id="exampleModalLabel">Add faker</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
               <fieldset>
                  <legend>Faker category</legend>
                  <form action="action.php" method="post" class="needs-validation">
                     <div class="form justify-content-center">
                        <div class="orm-group row">
                           <label for="fakerCategory" class="col-4 pt-1">Faker category :</label>
                           <input type="text" class="form-control col-5 ml-2 mr-1" id="fakerCategory" name="fakerCategory" placeholder=" Datelist, Payment..." required>
                           <button type="submit" class="btn btn-sm btn-primary col-2 ml-4" name="addFakerCategory">Add now</button>
                        </div>
                     </div>
                  </form>
               </fieldset>
               <fieldset>
                  <legend>Faker title</legend>
                  <form action="action.php" method="post" class="needs-validation">
                     <div class="form justify-content-center">
                        <div class="form-group row">
                           <select name="categoryId" class="form-control col-4 pt-1" required>
                              <option value="">Faker category</option>      
                              <?php
                                 $conn2 = connectFaker();                          
                                 $category = "select * FROM faker_category";
                                 $result = mysqli_query($conn2, $category);
                                 while($row = mysqli_fetch_array($result)) {?>
                                    <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                 <?php } ?>
                           </select>
                           <input type="text" class="form-control col-5 ml-2 mr-1" id="fakerCategory" name="fakerName" placeholder="Name, email, password..." required>
                           <button type="submit" class="btn btn-sm btn-primary col-2 ml-4" name="addFaker">Add now</button>
                        </div>
                     </div>
                  </form>
               </fieldset>
            </div>
         </div>
      </div>
   </div>
<?php } ?>

<div class="modal fade" id="fakerConnection" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header bg-primary py-2">
            <h5 class="modal-title text-center" id="exampleModalLabel">Faker Connection</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body bg-info">            
            <form action="" method="POST">
               <div class="form row justify-content-center">
                  <div class="form-group col">
                     <label for="serverName">Server name :</label>
                     <input name="serverName" class="form-control" id="serverName" type="text" value="localhost" placeholder="" required>
                  </div>
                  <div class="form-group col">
                     <label for="userName">User Name :</label>
                     <input name="userName" class="form-control" id="userName" type="text" value="root" placeholder="" required>
                  </div>
                  <div class="form-group col">
                     <label for="password">Password :</label>
                     <input name="password" class="form-control" id="password" type="text" value="" placeholder="">
                  </div>
                  <div class="form-group col">
                     <label for="dbName">Database name :</label>
                     <input name="dbName" class="form-control" id="dbName" type="text" value="php_faker" placeholder="" required>
                  </div>
               </div>
               <div class="modal-footer pb-0">
                  <button class="btn btn-danger" type="submit" name="fakerConn">Connect Now</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="dbConnection" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header bg-primary py-2">
            <h5 class="modal-title text-center" id="exampleModalLabel">Database Connection</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body bg-info">            
            <form action="" method="POST">
               <div class="form row justify-content-center">
                  <div class="form-group col">
                     <label for="serverName">Server name :</label>
                     <input name="serverName" class="form-control" id="serverName" type="text" value="localhost" placeholder="" required>
                  </div>
                  <div class="form-group col">
                     <label for="userName">User Name :</label>
                     <input name="userName" class="form-control" id="userName" type="text" value="root" placeholder="" required>
                  </div>
                  <div class="form-group col">
                     <label for="password">Password :</label>
                     <input name="password" class="form-control" id="password" type="text" value="" placeholder="">
                  </div>
                  <div class="form-group col">
                     <label for="dbName">Database name :</label>
                     <input name="dbName" class="form-control" id="dbName" type="text" value="api" placeholder="" required>
                  </div>
               </div>
               <div class="modal-footer pb-0">
                  <button class="btn btn-danger" type="submit" name="dbConn">Connect Now</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
