@extends('layouts.app')

@section('title', 'Tags')

@section('content')
<table class="post-details">
    <tr>
      <th>ID</th>
      <th>Tag</th>
      <th>Post</th>
    </tr>
    @foreach($tags as $tag)
    <tr>
        <td>{{ $tag->id }}</td>
        <td>{{ $tag->name }}</td>
        <td>
            <a href="{{ route('tags.show', $tag->id)}}">Vai</a>
        </td>
    </tr>
    @endforeach
</table>
<div class="go-back">
  <a href="{{ route('posts.index')}}">Homepage</a>
</div>
@endsection