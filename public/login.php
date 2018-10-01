
<?php 


require_once("../resources/config.php");



 ?>
<?php 

include("../resources/templates/front/header.php");


 ?>
 <?php 

    user_login();
  ?>

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Login</h1>
            <h3 class="text-center text-danger"> <?php 

    display_message();
  ?>
</h3>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="form-group"><label for="">
                    username<input type="text" name="username" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" >
                </div>
            </form>
        </div>  


    </header>


        </div>

    </div>
    <!-- /.container -->

    

       

        <!-- Footer -->
        
    <?php 

    include("../resources/templates/front/footer.php");

     ?>

    
    <!-- /.container -->

    <!-- jQuery -->
    