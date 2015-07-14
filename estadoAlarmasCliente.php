<?php 
session_start();
// session_destroy();
		// if(!isset($_SESSION['usuario'])){
		// 	session_destroy();
		// 	header('location: index.php?nError=10');
			
		// }

include_once ("php/clases.php");
include_once ("php/funciones.php");
include_once('header.php');
include_once ('aside_monitoreador.php');

?>
<head>
<script	src="http://maps.googleapis.com/maps/api/js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script>
	jQuery.ajax({
        url:"consultarEstadoAlarmas.php",
        type:"POST",
        dataType:'json',
    })

    .done(function(data){ // Data es el valor devuelto del ajax, en este caso tipo JSON


	var myCenter=new google.maps.LatLng(-34.61611560244965,-58.39679718017578);

	var mapProp = {
	  center:myCenter,
	  zoom:13,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

	for(var i in data) {

		var infowindow = new google.maps.InfoWindow();

	    var informationString = '<div>'+
	    						'<div><strong>Domicilio: </strong><br>'+data[i].direccion+' '+data[i].num_direccion+'</div>'+
	    						'<div><strong>Titular: </strong><br>'+data[i].nombres+' '+data[i].apellidos+'</div>'+
	    						'</div>';
	    						
	    						

		if (data[i].estado=='E') {
		var myLatlng=new google.maps.LatLng(data[i].latitud,data[i].longitud);

		var marker=new google.maps.Marker({
		  position:myLatlng,
		  icon:'img/marker_green.png'
		  });


		google.maps.event.addListener(marker,'click', (function(marker,informationString,infowindow){ 
        return function() {
           infowindow.setContent(informationString);
           infowindow.open(map,marker);
        };
		})(marker,informationString,infowindow)); 	     
 

		marker.setMap(map);
		}



		if (data[i].estado=='C') {

		informationString = informationString+"<a href='tel:911' style='color: rgb(17, 19, 194);font-weight: bold;''>LLAMAR 911</a>";

		
		
		var myLatlng=new google.maps.LatLng(data[i].latitud,data[i].longitud);

		var marker=new google.maps.Marker({
		  position:myLatlng,
		  map: map,
		  icon:'img/marker_red.png'
		  });

		google.maps.event.addListener(marker,'click', (function(marker,informationString,infowindow){ 
        return function() {
           infowindow.setContent(informationString);
           infowindow.open(map,marker);
        };
		})(marker,informationString,infowindow)); 	     
 
		   
		marker.setMap(map);	

		}	
	
	}

	google.maps.event.addDomListener(window, 'load');
	
	});
	

</script>
</head>

</head>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
	    <div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3">Estado de alarmas</h1>
	    </div>
   		<div class="panel-body">
			<div class='col-sm-7'>
			 	<div id="googleMap" style="width:1000px;height:600px;"></div> 
			</div>
		</div>	
	</div>
</div>	
<?php include_once('footer.php') ?>