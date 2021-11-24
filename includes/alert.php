
<?php if (isset($_SESSION['alertSuccess'])){ ?>
   <div class="alert alert-success text-center">
      <strong>Success! </strong>
      <?= $_SESSION['alertSuccess']; ?>
   </div>
<?php } ?>

<?php if (isset($_SESSION['alertFail'])){ ?>
   <div class="alert alert-danger text-center">
      <strong>Sorry! </strong>
      <?=$_SESSION['alertFail']; ?>
   </div>
<?php } ?>
