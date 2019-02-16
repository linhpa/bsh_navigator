@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
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
      border-color: transparent transparent transparent #FAA61A;
    }
    .nav-pills.nav-wizard > li.active .nav-wedge {
      border-color: #FAA61A #FAA61A #FAA61A transparent;
    }
    .nav-pills.nav-wizard > li.active a {
      background-color: #FAA61A;
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

    .thumb {
        height: 50px;
        border: 1px solid #000;
        margin: 10px 5px 0 0;
    }

    .upload-file-container-text{        
        line-height: 17px;
        text-align: center;
        display: inline-block;        
        left: 0; 
        bottom: 0; 
        width: 100px; 
        height: 35px;
    }

    .delete-img {
        cursor: pointer;
    }

    .shadow {
        -webkit-border-radius: 0% 0% 100% 100% / 0% 0% 8px 8px;
        -webkit-box-shadow: rgba(0, 0, 0,.30) 0 2px 3px;
    }
    .photo-container {
      margin: 20px auto;      

      height: auto;
      background: #F2F2F2;
      border: 1px solid #ccc;
      box-shadow: 1px 1px 2px #fff inset,
                  -1px -1px 2px #fff inset;
      border-radius: 3px/6px;         
    }

    .photo-display {
        display: inline-block;
        margin: 10px;
    }



</style>
@endsection

@section('content')

<div class="container" id="myWizard">
    <div class="row">
      <div class="col-xs-10 col-md-10">
        <h3><span class=""></span><a href="{{url('bsh_cases')}}">&nbsp;Case List</a></h3>
      </div>
    </div>
    <hr>
   <!--  <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 25%;">
            Step 1 of 4
        </div>
    </div> -->
    <div class="navbar" style="pointer-events:none">
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
                            <label>Description:</label>
                            <strong>{{ @$case->description }}</strong>
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
                        <button class="btn btn-primary btn-lg btn-block next" id="confirmArrived" style="display: none">Confirm Arrival<!-- <span class="glyphicon glyphicon-chevron-right"></span> --></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="step2">
            <h3>2. Arrived</h3>
            <div class="well">                
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <h3>Taking Photo</h3>                        
                    </div>
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
                <div class="shadow">
                    <div class="row photo-container">
                        <h4 style="margin-left: 10px">Photos of Scene</h4>
                        <div class="photo-display">                    
                            @foreach ($photos1 as $photo) 
                            <div class="upload-file-container-text" id="{{ $photo->photo_url }}">                   
                                <img class="gallery-items" src="{{ URL::to('/') }}/uploads/{{ $photo->photo_url }}" alt="Image" height="100" width="100" />
                                <span class="delete-img"><i class="fa fa-lg fa-trash"></i></span>
                            </div>
                            @endforeach                    
                        </div>

                    
                        
                        <div class="col-xs-12 col-md-12" style="margin-bottom: 20px">
                            <form id="form-files1" name="form-files1" action="{{ url('bsh_cases/uploadPhotos') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="case_id" value="{{ @$case->id }}">
                                <input type="hidden" name="type" value="1">
                                <!-- <label for="fileToUpload">Take or select photo(s)</label><br /> -->
                                <br />
                                <div class="input--file">
                                    <label for="files1">
                                      <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                          <circle cx="12" cy="12" r="3.2"/>
                                          <path d="M9 2l-1.83 2h-3.17c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-12c0-1.1-.9-2-2-2h-3.17l-1.83-2h-6zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
                                          <path d="M0 0h24v24h-24z" fill="none"/>
                                        </svg>
                                      </span>
                                    </label>
                                    <input style="display: none" type="file" name="files1[]" class="files" id="files1" multiple accept="image/*" capture="camera">
                                    <output id="list1" style="margin-bottom: 10px"></output>
                                </div>
                                <!-- <input type="file" name="files[]" id="files" multiple accept="image/*" capture="camera"> -->
                                <input type="submit" value="Upload" name="submit">                    
                            </form>
                        </div>
                      
                    </div>
                </div>
                <div class="shadow">

                    <div class="row photo-container">
                        <h4 style="margin-left: 10px">Photos of Damages</h4>
                        <div class="photo-display">                    
                            @foreach ($photos2 as $photo) 
                            <div class="upload-file-container-text" id="{{ $photo->photo_url }}">                   
                                <img class="gallery-items" src="{{ URL::to('/') }}/uploads/{{ $photo->photo_url }}" alt="Image" height="100" width="100" />
                                <span class="delete-img"><i class="fa fa-lg fa-trash"></i></span>
                            </div>
                            @endforeach                    
                        </div>
                    
                        <div class="col-xs-12 col-md-12" style="margin-bottom: 20px">
                            <form id="form-files2" name="form-files2" action="{{ url('bsh_cases/uploadPhotos') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="case_id" value="{{ @$case->id }}">
                                <input type="hidden" name="type" value="2">
                                <!-- <label for="fileToUpload">Take or select photo(s)</label><br /> -->
                                <br />
                                <div class="input--file">
                                    <label for="files2">
                                      <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                          <circle cx="12" cy="12" r="3.2"/>
                                          <path d="M9 2l-1.83 2h-3.17c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-12c0-1.1-.9-2-2-2h-3.17l-1.83-2h-6zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
                                          <path d="M0 0h24v24h-24z" fill="none"/>
                                        </svg>
                                      </span>
                                    </label>
                                    <input style="display: none" type="file" name="files2[]" class="files" id="files2" multiple accept="image/*" capture="camera">
                                    <output id="list2" style="margin-bottom: 10px"></output>
                                </div>
                                <!-- <input type="file" name="files[]" id="files" multiple accept="image/*" capture="camera"> -->
                                <input type="submit" value="Upload" name="submit">                    
                            </form>
                        </div>
                        
                    </div>
                </div>

                <div class="shadow">
                    <div class="row photo-container">
                        <h4 style="margin-left: 10px">Other Photos</h4>
                        <div class="photo-display">                    
                            @foreach ($photos3 as $photo) 
                            <div class="upload-file-container-text" id="{{ $photo->photo_url }}">                   
                                <img class="gallery-items" src="{{ URL::to('/') }}/uploads/{{ $photo->photo_url }}" alt="Image" height="100" width="100" />
                                <span class="delete-img"><i class="fa fa-lg fa-trash"></i></span>
                            </div>
                            @endforeach                    
                        </div>
                                            
                        <div class="col-xs-12 col-md-12" style="margin-bottom: 20px">
                            <form id="form-files3" name="form-files3" action="{{ url('bsh_cases/uploadPhotos') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="case_id" value="{{ @$case->id }}">
                                <input type="hidden" name="type" value="3">
                                <!-- <label for="fileToUpload">Take or select photo(s)</label><br /> -->
                                <br />
                                <div class="input--file">
                                    <label for="files3">
                                      <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                          <circle cx="12" cy="12" r="3.2"/>
                                          <path d="M9 2l-1.83 2h-3.17c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-12c0-1.1-.9-2-2-2h-3.17l-1.83-2h-6zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
                                          <path d="M0 0h24v24h-24z" fill="none"/>
                                        </svg>
                                      </span>
                                    </label>
                                    <input style="display: none" type="file" name="files3[]" class="files" id="files3" multiple accept="image/*" capture="camera">
                                    <output id="list3" style="margin-bottom: 10px"></output>
                                </div>
                                <!-- <input type="file" name="files[]" id="files" multiple accept="image/*" capture="camera"> -->
                                <input type="submit" value="Upload" name="submit">                    
                            </form>
                        </div>
                        
                    </div>
                </div>
                
                <!-- <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block next" type="submit">Continue&nbsp;</button>
                    </div>
                </div> -->
                <div class="btn-group btn-group-justified" role="group" aria-label="">
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-default back" type="button">Back</button>
                
                    </div>
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-primary btn-lg btn-block next">Continue</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="step3">
            <h3>3. Take Note</h3>
            <form id="info-form">
                <div class="well">
                    <div class="row">
                        <div class="col-xs-12 col-md-13">
                            <div class="form-group">
                                <label>Case Time</label>
                                <!-- <input id="datePicker" name="case_time" class="form-control input-lg"> -->
                                <div class='input-group date' id='datePicker'>
                                    <input type='text' class="form-control" name="case_time" value="{{ @$case->case_time }}"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-13">
                            <div class="form-group">
                                <label>Case Location</label>
                                <input name="case_location" class="form-control input-lg" value="{{ @$case->case_location }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-13">
                            <div class="form-group">
                                <label>Driver Info</label>
                                <input name="driver_info" class="form-control input-lg" value="{{ @$case->driver_info }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-13">
                            <div class="form-group">
                                <label>Case Detail Info</label>
                                <input name="case_detail_info" class="form-control input-lg" value="{{ @$case->case_detail_info }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-13">
                            <div class="form-group">
                                <label>Damage Level</label>
                                <input name="damage_level" class="form-control input-lg" value="{{ @$case->damage_level }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-13">
                            <div class="form-group">
                                <label>Done Jobs</label>
                                <input name="done_jobs" class="form-control input-lg" value="{{ @$case->done_jobs }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-13">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea rows="4" name="note" class="form-control input-lg">{{ @$case->note }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-default back" type="button">Back</button>
                    
                        </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" >Save & Continue</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="step4">
            <div class="well">
                <h3>4. Complete</h3>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select id="status" name="status" title="Status" class="form-control  input-lg validate-select required-entry" defaultvalue="">
                                <option value="">-- Select Status --</option>
                                @foreach ($statuses as $key => $status)
                                <option value="{{ $key }}" {{ $case->status == $key ? 'selected' : '' }}>{{ @$status }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="btn-group btn-group-justified" role="group" aria-label="">                   
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-primary btn-lg btn-block" id="complete-btn">Complete</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="push"></div>

@endsection

@section('javascript')
<!-- <script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
<script src="{{ asset('js/imageviewer.min.js') }}"></script>  
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">    
    $(document).ready( function() {
        $('#datePicker').datetimepicker({
            format: 'DD/MM/YYYY HH:mm',
            @if ($case->case_time != null)
            date: new Date("{{ @$case->case_time }}"),            
            @endif
        });
    })

    $("#info-form").on('submit', (e) => {
        e.preventDefault()

        $.post({
            url: '{{ route('bsh_cases.save') }}',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                id: {{ @$case->id }},
                case_time: $('input[name="case_time"]').val(),
                case_location: $('input[name="case_location"]').val(),
                driver_info: $('input[name="driver_info"]').val(),
                case_detail_info: $('input[name="case_detail_info"]').val(),
                damage_level: $('input[name="damage_level"]').val(),
                done_jobs: $('input[name="done_jobs"]').val(),
                note: $('textarea[name="note"]').val(),
            },
            beforeSend: () => {

            },
            success: (data) => {
                if (data.result) {
                    alert('Save successfully');
                }
            },
            error: (xhr) => {
                alert('Error');
            }
        })        

        var nextId = $(e.target).parents('.tab-pane').next().attr("id");        
        $('[href="#'+nextId+'"]').tab('show');
    })

    function handleFileSelect(evt) {        
        var files = evt.target.files; // FileList object

        let target = evt.target;
        let type = $(target).closest('form').find('input[name="type"]').val()

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

          // Only process image files.
          if (!f.type.match('image.*')) {
            continue;
          }

          var reader = new FileReader();

          // Closure to capture the file information.
          reader.onload = (function(theFile) {
            return function(e) {
              // Render thumbnail.
              var span = document.createElement('span');
              span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                '" title="', escape(theFile.name), '"/>'].join('');
              document.getElementById('list' + type).insertBefore(span, null);
            };
          })(f);

          // Read in the image file as a data URL.
          reader.readAsDataURL(f);
        }
    }

    $('.files').on('change', handleFileSelect);

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

    $('.delete-img').on('click', function (e) {
        let div = $(this).closest("div") 
        let id = div.attr("id")        
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'DELETE',
            url: "{{ url('deleteCasePhoto') }}",
            dataType: 'json',
            data: {
                id: id, 
                _method: 'DELETE',
                _token: '{{ csrf_token() }}'
            },
            beforeSend: () => {
                return confirm("Are you sure?");
            },
            success: (data) => {
                if (data.result == 1) {                    
                    div.remove()
                }                
            },
            error: (xhr) => {
                alert('Error..!!');
            }
        })
    })

    $("#complete-btn").on('click', (e) => {
        $.post({
            url: '{{ url('bsh_cases/complete') }}',
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',
                id: '{{ @$case->id }}',
                status: $("#status option:selected").val()
            },
            success: (data) => {
                if (data.result) {
                    window.location = '{{ url('bsh_cases') }}'    
                }                
            },
            error: (xhr) => {
                alert('Error')
            }
        })
    })
 
