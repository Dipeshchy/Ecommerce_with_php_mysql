
<?php 


require_once("../resources/config.php");



 ?>
<?php 

include("../resources/templates/front/header.php");


 ?>

 
    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p><a class="btn btn-primary btn-large">Call to action!</a>
            </p>
        </header>

        <hr>

<?php 

$query=query("SELECT * FROM ecommerce.products WHERE product_category_id=" . escape_string($_GET['id']). " ");
    confirm($query);

    while($row=fetch_array($query))
    {

 ?>
        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Latest Features</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3><?php echo $row['product_title']; ?></h3>
                        <p><?php echo $row['product_description']; ?></p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>


           

        </div>
        <!-- /.row -->

        <hr>
<?php 

}
 ?>
        <!-- Footer -->
       <?php 

    include("../resources/templates/front/footer.php");

     ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
