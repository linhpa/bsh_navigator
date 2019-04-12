@extends('layouts.app')

@section('css')
<style>
  .uper {
    margin-top: 40px;
  }

    @import url("https://fonts.googleapis.com/css?family=Roboto:400,700");

body {
  color: #000;
  font-family: "Roboto", sans-serif;
  /*font-size: 18px;
  font-weight: 400;*/
  line-height: 1.6;
}

.container {
  max-width: 1335px;
  margin: 0 auto;
}

.grid-row {
  display: flex;
  flex-flow: row wrap;
  justify-content: flex-start;
}

.grid-item {
  height: 350px;
  flex-basis: 20%;
  -ms-flex: auto;
  width: 259px;
  position: relative;
  padding: 10px;
  box-sizing: border-box;
}

.grid-row a {
  text-decoration: none;
}

.wrapping-link {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  z-index: 2;
  color: currentColor;
}

.grid-item-wrapper {
  -webkit-box-sizing: initial;
  -moz-box-sizing: initial;
  box-sizing: initial;
  background: #ececec;
  margin: 0;
  height: 100%;
  width: 100%;
  overflow: hidden;
  -webkit-transition: padding 0.15s cubic-bezier(0.4,0,0.2,1), margin 0.15s cubic-bezier(0.4,0,0.2,1), box-shadow 0.15s cubic-bezier(0.4,0,0.2,1);
  transition: padding 0.15s cubic-bezier(0.4,0,0.2,1), margin 0.15s cubic-bezier(0.4,0,0.2,1), box-shadow 0.15s cubic-bezier(0.4,0,0.2,1);
  position: relative;
}

.grid-item-container {
  height: 100%;
  width: 100%;
  position: relative;
}

.grid-image-top {
  height: 30%;
  width: 120%;
  background-size: cover;
  position: relative;
  background-position: 50% 50%;
  left: -10.5%;
  top: -4.5%;
}

.grid-image-top .centered {
  font-size: 20px;
  font-weight: 700;
  text-align: center;
  transform: translate(-50%, -50%);
  background-size: contain;
  background-repeat: no-repeat;
  position: absolute;
  top: 54.5%;
  left: 50%;
  width: 60%;
  height: 60%;
  background-position: center;
}