</script>

<script type="text/javascript">
var apiGeolocationSuccess = function(position) {
    let current_lat = position.coords.latitude
    let current_lng = position.coords.longitude   

    window.map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: current_lat, lng: current_lng},
      zoom: 16
    });

    window.markers = [];    

    @if (isset($case->lat2) && $case->lat2 != null) 
    markers.push(new google.maps.Marker({          
        icon: '{{ asset('images/cust_location.png') }}',
        title: 'Customer Position 2',
        position: {lat: {{ @$case->lat2 }}, lng: {{ @$case->lng2 }}},
        map: map
    }));
    @endif

    window.customerLocation = new google.maps.LatLng(parseFloat({{ @$case->lat2 }}), parseFloat({{ @$case->lng2 }}))

    @if (!isset($case->lat2) || $case->lat2 == null) 
    markers.push(new google.maps.Marker({          
        icon: '{{ asset('images/cust_location.png') }}',
        title: 'Customer Position 1',
        position: {lat: {{ @$case->lat1 }}, lng: {{ @$case->lng1 }}},
        map: map
    }));

    window.customerLocation = new google.maps.LatLng(parseFloat({{ @$case->lat1 }}), parseFloat({{ @$case->lng1 }}))
    
    @endif

    markers.push(new google.maps.Marker({          
        icon: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
        title: 'Current Position',
        position: {lat: current_lat, lng: current_lng},
        map: map
    }));

    checkDistance(current_lat, current_lng)
    

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
    //tryGeolocation();    
    window.intervalGetLocation = setInterval(getGDVLocation, 10 * 1000)
}     

