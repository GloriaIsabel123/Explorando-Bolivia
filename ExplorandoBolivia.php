<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Visor Simple OpenLayers</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.12/theme/default/style.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.12/OpenLayers.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js? AIzaSyC1mkVZoCS5xDsaoNyTroYt1TbmkhUoVLM&callback=initMap"
  type="text/javascript"></script>

	<style type="text/css">
		html, body {
			height: 100%;
			width: 100%;
			margin: 0;
		}
		.cabecera{
			height: 50px;
			background-color:blue;
		}
		.cabecera h2{
			color: #fff;
			margin-top: 0;
		}
		#mapa{
			height: 300px;
			width: 600px;
			border: solid 3px blue;
		}
		
	</style>
	<script type="text/javascript">
		var init = function(){

			var proyeccion = new OpenLayers.Projection("EPSG:900913"); //EPSG:900913
			var cn = new OpenLayers.Control.Navigation();
			var cz = new OpenLayers.Control.PanZoomBar(); // Zoom

			// Propiedades del objeto Map
			var propiedades = {
				projection: proyeccion,
				units: 'm',
				controls: [cn, cz]
			};

			//Creación de una instancia de la clase Map
			var map = new OpenLayers.Map("mapa", propiedades);	

			// Capa OSM
			var layerOSM = new OpenLayers.Layer.OSM();
			map.addLayer(layerOSM);

			var layerGoogleTerrain = new OpenLayers.Layer.Google("Google Terrain",{type:google.maps.MapTypeId.TERRAIN});

			map.addLayer(layerGoogleTerrain);
	

			var controlCapas = new OpenLayers.Control.LayerSwitcher();
			map.addControl(controlCapas);

        }
		// Cargamos la función init, para desplegar el mapa
		window.onload = init;
	
	</script>
</head>
<body>
	<div class="cabecera">
		<h2>Visor Simple OpenLayers</h2>
	</div>
	<div id="mapa"></div>
</body>
</html>