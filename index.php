<!DOCTYPE html>

<?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ERROR );
            require('vendor/autoload.php');

            use Respect\Validation\Validator as v;

            $fullnameerr = $usererr = $emailerr = $pswerr ="";
            
            if (isset($_POST['submit'])){
                $fullname = $_POST["fullname"];
                $user = $_POST["user"];
                $email = $_POST["email"];
                $psw = $_POST["psw"];

                if (false == v::notBlank()->validate($fullname)){
                    $fullnameerr = 'Please enter fullname.';
                }

                if (false == v::notBlank()->validate($user)){
                    $usererr = 'Please enter username.';
                }
                if (false == v::notBlank()->validate($email)){
                    $emailerr = 'Please enter email id.';
                }
                if (true == v::notBlank()->validate($email)){
                    if (false == v::email()->validate($email)){
                        
                        $emailerr = 'Please enter valid email id.';
                    }
                    elseif (v::callback(
                        function ($email): bool{
                            $myconnection = new mysqli("localhost", "root", "","ebook");
                            $sql = "SELECT email FROM registration WHERE email = '".$_POST['email']."'";
                            $result = mysqli_query($myconnection, $sql) or mysqli_error($myconnection);
                            return mysqli_num_rows($result);
                        }
                    )->validate($email)){
                        $emailerr = 'Email id already exist.';
                    }
                }
                if (false == v::notBlank()->validate($psw)){
                    $pswerr = 'Please enter password.';
                }
                if($fullnameerr == "" && $usererr == "" && $emailerr == "" )
                {
                    $servername = "localhost:3308";
                    $username = "root";
                    $password = "";
                    $dbname = "ebook";
                
                    try{
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO registration (fullname, user, email, password)
                        VALUES ('$fullname', '$user', '$email', '$psw')";
                        
                        //$db = ();
                        $conn->exec($sql);
                        $l_id = $conn->lastInsertId();

                        
                        header("location:index.php?id=".$l_id);
                    }   
                    catch(PDOException $e) 
                    {
                        echo $sql . "<br>" . $e->getMessage();
                    }
                    $conn = null;
                }
            }

?>

<!-- login -->
<?php
session_start();
use Respect\Validation\Rules\Email;
//use Respect\Validation\Validator as v; 
error_reporting(E_ERROR );

ob_start();
    session_start();
    error_reporting(E_ALL);
    require('vendor/autoload.php');
    $emailerr = $pswerr="";

    //validation
    if(isset($_POST['login'])){
        $email = $_POST["email"];
        $psw = $_POST["psw"];
        

        if (false == v::notBlank()->validate($email)){
            $emailerr = 'Please enter valid email id.';
        }
        
        if (false == v::notBlank()->validate($psw)){
            $pswerr = 'Please enter valid password.';
        }
        
        if(isset($_POST["remember"])){
            setcookie("email",$_POST["email"],time()+3600);
            setcookie("password",$_POST["password"],time()+3600);
            echo "Cookie set successfully.";
        } else{
            setcookie("email","");
            setcookie("password","");
            //echo "Cookie is not set.";
        }
    }

    //session start event
    if(isset($_POST["login"]))
    {

        
        $myconnection = mysqli_connect("localhost", "root", "", "ebook");
        $sql = "SELECT email, password FROM registration WHERE email = '$email' AND password = '$psw'";
        $result = mysqli_query($myconnection, $sql) or mysqli_error($myconnection);
        if(mysqli_num_rows($result)>0)
        {   
            $row = mysqli_fetch_assoc($result);
            $_SESSION["email"]=$row['email'];
            $_SESSION["password"]=$row['psw'];
            $_SESSION["avatar"]=$row['avatar'];
            
            header("location: home.php");
            echo "Session is created.";
        }    
        if (true == v::notBlank()){
            $emailerr = 'Please enter valid email id.';
            $pswerr = 'Please enter valid password.';
        }
    }
    

?>

<html>
<head>
	<title>Register Yourself</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
</head>
        
<body>
    <div class="cont">
    
    <div class="form sign-in">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"> <h2>Sign In</h2>
        <label>
            <span>Email Address</span>
            <span class="error">*</span>
            <input type="email" name="email" id="email" value="">
            <span class="error"><?php echo $emailerr; ?></span>
            
         
        </label>
        <label>
            <span>Password</span>
            <span class="error">*</span>
            <input type="password" name="psw" id="psw">
            <span class="error"> <?php echo $pswerr; ?> </span>
           
            
        </label>
    <button class="submit" type="submit"  id="signin" name="login">Sign In</button>
    <div class="media">
    <ul>
        <li> <a href="https://www.facebook.com/" target="_blank">
            <img src="facebook.png"> </a></li>
        <li><a href="https://www.twitter.com/" target="_blank">
            <img src="twitter.png"> </a></li>
        <li><a href="https://www.linkedin.com/" target="_blank">
            <img src="linkedin.png"> </a></li>
        <li><a href="https://www.instagram.com/" target="_blank"> </a>
            <img src="instagram.png"> </a></li>
            </div>
    </form>
    </div>

    <div class="sub-cont">
    <div class="img">
        <div class="img-text m-up">
            <h1>New here?</h1>
            <p>sign up and discover</p>
        </div>
        <div class="img-text m-in">
            <h1>One of us?</h1>
            <p>just sign in</p>
        </div>
        <div class="img-btn">
            <span class="m-up">Sign Up</span>
            <span class="m-in">Sign In</span>
        </div>
    </div>
    <div class="form sign-up">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">

        <h2>Sign Up</h2>
        <label for="fullname">
            <span>Full Name</span>
            <span class="error">*</span>
            <input type="text" name="fullname" id="fullname" value="">
            <span class="error"><?php echo $fullnameerr; ?></span>
        </label>

        <label for="user">
            <span>User Name</span>
            <span class="error">*</span>
            <input type="text" name="user" id="user" value="">
            <span class="error"> <?php echo $usererr; ?> </span>
        </label>

        <label for="email">
            <span>E-mail</span>
            <span class="error">*</span>
            <input type="text" name="email" id="email" value="">
            <span class="error"> <?php echo  $emailerr; ?> </span>
        </label>

        <label or="psw">
            <span>Password</span>
            <span class="error">*</span>
            <input type="password" name="psw" id="psw" >
            <span class="error"> <?php echo $pswerr; ?> </span>
        </label>
        <button type="submit" class="submit" onclick="location.href = 'index.php';" id="submit" name="submit">Sign Up Now</button>
    </div>
    </form>
    </div>
</div>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
