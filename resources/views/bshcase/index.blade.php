@extends('layouts.app')

@section('css')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
@endsection
@section('content')
<div class="uper">
    <h2>Case List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <!-- <td>Case ID</td> -->
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
                <!-- <td>{{@$case->case_id}}</td> -->
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
    </table>
    <div class="text-center">
        {{ $cases->appends(Request::all())->links() }}
    </div>
</div>

@endsection