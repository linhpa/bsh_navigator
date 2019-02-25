@extends('layouts.app')

@section('css')

<style>
  .card {
    margin: 20px
  }

  .card-header {
    font-size: 20px;
  }

  .uper {
    margin-top: 40px;
  }
</style>

@endsection

@section('content')
<div class="card uper">
  <div class="card-header">
    User ID: <strong>{{ $user->id }}</strong>
  </div>
  <div class="card-body">
    
  
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">
          <label for="email">Email:</label>
          <input readonly type="text" class="form-control" name="email" value="{{ $user->email }}" />
        </div>
        <div class="form-group">
          <label for="name">Name: </label>
          <input readonly type="text" class="form-control" name="name" value="{{ $user->name }}"  />
        </div>
        <div class="form-group">
          <label for="phone">Phone :</label>
          <input readonly type="text" class="form-control" name="phone" value="{{ $user->phone }}" />
        </div>
        <div class="form-group">
          <label for="gdv_id">GDV ID:</label>
          <input readonly type="text" class="form-control" name="gdv_id" value="{{ $user->gdv_id }}" />
        </div>
        <div class="form-group">
          <label for="role">Role:</label>
          <input readonly type="text" class="form-control" name="role" value="{{ $user->role }}" />
        </div>
        <a href="{{ url()->previous() }}"><button class="btn btn-primary">Exit</button></a>
  </div>
</div>
@endsection