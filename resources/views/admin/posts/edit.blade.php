@extends('layouts.base')

@section('title','edit post')

@section('content')
    <h1>Edita post: {{$post->title}}</h1>  
    
    <form action="{{route("admin.posts.update", $post->id)}}" method="POST">
        
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo del post" value="{{old('title', $post->title)}}">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" placeholder="Inserisci il contenuto del post">{{old('content', $post->content)}}</textarea>
        </div>
        <div class="form-group">
            <label for="published">Published</label>
            <input type="text" class="form-control" id="published" name="published" placeholder="Inserisci 1 per pubblicare il posto 0 altrimenti" value="{{old('published', $post->published)}}">
        </div>
        <a href="{{route("admin.posts.index")}}"><button type="button" class="btn btn-primary">back</button></a>
        <button type="submit" class="btn btn-success">save</button>
    </form>
    <form id="ms_delete-btn" action="{{route("admin.posts.destroy", $post->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo post?');">delete</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
@endsection