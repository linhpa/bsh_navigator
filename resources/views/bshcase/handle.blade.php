@extends('layouts.app')

@section('content')
<style>
    li.active > a.hidden-xs {
     display: block!important;
    }
    li.active > a.visible-xs {
        display: none!important; 
    }
    .nav-pills.nav-wizard > li {
      position: relative;
      overflow: visible;
      border-right: 10px solid #fff;
      border-left: 10px solid #fff;
    }
    .nav-pills.nav-wizard > li:first-child {
      border-left: 0;
    }
    .nav-pills.nav-wizard > li:first-child a {
      border-radius: 5px 0 0 5px;
    }
    .nav-pills.nav-wizard > li:last-child {
      border-right: 0;
    }
    .nav-pills.nav-wizard > li:last-child a {
      border-radius: 0 5px 5px 0;
    }
    .nav-pills.nav-wizard > li a {
      border-radius: 0;
      background-color: #eee;
      padding: 10px;
    }
    .nav-pills.nav-wizard > li .nav-arrow {
      position: absolute;
      top: 0px;
      right: -20px;
      width: 0px;
      height: 0px;
      border-style: solid;
      border-width: 20px 0 20px 20px;
      border-color: transparent transparent transparent #eee;
      z-index: 150;
    }
    .nav-pills.nav-wizard > li .nav-wedge {
      position: absolute;
      top: 0px;
      left: -20px;
      width: 0px;
      height: 0px;
      border-style: solid;
      border-width: 20px 0 20px 20px;
      border-color: #eee #eee #eee transparent;
      z-index: 150;
    }
    .nav-pills.nav-wizard > li:hover .nav-arrow {
      border-color: transparent transparent transparent #aaa;
    }
    .nav-pills.nav-wizard > li:hover .nav-wedge {
      border-color: #aaa #aaa #aaa transparent;
    }
    .nav-pills.nav-wizard > li:hover a {
      background-color: #aaa;
      color: #fff;
    }
    .nav-pills.nav-wizard > li.active .nav-arrow {
      border-color: transparent transparent transparent #428bca;
    }
    .nav-pills.nav-wizard > li.active .nav-wedge {
      border-color: #428bca #428bca #428bca transparent;
    }
    .nav-pills.nav-wizard > li.active a {
      background-color: #428bca;
    }
    /* CSS for Credit Card Payment form */
    .credit-card-box .panel-title {
        display: inline;
        font-weight: bold;  
    }
    .credit-card-box .form-control.error {
        border-color: red;
        outline: 0;
        box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
    }
    .credit-card-box label.error {
      font-weight: bold;
      color: red;
      padding: 2px 8px;
      margin-top: 2px;
    }
    .credit-card-box .payment-errors {
      font-weight: bold;
      color: red;
      padding: 2px 8px;
      margin-top: 2px;
    }
    .credit-card-box label {
        display: block;
    }

    .credit-card-box .display-tr {
        display: table-row;
    }
    .credit-card-box .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 50%;
    }
    /* Just looks nicer */
    .credit-card-box .panel-heading img {
        min-width: 180px;
    }

    .input--file {
      position: relative;
      color: #7f7f7f;
    }

    /*.input--file input {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      display: none !important;
    }*/

</style>

<div class="container" id="myWizard">
    <div class="row">
      <div class="col-xs-10 col-md-10">
        <h3><span class=""></span>&nbsp;Case Progress</h3>
      </div>
    </div>
    <hr>
   <!--  <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 25%;">
            Step 1 of 4
        </div>
    </div> -->
    <div class="navbar">
        <div class="navbar-inner">
            <ul class="nav nav-pills nav-wizard" id="tabMenu">
                <li class="active">
                    <a class="hidden-xs" href="#step1" data-toggle="tab" data-step="1">1. Case Info</a>
                    <a class="visible-xs" href="#step1" data-toggle="tab" data-step="1">1.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="">
                    <div class="nav-wedge"></div>
                    <a class="hidden-xs" href="#step2" data-toggle="tab" data-step="2">2. Arrived</a>
                    <a class="visible-xs" href="#step2" data-toggle="tab" data-step="2">2.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="">
                    <div class="nav-wedge"></div>
                    <a class="hidden-xs" href="#step3" data-toggle="tab" data-step="3">3. Take Note</a>
                    <a class="visible-xs" href="#step3" data-toggle="tab" data-step="3">3.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="">
                    <div class="nav-wedge"></div>
                    <a class="hidden-xs" href="#step4" data-toggle="tab" data-step="4">4. Complete</a>
                    <a class="visible-xs" href="#step4" data-toggle="tab" data-step="4">4.</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="step1">
            <h3>1. Case Info</h3>
            <div class="well">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group ">
                            <label>Car type:</label>
                            <strong>{{ @$case->car_type }}</strong>
                            <!-- <input class="form-control input-lg" placeholder="Email"> -->
                            <!-- <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span> -->
                            <span id="inputError2Status" class="sr-only">(error)</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <div class="form-group">
                            <label>Customer Name:</label>
                            <!-- <input class="form-control input-lg"> -->
                            <strong>{{ @$case->customer_name }}</strong>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 pull-right">
                        <div class="form-group">
                            <label>Customer Phone:</label>
                            <strong>{{ @$case->customer_phone }}</strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div id="map" style="width: 100%; height: 400px"></div>
                        <div id="infowindow-content">
                          <img src="" width="16" height="16" id="place-icon">
                          <span id="place-name"  class="title"></span><br>
                          <span id="place-address"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block next" type="submit">Continue&nbsp;<!-- <span class="glyphicon glyphicon-chevron-right"></span> --></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="step2">
            <h3>2. Arrived</h3>
            <div class="well">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <h3></h3>                        
                    </div>
                </div>
                <!-- <form id="image-form1" enctype="multipart/form-data" method="post" action="Upload.aspx">
                    {{ csrf_field() }}
                    <div>
                      <label for="fileToUpload">Take or select photo(s)</label><br />                 
                      <input type="file" multiple="true" name="fileToUpload" id="fileToUpload" onchange="fileSelected();" accept="image/*" capture="camera" />
                    </div>
                    <div id="details"></div>
                    <div>                 
                      <input type="button" onclick="uploadFile()" value="Upload" />                 
                    </div>
                 
                    <div id="progress"></div>
             
                </form> -->
                <div style="display: inline-block;">
                    @foreach ($photos as $photo)
                    <img class="gallery-items" src="{{ URL::to('/') }}/uploads/{{ $photo->photo_url }}" alt="Image" height="100" width="100" />
                    @endforeach
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-xs-12 col-md-12" style="margin-bottom: 20px">
                        <form action="{{ url('bsh_cases/uploadPhotos') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="case_id" value="{{ @$case->id }}">
                            <!-- <label for="fileToUpload">Take or select photo(s)</label><br /> -->
                            <br />
                            <div class="input--file">
                                <label for="files">
                                  <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                      <circle cx="12" cy="12" r="3.2"/>
                                      <path d="M9 2l-1.83 2h-3.17c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-12c0-1.1-.9-2-2-2h-3.17l-1.83-2h-6zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
                                      <path d="M0 0h24v24h-24z" fill="none"/>
                                    </svg>
                                  </span>
                                </label>
                                <input style="display: none" type="file" name="files[]" id="files" multiple accept="image/*" >
                            </div>
                            <!-- <input type="file" name="files[]" id="files" multiple accept="image/*" capture="camera"> -->
                            <input type="submit" value="Upload" name="submit">                    
                        </form>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block next" type="submit">Continue&nbsp;<!-- <span class="glyphicon glyphicon-chevron-right"></span> --></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="step3">
            <h3>3. Take Note</h3>
            <div class="well">
                <div class="row">
                   
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="step4">
            <div class="well">
                <h3>4. Complete</h3> Add another almost done step here..
                <div class="row">
                    
                </div>
                
            </div>

        </div>
    </div>
