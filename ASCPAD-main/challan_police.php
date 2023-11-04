<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
include 'partials/_dbconnect.php';
$userid=$_SESSION['username'];
$sql="Select * from challan_police where userid='$userid'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$police_name=$row['name'];
$police_id=$row['userid'];
$police_phone=$row['phone'];
$police_st=$row['police_st'];

// displaying rules
$query1="SELECT * FROM traffic_rules";
$resultq1=mysqli_query($conn,$query1);
$numq1=mysqli_num_rows($resultq1);
$rowq1=mysqli_fetch_assoc($resultq1);
// echo var_dump($rowq1);

if($_SERVER["REQUEST_METHOD"]=="POST"){

$vehicle_no=strtoupper($_POST["vehicle_no"]);
$rules=$_POST["rules_list"];
// echo $vehicle_no;
foreach($rules as $items){
    $query2="SELECT * FROM traffic_rules where rule_id='$items'";
    $resultq2=mysqli_query($conn,$query2);
    // $numq2=mysqli_num_rows($resultq2);
    $rowq2=mysqli_fetch_assoc($resultq2);

    $rule_id=$rowq2["rule_id"];
    // echo $rule_id;
    $rule_name=$rowq2["rule_name"];
    // echo $rule_name;
    $rule_penalty=$rowq2["rule_penalty"];
    // echo $rule_penalty;
    // echo var_dump($rowq2);
    // $sql1="INSERT INTO `towed_vehicles` (`vehicle_no`, `police_name`, `police_st`, `police_phone`,`date`) VALUES ('$vehicle_no', '$police_name', '$police_st', '$police_phone',current_timestamp())";
    $query3="INSERT INTO `challan_vehicle` (`vehicle_no`,`rule_broken_id`,`rule_broken`,`rule_broken_penalty`,`date`) VALUES ('$vehicle_no','$rule_id','$rule_name','$rule_penalty',current_timestamp())";
    $query4="INSERT INTO `challan_vehicle_rto` (`vehicle_no`,`rule_broken_id`,`rule_broken`,`rule_broken_penalty`,`date`) VALUES ('$vehicle_no','$rule_id','$rule_name','$rule_penalty',current_timestamp())";
    $resultq3=mysqli_query($conn,$query3);
    $resultq4=mysqli_query($conn,$query4);

        echo '<script type="text/javascript">
              window.onload = function () { alert("Success! Submitted."); }
              </script>';
}
// $existSql="Select * from towed_vehicles where vehicle_no='$vehicle_no'";
// $result4=mysqli_query($conn,$existSql);
// $numExistRows=mysqli_num_rows($result4);
// $showAlert=false;

// if($numExistRows>0){
    // $showAlert=true;
// echo '<script type="text/javascript">
// 
        // window.onload = function () { alert("Alert! Data already exists."); }
// 
// </script>';
// }
// else{
//   $exists=false;

    // $sql1="INSERT INTO `towed_vehicles` (`vehicle_no`, `police_name`, `police_st`, `police_phone`,`date`) VALUES ('$vehicle_no', '$police_name', '$police_st', '$police_phone',current_timestamp())";
    // $sql2="INSERT INTO `towed_vehicles_rto` (`vehicle_no`, `police_name`, `police_st`, `police_phone`,`date`) VALUES ('$vehicle_no', '$police_name', '$police_st', '$police_phone',current_timestamp())";
    // $result1=mysqli_query($conn,$sql1);
    // $result2=mysqli_query($conn,$sql2);
    
    // echo '<script type="text/javascript">

        // window.onload = function () { alert("Success! Submitted."); }

// </script>';
    

//  }
}
// $dt=curdate();
// $count_sql="SELECT count(*) FROM `towed_vehicles_rto` WHERE police_name='$police_name' AND DATE(date)=CURDATE()";
// $result=mysqli_query($conn,$count_sql);
// $row=mysqli_fetch_assoc($result);
// echo var_dump($row);
// echo var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police|Tow - Site</title>
    <link rel="stylesheet" href="challanpolicecss.css">

    <style>

    </style>
