@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<table class="post-details">
    <tr>
      <th>Titolo</th>
      <th>Categoria</th>
      <th>Autore</th>
      <th>Immagine</th>
      <th>Descrizione</th>
      <th>Tags</th>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <td>{{ $post['title'] }}</td>
      <td>{{ $category['title'] }}</td>
      <td>{{ $post->users['name'] }}</td>
      <td><img src="@if(Auth::user()){{asset($post->image_path)}}@else{{ $post->image_path }}@endif" alt="image"></td>
      <td>{{ $info['description'] }}</td>
      <td>
        @foreach($post->tags as $tag)
          <a href="{{ route('tags.show', $tag->id)}} ">{{ $tag->name }}</a>
          <br>
        @endforeach
      </td>
      <td><a class="btn btn-success" href="{{ route('posts.edit', $post->id)}}">Modifica</a></td>
      <td>
        <form action="{{ route("posts.destroy",$post->id) }}" method="post">
          @csrf
          @method("delete")
          <button type="submit" class="btn btn-danger">Elimina</button>
        </form>
      </td>
    </tr>
  </table>
  <div class="go-back">
    <a href="{{ route('posts.index')}}">Indietro</a>
  </div>
@endsection
