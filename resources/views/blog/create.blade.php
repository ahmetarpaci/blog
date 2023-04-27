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
        <form action="{{ route('blog.store')}}" method="post">
            @csrf
            <div class="col-lg-8 bg-white p-3">
                <h1 class="bd-title" id="content">Create Blog</h1>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" >
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Publish Date</label>
                    <input type="text" class="form-control" id="datepicker" width="276" />
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
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap5'
    });
</script>
@endsection


