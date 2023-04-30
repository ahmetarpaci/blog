@extends('layouts.app')

@section('content')

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
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Edit/Delete</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($blogs as $key=>$blog )
        <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$blog->title}}</td>
            <td>{{Str::substr($blog->description, 0, 50) }}</td>
            <td>{{($blog->status == 1)? "Publish" : "Not Publish"}}</td>
            <td>
                <a href="{{ route('blog.show',$blog->slug)}} " target="_blank">Show</a>
                <a href="{{ route('blog.edit',$blog->id)}} ">Edit</a>
                <form action="{{ route('blog.destroy',$blog->id)}}" method="POST" class="d-inline-block">
                    @csrf
                    @method('delete')
                    <button class="btn btn-link p-0 " type="submit"> Delete </button>
                </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
