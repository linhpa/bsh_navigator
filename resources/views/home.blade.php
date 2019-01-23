@extends('layouts.app')
@section('css')
<style type="text/css">
    .function-item {
      height: 200px;
      flex-basis: 20%;
      -ms-flex: auto;
      width: 150px;
      position: relative;
      padding: 10px;
      box-sizing: border-box;
      display: inline-block;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Dashboard</div> -->

                <div class="panel-body" style="text-align: center;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- <strong>Statistic {{ date("d/m/Y") }}</strong> -->
                    <!-- <table class="table table-bordered">
                        <thead>
                            <tr>
                              <td>New</td>
                              <td>Pending</td>
                              <td>Done</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                <td>{{@$row->new}}</td>
                                <td>{{@$row->pending}}</td>
                                <td>{{@$row->done}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> -->
                    <div class="function-item text-center">                      
                        @if ($data[0]->new > 0) 
                        <span style="font-size: 15px; float: right;" class="label label-danger label-indicator animation-pulse">{{ $data[0]->new }}</span>
                        @endif
                        <a href="{{ url('bsh_cases?new=1') }}"><img src="{{ asset('images/new_orange.png') }}" height="100px" width="100px"></a>
                        <h4>New Cases</h4>
                    </div>
                    <br>
                    <div class="function-item text-center">
                        <a href="{{ url('bsh_cases') }}"><img src="{{ asset('images/folder-2-xxl.png') }}" height="70px" width="70px"></a>
                        <h4>All Cases</h4>
                    </div>
                    <!-- <a href="{{ route('bsh_cases.index') }}"><button class="btn btn-primary">Case List</button></a> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
