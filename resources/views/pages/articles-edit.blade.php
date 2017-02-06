@extends('base')

@section('styles')
    {{ Html::style('css/article-edit.css') }}
@endsection

@section('title','page Edit')

@section('content')

    <div class="page-header">
        <h1>Article Edit</h1>
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

        {{--print success messages--}}
    @elseif(!empty(session('feedback')))
        <div class="alert alert-success text-capitalize text-center">
            {{session('feedback')}}
        </div>
    @endif

    <div class="well">
        {{ Form::open(['route'=>['articles.edit-post',$article->getId()],'method'=>"put"]) }}
        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{$article->getId()}}">
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placekitten.com/150/150">
            </a>
            <div class="media-body">
                <p class="text-right">By
                {{($article->getAuthor())->getName()}}
                <h4 class="media-heading">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" value="{{$article->getTitle()}}"
                               name="title">
                    </div>
                </h4>
                <div class="form-group">
                    <label for="body">Body:</label>
                    <textarea class="form-control" rows="5" id="body" name="body">{{$article->getBody()}}</textarea>
                </div>
                <div class="form-group">
                    <label for="comment">Review:</label>
                    <textarea class="form-control" rows="5" id="comment"
                              name="review">{{$article->getReview()}}</textarea>
                </div>

                <ul class="list-inline list-unstyled">
                    <li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li>
                    <li>|</li>
                    <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>
                    <li>|</li>
                    <li>
                        <label for="">Stars: </label>
                        <label class="radio-inline"><input type="radio" name="rate" value="1"
                                                           @if($article->getRate()==1)checked="checked"@endif>1</label>
                        <label class="radio-inline"><input type="radio" name="rate" value="2"
                                                           @if($article->getRate()==2)checked="checked"@endif>2</label>
                        <label class="radio-inline"><input type="radio" name="rate" value="3"
                                                           @if($article->getRate()==3)checked="checked"@endif>3</label>
                        <label class="radio-inline"><input type="radio" name="rate" value="4"
                                                           @if($article->getRate()==4)checked="checked"@endif>4</label>
                        <label class="radio-inline"><input type="radio" name="rate" value="5"
                                                           @if($article->getRate()==5)checked="checked"@endif>5</label>
                    </li>
                    <li>|</li>
                    <li>
                        <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
                        <span><i class="fa fa-facebook-square"></i></span>
                        <span><i class="fa fa-twitter-square"></i></span>
                        <span><i class="fa fa-google-plus-square"></i></span>
                    </li>
                    <input type="submit" class="text-capitalize text-info " value="update!">
                    &nbsp;
                    <a href="{{route('articles.index')}}"
                       class="text-capitalize text-danger pull-right">back to list</a>
                </ul>
            </div>
        </div>
        {{Form::close()}}
    </div>
@endsection