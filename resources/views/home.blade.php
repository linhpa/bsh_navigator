@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <strong>Statistic {{ date("d/m/Y") }}</strong>
                    <table class="table table-bordered">
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
                    </table>
                    <a href="{{ route('bsh_cases.index') }}"><button>Case List</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
