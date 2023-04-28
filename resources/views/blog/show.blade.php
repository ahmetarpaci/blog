@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{$data->title}}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on {{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y')}} , 2023 by {{$data->user->nickname}}</div>
                </header>
                <!-- Preview image figure-->
                @if ($data->image)
                    <figure class="mb-4"><img class="img-fluid rounded" src="{{url('/images/'.$data->image)}}" alt=""></figure>
                @endif
                <!-- Post content-->
                <section class="mb-5 text-pre-line">
                    {{$data->description}}
                </section>
            </article>
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
@endsection
