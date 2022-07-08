<!DOCTYPE html>
<?php
session_start();
include('db.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>

<html lang="en">
<head>
<title>Book Listing Page</title>
<link rel='stylesheet' href='style2.css' type='text/css' media='all' />



   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- aos css file cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <!-- magnific popup css cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

    <!-- bootstrap cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style2.css">

    <!--SEARCH BAR-->


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <!-- Including our scripting file. -->
   <script type="text/javascript" src="scripts1.js"></script>
   <style>
    
    .dropbtn {
  background-color: var(--red);
  color: white;
  height:3.5rem;
    width: 15rem;
  font-size: 16px;
  border: none;
  cursor: pointer;
    border-radius: .5rem;
    position: relative;
    z-index: 0;
    overflow: hidden;
    margin:1rem 0;
}


.dropbtn::before{
    content: '';
    position: absolute;
    top: -100%; left: 0;
    height:100%;
    width: 100%;
    background-color: var(--black);
    z-index: -1;
    transition: .2s linear;
  }

.dropbtn:hover:before{
    top: 0%;
  }
  
.dropbtn:hover, .dropbtn:focus {
    box-shadow: .1rem .5rem var(--red),
                0 .3rem .5rem rgba(0,0,0,.3);
}

#myInput {
  box-sizing: border-box;
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 16px;
  padding: 14px 20px 12px 45px;
  border: none;
  border-bottom: 1px solid #ddd;
}

#myInput:focus {outline: 3px solid #ddd;}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 230px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  font-size: 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
    
</head>
<body>
    

<!-- header section starts  -->

<header>
    
<div class="container">

    <a href="#" class="logo"><img src="LOGO.png">

    <nav class="nav">
        <ul>
            <li><a href="#home" opacity="0">Home</a></li>
            <li><a id="logout"  onclick="location.href = 'logout.php';" opacity="0">Logout</a></li>
            <li><a href="#home" opacity="0">About</a></li>
            
   <!--Cart-->
	<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));

?>
<li>
<div class="cart_div">
<a href="cart.php"><img src="cart-icon.png" /> Cart<span><?php echo $cart_count; }?></span></a>
</div>
</li>

</div>
 
        </ul>
    </nav>
</div>
<!--Cart-->


</header>

<!-- header section ends  -->
<body>
  <!-- home section starts  -->

  <section class="home" id="home">

<div class="container">

    <div class="row min-vh-100 align-items-center text-center text-md-left">

        <div class="col-md-6 pr-md-5" data-aos="zoom-in">
            <img src="home.jpg" width="110%" alt="">
        </div>

        <div class="col-md-6 pl-md-5 content" data-aos="fade-left">
            <h1><span>A Reader</span> Lives<span> 1000</span> Life</h1><h3>In just one</h3>
            <div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Search Books</button>
  <div id="myDropdown" class="dropdown-content">
    <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
    <a href="productpage.html">Birth</a>
    <a href="">Art</a>
    <a href="">Dont Look For The Double Meaning</a>
    <a href="">Never Stop Dreaming</a>
    <a href="">Book Of Flavor</a>
    <a href="">The Higher The Fail</a>
    <a href="">Historical Mistery</a>
    <a href="">Mario Stone</a>
    <a href="">Marble</a>
    <a href="">The Secret Of Colors</a>
    <a href="">Age Of Empires</a>
    <a href="">I Will Take It All Away From You</a>
    
  </div>
</div>
        </div>
       
    </div>

</div>

</section>


<!--cart add data-->

<?php
$result = mysqli_query($con,"SELECT * FROM `products`");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>₹".$row['price']."</div>
			  <button type='submit' class='button'>Buy Now</button>
			  </form>
		   	  </div>";
        }
mysqli_close($con);
?>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
<div style="width:700px; margin:50px auto;">
    </div>


<script>

    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}



    </script>

<!--cart add data-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- magnific popup js link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<!-- aos js file cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>


<script>

AOS.init({
    duration:1000,
    delay:100
});

</script>
</body>
</html>