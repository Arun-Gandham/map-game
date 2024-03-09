@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />
    <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/ui-carousel.css') }}" />
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
    <script src="{{ asset('assets/js/ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/ui-carousel.js') }}"></script>
@endsection


@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style type="text/css">
        #map {
            height: 400px;
        }
    </style>
    <div data-bs-spy="scroll" class="scrollspy-example">
        <div class="container mt-5">
            <div id="map" style="display: none;"></div>
            <h1>The Hunt</h1>
            <div class="row">
                <!-- Bootstrap carousel -->
                <div class="col-md">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        {{-- <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
                        </ol> --}}
                        <div class="carousel-inner">
                            @if (count(unserialize($game->image)))
                                @foreach (unserialize($game->image) as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img class="d-block w-100 h-50" src="{{ asset($image) }}" alt="First slide" />
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <h3>{{ $game->name }}</h3>
            <p>{{ $game->description }}</p>
            <form action="{{ route('show.game.submit', $game->id) }}" method="post">
                @csrf
                <input type="text" name="team_name" id="temename_input" disabled>
                <button type="submit" id="temename_button" disabled>Submit</button>
            </form>

        </div>
    </div>
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
                    document.getElementById('temename_input').disabled = false;
                    document.getElementById('temename_button').disabled = false;
                    var userLatLng = new google.maps.LatLng(position.coords.latitude, position.coords
                        .longitude);

                    // --------------------------


                }, function(error) {
                    document.getElementById('temename_input').disabled = true;
                    document.getElementById('temename_button').disabled = true;
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
