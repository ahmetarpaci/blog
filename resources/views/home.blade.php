@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            @foreach ($blogs as $key => $blog )
            @if ($key == 0)
                <div class="card mb-4">
                    @if ($blog->image)
                        <img class="card-img-top hero-blog-img" src="{{url('/images/'.$blog->image)}}" alt="{{$blog->title}}">
                    @endif

                    <div class="card-body">
                        <div class="small text-muted">{{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y')}}</div>
                        <h2 class="card-title">{{$blog->title}}</h2>
                        <p class="card-text">{{Str::substr($blog->description, 0, 250) }}...</p>
                        <a class="btn btn-primary" href="{{route('blog.show' , $blog->slug)}}">Read more →</a>
                    </div>
                </div>
            @else
            <!-- Nested row for non-featured blog posts-->
            @if ($key == 1)
                <div class="row">
                @endif
                    <div class="col-sm-6">
                        <div class="card mb-4">
                            @if ($blog->image)
                                <img class="card-img-top sub-blog-img" src="{{url('/images/'.$blog->image)}}" alt="{{$blog->title}}">
                            @endif
                            <div class="card-body">
                                <div class="small text-muted">{{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y')}}</div>
                                <h2 class="card-title">{{$blog->title}}e</h2>
                                <p class="card-text">{{Str::substr($blog->description, 0, 250) }}...</p>
                                <a class="btn btn-primary" href="{{route('blog.show' , $blog->slug)}}">Read more →</a>
                            </div>
                        </div>
                    </div>
                @if ($key == count($blogs)-1)
                </div>
            @endif

            @endif
            @endforeach
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
