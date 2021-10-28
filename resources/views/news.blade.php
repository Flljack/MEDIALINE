@extends('layout')

@section('title'){{$news->title}}@endsection
@section('content')
    <div class="card full">
        <div class="card-info">
            <div class="card-date">
            <span>
                {{\Carbon\Carbon::parse($news->created_at)->format('d/m/Y H:i')}}
            </span>
            </div>
            <h6>{{$news->author}}</h6>
            <h2>{{$news->title}}</h2>
            {!!$news->description !!}

        </div>
    </div>
@endsection
