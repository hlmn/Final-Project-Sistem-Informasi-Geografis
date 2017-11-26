@extends('layouts.layoutMap')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card text-center">
      <div class="card-header">
        Featured
      </div>
      <div class="card-body">
        <h4 class="card-title">Special title treatment</h4>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
      <div class="card-footer text-muted">
        2 days ago
      </div>
    </div>
  </div>
</div>



@endsection

@section('js')
  <script>
    function initMap() {
      // Create a map object and specify the DOM element for display.
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 8
      });
    }
    $(function(){
        var map;
        var poly;
        var flag = 0;
        var draw;
        // jqdoEe_rp[j[{o|BxydBroaA
        // window.initMap = function(){
        //  map = new google.maps.Map(document.getElementById('map'), {
        //    center: {lat: -34.397, lng: 150.644},
        //    zoom: 8
        //  });
        //  var ea = google.maps.geometry.encoding.decodePath('{{"xocqEa_ys[lbU{ccDz}DgiiDzhxAyxb@t~Hhr`Dykk@haxDggnCgdwB|eEztyDhxg@qheD~sAfumC"}}');
        //  console.log(ea);
        //  var drawingManager = new google.maps.drawing.DrawingManager({
        //      drawingMode: null,
        //      // polygonOptions: {
        //      //  editable: true,
        //      //  paths: ea
        //      // },
        //      drawingControl: true,
        //      drawingControlOptions: {
        //        position: google.maps.ControlPosition.TOP_CENTER,
        //        drawingModes: []

        //      },
        //  });
        //  var bermudaTriangle = new google.maps.Polygon({
        //      paths: ea,
        //      editable:true
        //  });

        //  draw = bermudaTriangle;
        //  compute();
        //  bermudaTriangle.setMap(map);
        //  bermudaTriangle.addListener('set_at', compute);
        //  bermudaTriangle.getPaths().forEach(function(path, index){

        //    google.maps.event.addListener(path, 'insert_at', compute);

        //    google.maps.event.addListener(path, 'remove_at', compute);

        //    google.maps.event.addListener(path, 'set_at', compute);

        //  });
        //    drawingManager.setMap(map);
        // }

        window.initMap = function () {
          map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 17
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
              console.log('gagal')
              // handleLocationError(true, infoWindow, map.getCenter());
            });
          } 
          else {
            console.log('gagal')
            // Browser doesn't support Geolocation
            // handleLocationError(false, infoWindow, map.getCenter());
          }

          drawingManager.setMap(map);
          drawingManager.addListener('overlaycomplete', function(e){
            drawingManager.setDrawingMode(null)
            drawingManager.setOptions({
              drawingControl: false,
            })
            console.log('a');
            
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
        function compute(event){
          var area = google.maps.geometry.spherical.computeArea(draw.getPath())
          console.log(area);

          var list = google.maps.geometry.encoding.encodePath(draw.getPath());
          console.log(list);
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
    })

  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCysQlJTZGqeY2wM1jwYm-Axq8d6b0Zp08&callback=initMap&libraries=drawing,geometry"></script>
@endsection