<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>G I S</title>

  	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script> 
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />	
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
	
<body>
	<?php echo $map['html']; ?>
	<?php echo $map['js']; ?>
</body>
</html>
