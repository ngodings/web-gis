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
	.user{
		padding:5px;
		margin-bottom: 5px;
	}
	#mapid { 
		height: 480px; 
	}
	</style>
</head>
<body>

  <!--Test -->
  <div id="test">
    <h2> Web GIS </h2>
    <div class="list-group">
      <a href="#" class="list-group-item active">Home</a>
      <a href="#" class="list-group-item">Menu</a>
      
    </div>

    

  </div>
  <!--/Test -->

  


  <!--Normale contenuto di pagina-->
  <div class="container">
    

    <div class="row">
      <div class="col-md-12">
          <h1> Web GIS </h1>
      </div>
	</div>

	<div class="row">
      <div class="col-md-12">
	  	<div id="mapid"></div>
      </div>
	</div>
	
	

    

  </div>
  <!--Normale contenuto di pagina-->

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  
  <script src="<?php echo base_url("assets/js/BootSideMenu.js"); ?>"></script>
  <script src="<?php echo base_url("assets/leaflet/leaflet.js"); ?>"></script>
  
  

  <script type="text/javascript">
	$('#test').BootSideMenu({side:"left", autoClose:false});
	
	//menampilkan map
	var map = L.map('mapid').setView([-7.5595759, 110.8541984], 13);
	var base_url ="<?= base_url() ?>";
	

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	var myFeatureGroup = L.featureGroup().addTo(map).on("click", groupClick);
	var bangunanMarker;

	$.getJSON("<?php echo base_url("index.php/home/bangunan_json"); ?>", function(data){
		$.each(data, function(i, field) {
		//multi maker dengan database

			var v_lat=parseFloat(data[i].bangunan_lat);
			var v_long=parseFloat(data[i].bangunan_long);
			//dengan icon yang berberbeda
			var icon_bangunan = L.icon ({
					iconUrl: base_url+'assets/img/maprs.png',
					iconSize: [30, 30]
			});

			bangunanMarker = L.marker([v_long, v_lat], {icon: icon_bangunan} )
			.addTo(myFeatureGroup)
			.bindPopup(data[i].bangunan_nama);

			bangunanMarker.id = data[i].bangunan_id;
			
			//bangunanMarker = L.marker([v_long, v_lat], {icon:icon_bangunan} ).addTo(map)
			//.bindPopup(data[i].bangunan_nama)
			//.openPopup();

		//$("div").append(field + " ");
		});
	  });
	  
	function groupClick(event){
		
		alert("Clicked on marker" + event.layer.id);

	}
	//menggunakan geojson untuk menandai suatu daerah

	$.getJSON(base_url+"assets/geojson/map.geojson", function(data){
		//untuk konfigurasi tampilan map mark atau multi polygon
		getLayer = L.geoJson(data, {
			style: function(feature, layer) {

				//membedakan multi polygon
				var kategori = feature.properties.kategori;
				if (kategori == 1){
					return { //daerah satu
						
							fillOpacity: 0.1,
							weight: 1,
							opacity: 1,
							color: "#f44242"
						};
				}else if(kategori == 2){
					return { //daerah dua
							fillOpacity: 0.5,
							weight: 1,
							opacity: 1,
							color: "#6d96f7"
						};

				}else{
					return { //daerah tiga
							fillOpacity: 0.8,
							weight: 1,
							opacity: 1,
							color: "#6d96f7"
						};

				}

				
			},
			//untuk setiap bidang menambahkan layer
			onEachFeature: function(feature, layer){
				// mendapatkan kode
				var kode = parseFloat(feature.properties.kode);

				$.getJSON(base_url+"home/foto/"+kode, function(data){
				
					var info_bidang ="<h5 style='text-align:center'>INFO BIDANG</h5>";
					info_bidang+="<a href='<?=base_url()?>home/bidang_detail/'"+kode+"'><img src='<?=base_url()?>assets/uploads/"+data+"' alt='maptime logo' height='180px' width='230px'/></a>";
					info_bidang+="<div style='width:100%;text-align:center;margin-top:10px;'><a href='<?=base_url()?>home/bidang_detail/"+kode+"'> Detail </a></div>";
					layer.bindPopup(info_bidang, {
						maxWidth : 260,
						closeButton : true,
						offset : L.point(0, -20)
					});

					layer.on('click', function(){
						layer.openPopup();
					});

				});
				//var info_bidang = "hello senin"+kode;
				//pop up sama antar bidang yang anda
				// var info_bidang ="<h5 style='text-align:center'>INFO BIDANG</h5>";
				// 	info_bidang+="<a href='<?=base_url()?>home/bidang_detail/'"+kode+"'><img src='https://bulelengkab.go.id/assets/instansikab/71/artikel/integrasi-dan-tekstual-dan-spasial-lahan-pertanian-pangan-berkelanjutan-lp2b-32.jpg' alt='maptime logo' height='180px' width='230px'/></a>";
				// 	info_bidang+="<div style='width:100%;text-align:center;margin-top:10px;'><a href='<?=base_url()?>home/bidang_detail/"+kode+"'> Detail </a></div>";
				// layer.bindPopup(info_bidang, {
				// 	maxWidth : 260,
				// 	closeButton : true,
				// 	offset : L.point(0, -20)
				// });

				// layer.on('click', function(){
				// 	layer.openPopup();
				// });

				
			}

		}).addTo(map);
    }); 

	
    
  </script>

</body>
</html>
