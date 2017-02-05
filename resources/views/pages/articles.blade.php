@extends('base')


@section('title','Articles')

@section('stylesheets')
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
@endsection
@section('content')

    <div class="page-header">
        <h1>Article Creation</h1>
    </div>

    {{--print success message--}}
    @if(session('feedback'))
        <div class="alert alert-success">
            {{session('feedback')}}
        </div>
    @endif

    @if(!empty($data))
        @foreach($data as $userKey=>$article)
            <div class="well">
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placekitten.com/150/150">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$article->getTitle()}}</h4>
                        <p class="text-right">By {{($article->getAuthor())->getName()}}</p>
                        <p>{{$article->getBody()}}</p>

                        @if(!empty($article->getReview()))
                            <p class="text-info">Review : {{$article->getReview()}}</p>
                        @endif

                        <ul class="list-inline list-unstyled">
                            <li><span><i class="glyphicon glyphicon-calendar"></i> {{rand(0,9)}} days, {{rand(0,9)}}
                                    hours </span>
                            </li>
                            <li>|</li>
                            <span><i class="glyphicon glyphicon-comment"></i> {{rand(0,9)}} comments</span>
                            <li>|</li>
                            <li>
                                <span class="glyphicon {{$article->getRate()<1?'glyphicon-star-empty':'glyphicon-star'}}"></span>
                                <span class="glyphicon {{$article->getRate()<2?'glyphicon-star-empty':'glyphicon-star'}}"></span>
                                <span class="glyphicon {{$article->getRate()<3?'glyphicon-star-empty':'glyphicon-star'}}"></span>
                                <span class="glyphicon {{$article->getRate()<4?'glyphicon-star-empty':'glyphicon-star'}}"></span>
                                <span class="glyphicon {{$article->getRate()<5?'glyphicon-star-empty':'glyphicon-star'}}"></span>
                            </li>
                            <li>|</li>
                            <li>
                                <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
                                <span><i class="fa fa-facebook-square"></i></span>
                                <span><i class="fa fa-twitter-square"></i></span>
                                <span><i class="fa fa-google-plus-square"></i></span>
                            </li>
                            <a href="{{route('articles.edit-view',$article->getId())}}"
                               class="text-capitalize text-info ">edit
                            </a>&nbsp;
                            <a href="{{route('articles.delete',$article->getId())}}"
                               class="text-capitalize text-danger pull-right delete-btn">delete
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach


        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{{route('article.create-get')}}" class="btn btn-primary center-block text-uppercase">create new
                    article</a>
            </div>
        </div>

        {{--Pagination was build manualy (without forloop)--}}
        <ul class="pagination">
            <li><a href="{{route('articles.index')}}?page=1&s=1">1</a></li>
            <li><a href="{{route('articles.index')}}?page=2&s=4">2</a></li>
            <li><a href="{{route('articles.index')}}?page=3&s=7">3</a></li>
            <li><a href="{{route('articles.index')}}?page=4&s=10">4</a></li>
            <li><a href="{{route('articles.index')}}?page=5&s=13">5</a></li>
            <li><a href="{{route('articles.index')}}?page=5&s=16">6</a></li>
            <li><a href="{{route('articles.index')}}?page=5&s=19">7</a></li>
            <li><a href="{{route('articles.index')}}?page=5&s=22">8</a></li>
            <li><a href="{{route('articles.index')}}?page=5&s=25">9</a></li>
            <li><a href="{{route('articles.index')}}?page=5&s=28">10</a></li>
        </ul>
    @else
        <script type="text/javascript">
            window.location = "{{ route('articles.generate') }}";//here double curly bracket
        </script>
    @endif
@endsection