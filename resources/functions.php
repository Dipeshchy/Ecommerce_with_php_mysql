<?php 
// helper functions
function redirect($location)
{
	header("Location: $location");
}

function query($sql)
{
	global $connection;
	return mysqli_query($connection,$sql);
}

function confirm($result)
{
	global $connection;

	if(!$result)
	{
		return die("Error".mysqli_error($connection));
	}
}

function escape_string($string)
{
	global $connection;

	return mysqli_real_escape_string($connection , $string);
}

function fetch_array($result)
{
	return mysqli_fetch_array($result);
}
/************ FRONT END FUNCTION *************/

// get products

function get_products()
{
	$query=query("SELECT * FROM products");
	confirm($query);

	while($row=fetch_array($query))
	{
		
		?>

		<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="thumbnail">
			<a href="item.php?id=<?php echo $row['product_id']; ?>"> <img src="../public/images/images.jpg" alt="" height="5px" width="5px"></a>
					<div class="caption">
					    <h4 class="pull-right">&#x20B9;<?php echo $row['product_price']; ?></h4>
					    <h4><a href="item.php?id=<?php echo $row['product_id']; ?>"><?php echo $row['product_title']; ?></a>
					    </h4>
					    <p><?php echo $row['product_description']; ?> <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
					    <a class="btn btn-primary" target="_blank" href="item.php?id=<?php echo $row['product_id']; ?>">Add to cart</a>
					</div>
			</div>
		</div>

	<?php	
	}

}

function get_categories()
{
	$query = query("SELECT * FROM categories");
	confirm($query);

while($row=fetch_array($query))
{
	$categories_link = <<<DELIMETER
	<a href='category.php?id={$row["cat_id"]}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;
	echo $categories_link;
}
}

function user_login()
{
	if(isset($_POST['submit']))
	{
		$username = escape_string($_POST['username']);
		$password = escape_string($_POST['password']);

		$query= query("SELECT * FROM users WHERE username = '{$username}' AND password= '{$password}' ");
		confirm($query);

		if(mysqli_num_rows($query) == 0)
		{
			redirect("login.php");
		}
		else
		{
			redirect("admin");
		}
	}
}	





 ?>
