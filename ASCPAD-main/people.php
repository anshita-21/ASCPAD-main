<?php
session_start();
include 'partials/_dbconnect.php';
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
include 'partials/_dbconnect.php';
$userid=$_SESSION['username'];
$sql="Select * from vehicle_data where vehicle_no='$userid'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$owner_name=$row['own_name'];
$owner_phone=$row['phone_no'];

// tow
    $noresult=true;
    $sql="select * from towed_vehicles where vehicle_no='$userid'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $num=mysqli_num_rows($result);

    if($num==1){
        $vehicleno=$row['vehicle_no'];
        $p_name=$row['police_name'];
        $police_st=$row['police_st'];
        $p_phone=$row['police_phone'];
        $date=$row['date'];
        $noresult=false;
    }
    else{
        $noresult=true; 
    }


// challan

$sql1="select * from challan_vehicle where vehicle_no='$userid'";
$result1=mysqli_query($conn,$sql1);
// $row1=mysqli_fetch_assoc($result1);
$num1=mysqli_num_rows($result1);
$noresult1=true;
if($num1>0){
    $noresult1=false;
}
// $total=0;
// while($row=mysqli_fetch_assoc($result1)){
//     $total=$total+$row["rule_broken_penalty"];
// }
// echo $total;


    // payment page redirect
    $_SESSION['veh_no'] = $userid; 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People|Tow - Site</title>
    <link rel="stylesheet" href="peoplestyle.css">
    <style>
table, th, td {
  border:1px solid black;
}
</style>
</head>

<body>
    <nav class="navbar">
        <div class="hamburger-menu block">
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn" for="menu__toggle">
                <span></span>
            </label>
            
            <ul class="menu__box">
                    <li class="profile"><img src="img/police.png" alt="" class="profimg"></li>
                    <li class="menu__item">Vehicle No. : <?php echo $userid ?> </li>
                    <li class="menu__item">Name : <?php echo $owner_name ?> </li>
                    <li class="menu__item">Phone No. : <?php echo $owner_phone ?> </li>
                    <li><a class="menu__item" href="challan_det.php?vehicle_no=<?php echo $userid ?>">Challan history</a></li>
                    
                </ul>
              </div>
        
              <div class="greeting">
                  <h1>Hello!! <?php echo $owner_name ?> </h1>
                </div>
        <div>
        <h1 class="title">
            Towing Services
        </h1>
        </div>
        <div>
        <button class="login">
            <a href="logout.php">
                <img src="img/logout.png" alt="" class="logoutimg">
            </a>
        </button>
    </div>
</nav>
<section>
    <div class="container">
        <h1>CHALLAN DETAILS</h1>
        <div class="result1">
        <?php
        if($noresult){
        //     echo '<div class="result">
        //  <h3> No outstanding challan </h3>
        //  </div>';
        }
        else{
        
            echo '<h2>Towed vehicle details</h2>
            <div class="result">
            <h3> Vehicle number : '.$vehicleno.' <br>
            Police Name : '.$p_name.' <br>
         Police Station : '.$police_st.' <br>
            Police phone no : '.$p_phone.' <br>
            Date/Time: '.$date.' </h3><br>
            
            <h3> Challan Amount: 600 Rs. </h3>
            
            </div>';
            ?>
            <a href='payment_page_tow.php?total=<?php echo "600" ?>'>Pay Now</a>
            <!-- <a href='payment_page.php?total=<?php echo "600" ?>&table="tow"'>Pay Now</a> -->
            <?php
            echo '<hr>';

        }
        ?>
    </div>

    <div class="result2">
        <?php
            if($noresult1){

            }
            else{
                
                echo '<h2>Traffic rules violation challan</h2>';
                ?>
                <div class="table1">
                    <table>
                        <tr>
                        <th>Date</th>
                        <th>Rules violated</th>
                        <th>Penalty amount</th>
                        </tr>
    
                        <?php
                            if($num1>0){
                                $total=0;
                                while($row1=mysqli_fetch_assoc($result1)){
                                    echo "
                                        <tr>
                                            <td>".$row1['date']."</td>
                                            <td>".$row1['rule_broken']."</td>
                                            <td>".$row1['rule_broken_penalty']."</td>
                                        </tr>
                                    ";
                                    $total=$total+$row1["rule_broken_penalty"];
                                }
                                echo "
                                        <tr>
                                            <td colspan='2'>Total</td>
                                            <td>".$total."</td>
                                        </tr>
                                    ";
                                
                            }

                            else{
                                echo "
                                    <tr>
                                        <td colspan='4'>No record found</td>
                                    </tr>
                                ";
                            }

                        ?>
                    </table>
                </div>
                <a href='payment_page_rule.php?total=<?php echo $total ?>'>Pay Now</a>
            <?php
            }
            ?>
        
    
