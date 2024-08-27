<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Maps Routing</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Get Directions with Google Maps</h1>
    <form id="routeForm">
        <label for="start">Start:</label>
        <input type="text" id="start" placeholder="Start location">
        <label for="end">End:</label>
        <input type="text" id="end" placeholder="End location">
        <button type="submit">Get Directions</button>
    </form>
    <div id="map"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6HBpHxcgpVgxAcaVso4vYU9l-_WML5EM&libraries=places"></script>
    <script>

let map;
let directionsService;
let directionsRenderer;

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
    const start = document.getElementById('start').value;
    const end = document.getElementById('end').value;

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
    console.log('Travel time with traffic:', travelTimeWithTraffic);

    // Optionally, display the travel time without traffic
    const travelTimeWithoutTraffic = leg.duration.text;
    console.log('Travel time without traffic:', travelTimeWithoutTraffic);
}

// Initialize map when the window loads
window.onload = initMap;

    </script>
</body>
</html>
