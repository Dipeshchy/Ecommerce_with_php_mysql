
<?php 


require_once("../resources/config.php");



 ?>
<?php 

include("../resources/templates/front/header.php");


 ?>
 <?php 

    user_register();
  ?>

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Register</h1>
            <h3 class="text-center text-danger"> <?php 

    display_message();
  ?>
</h3>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="form-group"><label for="">
                    username<input type="text" name="username" class="form-control"></label>
                </div>
                <div class="form-group"><label for="">
                    Firstname<input type="text" name="user_firstname" class="form-control"></label>
                </div>
                <div class="form-group"><label for="">
                    Lastrname<input type="text" name="user_lastname" class="form-control"></label>
                </div>
                <div class="form-group"><label for="">
                    Email<input type="email" name="user_email" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="">
                    Contact Number<input type="number" name="user_contact_number" class="form-control"></label>
                </div>
                <div class="form-group"><label for="">
                    Password<input type="password" name="password" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Reenter-Password<input type="password" name="repassword" class="form-control"></label>
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
    