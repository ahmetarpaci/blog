@extends('layouts.app')
@section('header')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8 bg-white p-3">
        <form action="{{ route('blog.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12 bg-white p-3">
                @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                            {{ $error }} <br>
                            @endforeach
                        </div>
                @endif
                <h1 class="bd-title" id="content">Create Blog</h1>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Pictures</label>
                    <input class="form-control" type="file" id="formFile" name="formFile">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" >
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Description</label>
                    <textarea class="form-control" id="Description" name="description" rows="13"></textarea>
                </div>
                <div class="mb-3">
                    <label for="datepicker" class="form-label">Publish Date</label>
                    <input type="text" class="form-control" id="datepicker" name="publish_date"  width="276" />
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="status" checked value="">
                    <label class="form-check-label" for="flexCheckDefault">
                      Publish
                    </label>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Publish</button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
@section('footerjs')
<script>
    let today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap5',
        minDate : today,

    });
</script>
@endsection


