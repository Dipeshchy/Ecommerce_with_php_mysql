
<?php 


require_once("../resources/config.php");



 ?>
<?php 

include("../resources/templates/front/header.php");


 ?>

    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">
  <h3 class="text-center text-danger bg-danger"><?php 
  
display_message();

 ?></h3>
 <?php 
// if(isset($_SESSION['product_1']))
// {
// echo $_SESSION['product_1'];
//   }

  ?>
      <h1>Checkout</h1>


<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="business" value="dipeshchaudhary55@gmail.com">
   <input type="hidden" name="currency_code" value="Nepal">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
          <?php 
            cart();
           ?>
        </tbody>
    </table>
    <?php 

      if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >=1 )
      {
        $paypal_button = <<<DELIMETER
          <input type="image" name="upload"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">

DELIMETER;
    echo $paypal_button;
      }

     ?>
  
</form>




<!--  ***********CART TOTALS*************-->
            
 <div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>


<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"> <?php echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity']  : $_SESSION['item_quantity'] ="0";  ?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount"> &#x20B9;
  <?php echo isset($_SESSION['item_total']) ? $_SESSION['item_total']  : $_SESSION['item_total'] ="0";  ?> </span></strong> </td>
</tr>


</tbody>

</table>

</div>


 </div><!--Main Content


           <hr>

    <?php 

    include("../resources/templates/front/footer.php");

     ?>
