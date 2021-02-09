@extends('layouts.app')

@section('title', 'post')

@section('content')

<table class="post-details">
    <tr>
        <th>Tag</th>
        <th>Post Id</th>
        <th>Post Title</th>
        <th><a class="btn btn-success" href="{{ route('tags.index') }}">Lista Tag</a></th>
    </tr>
    @foreach($tag->posts as $post)
    <tr>
        <td>{{ $tag->name }}</td>
        <td>{{ $post->id }}</td>
        <td>{{ $post->title }}</td>
        <td>
            <a href="{{ route('posts.show', $post->id)}}">Vai al post</a>
        </td>
    </tr>
    @endforeach
</table>
<div class="go-back">
    <a href="{{ route('posts.show', $post['id'])}}">Indietro</a>
</div>

@endsection