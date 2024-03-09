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

        #modal_dis_desc {
            font-size: 20px;
        }

        .modal-body-outer {
            padding: 2rem !important;
        }
    </style>
    <section class="section-py ">
        <div class="container">
            <button id="updateButton" onclick="updateLocation()" style="display: none;">Update Location</button>
            <div id="map" style="height: 400px;" class="m-5"></div>

        </div>
    </section>
    <!-- Modal 2-->
    <div class="modal fade" id="modalToggle2" aria-hidden="true" aria-labelledby="modalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-outer">
                    <h3><strong id="modaldis"></strong> <span id="modal_dis_desc">to reach the point</span></h3>
                    <h5 id="modalLabel"></h5>
                    <img src="" id="modalImage" class="w-100">

                    <p id="modaldesc"></p>
                    <div class="qes-outer" id="qes-outer">
                        <strong id="modalque"></strong>
                        <p id="modaloptions"></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="point_id">
                        <input type="hidden" id="team_id" value="{{ $team_id }}">
                        <button class="btn btn-primary" id="submit_button" onclick="submitPoint()">Submit</button>
                    </div>
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
                asset($point->image),
                $point->description,
                $point->question,
                $point->question_des,
                implode(',', unserialize($point->options)),
                $point->id,
            ];
        }
    @endphp
    <script type="text/javascript">
        // Function to populate modal with data 
        function populateModal(title, image, desc, que, options, dis, radius, options, point_id) {
            document.getElementById('modalLabel').innerHTML = title;
            document.getElementById('modalImage').src = image;
            document.getElementById('modaldesc').innerHTML = desc;
            document.getElementById('modalque').innerHTML = que;
            document.getElementById('point_id').value = point_id;
            document.getElementById('modaldis').innerHTML = dis;
            if (radius > dis) {
                document.getElementById('modaldis').classList.add("text-success")
                document.getElementById('modaldis').classList.remove("text-black")
                document.getElementById('modal_dis_desc').innerHTML = "m. distance from point";
                document.getElementById('qes-outer').style.display = "block";
                document.getElementById('submit_button').style.cssText = "display: block !important;";
                var radioOptionsDiv = document.getElementById('modaloptions');
                radioOptionsDiv.innerHTML = "";
                var optionsData = options.split(',');
                // Loop through the options array to create radio buttons
                optionsData.forEach(function(option, index) {
                    // Create a div for each radio button with the class 'form-check'
                    var formCheckDiv = document.createElement("div");
                    formCheckDiv.classList.add("form-check");

                    // Create a radio input element
                    var radioInput = document.createElement("input");
                    radioInput.type = "radio";
                    radioInput.classList.add("form-check-input");
                    radioInput.name = "options";
                    radioInput.value = index + 1;
                    radioInput.id = "defaultRadio" + (options.indexOf(option) +
                        1); // Unique ID for each radio button

                    // Create a label for the radio button
                    var label = document.createElement("label");
                    label.classList.add("form-check-label");
                    label.setAttribute("for", "defaultRadio" + (options.indexOf(option) +
                        1)); // Link label to radio button
                    label.textContent = option;

                    // Append the radio button and label to the form-check div
                    formCheckDiv.appendChild(radioInput);
                    formCheckDiv.appendChild(label);

                    // Append the form-check div to the radioOptionsDiv
                    radioOptionsDiv.appendChild(formCheckDiv);
                });
            } else {
                document.getElementById('modaldis').classList.remove("text-success")
                document.getElementById('modaldis').classList.add("text-black")
                document.getElementById('modal_dis_desc').innerHTML = "m. to open this point";
                document.getElementById('qes-outer').style.display = "none";
                document.getElementById('submit_button').style.cssText = "display: none !important;";
            }

            $('#modalToggle2').modal('show');
        }

        function submitPoint() {
            var checkedRadio = document.querySelector('input[name="options"]:checked');
            if (checkedRadio) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content'); // Get CSRF token from meta tag
                var postData = {
                    point_id: document.getElementById('point_id').value,
                    option: checkedRadio.value,
                    team_id: document.getElementById('team_id').value,
                    _token: csrfToken, // Include CSRF token in the data
                    // Add more key-value pairs as needed
                };
                $.ajax({
                    url: "{{ route('map.point.submit') }}", // Replace with your API endpoint
                    type: "POST",
                    data: postData,
                    success: function(response) {
                        $('#modalToggle2').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        alert("Error:", error);
                    }
                });
            } else {
                alert("Pleaes select your answer.");
            }
        }

        function calculateDistance(coord1, coord2) {
            // Convert latitude and longitude to Google Maps LatLng objects
            var latLng1 = new google.maps.LatLng(coord1.lat, coord1.lng);
            var latLng2 = new google.maps.LatLng(coord2.lat, coord2.lng);
            var distance = google.maps.geometry.spherical.computeDistanceBetween(latLng1, latLng2);

            return Math.floor(distance); // Distance in meters
        }

        var map, marker, circle, currentLat, currentLng; // Declare map variable globally

        // Initialize the map with the user's initial location
        function initMap() {
            var mapOptions = {
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [{
                    featureType: "poi",
                    stylers: [{
                        visibility: "off"
                    }] // Hide all POIs
                }]
            };

            // Create the map
            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Display initial location
            displayCurrentLocation();
            infowindow = new google.maps.InfoWindow();
            var locations = {{ Js::from($locations) }};
            var usermarker;
            //------------------------
            for (i = 0; i < locations.length; i++) {

                usermarker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 10,
                        fillColor: locations[i][3], // CSS color for each location
                        fillOpacity: 1,
                        strokeWeight: 2
                    }
                });

                attachMarkerClickEvent(usermarker, locations[i]);


            }
            // Simulate click on the hidden button every 5 seconds
            setInterval(function() {
                document.getElementById('updateButton').click();
            }, 3000);
        }

        function attachMarkerClickEvent(usermarker, location) {
            usermarker.addListener('click', function() {
                var dis = calculateDistance({
                    lat: location[1],
                    lng: location[2]
                }, {
                    lat: currentLat,
                    lng: currentLng
                });
                populateModal(location[0], location[5], location[6], location[7], location[8], dis, location[4],
                    location[9], location[10]);
            });
        }

        // Display current location on the map
        function displayCurrentLocation() {
            if (navigator.geolocation) {
                var options = {
                    enableHighAccuracy: true
                };

                // Get the user's current location
                navigator.geolocation.getCurrentPosition(function(position) {
                    var currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords
                        .longitude);
                    currentLat = position.coords.latitude
                    currentLng = position.coords.longitude
                    // Create a marker for the user's location if not already created
                    if (!marker) {
                        marker = new google.maps.Marker({
                            position: currentLocation,
                            map: map,
                            icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                            scaledSize: new google.maps.Size(50, 50),
                            title: 'Your Location'
                        });
                        map.setCenter(currentLocation);
                    } else {
                        // Reposition the existing marker to the new location
                        marker.setPosition(currentLocation);

                    }


                    // Draw a circle around the user's location
                    // if (!circle) {
                    //     circle = new google.maps.Circle({
                    //         strokeColor: '#00BFFF',
                    //         strokeOpacity: 0.8,
                    //         strokeWeight: 2,
                    //         fillColor: '#00BFFF',
                    //         fillOpacity: 0.35,
                    //         map: map,
                    //         center: currentLocation,
                    //         radius: 100 // Specify the radius in meters
                    //     });
                    // } else {
                    //     // Update the circle position to the new location
                    //     circle.setCenter(currentLocation);
                    // }
                }, function() {
                    handleLocationError(true, map.getCenter());
                }, options);
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, map.getCenter());
            }
        }

        // Handle errors in geolocation
        function handleLocationError(browserHasGeolocation, pos) {
            var infoWindow = new google.maps.InfoWindow({
                map: map
            });
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        }

        // Update location on button click
        function updateLocation() {
            displayCurrentLocation();
        }





        // Load the Google Maps API asynchronously
        function loadScript() {
            var script = document.createElement('script');
            script.src =
                "https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=geometry&callback=initMap";
            script.defer = true;
            script.async = true;
            document.body.appendChild(script);
        }

        // Call the loadScript function to load the Google Maps API
        window.onload = loadScript;
    </script>
@endsection
