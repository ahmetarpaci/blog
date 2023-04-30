@extends('layouts.app')

@section("content")
<div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nick name</th>
            <th scope="col">User Name</th>
            <th scope="col">Status</th>
            <th scope="col">Admin/Ban/SuspendDelete/</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($userlist as $key=>$user )
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$user->nickname}}</td>
                <td>{{$user->name }}</td>
                <td>
                    @switch($user->status)
                        @case(0)
                            Delete User
                            @break
                        @case(1)
                            User
                            @break
                        @case(2)
                            Admin
                            @break
                        @case(3)
                            Suspend User
                            @break
                        @default
                    @endswitch
                </td>
                <td>
                    @if($user->email == "admin@admin.com")
                    @else
                    @if ($user->status == 2)
                    <form action="{{route("useradd", $user->id)}}" method="POST" class="d-inline-block">
                        @csrf
                        <button class="btn btn-link p-0 " type="submit"> Normal User  </button>
                    </form>
                    @else
                    <form action="{{route("adminadd", $user->id)}}" method="POST" class="d-inline-block">
                        @csrf
                        <button class="btn btn-link p-0 " type="submit"> Admin  </button>
                    </form>
                    @endif
                    <form action="{{route("activeuser", $user->id)}}" method="POST" class="d-inline-block">
                        @csrf
                        <button class="btn btn-link p-0 " type="submit"> Active  </button>
                    </form>
                    <form action="{{route("banuser", $user->id)}}" method="POST" class="d-inline-block">
                        @csrf
                        <button class="btn btn-link p-0 " type="submit"> Ban  </button>
                    </form>
                    <form action="{{route("suspenduser", $user->id)}}" method="POST" class="d-inline-block">
                        @csrf
                        <button class="btn btn-link p-0 " type="submit"> Suspend </button>
                    </form>
                    <form action="{{route("deleteuser", $user->id)}}" method="POST" class="d-inline-block">
                        @csrf
                        <button class="btn btn-link p-0 " type="submit"> Delete </button>
                    </form>
                    @endif
                </td>
              </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