</head>
<body>
    <nav>
        <div class="navbar">
            <div class="container nav-container">
                <input class="checkbox" type="checkbox" name="" id="" />
                <div class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>

                <div class="menu-items">
                    <li><a href="#">Police id :<?php echo $police_id?></a></li>
                    <li><a href="#">Police Name :<?php echo $police_name?></a></li>
                    <li><a href="#">Police Station :<?php echo $police_st?></a></li>
                    <li><a href="#">Phone No. :<?php echo $police_phone?></a></li>
                    <!-- <li><a href="#">No. of vehicles towed today:<?php echo $row['count(*)']?></a></li> -->
                    <!-- <li><a href="#" class="link">Towed Vehicle Details</a></li> -->
                </div>
            </div>
            <div class="login__logo">
                <img src="./depngs/towlogo.png" alt="No Logo">
            </div>
            <div class="logout">
                <a href="logout.php">
                    <!-- <button>Pay</button> -->
                    <img src="./depngs/logout.png" alt="">
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <form action="challan_police.php" method="post">
        <div class="searchSection">
            <div class="search">
                <input type="text" required pattern="[A-Za-z]{2}[0-9]{2}[A-Za-z]{2}[0-9]{4}" name="vehicle_no" class="vehiNum" placeholder="Enter Vehicle Number" minlength="10" maxlength="10">
            </div>

            <div class="dropdown">
                <div class="select">
                    <span class="selected">Select Rules Violated</span>
                    <div class="caret"></div>
                </div>

                <ul class="menu">
                    <?php
                        if($numq1>0){
                            foreach($resultq1 as $item){
                                ?>
                                     <li><input id="myCheckbox" type="checkbox" name="rules_list[]" value="<?php echo $item['rule_id']; ?>" /><?php echo $item['rule_name'];?></li>
                                     <?php

                            }
                        }
                        else{
                            echo "No record found";
                        }
                        ?>
                    <!-- <li><input id="myCheckbox" type="checkbox" /><span id="mySpan">Driving without a seat belt</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Triple riding on two-vehicle</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Driving without a number plate</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Driving without helmet</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Parking in "no parking zone"</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Minor driving vehicle</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Disobey of traffic signals</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Dangerous/rash driving</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Using a mobile phone while driving</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Drunken driving</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Driving vehicle without registration</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Driving uninsured vehicle</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Violation of road regulations</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Over-speeding</span></li>
                    <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Carrying excess luggage</span></li> -->
                </ul>
            </div>

            <div class="btn">
                <button>Submit</button>
            </div>
</form>
        </div>

        <!-- <div class="dropdown">
            <div class="select">
                <span class="selected">Select Rules Violated</span>
                <div class="caret"></div>
            </div>

            <ul class="menu">
                <li><input id="myCheckbox" type="checkbox" /><span id="mySpan">Driving without a seat belt</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Triple riding on two-vehicle</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Driving without a number plate</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Driving without helmet</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Parking in "no parking zone"</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Minor driving vehicle</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Disobey of traffic signals</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Dangerous/rash driving</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Using a mobile phone while driving</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Drunken driving</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Driving vehicle without registration</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Driving uninsured vehicle</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Violation of road regulations</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Over-speeding</span></li>
                <li><input class="myCheckbox" type="checkbox" /><span class="mySpan">Carrying excess luggage</span></li>
            </ul>
        </div> -->
        <!-- class="active" -->
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
    /*var checkList = document.getElementById('dp');
                                                    checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
                                                        if (checkList.classList.contains('visible'))
                                                            checkList.classList.remove('visible');
                                                        else
                                                            checkList.classList.add('visible');
                                                    }*/
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        const select = dropdown.querySelector('.select');
        const caret = dropdown.querySelector('.caret');
        const menu = dropdown.querySelector('.menu');
        const options = dropdown.querySelector('.menu li');
        const selected = dropdown.querySelector('.selected');

        select.addEventListener('click', () => {
            select.classList.toggle('select-clicked');
            caret.classList.toggle('caret-rotate');
            menu.classList.toggle('menu-open');
        });
        options.forEach(option => {
            option.addEventListener('click', () => {
                selected.innerText = option.innerText;

                select.classList.remove('select-clicked');

                caret.classList.remove('caret-rotate');

                menu.classList.remove('menu-open');
                options.forEach(option => {
                    option.classList.remove('active');
                });
                option.classList.add('active');
            });
        });
    });



    /*const checkbox = document.getElementById("myCheckbox");
    const span = document.getElementById("mySpan");

    span.addEventListener("click", function() {
        checkbox.checked = !checkbox.checked;
    });*/
</script>

</html>