.grid-image-top.new-case {
  background: -webkit-gradient(linear,left top, left bottom,from(#1AA9FB),to(#1785C4));
  background: -webkit-linear-gradient(#1AA9FB,#1785C4);
  background: -o-linear-gradient(#1AA9FB,#1785C4);
  background: linear-gradient(#1AA9FB,#1785C4);
}

.grid-image-top.pending-case {
  background: -webkit-gradient(linear,left top, left bottom,from(#FFB266),to(#FF9933));
  background: -webkit-linear-gradient(#FFB266,#FF9933);
  background: -o-linear-gradient(#FFB266,#FF9933);
  background: linear-gradient(#FFB266,#FF9933);
}

.grid-image-top.done-case {
  background: -webkit-gradient(linear,left top, left bottom,from(#2db89a),to(#00793d));
  background: -webkit-linear-gradient(#2db89a,#00793d);
  background: -o-linear-gradient(#2db89a,#00793d);
  background: linear-gradient(#2db89a,#00793d);
}

.grid-item-content {
  padding: 0 20px 20px 20px;
}

.item-title {
  font-size: 20px;
  line-height: 26px;
  font-weight: 700;
  margin-bottom: 18px;
  display: block;
}

.item-category {
  text-transform: uppercase;
  display: block;
  margin-bottom: 20px;
  font-size: 14px;
  -o-text-overflow: ellipsis;   /* Opera */
    text-overflow:    ellipsis;   /* IE, Safari (WebKit) */
    overflow:hidden;              /* don't show excess chars */
    white-space:nowrap;           /* force single line */
    width: 300px;                 /* fixed width */
}

.item-excerpt {
    margin-bottom: 20px;
    display: block;
    font-size: 14px;
  
    -o-text-overflow: ellipsis;   /* Opera */
    text-overflow:    ellipsis;   /* IE, Safari (WebKit) */
    overflow:hidden;              /* don't show excess chars */
    white-space:nowrap;           /* force single line */
    width: 300px;                 /* fixed width */
}

.customer-name-box {
    -o-text-overflow: ellipsis;   /* Opera */
    text-overflow:    ellipsis;   /* IE, Safari (WebKit) */
    overflow:hidden;              /* don't show excess chars */
    white-space:nowrap;           /* force single line */
    width: 300px;                 /* fixed width */   
}

.more-info {
  position: absolute;
  bottom: 0;
  margin-bottom: 25px;
  padding-left: 0;
  transition-duration: .5s;
  font-size: 12px;
  display: flex;
}

.more-info i {
  padding-left: 5px;
  transition-duration: .5s;
}

.grid-item:hover .more-info i {
  padding-left: 20px;
  transition-duration: .5s;
}

.more-info i::before {
  font-size: 16px;
}

.grid-item:hover .grid-item-wrapper {
  padding: 2% 2%;
  margin: -2% -2%;
}

@media(max-width: 1333px) {
  .grid-item {
    flex-basis: 33.33%;
  }
}

@media(max-width: 1073px) {
   .grid-item {
    flex-basis: 33.33%;
  }
}

@media(max-width: 815px) {
  .grid-item {
    flex-basis: 50%;
  }
}

@media(max-width: 555px) {
  .grid-item {
    flex-basis: 100%;
  }
}

.modal {
  text-align: center;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

</style>
@endsection
@section('content')
<div class="uper">
    <h2 style="text-align: center;">Case List</h2>
    <!-- <table class="table table-bordered">
        <thead>
            <tr>
                
                <td>Name</td>
                <td>Phone</td>
                <td>Agent</td>
                <td>Address 1</td>
                <td>Address 2</td>
                <td>Updated At</td>
                <td>Status</td>
                <td colspan="2">Action</td>
            </tr>
        </thead>   
        <tbody>
            @foreach($cases as $case)
            <tr>
                
                <td>{{@$case->customer_name}}</td>
                <td>{{@$case->customer_phone}}</td>
                <td>{{@$case->user->name}}</td>
                <td>{{@$case->address1}}</td>
                <td>{{@$case->address2}}</td>
                <td>{{@$case->updated_at}}</td>
                <td>{{@$statuses[$case->status] ?: 'New'}}</td>
                <td>
                    <a href="{{ url('bsh_cases/handle', $case->id)}}" class="btn btn-primary">
                        @if ($case->status == 3 || $case->status == 2) 
                        Edit
                        @else
                        Take Case
                        @endif
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> -->

        <div class="container">
          <div class="grid-row">
            @foreach($cases as $case)
            <div class="grid-item">
              <!-- <a class="wrapping-link" href="{{ url('bsh_cases/handle', $case->id)}}"></a> -->
              <!-- <a class="wrapping-link" href="{{ url('bsh_cases/handle', $case->id)}}" @if($case->status != 2 && $case->status != 3) onclick="return confirm('Are you sure to take this case?')" @endif> </a> -->
              <div class="grid-item-wrapper">
                <div class="grid-item-container">
                  <!-- @if (@$case->status == 3)
                  <div class="grid-image-top done-case">
                  @elseif (@$case->status == 2)         
                  <div class="grid-image-top pending-case">         
                  @else
                  <div class="grid-image-top new-case">
                  @endif -->
                  <div class="grid-image-top pending-case">
                    <span class="centered customer-name-box">{{@$case->customer_name}} <br> {{@$case->customer_phone}}</span>
                  </div>
                  <div class="grid-item-content">
                    <span class="item-title">Case ID: {{ @$case->id }} -- {{ @$statuses[@$case->status] }}</span>
                    <span class="item-category">{{ @$case->description }}</span>
                    <span class="item-excerpt">Address 1: {{ @$case->address1 }}</span>                    
                    <span class="item-excerpt">Address 2: {{ @$case->address2 }}</span>                    
                    @if ($case->status == null || $case->status == 1 || $case->status == 4)
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#takeCaseModal-{{ @$case->id }}">Take/Reject Case</button>
                    @else
                    <a href="{{ url('bsh_cases/handle', $case->id, true)}}"><button type="button" class="btn btn-info btn-lg">Edit Case</button></a>
                    @endif
                  </div>
                  
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div id="takeCaseModal-{{ @$case->id }}" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Case ID: {{ @$case->id }}</h4>
                  </div>
                  <div class="modal-body">
                    <p><strong>Do you want to take this case?</strong></p>
                    <p class=""><strong>Case ID: {{ @$case->id }}</strong></p>
                    <p class="">Description: {{ @$case->description }}</p>
                    <p class="">Address 1: {{ @$case->address1 }}</p>                    
                    <p class="">Address 2: {{ @$case->address2 }}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="takeCaseConfirm({{ @$case->id }})">Take</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectCaseModal-{{ @$case->id }}">Reject</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>

            <!-- reject modal -->
            <div id="rejectCaseModal-{{ @$case->id }}" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Case ID: {{ @$case->id }}</h4>
                  </div>
                  <div class="modal-body">
                    <p><strong>Rejection Reason</strong></p>
                    <div style="width: 100%">
                        <textarea style="width: 100%" rows="3" id="rejectionReason-{{ @$case->id }}" placeholder="Enter rejection reason here..."></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="rejectCase({{ @$case->id }})">Confirm Reject</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
            @endforeach
          </div>
        </div>


    <div class="text-center">
        {{ $cases->appends(Request::all())->links() }}
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    async function takeCaseConfirm(caseId) {
        if (!caseId) {
            return 
        }

        let take_confirm = await confirm('Are you sure to take this case?')

        if (!take_confirm) {
            return
        }

        let data = {
            _token: "{{ csrf_token() }}",
            case_id: caseId
        }

        $.ajax({
            method: "POST",
            url: "{{ url('bsh_cases/takeCase') }}",
            data: data,
            success: (data) => {
                window.location = "{{ url('bsh_cases/handle') }}/" + caseId
            },
            error: (e) => {
                console.log(e)
            }
        })
    }

    function rejectCase(caseId) {
        if (!caseId) {
            return 
        }

        let data = {
            _token: "{{ csrf_token() }}",
            case_id: caseId,
            rejection_reason: $("#rejectionReason-" + caseId).val()
        }

        $.ajax({
            method: "POST",
            url: "{{ url('bsh_cases/rejectCase') }}",
            data: data,
            success: (data) => {
                window.location = "{{ route('home') }}"
            },
            error: (e) => {
                console.log(e)
            }
        })
    }
</script>
@endsection