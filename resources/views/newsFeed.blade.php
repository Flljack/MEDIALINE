@extends('layout')

@section('title', 'Новости')

@section('content')
    @foreach ($newsList as $news)
        <div class="card">
            <div class="card-info">
                <div class="card-date">
                <span>
					{{\Carbon\Carbon::parse($news->created_at)->format('d/m/Y H:i')}}
				</span>
                </div>
                <h6>{{$news->author}}</h6>
                <h2>{{$news->title}}</h2>
                <p>{{ Str::limit($news->description, 200) }}</p>
                <a class="card__show-more" href="{{route('news', $news->id)}}">подробнее</a>

            </div>
        </div>
    @endforeach
    {{ $newsList->links() }}
@endsection
