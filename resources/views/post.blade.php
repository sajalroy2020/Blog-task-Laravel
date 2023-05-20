@extends('layouts.app')

@section('content')
    <h2 class="mt-4">Blog post Create</h2>
    <hr>
    <div class="w-50 p-4 shadow card mt-5">
      <form action="{{route('post_store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <select class="form-select p-2" name="category_id">
                <option selected>Open this select menu</option>
                @foreach ($categories as $category)
                    <option class="py-2 my-3" {{old('category_id' == $category->id ? 'selected' : '')}} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <label class="form-label" for="form4Example1">Select Category</label>
            @error('category_id')
                <div class="text-danger">{{$message}}</div>
              @enderror
        </div>

        <div class="form-outline my-4">
          <input type="text" name="title" class="form-control" value="{{old('title')}}" />
          <label class="form-label" for="form4Example1">Title</label>
          @error('title')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="form-outline mb-4">
          <textarea class="form-control" name="description" value="{{old('description')}}" id="form4Example3" rows="4"></textarea>
          <label class="form-label" for="form4Example3">Message</label>
          @error('description')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="form-outline my-4">
            <input type="file" name="cover_image" class="form-control"  />
            <label class="form-label" for="form4Example1">Cover Image</label>
            @error('cover_image')
              <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        {{-- <div class="form-outline my-4">
            <input type="file" id="input-file-now-custom-3" class="form-control" name="images[]" multiple>
            <label class="form-label" for="form4Example1">More Image</label>
            @error('cover_image')
              <div class="text-danger">{{$message}}</div>
            @enderror
        </div> --}}

        <div class="form-check  mb-4">
          <input class="form-check-input me-2" name="published_at" type="checkbox" value="{{old('published_at')}}" id="form4Example4" />
          <label class="form-check-label" for="form4Example4">
            Publish
          </label>
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4">Save</button>
      </form>
    </div>
@endsection
