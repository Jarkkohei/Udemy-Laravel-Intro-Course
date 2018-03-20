@extends('layouts.admin-master')

@section('content')
<div class="container">
    <section id="post-admin">
        <a class="btn" href="{{ route('admin.blog.post.edit', ['post_id' => $post->id]) }}">Edit Post</a>
        <a class="btn" href="{{ route('admin.blog.post.delete', ['post_id' => $post->id]) }}">Delete Post</a>
    </section>
    <section class="post">
    <h1>{{ $post->title }}</h1>
    <span class="info-box">{{ $post->author }} | {{ $post->created_at }}</span>
    <p>{{ $post->body }}</p>
    </section>
</div>
@endsection