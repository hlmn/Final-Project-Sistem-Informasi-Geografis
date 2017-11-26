@extends('layouts.adminlayout')
@section('gaya')
<style type="text/css">
	#map {
		/*height: 100%; */
		width: 100%;
		/*overflow: none;*/
	}
	#description {
		font-family: Roboto;
		font-size: 15px;
		font-weight: 300;
	}

	#infowindow-content .title {
		font-weight: bold;
	}

	#infowindow-content {
		display: none;
	}

	#map #infowindow-content {
		display: inline;
	}

	.pac-card {
		margin: 40px 17px 0 0;
		border-radius: 2px 0 0 2px;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		outline: none;
		box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
		background-color: #fff;
		font-family: Roboto;
		width: 51vh
	}

	#pac-container {
		padding-bottom: 12px;
		margin-right: 12px;
	}

	.pac-controls {
		display: inline-block;
		padding: 5px 11px;
	}

	.pac-controls label {
		font-family: Roboto;
		font-size: 13px;
		font-weight: 300;
	}

	#pac-input {
		background-color: #fff;
		font-family: Roboto;
		font-size: 15px;
		font-weight: 300;
		margin: 10px 10px 0px 5px;
		padding: 0 11px 0 13px;
		text-overflow: ellipsis;
		width: 100%;
	}

	#pac-input:focus {
		border-color: #4d90fe;
	}

	#title {
		color: #fff;
		background-color: #4d90fe;
		font-size: 25px;
		font-weight: 500;
		padding: 6px 12px;
	}
	

</style>
@endsection
@section('content')
	<section>
	<div class="pac-card" id="pac-card">
        <div>
          <div id="title">
            Search
          </div>
          {{-- <div id="type-selector" class="pac-controls">
            <input type="radio" name="type" id="changetype-all" checked="checked">
            <label for="changetype-all">All</label>

            <input type="radio" name="type" id="changetype-establishment">
            <label for="changetype-establishment">Establishments</label>

            <input type="radio" name="type" id="changetype-address">
            <label for="changetype-address">Addresses</label>

            <input type="radio" name="type" id="changetype-geocode">
            <label for="changetype-geocode">Geocodes</label>
          </div>
          <div id="strict-bounds-selector" class="pac-controls">
            <input type="checkbox" id="use-strict-bounds" value="">
            <label for="use-strict-bounds">Strict Bounds</label>
          </div> --}}
        </div>
        <div id="pac-container">
          <input id="pac-input" type="text"
              placeholder="Enter a location" class="form-control">
        </div>
      </div>
	<div id="map">
	          	
	</div>
	</section>
	
{{-- <div class="row">
	<div class="col-md-12" >
		<div class="box">
	        <div class="box-header with-border">
	          <h3 class="box-title">Title</h3>

	          <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
	              <i class="fa fa-minus"></i></button>
	            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
	              <i class="fa fa-times"></i></button>
	          </div>
	        </div>
	        <div class="box-body">
	          
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	          
	        </div>
	        <!-- /.box-footer-->
      </div>
      
	</div>
</div> --}}
@endsection
@section('footer')
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Luas:</label>
      <p><span id="luas">0</span> m<sup>2</sup></p>
      {{-- <input type="text" name=""  class="form-control"> --}}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Keliling:</label>
      <p><span id="keliling">0</span> m</p>
      {{-- <input type="text" name=""  class="form-control"> --}}
    </div>

  </div>
  <div class="col-md-3">
    	<button class="btn btn-danger" id="reset">Clear Map</button>
    	<form style="display: inline;" id="form" method="POST" action="{{route('submit.polygon')}}">
    		<input type="hidden" id="path" name="path"  class="form-control">
    		{{csrf_field()}}
			{{-- <input type="text" name=""  class="form-control"> --}}
    		<button class="btn btn-primary" type="submit">Submit</button>
    	</form>
    	
   </div>
</div>
@endsection

@section('js')

<script type="text/javascript">

	// $(document).ready(function () {
 //        var contentHeigh = $("body > #wrapper").height() - 100;
 //        $('#map').css("height", contentHeigh + "px");
 //    });
	$(function(){
		var contentHeight = $("#wrapper").height();
		console.log(contentHeight)
        $('#map').css("height", contentHeight + "px");

		// var window_height = $(window).height(), header_height = $(".main-header").height();
		// $("#myDiv").css("height", window_height - header_height);
		var map;
		var poly;
		var flag = 0;
		var draw;
		var infoWindow;

		// jqdoEe_rp[j[{o|BxydBroaA
		// window.initMap = function(){
		// 	map = new google.maps.Map(document.getElementById('map'), {
		// 	  center: {lat: -34.397, lng: 150.644},
		// 	  zoom: 8
		// 	});
		// 	var ea = google.maps.geometry.encoding.decodePath('{{"xocqEa_ys[lbU{ccDz}DgiiDzhxAyxb@t~Hhr`Dykk@haxDggnCgdwB|eEztyDhxg@qheD~sAfumC"}}');
		// 	console.log(ea);
		// 	var drawingManager = new google.maps.drawing.DrawingManager({
		// 	    drawingMode: null,
		// 	    // polygonOptions: {
		// 	    // 	editable: true,
		// 	    // 	paths: ea
		// 	    // },
		// 	    drawingControl: true,
		// 	    drawingControlOptions: {
		// 	      position: google.maps.ControlPosition.TOP_CENTER,
		// 	      drawingModes: []

		// 	    },
		// 	});
		// 	var bermudaTriangle = new google.maps.Polygon({
		// 	    paths: ea,
		// 	    editable:true
		// 	});

		// 	draw = bermudaTriangle;
		// 	compute();
		// 	bermudaTriangle.setMap(map);
		// 	bermudaTriangle.addListener('set_at', compute);
		// 	bermudaTriangle.getPaths().forEach(function(path, index){

		// 	  google.maps.event.addListener(path, 'insert_at', compute);

		// 	  google.maps.event.addListener(path, 'remove_at', compute);

		// 	  google.maps.event.addListener(path, 'set_at', compute);

		// 	});
		//   	drawingManager.setMap(map);
		// }
		/* get center of a polygon */
		// var lat = myPolygon.my_getBounds().getCenter().lat();
		// var lng = myPolygon.my_getBounds().getCenter().lng();
		window.initMap = function () {
			map = new google.maps.Map(document.getElementById('map'), {
			  center: {lat: -34.397, lng: 150.644},
			  zoom: 17,
			  fullscreenControl: false
			});
			var drawingManager = new google.maps.drawing.DrawingManager({
			    drawingMode: google.maps.drawing.OverlayType.POLYGON,
			    polygonOptions: {
			    	editable: true,
			    },
			    drawingControl: true,
			    drawingControlOptions: {
			      position: google.maps.ControlPosition.TOP_CENTER,
			      drawingModes: ['polygon']
			    },
			});
			infoWindow = new google.maps.InfoWindow;
			var card = document.getElementById('pac-card');
	        var input = document.getElementById('pac-input');
	        // var types = document.getElementById('type-selector');
	        // var strictBounds = document.getElementById('strict-bounds-selector');
	        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
	        var autocomplete = new google.maps.places.Autocomplete(input);
	        autocomplete.bindTo('bounds', map);
	        // var infowindow = new google.maps.InfoWindow();
	        // var infowindowContent = document.getElementById('infowindow-content');
	        // infowindow.setContent(infowindowContent);
	        // var marker = new google.maps.Marker({
	        //   map: map,
	        //   anchorPoint: new google.maps.Point(0, -29)
	        // });
	        autocomplete.addListener('place_changed', function() {
	          // infowindow.close();
	          // marker.setVisible(false);
	          var place = autocomplete.getPlace();
	          if (!place.geometry) {
	            // User entered the name of a Place that was not suggested and
	            // pressed the Enter key, or the Place Details request failed.
	            window.alert("No details available for input: '" + place.name + "'");
	            return;
	          }

	          // If the place has a geometry, then present it on a map.
	          if (place.geometry.viewport) {
	            map.fitBounds(place.geometry.viewport);
	            console.log('a');
	          } else {
	            map.setCenter(place.geometry.location);
	            console.log('b')
	            map.setZoom(17);  // Why 17? Because it looks good.
	          }
	          // marker.setPosition(place.geometry.location);
	          // marker.setVisible(true);

	          var address = '';
	          if (place.address_components) {
	            address = [
	              (place.address_components[0] && place.address_components[0].short_name || ''),
	              (place.address_components[1] && place.address_components[1].short_name || ''),
	              (place.address_components[2] && place.address_components[2].short_name || '')
	            ].join(' ');
	          }


	          // infowindowContent.children['place-icon'].src = place.icon;
	          // infowindowContent.children['place-name'].textContent = place.name;
	          // infowindowContent.children['place-address'].textContent = address;
	          // infowindow.open(map, marker);
	        });
        // Try HTML5 geolocation.
	        if (navigator.geolocation) {
	          navigator.geolocation.getCurrentPosition(function(position) {
	            var pos = {
	              lat: position.coords.latitude,
	              lng: position.coords.longitude
	            };

	            // infoWindow.setPosition(pos);
	            // infoWindow.setContent('Location found.');
	            // infoWindow.open(map);
	            map.setCenter(pos);
	          }, function() {
	            // handleLocationError(true, infoWindow, map.getCenter());
	          });
	        } 
	        else {
	          // Browser doesn't support Geolocation
	          // handleLocationError(false, infoWindow, map.getCenter());
	        }
	        // setTimeout(function () { map.invalidateSize() }, 500);

		  	drawingManager.setMap(map);
		  	drawingManager.addListener('overlaycomplete', function(e){
		  	drawingManager.setDrawingMode(null)
		  	drawingManager.setOptions({
		  		drawingControl: false,
		  	})
		  	// console.log('a');
		  	
		  	var newShape = e.overlay;
		  	draw = newShape;
		  	compute();
			newShape.type = e.type;
			newShape.addListener('click', function() {
				var area = google.maps.geometry.spherical.computeLength(newShape.getPath())
				console.log(area);
				
			});
			newShape.addListener('set_at', compute);
			newShape.getPaths().forEach(function(path, index){

			  google.maps.event.addListener(path, 'insert_at', compute);

			  google.maps.event.addListener(path, 'remove_at', compute);

			  google.maps.event.addListener(path, 'set_at', compute);

			});
		  });
		
		}
		function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	        infoWindow.setPosition(pos);
	        infoWindow.setContent(browserHasGeolocation ?
	                              'Error: The Geolocation service failed.' :
	                              'Error: Your browser doesn\'t support geolocation.');
	        infoWindow.open(map);
	    }
		function compute(event){
			var area = google.maps.geometry.spherical.computeArea(draw.getPath())
			console.log(area);
			$('#luas').html(area);
			var length = google.maps.geometry.spherical.computeLength(draw.getPath())
			console.log(length);
			$('#keliling').html(length);

			// var list = google.maps.geometry.encoding.encodePath(draw.getPath());
			// console.log(list);
		}
		function changed(event){
			console.log('a')
		}
		function addLatLng(event) {
			if(flag > 2) return false
			++flag;
	        var path = poly.getPath();
	        path.push(event.latLng);

	    }

	    function removeMarker(event){
	    	console.log(event)
	    }



	    $('#reset').on('click', function(){
	    	// draw.setMap(null);
	    	draw.getPaths().clear();
	    	initMap()
	    	// draw.setMap(map)
	    });
	    $('#form').submit(function(event){
	    	var list = google.maps.geometry.encoding.encodePath(draw.getPath());
	    	$('#path').val(list);
	    })
	})
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCysQlJTZGqeY2wM1jwYm-Axq8d6b0Zp08&callback=initMap&libraries=drawing,geometry,places"></script>
{{-- <script async defer src="https://maps.googleapis.com/maps/api/distancematrix/json?origins=Vancouver+BC|Seattle&destinations=San+Francisco|Victoria+BC&mode=bicycling&language=fr-FR&key=AIzaSyBcqKAtve0aOjxImkUxJT4NlhjoDWljZrw"></script> --}}

@endsection