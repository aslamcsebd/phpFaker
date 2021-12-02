<!-- Session unset -->
<?php 
   unset($_SESSION['alertSuccess']);
   unset($_SESSION['alertFail']);
?>
<!-- jQuery -->
   <script src="assets/js/jquery.min.js"></script>
 
   <!-- Bootstrap v4.6.0 -->
   <script src="assets/js/bootstrap.bundle.min.js"></script>

   <!-- overlayScrollbars -->
   <script src="assets/js/jquery.overlayScrollbars.min.js"></script>
   
   <!-- AdminLTE App -->
   <script src="assets/js/adminlte.min.js"></script>
   
   <!-- {{-- Pushmenu --}} -->
   <script src="assets/js/custom.js"></script>

   <script src="assets/js/dataTables.min.js"></script>
   
   <script type="text/javascript">
      // if ($(window).width() > 992) {
      // $(window).scroll(function(){
      //   if ($(this).scrollTop() > 0) { //default: 40
      //      $('#navbar_top').addClass("fixed-top");
      //      // add padding top to show content behind navbar
      //      $('body').css('padding-top', $('.navbar').outerHeight() + 'px');
      //    }else{
      //      $('#navbar_top').removeClass("fixed-top");
      //       // remove padding top from body
      //      $('body').css('padding-top', '0');
      //    }   
      // });
      // } // end

      window.setTimeout(function() {
         $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
         });
      },2000);
   
      // $(document).ready(function(){
      //    $('.table').DataTable();
      // });
   </script>
