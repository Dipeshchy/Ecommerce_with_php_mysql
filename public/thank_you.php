
<?php 


require_once("../resources/config.php");

require_once('cart.php');

 ?>
<?php 

include("../resources/templates/front/header.php");


 ?>
 <?php 

 if(isset($_GET['tx']))
 {
  $amount =$_GET['amt'];
  $currency = $_GET['cc'];
   $transaction =$_GET['tx'];
  $status= $_GET['sts'];


$query = query("INSERT INTO ecommerce.orders(order_amount, order_transaction , order_status , order_currency) VALUES('{$amount}' , '{$transaction}' , '{$status}' , '{$currency}') ");

confirm($query);

report();

// session_destroy();

 }
 else
 {
  redirect("index.php");
 }
  ?>

    <!-- Page Content -->
    <div class="container">


        <h1 class="text-center">Thank You</h1>


 </div><!--Main Content -->

<?php 

report();
 ?>
           

    <?php 

    include("../resources/templates/front/footer.php");

     ?>
