

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Transport List
      <small>Add, Edit, Delete</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url('Contract') ?>"> Transport List</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12 text-right">
        <div class="form-group">
         
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Transport List List</h3>
            <div class="box-tools">
          
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
          <div id="map"></div>
          </div><!-- /.box-body -->
         
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() {
   
  });
</script>

<script>

let map;
let directionsService;
let directionsRenderer;
const start ="<?php echo($source_name)?>";
const end ="<?php echo($destination_name)?>";
calculateAndDisplayRoute();
function initMap() {
    // Initialize map
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8
    });

    // Initialize Directions Service and Renderer
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);

    // Handle form submission
    document.getElementById('routeForm').addEventListener('submit', function(event) {
        event.preventDefault();
        calculateAndDisplayRoute();
    });
}

function calculateAndDisplayRoute() {
 

    directionsService.route({
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING, // or WALKING, BICYCLING, TRANSIT
        drivingOptions: {
            departureTime: new Date() // Set departure time to now for current traffic
        }
    }, (response, status) => {
        console.log(response);
        if (status === google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(response);
            // Extract and display traffic-related information
            displayTrafficInfo(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

function displayTrafficInfo(response) {
    const route = response.routes[0];
    const leg = route.legs[0];
    
    // Display total travel time with traffic
    const travelTimeWithTraffic = leg.duration_in_traffic.text;
    const travelTimeValueWithTraffic = leg.duration_in_traffic.value;
    console.log('Travel time with traffic:', travelTimeWithTraffic);

    // Optionally, display the travel time without traffic
    const travelTimeWithoutTraffic = leg.duration.text;
    console.log('Travel time without traffic:', travelTimeWithoutTraffic);
}

// Initialize map when the window loads
window.onload = initMap;

    </script>
