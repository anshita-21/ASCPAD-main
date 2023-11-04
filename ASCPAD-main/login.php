<?php
$login=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/_dbconnect.php';
    $username=strtoupper($_POST["username"]);
    $password=$_POST["password"];

    $sql_tp="Select * from tow_police where userid='$username' AND pswd='$password'";
    $result_tp=mysqli_query($conn,$sql_tp);
    $num_tp=mysqli_num_rows($result_tp);
    $row_tp=mysqli_fetch_assoc($result_tp);
    
    $sql_pe="Select * from vehicle_data where vehicle_no='$username' AND passwd='$password'";
    $result_pe=mysqli_query($conn,$sql_pe);
    $num_pe=mysqli_num_rows($result_pe);
    $row_pe=mysqli_fetch_assoc($result_pe);

    $sql_cp="Select * from challan_police where userid='$username' AND pswd='$password'";
    $result_cp=mysqli_query($conn,$sql_cp);
    $num_cp=mysqli_num_rows($result_cp);
    $row_cp=mysqli_fetch_assoc($result_cp);

    if($num_tp==1){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;

                header("location: police.php");
    } 
    else if($num_pe==1){
                 $login = true;
                 session_start();
                 $_SESSION['loggedin'] = true;
                 $_SESSION['username'] = $username;

                 header("location: people.php");
    } 
    else if($num_cp==1){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        header("location: challan_police.php");
    } 

    else{
        $showError="Invalid Credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login|Tow - Site</title>
    <link rel="stylesheet" href="logincss.css">
    <style>
        body {
            position: relative;
        }
        
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            display: none;
        }
        
        .loading.active {
            display: block;
        }
        
        .loading-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            /*transform: translate(-50%, -50%);*/
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 5px solid #fff;
            border-top-color: #7ED957;
            animation: loading 1s ease-in-out infinite;
        }
        
        @keyframes loading {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="login__logo">
        <img src="./depngs/towlogo.png" alt="No Logo">
    </div>
    <div class="hr">
        <hr style="border: 0.1px solid rgb(229, 228, 228);">
    </div>
    <div class="login">
        <div class="image">
            <img src="./depngs/trafficpolice.png" alt="">
        </div>
    <?php
    if($login){

        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';

    }
    if($showError){
        echo '<script type="text/javascript">

        window.onload = function () { alert("Error! '. $showError.'"); }

</script>';
        }
        ?>
        <div class="form">
            <form action="login.php" method="post">
                <h2>Login</h2>
                <div class="user">
                    <input type="text" name="username" class="username" placeholder="Enter Username" required>
                </div>
                <div class="pass">
                    <input type="password" name="password" class="password" placeholder="Enter Password" required>
                </div>
                <div class="btn">

                    <a href="">
                        <button type="submit" style="background-color: #7ED957;
    border: none;
    font-size: 1.3rem;
    color: white;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    cursor: pointer;" >Go</button>
                        <!-- <button>Search</button> -->
                    </a>
                </div>
            </form>
        </div>
    </div>

    <hr>

    <div class="footer">
        <div class="footer-links">
            <div class="footer-links_logo">
                <img src="./depngs/towlogo.png" alt="">
                <p>Lorem ipsum dolor sit amet. <br /> All Rights Reserved</p>
            </div>
            <div class="footer-links_div">
                <h4>Links</h4>
                <p>Overons</p>
                <p>Social Media</p>
                <p>Counters</p>
                <p>Contact</p>
            </div>
            <div class="footer-links_div">
                <h4>Company</h4>
                <p>Terms & Conditions</p>
                <p>Privacy Policy</p>
                <p>Contact</p>
            </div>
            <div class="footer-links_div">
                <h4>Get in touch</h4>
                <p>Crechterwoord K12 182 DK Alknjkcb</p>
                <p>085-132567</p>
                <p>info@payme.net</p>
            </div>
        </div>

    </div>
    <div class="footer-copyright">
        <p>© 2023 ASCPAD. All rights reserved.</p>
    </div>

</body>
<script>
    function fadeOut(event) {
        event.preventDefault(); // Prevent the default link behavior
        document.querySelector('body').classList.add('fadeOut');
        document.querySelector('.loading').classList.add('active');
        setTimeout(function() {
            window.location.href = event.target.href;
        }, 1000); // Wait 1 second before navigating to the new page
    }

    function fadeIn() {
        document.querySelector('body').classList.add('fadeIn');
        document.querySelector('.loading').classList.remove('active');
    }
</script>

</html>

</html>