</div>

<div id="push"></div>

@endsection

@section('javascript')
<script type="text/javascript">
    //old tab handle when redirect back
    $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')

    //image viewer
    $(function () {
        var viewer = ImageViewer();
        $('.gallery-items').click(function () {
            var imgSrc = this.src,
                highResolutionImage = $(this).data('high-res-img');
     
            viewer.show(imgSrc, highResolutionImage);
        });
    });

    $('.next').click(function(){

      var nextId = $(this).parents('.tab-pane').next().attr("id");
      $('[href="#'+nextId+'"]').tab('show');
      return false;
      
    });

    $('.back').click(function(){

      var prevId = $(this).parents('.tab-pane').prev().attr("id");
      $('[href="#'+prevId+'"]').tab('show');
      return false;
      
    });

    // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

      
    // });

    $('.first').click(function(){

      $('#myWizard a:first').tab('show')

    });
 
</script>

<script type="text/javascript">
var apiGeolocationSuccess = function(position) {
    let current_lat = position.coords.latitude
    let current_lng = position.coords.longitude   

    window.map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: current_lat, lng: current_lng},
      zoom: 16
    });

    let markers = [];

    markers.push(new google.maps.Marker({          
        icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
        title: 'Current Position',
        position: {lat: current_lat, lng: current_lng},
        map: map
    }));

    markers.push(new google.maps.Marker({          
        icon: 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png',
        title: 'Customer Position 1',
        position: {lat: {{ @$case->lat1 }}, lng: {{ @$case->lng1 }}},
        map: map
    }));

    markers.push(new google.maps.Marker({          
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
        title: 'Customer Position 2',
        position: {lat: {{ @$case->lat2 }}, lng: {{ @$case->lng2 }}},
        map: map
    }));

    var bounds = new google.maps.LatLngBounds();
    for (var i = 0; i < markers.length; i++) {
        bounds.extend(markers[i].getPosition());
    }

    map.fitBounds(bounds);  
};

var tryAPIGeolocation = function() {
    jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDViaUZiCsi7LfCkwkdpLRT4AmWzWP9CnM", function(success) {
        apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
  })
  .fail(function(err) {
    console.log("API Geolocation error! \n\n"+err);
  });
};

var browserGeolocationSuccess = function(position) {
    //alert("Browser geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
    apiGeolocationSuccess(position);
};

var browserGeolocationFail = function(error) {
  let msg = ''
  switch (error.code) {
    case error.TIMEOUT:
      msg = "Browser geolocation error !\n\nTimeout.";
      break;
    case error.PERMISSION_DENIED:               
      // if(error.message.indexOf("Only secure origins are allowed") == 0) {
      //   tryAPIGeolocation();
      // }
      tryAPIGeolocation();
      break;
    case error.POSITION_UNAVAILABLE:
      msg = "Browser geolocation error !\n\nPosition unavailable.";
      break;
  }  
};

var tryGeolocation = function() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        browserGeolocationSuccess,
      browserGeolocationFail,
      {maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
  }
};
if ("{{ !Auth::guest() }}" == "1") {
    tryGeolocation();    
}        

initAutocomplete = function() {
    
}

initAutocomplete();
</script>
<script type="text/javascript">
 
 
</script>
@endsection