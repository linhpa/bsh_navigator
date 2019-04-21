@extends('layouts.app')

@section('css')

<style>
  .uper {
    margin: 20px;
  }

  .text-form-input {
    width: 100%;
  }
</style>

@endsection

@section('content')

<div class="card uper">
  <div class="card-header">
    Create New Case
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('bsh_cases.store') }}" style="display: inline;">
          <div class="form-group">
              {{ csrf_field() }}
              <label for="description">Description:</label>
              <input type="text" class="form-control text-form-input" name="description"/>
          </div>
          <div class="form-group">
              <label for="customer_name">Customer name :</label>
              <input type="text" class="form-control text-form-input" name="customer_name"/>
          </div>
          <div class="form-group">
              <label for="customer_phone">Customer phone number:</label>
              <input type="text" class="form-control text-form-input" name="customer_phone" required />
          </div>
            <div class="form-group">
                <label for="customer_phone">Address:</label>
                <div id="pac-container">
                    <input id="pac-input" name="position2"  class="form-control"
                          placeholder="Enter a location" style="width: 100%" autocomplete="off">
                </div>
            </div>
            <!-- <div id="map" style="width: 100%; height: 100%"></div> -->
            <div id="map" style="width: 100%; height: 400px"></div>
            <div id="infowindow-content">
                <!-- <img src="" width="16" height="16" id="place-icon"> -->
                <span id="place-name"  class="title"></span><br>
                <span id="place-address"></span>
            </div>

            <input id="address" type="hidden" name="address">
            <input id="lat" type="hidden" name="lat">
            <input id="lng" type="hidden" name="lng">

          <button type="submit" class="btn btn-primary">Add</button>
      </form>
      <a href="{{ route('bsh_cases.index') }}" style="display: inline;"><button class="btn">Exit</button></a>
  </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
initAutocomplete = function() {
    window.map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 10.7725133, lng: 106.70578479999999},
      zoom: 16
    });
    var card = document.getElementById('pac-card');
    var input = document.getElementById('pac-input');

    //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
    var searchBox = new google.maps.places.SearchBox(input);
    //var autocomplete = new google.maps.places.Autocomplete(input);

    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });

    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      // Clear out the old markers.
      markers.forEach(function(marker) {
        marker.setMap(null);
      });
      markers = [];

      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }

        markers.push(window.manualMarker = new google.maps.Marker({          
            icon: "{{ asset('images/green-dot.png') }}",
            title: place.name,
            position: place.geometry.location,
            map: map
        }))

        // popupObservable.getGDVLocation(place.geometry.location)

        // popupObservable.set("manualCustomerMarker", place.geometry.location)
        // popupObservable.set("item.position2", place.formatted_address)
        $("#lat").val(place.geometry.location.lat())
        $("#lng").val(place.geometry.location.lng())
        $("#address").val(place.formatted_address)

        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });
      
}

//initAutocomplete();

$('form input').keydown(function (e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});
</script>
@endsection
