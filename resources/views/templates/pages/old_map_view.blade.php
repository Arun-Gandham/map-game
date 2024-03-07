@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}">
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/ui-modals.js') }}"></script>
@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style type="text/css">
        #map {
            height: 400px;
        }
    </style>
    <div class="container mt-5">
        <div id="map"></div>

    </div>
    <!-- Modal 2-->
    <div class="modal fade" id="modalToggle2" aria-hidden="true" aria-labelledby="modalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalToggleLabel2">Modal 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Hide this modal and show the first with the button below.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#modalToggle" data-bs-toggle="modal"
                        data-bs-dismiss="modal">Back to first</button>
                </div>
            </div>
        </div>
    </div>
    @php
        $locations = [];
        foreach ($points as $key => $point) {
            $locations[] = [
                $point->title,
                explode(',', $point->lat_long)[0],
                explode(',', $point->lat_long)[1],
                $point->type_obj->color ?? 'blue',
                $point->distance,
                $point->image,
                $point->description,
            ];
        }
    @endphp
    <script type="text/javascript">
        // // Initialize the map with the user's initial location
        // function initMap() {
        //     // Set up map options
        //     var mapOptions = {
        //         zoom: 15,
        //         mapTypeId: google.maps.MapTypeId.ROADMAP
        //     };

        //     // Create the map
        //     var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        //     // Initialize the Geolocation API
        //     if (navigator.geolocation) {
        //         // Get the user's initial location
        //         navigator.geolocation.getCurrentPosition(function(position) {
        //             var initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords
        //                 .longitude);

        //             // Set the map center to the user's initial location
        //             map.setCenter(initialLocation);

        //             // Create a marker for the user's initial location
        //             var marker = new google.maps.Marker({
        //                 position: initialLocation,
        //                 map: map,
        //                 title: 'Your Location'
        //             });

        //             // Update the user's location as they move
        //             navigator.geolocation.watchPosition(function(position) {
        //                 var newLocation = new google.maps.LatLng(position.coords.latitude, position.coords
        //                     .longitude);

        //                 // Update the marker position
        //                 marker.setPosition(newLocation);

        //                 // Center the map on the new location
        //                 map.setCenter(newLocation);
        //             });
        //         }, function() {
        //             handleLocationError(true, map.getCenter());
        //         });
        //     } else {
        //         // Browser doesn't support Geolocation
        //         handleLocationError(false, map.getCenter());
        //     }
        // }

        // // Handle errors in geolocation
        // function handleLocationError(browserHasGeolocation, pos) {
        //     var infoWindow = new google.maps.InfoWindow({
        //         map: map
        //     });
        //     infoWindow.setPosition(pos);
        //     infoWindow.setContent(browserHasGeolocation ?
        //         'Error: The Geolocation service failed.' :
        //         'Error: Your browser doesn\'t support geolocation.');
        // }


































        // Load the Google Maps API asynchronously
        function loadScript() {
            var script = document.createElement('script');
            script.src = "https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap";
            script.defer = true;
            script.async = true;
            document.body.appendChild(script);
        }

        // Call the loadScript function to load the Google Maps API
        window.onload = loadScript;

































        // const createMap = () => {
        //     return new google.maps.Map(document.getElementById('map'), {
        //         zoom: 15
        //     });
        // };

        // const createMarker = ({
        //     map,
        //     position
        // }) => {
        //     return new google.maps.Marker({
        //         map,
        //         position
        //     });
        // };

        // const getCurrentPosition = ({
        //     onSuccess,
        //     onError = () => {}
        // }) => {
        //     if ('geolocation' in navigator === false) {
        //         return onError(new Error('Geolocation is not supported by your browser.'));
        //     }

        //     return navigator.geolocation.getCurrentPosition(onSuccess, onError);
        // };

        // // New function to track user's location.
        // const trackLocation = ({
        //     onSuccess,
        //     onError = () => {}
        // }) => {
        //     if ('geolocation' in navigator === false) {
        //         return onError(new Error('Geolocation is not supported by your browser.'));
        //     }

        //     // Use watchPosition instead.
        //     return navigator.geolocation.watchPosition(onSuccess, onError);
        // };

        // function getCurrentLocationCords(onSuccess, onError) {
        //     if (!('geolocation' in navigator)) {
        //         onError(new Error('Geolocation is not supported by your browser.'));
        //         return;
        //     }

        //     navigator.geolocation.getCurrentPosition(function(position) {
        //         var lat = position.coords.latitude;
        //         var lng = position.coords.longitude;
        //         onSuccess({
        //             lat,
        //             lng
        //         });
        //     }, function(error) {
        //         onError(new Error('Error getting user\'s location: ' + error.message));
        //     });
        // }


        // const getPositionErrorMessage = code => {
        //     switch (code) {
        //         case 1:
        //             return 'Permission denied.';
        //         case 2:
        //             return 'Position unavailable.';
        //         case 3:
        //             return 'Timeout reached.';
        //         default:
        //             return null;
        //     }
        // }

        // function initMap() {
        //     const map = createMap();
        //     const marker = createMarker({
        //         map
        //     });



        //     trackLocation({
        //         onSuccess: ({
        //             coords: {
        //                 latitude: lat,
        //                 longitude: lng
        //             }
        //         }) => {
        //             console.log(lat, lng);
        //             marker.setPosition({
        //                 lat,
        //                 lng
        //             });
        //             map.panTo({
        //                 lat,
        //                 lng
        //             });
        //         },
        //         onError: err =>
        //             alert(`Error: ${getPositionErrorMessage(err.code) || err.message}`)
        //     });
        //     // setInterval(() => {
        //     //     console.log(getCurrentLocationCords());
        //     //     marker.setPosition(getCurrentLocationCords());
        //     // }, 3000);
        // }








        // function getCurrentLocation(onSuccess, onError) {
        //     if (!('geolocation' in navigator)) {
        //         onError(new Error('Geolocation is not supported by your browser.'));
        //         return;
        //     }

        //     // Continuously watch for changes in the user's position
        //     var watchId = navigator.geolocation.watchPosition(function(position) {
        //         var lat = position.coords.latitude;
        //         var lng = position.coords.longitude;
        //         onSuccess({
        //             lat,
        //             lng
        //         });
        //     }, function(error) {
        //         onError(new Error('Error getting user\'s location: ' + error.message));
        //     });

        //     // Optionally, return the watchId if you want to clear the watch later
        //     return watchId;
        // }
        // var userMarker;

        // function loadMapWithLocation(lat, lng) {
        //     const map = new google.maps.Map(document.getElementById('map'), {
        //         zoom: 10,
        //         center: {
        //             lat,
        //             lng
        //         },
        //     });

        //     // Add marker for user's location
        //     userMarker = new google.maps.Marker({
        //         position: {
        //             lat,
        //             lng
        //         },
        //         map: map,
        //         title: 'Your Location'
        //     });

        //     // Optionally, you can perform additional map-related operations here
        // }


        // function initMap() {
        //     // Call getCurrentLocation and then loadMapWithLocation
        //     getCurrentLocation(function(coordinates) {
        //         var map = loadMapWithLocation(coordinates.lat, coordinates.lng);

        //         // Set up marker for the user's location
        //         userMarker = new google.maps.Marker({
        //             position: {
        //                 lat: coordinates.lat,
        //                 lng: coordinates.lng
        //             },
        //             map: map,
        //             title: 'Your Location'
        //         });

        //         // Update marker and map center every second
        //         setInterval(() => {
        //             getCurrentLocation(function(newCoordinates) {
        //                 userMarker.setPosition({
        //                     lat: newCoordinates.lat,
        //                     lng: newCoordinates.lng
        //                 });
        //             }, function(error) {
        //                 console.error(error.message); // Handle error
        //             });
        //         }, 1000);
        //     }, function(error) {
        //         console.error(error.message); // Handle error
        //     });
        // }











        // var map;
        // var userMarker;

        // function initMap() {

        //     map = new google.maps.Map(document.getElementById("map"), {
        //         zoom: 10,
        //         styles: [{
        //                 featureType: "poi",
        //                 elementType: "labels",
        //                 stylers: [{
        //                     visibility: "off"
        //                 }] // Hide POI labels
        //             },
        //             {
        //                 featureType: "poi",
        //                 stylers: [{
        //                     visibility: "off"
        //                 }] // Hide all POIs
        //             }
        //         ]
        //     });

        //     // Update user's current location and map center every time it changes
        //     if (navigator.geolocation) {
        //         navigator.geolocation.watchPosition(function(position) {
        //             var userLatLng = new google.maps.LatLng(position.coords.latitude, position.coords
        //                 .longitude);
        //             if (!map.getCenter()) {
        //                 // Center the map on the user's location if it's not already centered
        //                 map.setCenter(userLatLng);
        //                 map.setZoom(10); // You can adjust the zoom level as needed
        //             }
        //             updateMapWithUserLocation(userLatLng);
        //             infowindow = new google.maps.InfoWindow();
        //             var locations = {{ Js::from($locations) }};
        //             //------------------------
        //             for (i = 0; i < locations.length; i++) {

        //                 marker = new google.maps.Marker({
        //                     position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        //                     map: map,
        //                     icon: {
        //                         path: google.maps.SymbolPath.CIRCLE,
        //                         scale: 10,
        //                         fillColor: locations[i][3], // CSS color for each location
        //                         fillOpacity: 1,
        //                         strokeWeight: 2
        //                     }
        //                 });

        //                 marker.addListener('click', function() {
        //                     // Open the modal when marker is clicked
        //                     $('#modalToggle2').modal('show');
        //                 });

        //                 google.maps.event.addListener(marker, 'click', (function(marker, i) {
        //                     return function() {
        //                         infowindow.setContent(locations[i][0]);
        //                         infowindow.open(map, marker);
        //                     }
        //                 })(marker, i));

        //             }

        //             // --------------------------


        //         }, function(error) {
        //             window.loca
        //             console.log("Error getting user's location: " + error.message);
        //         }, {
        //             enableHighAccuracy: true,
        //             maximumAge: 0,
        //             timeout: 5000
        //         });
        //     } else {
        //         alert("Geolocation is not supported by this browser.");
        //     }
        // }

        // // Load the map asynchronously
        // function loadMapScript() {
        //     var script = document.createElement("script");
        //     script.src =
        //         "https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap";
        //     script.async = true;
        //     document.body.appendChild(script);
        // }


        // // Call the function to load the map
        // loadMapScript();


        // function updateMapWithUserLocation(userLatLng) {
        //     if (!userMarker) {
        //         userMarker = new google.maps.Marker({
        //             position: userLatLng,
        //             map: map,
        //             icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
        //             title: 'Your Location'
        //         });
        //     } else {
        //         userMarker.setPosition(userLatLng);
        //     }
        //     map.setCenter(userLatLng);
        //     console.log("User's location updated:", userLatLng.lat(), userLatLng.lng());
        // }












        // -------------------------------





        //     function initMap() {









        //         function calculateDistance(coord1, coord2) {
        //             // Convert latitude and longitude to Google Maps LatLng objects
        //             var latLng1 = new google.maps.LatLng(coord1.lat, coord1.lng);
        //             var latLng2 = new google.maps.LatLng(coord2.lat, coord2.lng);

        //             // Calculate the distance between the two coordinates
        //             var distance = google.maps.geometry.spherical.computeDistanceBetween(latLng1, latLng2);

        //             return distance; // Distance in meters
        //         }

        //         // Example usage
        //         var coord1 = {
        //             lat: 17.46221,
        //             lng: 78.35685
        //         };
        //         var coord2 = {
        //             lat: 17.4372271,
        //             lng: 78.3883479
        //         };
        //         setInterval(() => {
        //             var distance = calculateDistance(coord1, coord2);
        //             console.log("Distance between coordinates: " + distance.toFixed(2) + " Meters");
        //         }, 5000);



















        //         const myLatLng = {
        //             lat: 17.4372271,
        //             lng: 78.3883479
        //         };
        //         const map = new google.maps.Map(document.getElementById("map"), {
        //             zoom: 10,
        //             center: myLatLng,
        //         });



        //         var locations = {{ Js::from($locations) }};

        //         var infowindow = new google.maps.InfoWindow();

        //         var marker, i;
        //         marker = new google.maps.Marker({
        //             position: new google.maps.LatLng(myLatLng),
        //             map: map,
        //             icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png', // icon for current location
        //             title: 'Your Location'
        //         });

        //         google.maps.event.addListener(marker, 'click', (function(marker) {
        //             return function() {
        //                 infowindow.setContent("Your Location");
        //                 infowindow.open(map, marker);
        //             }
        //         })(marker));
        //         for (i = 0; i < locations.length; i++) {
        //             marker = new google.maps.Marker({
        //                 position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        //                 map: map
        //             });

        //             google.maps.event.addListener(marker, 'click', (function(marker, i) {
        //                 return function() {
        //                     infowindow.setContent(locations[i][0]);
        //                     infowindow.open(map, marker);
        //                 }
        //             })(marker, i));

        //         }

        //         updateMyLocation()
        //     }

        //     function updateMyLocation() {
        //         if (navigator.geolocation) {
        //             navigator.geolocation.watchPosition(function(position) {
        //                 console.log(position.coords.latitude, position.coords.longitude);
        //             });
        //         }
        //     }

        //     window.initMap = initMap;
        // 
    </script>


    {{-- <script type="text/javascript" 
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
    
    <script 
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=geometry&callback=initMap" //
        async defer></script> --}}
@endsection
