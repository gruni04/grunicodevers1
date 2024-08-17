@extends('layouts.app')


@section('page-style')
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}"  rel="stylesheet">
    <!-- page css -->
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
@endsection


@section('content')
    
    <div class="card">
        <div class="card-header border bottom">
            <h4 class="card-title">{{ $sub_title }}</h4>
        </div>
        <div class="card-body">
            @can('mark-self-attendance')
            
            @php
                $is_marked = DB::table('attendances')->where('user_id', auth()->user()->id)->whereDate('date', date('Y-m-d'))->first();
            @endphp
            @if(!$is_marked || ($is_marked && $is_marked->user_selfi=='' ) )
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-info btn-rounded btn-float custom-map-control-button " id="activate-camera-btn" >{{ $is_marked ? "Upload Selfi" : "Mark Today Attendance" }} </button>
                    <div class="form-group">
                        <label class="control-label">Notes</label>
                        <textarea class="form-control" name="comment" id="comment" placeholder="Enter Notes before mark atendance">{{ $is_marked && $is_marked->comment ? $is_marked->comment : '' }}</textarea>
                    </div>
                    
                    <p id="attendance-notice">Open Camera and take Selfi to mark Today Attendance</p>
                    
                    <div id="map" class="d-none"></div>
                    
                </div>
                
                <div class="col-md-3">
                    <video id="capturevideo" width="230" height="230" class="d-none"></video>
                    <br />
                    <button type="button" id="activate-camera-btn" class="btn btn-info btn-rounded btn-float d-none" >Activate Camera</button>
                    <button type="button" id="deactivate-camera-btn" class="btn btn-danger btn-rounded btn-float d-none">Deactivate Camera</button>
                    <button type="button" id="btnCapture" class="btn btn-info btn-rounded btn-float d-none">Capture</button>
                </div>
                
                <div class="col-md-3" id="imagesave" >
                    <canvas id="capturecanvas" width="230" height="225" class="d-none"></canvas>
                </div>
                <div class="col-md-3">
                    <button type="button" id="mark-today-attendance" onclick="saveSelfi()" class="btn btn-info btn-rounded btn-float d-none">Upload Today Selfi</button>
                </div>
            </div>
            @endif
            @if($is_marked)
            <div class="row">
                <div class="col-md-3">
                    @if($is_marked && $is_marked->date_day_out=='')
                    
                    <button class="btn btn-info btn-rounded btn-float" id="day-out-attendance-btn" >Day Out</button>
                    @endif
                    <div id="map" class="d-none"></div>
                </div>
            </div>
            @endif
            
            @endcan
            
            <div class="row">
                @can('mark-self-attendance')
                @php
                    $attendance = DB::table('attendances')->where('user_id', auth()->user()->id)->count();
                @endphp
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media justify-content-between">
                                <div>
                                    <p class="">Total Attendance</p>
                                    <h2 class="font-size-28 font-weight-light">{{ $attendance }}</h2>
                                    <span class="text-semibold text-success font-size-15">
                                        
                                        <span></span>
                                    </span>
                                </div>
                                <div class="align-self-end">
                                    <i class="ti-credit-card font-size-70 text-success opacity-01"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
                
                @can('project-list')
                @php
                    //$projects = App\Models\AssigneProject::select('assigne_project')->whereRaw("find_in_set('".auth()->user()->id."', assigne_to)")->count();
                    if(auth()->user()->hasRole('Client') ){
                        $projects = App\Models\Project::select('count(*) as allcount')->where('client', auth()->user()->id)->count();
                    }else{
                        $projects = App\Models\ProjectUser::where(['project_users.user_id'=>auth()->user()->id, 'project_users.board_type'=>1])
                                            ->join('projects as x', 'x.id', '=', 'project_users.board_id')
                                            ->select('x.id', 'x.project_name')
                                            ->count();
                    }
                @endphp
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media justify-content-between">
                                <div>
                                    <p class="">Total Projects</p>
                                    <h2 class="font-size-28 font-weight-light">{{ $projects }}</h2>
                                    <span class="text-semibold text-danger font-size-15">
                                        
                                        <span></span>
                                    </span>
                                </div>
                                <div class="align-self-end">
                                    <i class="ti-pie-chart font-size-70 text-info opacity-01"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media justify-content-between">
                                <div>
                                    <!--<p class="">Growth Rate</p>
                                    <h2 class="font-size-28 font-weight-light">28%</h2>
                                    <span class=" font-size-13 opacity-04">
                                        from last month
                                    </span>-->
                                </div>
                                <div class="align-self-end">
                                    <i class="ti-bar-chart font-size-70 text-danger opacity-01"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media justify-content-between">
                                <div>
                                    <!--<p class="">New Customers</p>
                                    <h2 class="font-size-28 font-weight-light">178</h2>
                                    <span class="text-semibold text-success font-size-15">
                                        <i class="ti-arrow-up font-size-11"></i> 
                                        <span>18%</span>
                                    </span>-->
                                </div>
                                <div class="align-self-end">
                                    <i class="ti-user font-size-70 text-primary opacity-01"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            
        </div>
    </div>
