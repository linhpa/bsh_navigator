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
    Edit User ID: <strong>{{ $user->id }}</strong>
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
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
      <form method="post" action="{{ route('users.update', $user->id) }}">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">
          <label for="email">Email:</label>
          <input readonly type="text" class="form-control" name="email" value="{{ $user->email }}" />
        </div>
        <div class="form-group">
          <label for="name">Name: </label>
          <input type="text" class="form-control" name="name" value="{{ $user->name }}"  />
        </div>
        <div class="form-group">
          <label for="phone">Phone :</label>
          <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" />
        </div>
        <div class="form-group">
          <label for="gdv_id">GDV ID:</label>
          <input type="text" class="form-control" name="gdv_id" value="{{ $user->gdv_id }}" />
        </div>
         <div class="form-group">
          <label for="role">Role:</label>
          <select id="role" type="text" class="form-control" name="role" value="{{ $user->role }}" required>
              @foreach ($roles as $role) 
              <option value="{{ $role->role }}" {{ ($role->role == $user->role) ? "selected" : "" }}>{{ $role->role }}</option>
              @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection