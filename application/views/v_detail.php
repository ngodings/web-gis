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
	<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

	<link href="<?php echo base_url("assets/css/BootSideMenu.css"); ?>" rel="stylesheet">
	<!-- map -->
	<link href="<?php echo base_url("assets/leaflet/leaflet.css"); ?>" rel="stylesheet">
	
	

	<style type="text/css">
	#mapid { 
		height: 400px; 
	}

	.slider-holder
        {
            width: 800px;
            height: 400px;
            background-color: yellow;
            margin-left: auto;
            margin-right: auto;
            margin-top: 0px;
            text-align: center;
            overflow: hidden;
        }
       
        .image-holder
        {
            width: 2400px;
            background-color: grey;
            height: 400px;
            clear: both;
            position: relative;
           
            -webkit-transition: left 2s;
            -moz-transition: left 2s;
            -o-transition: left 2s;
            transition: left 2s;
        }
       
        .slider-image
        {
            float: left;
            margin: 0px;
            padding: 0px;
            position: relative;
        }
       
        #slider-image-1:target ~ .image-holder
        {
            left: 0px;
        }
       
        #slider-image-2:target ~ .image-holder
        {
            left: -800px;
        }
       
        #slider-image-3:target ~ .image-holder
        {
            left: -1600px;
        }
       
        .button-holder
        {
            position: relative;
            top: -20px;
        }
       
        .slider-change
        {
            display: inline-block;
            height: 10px;
            width: 10px;
            border-radius: 5px;
            background-color: brown;
        }
	</style>
</head>
<body>

	<div style="width: 50%; float:left">
		<div id="mapid"></div>
	</div>
	<div style="width: 50%; float:right">
		<div class="slider-holder">
			<span id="slider-image-1"></span>
			<span id="slider-image-2"></span>
			<span id="slider-image-3"></span>
			<div class="image-holder">
				<?php foreach($dok as $r) {?>
				<img src="<?= base_url()?>assets/uploads/<?=$r->dokumentasi_gambar?>" class="slider-image" />
				<?php }?>
			</div>
			<div class="button-holder">
				<a href="#slider-image-1" class="slider-change"></a>
				<a href="#slider-image-2" class="slider-change"></a>
				<a href="#slider-image-3" class="slider-change"></a>
			</div>
		</div>
	</div>
	<div>
		<?php foreach ($bidang as $b){?>
		<li> Nama bidang : <?= $b->bidang_nama?></li>
		<li> Keterangan : <?= $b->bidang_keterangan?></li>
		<?php }?>
	</div>


	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  	<script src="<?php echo base_url("assets/js/BootSideMenu.js"); ?>"></script>
  	<script src="<?php echo base_url("assets/leaflet/leaflet.js"); ?>"></script>
  
  
	<script type="text/javascript">
		var map = L.map('mapid').setView([-7.5595759, 110.8541984], 13);
		var base_url ="<?= base_url() ?>";
		var v_kode ="<?=$kode?>";
		

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		$.getJSON(base_url+"assets/geojson/map.geojson", function(data){
		//untuk konfigurasi tampilan map mark atau multi polygon
		getLayer = L.geoJson(data, {
			style: function(feature, layer) {
				

				//membedakan multi polygon
				var kode = feature.properties.kode;
				if (kode == v_kode){
					return{
						fillOpacity: 0.8,
						fillColor: "",
						weight: 1,
						opacity: 1,
						color: "#11f43e"

					};

				}else {
					return { //daerah dua
							fillOpacity: 0.0,
							weight: 1,
							opacity: 1,
							color: "#6d96f7"
						};

				}
				

				
			},
			//untuk setiap bidang menambahkan layer
			onEachFeature: function(feature, layer){
				// mendapatkan kode
				var kode = feature.properties.kode;
				var long = parseFloat(feature.properties.longitude);
				var latt = parseFloat(feature.properties.latitude);
				//untuk memfokuskan daerah
				if (kode == v_kode){
					map.flyTo([long, latt], 14, {
						animate: true,
						duration: 2
					});

					//membuat tanda marker agar dapat di tengah plotygon
					var center = getCenteroid(feature.geometry.coordinates[0]);
					L.marker([center[1],center[0]]).addTo(map);
					//dibalik jadi 0 latitude
				}
				
			}

		}).addTo(map);
	}); 
	
	//agar marker di tengah polygon
	var getCenteroid = function (coord)
	{
		var center = coord.reduce(function (x,y){
			return [x[0] + y[0]/coord.length, x[1] + y[1]/coord.length]
		}, [0,0])
		return center;
	}

	</script>

</body>
</html>

