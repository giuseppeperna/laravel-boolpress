@extends('layouts.app')

@section('title', 'Posts')

@section('content')


<form class="search-bar" method="get" action="{{ route('posts.index')}}">
    @csrf
    <input type="text" class="form-control" name="search" placeholder="Cerca...">
    <button class="btn btn-success" type="submit">Trova</button>
    <a class="btn btn-danger" href="{{ route('posts.index')}}">Cancella</a>
</form>


<table class="post-details">
    <tr>
        <th>Id</th>
        <th>Titolo</th>
        <th>Autore</th>
        <th>Slug</th>
        <th><a class="btn btn-success" href="{{ route('posts.create') }}">Crea nuovo post</a></th>
    </tr>
    
    @foreach ($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->author }}</td>
        <td>{{ $post->postInfo['slug'] }}</td>
        <td>
            <a href="{{ route('posts.show', $post->id) }}">Dettagli</a>
        </td>
    </tr>
    @endforeach
</table>

@if(!$search)
<div class="pagination">
    {{ $posts->links() }}
</div>
@endif

@endsection