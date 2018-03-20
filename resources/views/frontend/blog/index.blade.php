@extends('layouts.master')

@section('title')
    Blog index
@endsection

@section('styles')
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/font-awesome.min.css">
@endsection

@section('content')
    @foreach($posts as $post)
        <article class="blog-post">
            <h3>{{ $post->title }}</h3>
            <span class="subtitle">{{ $post->author }} | {{ $post->created_at }}</span>
            <p>{{ $post->body }}</p>
            <a href="#">Read more</a>
        </article>
    @endforeach

    <!-- If more than one page of results -->
    @if($posts->lastPage() > 1)
        <section class="pagination">
            <!-- If not on first page -->
            @if($posts->currentPage() != 1)
                <a href="{{ $posts->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
            @endif
            <!-- If not on last page -->
            @if($posts->currentPage() != $posts-lastPage())
                <a href="{{ $posts->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
            @endif
        </section>
    @endif
@endsection