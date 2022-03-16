@extends('layouts.base')

@section('title', 'posts list')


@section('content')

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">title</th>
        <th scope="col">content</th>
        <th scope="col">published</th>
        <th scope="col">slug</th>
        <th scope="col"><a href="{{route("admin.posts.create")}}"><button type="button" class="btn btn-success">create</button></a></th>
        <th scope="col"><a href="{{route("admin.home")}}"><button type="button" class="btn btn-info">back</button></a></th>
    </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td scope="row">{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->content}}</td>
            <td>{{$post->published}}</td>
            <td>{{$post->slug}}</td>
            <td><a href="{{route("admin.posts.show", $post->id)}}"><button type="button" class="btn btn-primary">show</button></a></td>
            <td><a href="{{route("admin.posts.edit", $post->id)}}"><button type="button" class="btn btn-warning">edit</button></a></td>
        </tr>
        @endforeach
    
    </tbody>
</table>
    
@endsection