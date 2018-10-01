<?php 
// helper functions


function set_message($msg)
{
	if(!empty($msg))
	{
		$_SESSION['message'] = $msg;

	}
	else
	{
		$msg= "";
	}
}

function display_message()
{
	if(isset($_SESSION['message']))
	{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

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
					    <p><?php echo substr($row['product_description'],0,50); ?> <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
					    <a class="btn btn-primary" target="_blank" href="cart.php?add=<?php echo $row['product_id']; ?>">Add to cart</a>
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

			set_message("Wrong username or password");
			 // redirect("login.php");
			
		}
		else
		{
			redirect("admin");
		}
	}
}	

function send_message()
{
	if(isset($_POST['submit']))
	{
		$to = "chaudharydipesh627@gmail.com";
		$from_name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		$header = "FROM: {$from_name} {$email}";
		$result = mail($to, $subject, $message, $header);

		if(!$result)
		{
			echo "ERROR";
		}
		else
		{
			echo "SENT";
		}
	}
}



 ?>