@endsection


@section('page-script')
    <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>-->
    
    <!--<script src="{{ url('assets/admin/vendor/sweetalert/lib/sweet-alert.js')}}"></script>-->
    @can('mark-self-attendance')
    
    <script
      src="https://maps.googleapis.com/maps/api/js?key=<?php echo config('constants.GOOGLE_MAPS_API_KEY'); ?>&callback=initMap&v=weekly"
      defer
    ></script>
    <?php //echo config('constants.GOOGLE_MAPS_API_KEY'); ?>
    
    @if(!$is_marked)
    
    <script type="text/javascript">
        var project_locations = {};
        $(document).ready(function(){
            // myProjectLocation();
        });
        
        
        function myProjectLocation(){
            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
            $.ajax({
                  type: "POST",
                  url:'{{ route('attendance.user.project-location') }}',
                  dataType:'json',
                  data: {},
                  beforeSend:function() {},
                  success:function(responce)
                  {
                    if(responce.status==1) {
                        project_locations = responce.data;
                    }else if(responce.status==2){
                        $("#activate-camera-btn").hide();
                        $("#attendance-notice").html(responce.message);
                        _error(responce.message);
                    }else {
                       _error(responce.message); 
                    }
                  },
                  error:function()
                  {
                     _error('Something Went Wrong..');
                  },
                  complete:function()
                  {
                  }
            });
            
            
        }
        
        function markAttendance(pos, readable_address){
            // alert("markAttendance");
            var distance = [], project_distance=[];
            /*if(project_locations.length<=0){
                alert("You dose not have any assigned project");
                return false;
            }*/
            
            /*for(var i=0; i<project_locations.length;i++){
                // console.log(project_locations[i]);
                var project_pos = {
                    lat:project_locations[i].lat,
                    lng:project_locations[i].lng,
                }
                
                project_distance[i] = {
                    project: project_locations[i].assigne_project,
                    distance: getDistanceBetweenPoints(pos, project_pos),
                    // distance: getDistance(pos, project_pos),
                }
            }*/
            var min_distance_loc=-1, min_distance_id=0;
            /*for(var i=0; i<project_distance.length;i++){
                // console.log(project_distance[i].distance, i);
                if(min_distance_loc>=project_distance[i].distance){
                    min_distance_loc = project_distance[i].distance;
                    min_distance_id = project_distance[i].project;
                }
            }*/
            
            // console.log("distance", project_distance, 'pos', pos);
            // console.log("distance-data", min_distance_loc, min_distance_id);
            // return false;
            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
            $.ajax({
                  type: "POST",
                  url:'{{ route('attendance.user.store') }}',
                  dataType:'json',
                  data: {lat: pos.lat, lng: pos.lng, min_distance_loc:min_distance_loc, min_distance_id:min_distance_id, comment: $("#comment").val(), readable_address:readable_address},
                  beforeSend:function() {},
                  success:function(responce)
                  {
                    if(responce.status==1) {
                        
                        // a_id = responce.aid;
                        // _success(responce.message);
                        $("#activate-camera-btn").html("Upload Selfi");
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Today Attendance Completed, Upload your selfi',
                          showConfirmButton: false,
                          timer: 1500
                        });
                        // project_locations = responce.data;
                    }else if(responce.status==2){
                        // $("#activate-camera-btn").hide();
                        $("#attendance-notice").html(responce.message);
                        _error(responce.message);
                    }else {
                       _error(responce.message); 
                    }
                  },
                  error:function()
                  {
                     _error('Something Went Wrong..');
                  },
                  complete:function()
                  {
                  }
            });
            
            
        }
        
        let map, infoWindow;

        function initMap() {
          map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 6,
          });
          infoWindow = new google.maps.InfoWindow();
          const geocoder = new google.maps.Geocoder();
        
          const locationButton = document.getElementById("activate-camera-btn");
            
          // locationButton.textContent = "Pan to Current Location";
          // locationButton.classList.add("custom-map-control-button");
          map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
          locationButton.addEventListener("click", () => {
            
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                // console.log("getCenter", map.getCenter().lat());
              navigator.geolocation.getCurrentPosition(
                (position) => {
                  const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                  };
                  // var readable_address = geocodeLatLng(geocoder, map, infoWindow, pos);
                    // console.log("readable_address", readable_address);
                    // return false;
                    geocoder
                        .geocode({ location: pos })
                        .then((response) => {
                          if (response.results[0]) {
                            var readable_address = response.results[0].formatted_address;
                            markAttendance(pos, readable_address);
                            // console.log("readable address xyz", response.results[0].formatted_address);
                          } else {
                            window.alert("No results found");
                          }
                        })
                        .catch((e) => window.alert("Geocoder failed due to: " + e));
                          
                  // infoWindow.setPosition(pos);
                  // infoWindow.setContent("Location found.");
                  // infoWindow.open(map);
                  // map.setCenter(pos);
                },
                (error) => {
                    alert(error.message+", Open in Https");
                    
                    handleLocationError(true, infoWindow, map.getCenter());
                }, {timeout:10000}
              );
            } else {
              // Browser doesn't support Geolocation
              handleLocationError(false, infoWindow, map.getCenter());
            }
          });
        }
        
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            // alert()
          infoWindow.setPosition(pos);
          infoWindow.setContent(
            browserHasGeolocation
              ? "Error: The Geolocation service failed."
              : "Error: Your browser doesn't support geolocation."
          );
          infoWindow.open(map);
        }
        function geocodeLatLng(geocoder, map, infowindow, latlng) {
          
          // console.log("readable address 0");
          var readable_address = '';
          geocoder
            .geocode({ location: latlng })
            .then((response) => {
              if (response.results[0]) {
                readable_address = response.results[0].formatted_address;

                // map.setZoom(11);
                // const marker = new google.maps.Marker({
                //   position: latlng,
                //   map: map,
                // });
                console.log("readable address xyz", response.results[0].formatted_address);
                // infowindow.setContent(response.results[0].formatted_address);
                // infowindow.open(map, marker);
              } else {
                window.alert("No results found");
              }
            })
            .catch((e) => window.alert("Geocoder failed due to: " + e));
            return readable_address;
        }
        
        window.initMap = initMap;
        
        var rad = function(x) {
            return x * Math.PI / 180;
        };
        
        var getDistance = function(p1, p2) {
            var R = 6378137; // Earth’s mean radius in meter
            var dLat = rad(p2.lat - p1.lat);
            var dLong = rad(p2.lng - p1.lng);
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(rad(p1.lat)) * Math.cos(rad(p2.lat)) *
                    Math.sin(dLong / 2) * Math.sin(dLong / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;
            return d; // returns the distance in meter
        };
        
        /**
         * Converts degrees to radians.
         * 
         * @param degrees Number of degrees.
         */
        function degreesToRadians(degrees){
            return degrees * Math.PI / 180;
        }
        
        /**
         * Returns the distance between 2 points of coordinates in Google Maps
         * 
         * @see https://stackoverflow.com/a/1502821/4241030
         * @param lat1 Latitude of the point A
         * @param lng1 Longitude of the point A
         * @param lat2 Latitude of the point B
         * @param lng2 Longitude of the point B
         */
        function getDistanceBetweenPoints(p1, p2){
            var lat1 = p1.lat, lng1 = p1.lng, lat2 = p1.lat, lng2 = p1.lat;
            // The radius of the planet earth in meters
            let R = 6378137;
            let dLat = degreesToRadians(lat2 - lat1);
            let dLong = degreesToRadians(lng2 - lng1);
            let a = Math.sin(dLat / 2)
                    *
                    Math.sin(dLat / 2) 
                    +
                    Math.cos(degreesToRadians(lat1)) 
                    * 
                    Math.cos(degreesToRadians(lat1)) 
                    *
                    Math.sin(dLong / 2) 
                    * 
                    Math.sin(dLong / 2);
        
            let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            let distance = R * c;
        
            return distance;
        }
        
    </script>
    @else
        
    <script type="text/javascript">
        var project_locations = {};
        
        function dayOutAttendance(pos, readable_address){
            if(!confirm("Are You Sure want to Close Day?")){
                return false;
            }
            var distance = [], project_distance=[];
            
            var min_distance_loc=-1, min_distance_id=0;
            
            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
            $.ajax({
                  type: "POST",
                  url:'{{ route('attendance.user.day-out') }}',
                  dataType:'json',
                  data: {lat: pos.lat, lng: pos.lng, min_distance_loc:min_distance_loc, min_distance_id:min_distance_id, readable_address:readable_address},//a_id:a_id, 
                  beforeSend:function() {},
                  success:function(responce)
                  {
                    if(responce.status==1) {
                        // _success(responce.message);
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: responce.message,
                          showConfirmButton: false,
                          timer: 1500
                        });
                        window.setTimeout(function() {
	                        window.location.reload();
	                    }, 1500);
                    }else if(responce.status==2){
                        
                        _error(responce.message);
                    }else {
                       _error(responce.message); 
                    }
                  },
                  error:function()
                  {
                     _error('Something Went Wrong..');
                  },
                  complete:function()
                  {
                  }
            });
            
            
        }
        
        let map, infoWindow;

        function initMap() {
            // alert("a");
          map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 6,
          });
          infoWindow = new google.maps.InfoWindow();
          const geocoder = new google.maps.Geocoder();

          const locationButton = document.getElementById("day-out-attendance-btn");
        
          // locationButton.textContent = "Pan to Current Location";
          // locationButton.classList.add("custom-map-control-button");
          map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
          locationButton.addEventListener("click", () => {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(
                (position) => {
                    // console.log(position);
                  const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                  };
                  geocoder
                        .geocode({ location: pos })
                        .then((response) => {
                          if (response.results[0]) {
                            var readable_address = response.results[0].formatted_address;
                            dayOutAttendance(pos, readable_address);
                            // console.log("readable address xyz", response.results[0].formatted_address);
                          } else {
                            window.alert("No results found");
                          }
                        })
                        .catch((e) => window.alert("Geocoder failed due to: " + e));
                  
                  // infoWindow.setPosition(pos);
                  // infoWindow.setContent("Location found.");
                  // infoWindow.open(map);
                  // map.setCenter(pos);
                },
                () => {
                  handleLocationError(true, infoWindow, map.getCenter());
                }
              );
            } else {
              // Browser doesn't support Geolocation
              handleLocationError(false, infoWindow, map.getCenter());
            }
          });
        }
        
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          infoWindow.setPosition(pos);
          infoWindow.setContent(
            browserHasGeolocation
              ? "Error: The Geolocation service failed."
              : "Error: Your browser doesn't support geolocation."
          );
          infoWindow.open(map);
        }
        
        window.initMap = initMap;
        
    </script>
        
    @endif
    
    <!--selfi seript-->
    @if(!$is_marked || ($is_marked && $is_marked->user_selfi=='') )
    <script src="{{ url('assets/admin/js/html2canvas.js')}}"></script>
    <script>
        
        function saveSelfi(){
            var selfi = '';
            
            html2canvas(document.querySelector('#imagesave')).then(function(canvas) {
                // saveAs(canvas.toDataURL(), 'file-name.png');=
                selfi = canvas.toDataURL();
                
                
                if(selfi==null || selfi==''){
                    alert("Selfi is Required, Please take selfi to mark today attendance");
                    return false;
                }
                
                if(!confirm("Are You Sure want to Mark today Attendance with selfi?")){
                    return false;
                }
                $.ajaxSetup({
    		        headers: {
    		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		        }
    		    });
                $.ajax({
                      type: "POST",
                      url:'{{ route('attendance.user.store-selfi') }}',
                      dataType:'json',
                      data: { selfi:selfi},//id: a_id,
                      beforeSend:function() {},
                      success:function(responce)
                      {
                        if(responce.status==1) {
                            _success(responce.message);
    	                    window.setTimeout(function() {
    	                        window.location.reload();
    	                    }, 1500);
                        }else {
                           _error(responce.message); 
                        }
                      },
                      error:function()
                      {
                         _error('Something Went Wrong..');
                      },
                      complete:function()
                      {
                      }
                });
            });
            
        }
        
        var videoCapture;
        $(document).ready(function () {
            videoCapture = document.getElementById('capturevideo');
        });
        $(document).on('click', '#activate-camera-btn', function () {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // alert("camera");
                // access video stream from webcam
                navigator.mediaDevices.getUserMedia({ video: true }).then(function (stream) {
                    // on success, stream it in video tag 
                    window.localStream = stream;
                    videoCapture.srcObject = stream;
                    videoCapture.play();
                    activateCamera();
                }).catch(e => {
                    // on failure/error, alert message. 
                    alert("Please Allow: Use Your Camera!");
                });
            }
        });
        $(document).on('click', '#deactivate-camera-btn', function () {
            // stop video streaming if any
            localStream.getTracks().forEach(function (track) {
                if (track.readyState == 'live' && track.kind === 'video') {
                    track.stop();
                    deactivateCamera();
                }
            });
        });
        $(document).on('click', '#btnCapture', function () {
            document.getElementById('capturecanvas').getContext('2d').drawImage(videoCapture, 0, 0, 230, 225);
            $("#mark-today-attendance").removeClass("d-none");
        });
        function activateCamera() {
            $("#activate-camera-btn").addClass("d-none");
            $("#deactivate-camera-btn").removeClass("d-none");
            $("#capturevideo").removeClass("d-none");
            $("#btnCapture").removeClass("d-none");
            $("#capturecanvas").removeClass("d-none");
        }
        function deactivateCamera() {
            $("#deactivate-camera-btn").addClass("d-none");
            $("#activate-camera-btn").removeClass("d-none");
            $("#capturevideo").addClass("d-none");
            $("#btnCapture").addClass("d-none");
            $("#capturecanvas").addClass("d-none");
            $("#mark-today-attendance").addClass("d-none");
        }
        // $('#save_image_locally').click(function(){
        //     html2canvas(document.querySelector('#imagesave')).then(function(canvas) {
        //         // saveAs(canvas.toDataURL(), 'file-name.png');
        //         // console.log(canvas.toDataURL());
        //         // $("#c-img").attr('src', canvas.toDataURL());
        //     });
        // });
        // function saveAs(uri, filename) {

        //     var link = document.createElement('a');
        
        //     if (typeof link.download === 'string') {
        
        //         link.href = uri;
        //         link.download = filename;
        
        //         //Firefox requires the link to be in the body
        //         document.body.appendChild(link);
        
        //         //simulate click
        //         link.click();
        
        //         //remove the link when done
        //         document.body.removeChild(link);
        
        //     } else {
        
        //         window.open(uri);
        
        //     }
        // }
    </script>
    @endif
    
    @endcan
    
@endsection