</div>
</section>
<footer>
    <nav class="fnbar">
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
            <a href="#">Feedback</a>
            <a href="#">Visitor Summary</a>
            <a href="#">Help</a>
            <a href="#">Link To Us</a>
            <a href="#">Website Policy</a>
        </nav>
        <div class="content">
            <div class="ctnt1">

                <h3 class="f1">Traffic Rules</h3>
                <div class="rules">
                    <a href="#">Do Not Drink and Drive</a>
                    <a href="#">Always Own Valid Car Insurance Policy</a>
                    <a href="#">Wear your seatbelt while Driving a Car</a>
                    <a href="#">Riding a Two-Wheeler without a Helmet On</a>
                    <a href="#">Using a Mobile Phone while Riding</a>
                    <a href="#">Over Speeding</a>
                    <a href="#">Jumping the Red Light</a>
                </div>
            </div>
            <div class="ctnt2">
                <h3 class="f2">
                    About Govt
                </h3>
                <div class="about">
                    <a href="#">Constitution Of India</a>
                    <a href="#">Govt Directory</a>
                    <a href="#">Indian Parliament</a>
                    <a href="#">Publications</a>
                    <a href="#">RTO Of India</a>
                    <a href="#">Traffic Police</a>
                    <a href="#">Who's Who</a>
                </div>
            </div>
        </div>

    </footer>
    <script src="">
        $(document).ready(function() {
	navNumbers();
	backToDefault();
	
	// show hovered li stuff
	$('.main-menu').on('mouseover', 'li', function() {
		showTarget($(this));
	});

	// show default .active li stuff
	$('.main-menu').on('mouseleave', backToDefault);
	
	// change active list item
	$('.main-menu').on('click', 'li', function() {
		changeActive($(this));
	});
	
	// toggle menu
	$('.toggle').on('click', toggleMenu);
	
	// for showcase only
	var tl = new TimelineMax(),
			body = $('body'),
			header = $('header'),
			content = $('.content p'),
			toggle = $('.toggle'),
			nav = $('nav');
	
	tl.to(body, 1, {
		padding: '0 80px 80px',
		delay: .5
	});
	
	tl.to(header, .25, {
		opacity: 1,
		delay: .5
	});
	
	tl.to(content, .25, {
		opacity: 1
	}, '-=.25');
	
	tl.call(function() {
		toggleMenu();
	}, null, null, 3);
	
	tl.call(function() {
		toggleMenu();
	}, null, null, 4.5);

});

// toggle menu
function toggleMenu() {
	var toggle = $('.toggle');
	var nav = $('nav');
	
	if(toggle.hasClass('clicked')) {
		toggle.removeClass('clicked');
		nav.removeClass('open');
		console.log('remove open');
		setTimeout(function() {
			console.log('add hidden');
			nav.addClass('hidden');
		}, 500);
	} else {
		nav.removeClass('hidden');
		toggle.addClass('clicked');
		nav.addClass('open');
	}
}

// give the list items numbers
function navNumbers() {
	var sum = $('.main-menu li').length;
	var i = 0;
	var x = 0;

	$('.showcase-menu li').each(function() {
		$(this).attr('data-target', x);
		x++;
	});
	
	$('.main-menu li').each(function() {
		var number = ('0' + i).slice(-2);
		var numberElement = '<div class="number"><span>'+number+'</span></div>';
		$(this).prepend(numberElement);
		$(this).attr('data-target', i);
		i++;
	});
}


// show the hovered list item stuff
function showTarget(e) {
	$('.main-menu li').removeClass('hover');
	
	var target = $(e).attr('data-target');
	var showcaseHeight = $('.showcase-menu').outerHeight();
	
	showcaseHeight = (showcaseHeight * target) * -1;
	
	$('.showcase-menu').css({
		top: showcaseHeight
	});
	
	$(e).addClass('hover');
}

// show the list item stuff of .active
function backToDefault() {
	$('.main-menu li').removeClass('hover');
	
	var activeItem = $('.main-menu li.active');
	var target = activeItem.attr('data-target');
	var showcaseHeight = $('.showcase-menu').outerHeight();
	
	showcaseHeight = (showcaseHeight * target) * -1;
	
	$('.showcase-menu').css({
		top: showcaseHeight
	});
	
	activeItem.addClass('hover');
}


// change active list item
function changeActive(e) {
	$('.main-menu li').removeClass('active');
	$(e).addClass('active');
}
    </script>
</body>

</html>

<!-- SELECT *
FROM events
where event_date between '2018-01-01' and '2018-01-31'; -->
