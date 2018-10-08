<!-- <?php 

include('location: ../../functions.php');

 ?> -->

 <?php 

add_products();

  ?>


<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Add Product

</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control">
       
    </div>


    <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60">
      </div>
    </div>




    
    

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>
          <!-- <hr> -->
        <select name="product_category" id="" class="form-control">

           <?php
            $query="SELECT * FROM ecommerce.categories";
            $select_categories=mysqli_query($connection,$query);
            // confirm($select_categories);
                 while($row=mysqli_fetch_assoc($select_categories))
                {
                    
                 $cat_id = $row['cat_id'];
                  $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
                 }
            ?>
           <!--  <option value="">Select Category</option> -->
           
        </select>


</div>
 
     <div class="form-group">
       <label for="product-quantity">Product Quantity</label>
       <input type="number" name="product_quantity" class="form-control">
       
    </div>





    <!-- Product Brands-->


   <!--  <div class="form-group">
      <label for="product-title">Product Brand</label>
         <select name="product_brand" id="" class="form-control">
            <option value="">Select Brand</option>
         </select>
    </div> -->


<!-- Product Tags -->


    <div class="form-group">
          <label for="product-title">Product Short Description</label>
          <!-- <hr> -->
        <input type="text" name="product_short_desc" class="form-control" size="30">
    </div>

    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file">
      
    </div>

 <div class="form-group">
        
        <input type="submit" class="btn btn-primary" name="add_product" value="Add Product">
    </div>

</aside><!--SIDEBAR-->


    
</form>



                



            </div>
            <!-- /.container-fluid -->


   <?php 


include("../../resources/templates/back/footer.php");
    ?>