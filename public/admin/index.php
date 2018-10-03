<?php 
    require_once('../../resources/config.php');

 ?>

 <?php 

 include("../../resources/templates/back/header.php");
  ?>

  <?php 

if(!isset($_SESSION['username']))
{
    redirect("../../public");
}

   ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                 <!-- FIRST ROW WITH PANELS -->

                <!-- /.row -->
                         <?php 
                         if($_SERVER['REQUEST_URI'] == '/ecommerce/public/admin/' || $_SERVER['REQUEST_URI'] =='/ecommerce/public/admin/index.php')
                         {
                             include("../../resources/templates/back/admin_content.php");
                         }



  ?>
      <?php 
                         if(isset($_GET['orders']))
                         {
                             include("../../resources/templates/back/orders.php");
                         }
                         
                         
                         


  ?>
     <?php 
                         if(isset($_GET['products']))
                         {
                             include("../../resources/templates/back/products.php");
                         }
                         
                         
                         


  ?>
     <?php 
                         if(isset($_GET['add_product']))
                         {
                             include("../../resources/templates/back/add_product.php");
                         }
                         
                         
                         


  ?>
     <?php 
                         if(isset($_GET['categories']))
                         {
                             include("../../resources/templates/back/categories.php");
                         }
                         
                         
                         


  ?>
     <?php 
                         if(isset($_GET['users']))
                         {
                             include("../../resources/templates/back/users.php");
                         }
                         
                         
                         


  ?>
            </div>
            <!-- /.container-fluid -->
  
  

        </div>
        <!-- /#page-wrapper -->
 <?php 

 include("../../resources/templates/back/footer.php");
  ?>