$.post({
    url: '{{ url('bsh_cases/getGDVLocation') }}',
    dataType: 'json',
    data: {
        _token: '{{ csrf_token() }}',
        gdv_id: '{{ @$case->user->gdv_id }}',            
    },
    success: (data) => {
        if (data.data) {
            let position = data.data.position
            apiGeolocationSuccess(position)
            checkDistance(position.coords.latitude, position.coords.longitude)
        }
    },
    error: (xhr) => {
        alert('Error')
    }
})

function getGDVLocation() {
    $.post({
        url: '{{ url('bsh_cases/getGDVLocation') }}',
        dataType: 'json',
        data: {
            _token: '{{ csrf_token() }}',
            gdv_id: '{{ @$case->user->gdv_id }}',            
        },
        success: (data) => {
            if (data.data) {
                let position = data.data.position
                //apiGeolocationSuccess(position)
                checkDistance(position.coords.latitude, position.coords.longitude)
                updateGDVMarker(position)
            }
        },
        error: (xhr) => {
            alert('Error')
        }
    })
}

function updateGDVMarker(position) {
    let lat = position.coords.latitude, lng = position.coords.longitude

    gdvMarker = window.markers.pop()
    gdvMarker.setMap(null)
    window.markers.push(new google.maps.Marker({          
        icon: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
        title: 'Current Position',
        position: {lat: lat, lng: lng},
        map: map
    }))
}

// var watchID = navigator.geolocation.watchPosition(function(position) {
//     checkDistance(position.coords.latitude, position.coords.longitude);
//     apiGeolocationSuccess(position);
// });

function checkDistance(lat, lng) {
    let gdvPos = new google.maps.LatLng(parseFloat(lat), parseFloat(lng))
    distance = google.maps.geometry.spherical.computeDistanceBetween(gdvPos, customerLocation)

    if (distance <= 200) {
        $("#confirmArrived").css('display', 'block');        
    }
}



initAutocomplete = function() {
    
}

initAutocomplete();
</script>

@endsection