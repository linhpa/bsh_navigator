@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Case ID</td>
          <td>Name</td>
          <td>Phone</td>
          <td>Agent</td>
          <td>Address 1</td>
          <td>Address 2</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($cases as $case)
        <tr>
            <td>{{@$case->case_id}}</td>
            <td>{{@$case->customer_name}}</td>
            <td>{{@$case->customer_phone}}</td>
            <td>{{@$case->user->name}}</td>
            <td>{{@$case->address1}}</td>
            <td>{{@$case->address2}}</td>
            <td><a href="{{ url('bsh_cases/handle', $case->id)}}" class="btn btn-primary">Take Case</a></td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection