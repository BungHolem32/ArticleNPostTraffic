@extends('base')

@section('title','Create new Article')

@section('content')
    <div class="page-header">
        <h1>Article Creation</h1>
    </div>
    {{--print the errors --}}
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif(!empty(session('feedback')))
        <div class="alert alert-success text-capitalize text-center">
            {{session('feedback')}}
        </div>
    @endif


    {{ Form::open(['route'=>'article.create-post']) }}
    {{ csrf_field() }}
    <div class="form-group row">
        <label for="author" class="col-2 col-form-label">Author</label>
        <div class="col-10">
            <input class="form-control" type="text" value="Artisanal kale" id="name" name="name">
        </div>
    </div>
    <div class="form-group row">
        <label for="title" class="col-2 col-form-label">Title</label>
        <div class="col-10">
            <input class="form-control" type="text" value="title example" id="title" name="title">
        </div>
    </div>
    <div class="form-group row">
        <label for="body">Body</label>
        <textarea class="form-control" id="body" name="body" rows="3"></textarea>
    </div>
    <div class="form-group row">
        <label for="review">Review</label>
        <textarea class="form-control" id="review" name="review" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    {{ Form::close()}}

@endsection