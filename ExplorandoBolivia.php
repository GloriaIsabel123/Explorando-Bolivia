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
		div{
        
		}
		.cabecera{
			height: 50px;
			width: 100%;
			background-color:blue;
			text-align: center;
			color:white;
		}
		.cabecera h2{
			color: #fff;
			margin-top: 0;
			text-align: center;
		}
		#visor{
            height:500px;
            width: 800px;
            border: solid 3px blue;
            border: 10px;
		}
		#tituto_visor{
		color: #acc236 !important;	
		height: 10%;
		width: 100%;
	    border-top-left-radius: 10px;
	    border-top-right-radius: 10px; 
	    text-align: center;
	    background-color:  rgba(0, 0,255, 0.8);
		}

		#mapa{
			height: 90%;
			width: 100%;
		}

	</style>
	<script type="text/javascript">
		var init = function(){

			var cn = new OpenLayers.Control.Navigation();
			var cz = new OpenLayers.Control.PanZoomBar(); 
			OpenLayers.ProxyHost="/cgi-bin/proxy.cgi?url="; 
            
			var fromProjection = new OpenLayers.Projection("EPSG:4326"); 
    		var toProjection = new OpenLayers.Projection("EPSG:900913");		
            
            var extension = new OpenLayers.Bounds(-71.54296875,-24.3671135627,-56.07421875,-7.3624668655).transform(fromProjection,toProjection);
    		
			var propiedades = {
				maxExtent : extension,
				displayProjection: fromProjection,
				projection: toProjection,
				units: 'm',
				controls: [cn, cz]
			};

			var map = new OpenLayers.Map("mapa", propiedades);	

			var layerOSM = new OpenLayers.Layer.OSM();
			map.addLayer(layerOSM);

			var layerGoogleTerrain = new OpenLayers.Layer.Google("Google Terrain",{type:google.maps.MapTypeId.TERRAIN});

			map.addLayer(layerGoogleTerrain);
	

			var controlCapas = new OpenLayers.Control.LayerSwitcher();
			map.addControl(controlCapas);
            
            
    		var LonLat = new OpenLayers.LonLat(-64.819336, -17.379999);
			var zoom = 5;
			var LonLatTransformado = LonLat.transform(
				fromProjection,
				map.getProjection() 
			);
			map.setCenter(LonLatTransformado, zoom);
           
            
			var layer_departamento = new OpenLayers.Layer.WMS(
				"Departamentos",
				"http://192.168.43.124:8080/geoserver/wms",
				{
					layers: 'curso_gis:tbl_departamento',
					transparent: true
				}
			);

			map.addLayer(layer_departamento);
			layer_departamento.setVisibility(false);

			var layer_provincia = new OpenLayers.Layer.WMS(
				"Provincias",
				"http://192.168.43.124:8080/geoserver/wms",
				{
					layers: 'curso_gis:tbl_provincia',
					transparent: true
				}
			);

			map.addLayer(layer_provincia);
			layer_provincia.setVisibility(false);

			var layer_lago = new OpenLayers.Layer.WMS(
				"Lagos",
				"http://192.168.43.124:8080/geoserver/wms",
				{
					layers: 'curso_gis:tbl_lago',
					transparent: true
				}
			);

			map.addLayer(layer_lago);
			layer_lago.setVisibility(false);

			var layer_salar = new OpenLayers.Layer.WMS(
				"Salares",
				"http://192.168.43.124:8080/geoserver/wms",
				{
					layers: 'curso_gis:tblsalar',
					transparent: true
				}
			);

			map.addLayer(layer_salar);
			layer_salar.setVisibility(false);

			var layer_areaProtegida = new OpenLayers.Layer.WMS(
				"Areas Protegidas",
				"http://192.168.43.124:8080/geoserver/wms",
				{
					layers: 'curso_gis:tblprotegidas',
					transparent: true
				}
			);

			map.addLayer(layer_areaProtegida);
			layer_areaProtegida.setVisibility(false);

			OpenLayers.Util.onImageLoadError = function() {
            this.src = "image/bolivia_te_espera.png";
            };

            var controlinfo = new OpenLayers.Control.WMSGetFeatureInfo({
	        queryVisible: true,
	        eventListeners: {
		    getfeatureinfo: function (event){
			var info=document.getElementById("informacion");
			info.innerHTML()=event.text;
		    }
	        }
            });
            map.addControl(controlinfo);
            controlinfo.activate();
            }
          
		window.onload = init;
	
	</script>
</head>
<body>
	<div class="cabecera">
		<h1>MINISTERIO DE CULTURAS Y DEPORTES</h1>
	</div>
	<div id='visor'>
	<div id='tituto_visor'><h2>Explora Bolivia</h2></div>
	<div id="mapa"></div>
	</div>
    
    <div id="informacion"></div>

</body>
</html>