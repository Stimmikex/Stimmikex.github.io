<?php
	$pageName = 'Home';
?>
<!DOCTYPE html>
<html class="no-js" lang="IS_is">
	<head>
		<?php require_once 'inc/head.php'; ?>
	</head>
	<body>
		<?php require_once 'inc/header.php'; ?>
		<?php
			if (isset($_GET['code'])) {
				header('location: index.php');
			}
			
			if ($logged === 'in') {
		?>
		<h2>Get a Ride</h2>
		<ul class="index_ul">
			<li><a href="offer.php">Offer a ride</a></li>
			<li><a href="request.php">Request a ride</a></li>
			<li><a href="planner.php">Dayplan</a></li>
			<li><a href="check_plan.php">Check for plans</a></li>
		</ul>
		<h2>Carpooling</h2>
		<ul class="index_ul">
			<li><a href="#">Ask ride</a></li>
			<li><a href="#">Add ride</a></li>
			<li><a href="#">Search</a></li>
		</ul>
		<?php
			} else {
		?>
		<div class="ism-slider" data-transition_type="fade" id="my-slider">
		  <ol>
		    <li>
		      <img src="img/slides/slider_1.jpg">
		      <div class="ism-caption ism-caption-0">Get a ride!</div>
		    </li>
		    <li>
		      <img src="img/slides/beautiful-701678_1280.jpg">
		      <div class="ism-caption ism-caption-0">Make a plan!</div>
		    </li>
		    <li>
		      <img src="img/slides/slider_2.gif">
		      <div class="ism-caption ism-caption-0">Save money and the world from over heating</div>
		    </li>
		  </ol>
		</div>
		<p>Please <a href="login.php">log in</a> to offer or request a ride.</p>
		<div>
			<h4>About Us</h4>
			<p>RideRequest Is a side where users can make daily plans where they go daily and to get people to join them for this trip</p>
		</div>
		<?php
			}
		?>
		<?php require_once 'inc/footer.php'; ?>
	</body>
</html>