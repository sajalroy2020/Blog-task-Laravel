@extends('layouts.app')

@section('content')
    <h2 class="mt-4">Blog post Update</h2>
    <hr>
    <div class="w-50 p-4 shadow card mt-5">
      <form action="{{route('post_update', $editData->id)}}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div>
            <select class="form-select p-2" name="category_id">
                <option selected>Open this select menu</option>
                @foreach ($categories as $category)
                    <option class="py-2 my-3" {{old('category_id', $editData->category_id) == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <label class="form-label" for="form4Example1">Select Category</label>
            @error('category_id')
                <div class="text-danger">{{$message}}</div>
              @enderror
        </div>

        <div class="form-outline my-4">
          <input type="text" name="title" class="form-control" value="{{old('title', $editData->title)}}" />
          <label class="form-label" for="form4Example1">Title</label>
          @error('title')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="form-outline mb-4">
          <textarea class="form-control" name="description" value="{{old('description')}}" id="form4Example3" rows="4">{{$editData->description}}</textarea>
          <label class="form-label" for="form4Example3">Message</label>
          @error('description')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="form-outline mb-4">
            <img width="150" height="150px" src="{{ asset('cover/'.$editData->cover_image) }}" alt="">
            <input type="file" class="form-control py-4 mb-3" name="cover_image" placeholder="image">
        </div>

        <div class="form-check  mb-4">
          <input class="form-check-input me-2" name="published_at" type="checkbox" value="{{old('published_at')}}" {{$editData->published_at ? 'checked' : ''}} id="form4Example4" />
          <label class="form-check-label" for="form4Example4">
            Publish
          </label>
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4">Update</button>
      </form>
    </div>
@endsection
