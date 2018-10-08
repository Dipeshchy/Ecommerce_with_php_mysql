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


// *******************CREATING TABLE **********/

function creating_products_table()
{
	
	$query = query("CREATE TABLE IF NOT EXISTS ecommerce.products (
	product_id int AUTO_INCREMENT PRIMARY KEY,
	product_title varchar(255),
	product_category_id int(11),
	product_price int(11),
	product_quantity int(11),
	product_description text,
	short_desc text,
	product_image text
	
	)");
confirm($query);

}


function creating_categories_table()
{
	$query= query("CREATE TABLE IF NOT EXISTS ecommerce.categories (
	cat_id int AUTO_INCREMENT PRIMARY KEY,
	cat_title varchar(255)
	)");
	confirm($query);

}

function creating_order_table()
{
	$query = query("CREATE TABLE IF NOT EXISTS ecommerce.orders (
	order_id int AUTO_INCREMENT PRIMARY KEY,
	order_amount float,
	order_transaction varchar(255),
	order_status varchar(255),
	
	order_currency varchar(255)
	)");
	confirm($query);
}

function creating_report_table()
{
	$query = query("CREATE TABLE IF NOT EXISTS ecommerce.reports (
	report_id int(11) AUTO_INCREMENT PRIMARY KEY,
	product_id int,
	product_price float,
	product_quantity int(11)
	)");
	confirm($query);
}


function creating_users_table()
{
	$query = query("CREATE TABLE IF NOT EXISTS ecommerce.users (
	user_id int(11) AUTO_INCREMENT PRIMARY KEY,
	username varchar(255),
	user_firstname varchar(255),
	user_lastname varchar(255),
	user_email varchar(255),
	user_contact_number int(10),
	
	password varchar(255)
	)");
	confirm($query);
}

/************ FRONT END FUNCTION *************/

// get products

function get_products()
{
	$query=query("SELECT * FROM ecommerce.products");
	confirm($query);

	while($row=fetch_array($query))
	{
		
		?>

		<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="thumbnail">
			<a href="item.php?id=<?php echo $row['product_id']; ?>"> <img src="<?php echo $row['product_image']; ?>" alt="" height="5px" width="5px"></a>
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
	$query = query("SELECT * FROM ecommerce.categories");
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

		$query= query("SELECT * FROM ecommerce.users WHERE username = '{$username}' AND password= '{$password}' ");
		confirm($query);

		if(mysqli_num_rows($query) == 0)
		
		{

			set_message("Wrong username or password");
			 // redirect("login.php");
			
		}
		else
		{
			$_SESSION['username'] = $username;
			redirect("admin");
		}
	}
}

function user_register()
{
	if(isset($_POST['submit']))
	{
		$username = escape_string($_POST['username']);
		$user_firstname = escape_string($_POST['user_firstname']);
		$user_lastname = escape_string($_POST['user_lastname']);
		$user_email = escape_string($_POST['user_email']);
		$user_contact_number = escape_string($_POST['user_contact_number']);
		$password = escape_string($_POST['password']);
		$repassword = escape_string($_POST['repassword']);

		if($password != $repassword)
		{
			set_message("Passwords didn't match");
		}
		else
		{



		$query= query("INSERT INTO ecommerce.users(username , user_firstname , user_lastname , user_email , user_contact_number , password) VALUES('{$username}' , '{$user_firstname}' , '{$user_lastname}' , '{$user_email}' , '{$user_contact_number}' , '{$password}') ");
		confirm($query);

		if($query)
		{
			?>
			 <script language='javascript' type="text/javascript">
			 			alert('Registered Successfully!!');
</script>
					?>
					<?php
			redirect('index.php');
		}
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

function cart()
{
	$total= 0;
	$quantity = 0;
	$item_name =1;
	$item_number=1;
	$amount =1;
	$item_total_quantity=1;

	foreach ($_SESSION as $name => $value) {
		if($value > 0)
		{


		if(substr($name, 0, 8) == "product_")
		{
			$length =strlen($name);

			$id = substr($name, 8, $length);

	$query = query("SELECT * FROM ecommerce.products WHERE product_id=" .escape_string($id)." ");
	confirm($query);

	while ($row=fetch_array($query)) {
		$sub_total = $row['product_price'] * $value;
		$products = <<<DELIMETER
		    <tr>
                <td>{$row['product_title']}</td>
                <td>&#x20B9;{$row['product_price']}</td>
                <td>{$value}</td>
                <td>&#x20B9;{$sub_total}</td>
              <td><a class="btn btn-warning" href="cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a> &nbsp; <a class="btn btn-success" href="cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>&nbsp;<a class="btn btn-danger" href="cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
              <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
			  <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
			  <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
			  <input type="hidden" name="item_total_quantity_{$item_total_quantity}" value="{$value}">
              
            </tr>
DELIMETER;
            echo $products;
           $_SESSION['item_total'] = $total +=$sub_total;
            $_SESSION['item_quantity'] = $quantity+=$value;
			$item_name +=1;
			$item_number +=1;
			$amount +=1;
			$item_total_quantity +=1;
           
            
	}
 
		}


	}
	
	}






}

function report()
{
	$total= 0;
	$quantity = 0;
	

	foreach ($_SESSION as $name => $value) {
		if($value > 0)
		{


		if(substr($name, 0, 8) == "product_")
		{
			$length =strlen($name);

			$id = substr($name, 8, $length);

	$query = query("SELECT * FROM ecommerce.products WHERE product_id=" .escape_string($id)." ");
	confirm($query);

	while ($row=fetch_array($query)) {
		$product_price = $row['product_price'];
		$sub_total = $row['product_price'] * $value;
		



         $total +=$sub_total;
            $quantity+=$value;	

            $insert_report= query("INSERT INTO ecommerce.reports(product_id , product_price , product_quantity) VALUES('{$id}' , '{$product_price}' , '{$value}') ");
            confirm($insert_report);		  
            }
 
		}
	}
	
	}
}

// *********** BACKEND ADMIN******************

function add_products()
{
	if(isset($_POST['add_product']))
	{
		$product_title = escape_string($_POST['product_title']);
		$product_description = escape_string($_POST['product_description']);
		$product_price = escape_string($_POST['product_price']);
		$product_quantity = escape_string($_POST['product_quantity']);
		$product_category = escape_string($_POST['product_category']);
		$product_short_desc = escape_string($_POST['product_short_desc']);
		 $product_image = $_FILES['file']['name'];
    	$product_image_temp = $_FILES['file']['tmp_name'];

    	move_uploaded_file($product_image_temp, "../images/product_images/$product_image");

    	$query =query("INSERT INTO ecommerce.products(product_title , product_category_id , product_price , product_quantity , product_description , short_desc , product_image) VALUES('{$product_title}' , '{$product_category}' , '{$product_price}' , '{$product_quantity}' , '{$product_description}' , '{$product_short_desc}' , '{$product_image}') ");
    	confirm($query);
	}
}

 ?>
