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
        <button onclick="refreshLocation()">Refresh</button>

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
        $locations = [
            ['Kondapur', 17.46221, 78.35685],
            ['Baridhara', 23.808117739943608, 90.44537670239676],
            ['300 Fit ', 23.836538363288035, 90.4658279948394],
            ['Tongi', 23.901545202737925, 90.40824277591372],
            ['Dhamrai', 23.914649046324804, 90.21735533044152],
            ['Manikganj', 23.86481597833292, 90.00501020845859],
        ];
    @endphp
    <script type="text/javascript">
        var map;
        var userMarker;

        function refreshLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(function(position) {
                    var userLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    updateMapWithUserLocation(userLatLng);
                });
            }
        }

        function initMap() {

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                styles: [{
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [{
                            visibility: "off"
                        }] // Hide POI labels
                    },
                    {
                        featureType: "poi",
                        stylers: [{
                            visibility: "off"
                        }] // Hide all POIs
                    }
                ]
            });

            // Update user's current location and map center every time it changes
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(function(position) {
                    var userLatLng = new google.maps.LatLng(position.coords.latitude, position.coords
                        .longitude);
                    if (!map.getCenter()) {
                        // Center the map on the user's location if it's not already centered
                        map.setCenter(userLatLng);
                        map.setZoom(10); // You can adjust the zoom level as needed
                    }
                    updateMapWithUserLocation(userLatLng);
                    infowindow = new google.maps.InfoWindow();
                    var locations = {{ Js::from($locations) }};
                    //------------------------
                    for (i = 0; i < locations.length; i++) {

                        // Sample array
                        var array = ["#198754", "#20c997", "#343a40", "#f8f9fa", "#ffc107"];

                        // Get random index
                        var randomIndex = Math.floor(Math.random() * array.length);
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            map: map,
                            icon: {
                                path: google.maps.SymbolPath.CIRCLE,
                                scale: 10,
                                fillColor: array[randomIndex], // CSS color for each location
                                fillOpacity: 1,
                                strokeWeight: 2
                            }
                        });

                        marker.addListener('click', function() {
                            // Open the modal when marker is clicked
                            $('#modalToggle2').modal('show');
                        });

                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                infowindow.setContent(locations[i][0]);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));

                    }

                    // --------------------------


                }, function(error) {
                    window.loca
                    console.log("Error getting user's location: " + error.message);
                }, {
                    enableHighAccuracy: true,
                    maximumAge: 0,
                    timeout: 5000
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Load the map asynchronously
        function loadMapScript() {
            var script = document.createElement("script");
            script.src = "https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap";
            script.async = true;
            document.body.appendChild(script);
        }


        // Call the function to load the map
        loadMapScript();


        function updateMapWithUserLocation(userLatLng) {
            if (!userMarker) {
                userMarker = new google.maps.Marker({
                    position: userLatLng,
                    map: map,
                    icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                    title: 'Your Location'
                });
            } else {
                userMarker.setPosition(userLatLng);
            }
            map.setCenter(userLatLng);
            console.log("User's location updated:", userLatLng.lat(), userLatLng.lng());
        }












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
