@extends('layouts.app')

@section('css')
<style>
  .uper {
    margin: 20px
  }
</style>
@endsection

@section('content')
<div class="uper">
    <h2 style="text-align: center;">User List</h2>
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
    <div>
      <a href="{{ route('register') }}"><button class="btn btn-success"><i class="fa fa-plus"></i> </button></a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
              <td>User ID</td>
              <td>Email</td>
              <td>Name</td>
              <td>Phone</td>
              <td>GDV ID</td>
              <td>Role</td>
              <td>Created At</td>
              <td>Updated At</td>
              <td>Command</td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{@$user->id}}</td>
                <td>{{@$user->email}}</td>
                <td>{{@$user->name}}</td>
                <td>{{@$user->phone}}</td>
                <td>{{@$user->gdv_id}}</td>
                <td>{{@$user->role}}</td>
                <td>{{@$user->created_at}}</td>
                <td>{{@$user->updated_at}}</td>                
                <td>                    
                    <a href="{{ route('users.edit', $user->id) }}">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    </a>
                    <div style="display: inline-block;">
                    @if ($user->role != 'admin')
                    <form id="destroy-form" action="{{ route('users.destroy', $user->id)}}" method="post">
                      {{ csrf_field() }}                      
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash"></i></button>
                    </form>     
                    @endif                  
                    </div>                 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {{ $users->appends(Request::all())->links() }}
    </div>
</div>

@endsection
