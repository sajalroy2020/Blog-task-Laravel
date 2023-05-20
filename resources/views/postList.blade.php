@extends('layouts.app')

@section('content')
<h2 class="mt-5">All Post List</h2>
<table class="table table-hover border mt-3">
    <thead class="bg-light shadow-sm">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Cover</th>
        <th scope="col">Author</th>
        <th scope="col">Category</th>
        <th scope="col">Publish status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($posts as $key => $post)
        <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$post->title}}</td>
            <td><img src="cover/{{ $post->cover_image }}" class="img-responsive" style="max-height:100px; max-width:100px" alt="" srcset=""></td>
            <td>{{$post->author->name}}</td>
            <td>{{$post->category->name}}</td>
            <td>{{$post->published_at ? "Published" : "Draft"}}</td>
            <td>
                <a href="{{route('single_post', $post->id)}}"><button class="btn btn-warning text-black">View</button></a>
                <a href="{{route('post_edit', $post->id)}}"><button class="btn btn-success mx-1">Edit</button></a>
                <a href="{{route('post_destroy', $post->id)}}"><button class="btn btn-danger">Delete</button></a>
                {{-- <form action="{{route('post_destroy', $post->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form> --}}
            </td>

        </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-2">No Data Found</td>
            </tr>
        @endforelse
    </tbody>
  </table>
@endsection
