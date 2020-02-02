<?php
	$pageName = 'Geolocation Test';
?>
<!DOCTYPE html>
<html class="no-js" lang="IS_is">
	<head>
		<?php require_once 'inc/head.php'; ?>
	</head>
	<body>
		<?php require_once 'inc/header.php'; ?>
		<div id="geotest"></div>
		<?php require_once 'inc/footer.php'; ?>
		<script type="text/javascript">
			geolocation();
			console.log((calculateDistanceKm(64.140084, -21.922452, 64.141296, -21.924664) * 1000) + 'm');
		</script>
	</body>
</html>