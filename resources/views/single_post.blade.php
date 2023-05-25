@extends('layouts.app')

@section('content')

<div class="mt-4 mb-3">
    <h2>{{$postsDetails->title}}</h2>
    <div>
        <img style="height: 200px" src="{{ asset('cover/'.$postsDetails->cover_image) }}" alt="cover-image">
    </div>
    <p class="mb-3">{{$postsDetails->description}}</p>
    <h6>Author Name: <b>{{$postsDetails->author->name}}</b></h6>
    <h6>Category Name: <b>{{$postsDetails->category->name}}</b></h6>
    <small class="text-danger my-3">{{$postsDetails->updated_at}}</small>
</div>

<div class="mb-4 d-flex align-items-center">
    <h5 class="me-4"> Favourite_</h5>
    <form action="{{route('add_favourite_')}}" method="POST" class="py-2 px-1 rounded-circle shadow border">
        @csrf
        <input type="hidden" name="post_id" value="{{$postsDetails->id}}">
        @if ($favourite == 1)
            <button type="submit" class="border-0 bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"    style="width:30px; color:red;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </button>
        @else
            <button type="submit" class="border-0 bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"    style="width:30px; color:rgb(48, 47, 47);">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </button>
        @endif
    </form>
</div>

<hr>
<div class="">
    <h5>Comment *</h5>
    <form class=" w-50" action="{{route('commentPost', $postsDetails->category->id)}}" method="POST">
        @csrf
        <div class="form-outline my-4">
            <input type="hidden" name="post_id" value="{{$postsDetails->id}}">
            <textarea class="form-control" name="comment" value="{{old('comment')}}" rows="2"></textarea>
            @error('comment')
              <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-warning btn-block mb-4">Post comment</button>
        </div>
    </form>
</div>
<hr>

@foreach ($postsComments as $postsComment)
    <div class="shadow border p-3 mt-2 bg-light">
        <p class="pb-0 mb-0 h5"><b>{{$postsComment->user->name}}_</b></p>
        <p class="pb-1">{{$postsComment->comment}}</p>

        @foreach ($commentsReplays as $commentsReplay)
            @if ($postsComment->id == $commentsReplay->comment_id)
                <div class="ms-4 mb-4">
                    <p class="pb-0 mb-0"><b>{{$commentsReplay->user->name}}_</b></p>
                    <small class="pb-3">{{$commentsReplay->replay}}</small>
                </div>
            @endif
        @endforeach

        <form action="{{route('replay')}}" method="POST">
            @csrf
            <input type="hidden" name="comment_id" value="{{$postsComment->id}}">
            <input type="hidden" name="post_id" value="{{$postsDetails->id}}">
            <input type="text" name="replay">
            <button type="submit" class="btn btn-success btn-block mb-1 py-1">Replay</button>
            @error('replay')
              <div class="text-danger">{{$message}}</div>
            @enderror
        </form>
    </div>
@endforeach

@endsection
