<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Replay;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function index()
    {
        $data['categories'] = Category::all();
        return view('post', $data);
    }

    public function store(PostRequest $request)
    {
        $formData = $request->validated();

        if($request->hasFile("cover_image")){
            $file=$request->file("cover_image");
            $imageName=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("cover/"),$imageName);
            $formData['cover_image'] = $imageName;
        }

        if($request->has('published_at')){
            $formData['published_at'] = now();
        }

        $formData['user_id'] = Auth::id();

        if (Post::create($formData)) {
            return redirect()->route('postList')->with('SUCCESS_MESSAGE', 'Post Created successfully');
        }
        return redirect()->back()->withInput()->with('ERROR_MESSAGE', 'something went rong !..');
    }

    public function show()
    {
        $data['posts'] = Post::with(['author', 'category'])->paginate();
        return view('postList', $data);
    }

    public function details($id)
    {
        $userId = Auth::id();
        $data['postsDetails'] = Post::find($id);
        $data['postsComments'] = Comment::with(['user'])->where('post_id', $id)->get();
        $data['commentsReplays'] = Replay::with(['user'])->where('post_id', $id)->get();
        $data['favourite'] = Favourite::where('post_id', $id)->where('user_id', $userId)->value('is_favourite');
        return view('single_post', $data);
    }

    public function edit($id)
    {
        $data['categories'] = Category::all();
        $data['editData'] = Post::find($id);
        return view('editPost', $data);
    }

    // public function update(PostRequest $request, $id)
    // {
    //     $formData = $request->validated();

    //     if($request->has('published_at')){
    //         $formData['published_at'] = now();
    //     }

    //     $imgPath = '';
    //     $deleteOldImg = "cover/".$formData->cover_image;
    //     if($image = $request->file($formData['cover_image']) && $image = $formData['cover_image']){
    //        if (File::exists("cover/".$deleteOldImg)) {
    //           File::delete("cover/".$deleteOldImg);
    //        }
    //        $imgPath = time().'.'.$image->getClientOriginalExtension();
    //        $image->move(\public_path("/cover"),$imgPath);
    //     }else{
    //        $imgPath = $formData->cover_image;
    //     }
    //     $formData['cover_image'] = $imgPath;


    //     if (Post::findOrFail($id)->update($formData)) {
    //         return redirect()->route('postList')->with('SUCCESS_MESSAGE', 'Post Updated successfully');
    //     }
    //     return redirect()->back()->withInput()->with('ERROR_MESSAGE', 'something went rong !..');
    // }
    public function update(Request $request, $id){

        $updateData = Post::findOrFail($id);
        $imgPath = '';
        $deleteOldImg = 'cover/'.$updateData->cover_image;

        if($image = $request->file('cover_image')){
           if (File::exists($deleteOldImg)) {
              File::delete($deleteOldImg);
           }
           $imgPath = time().'.'.$image->getClientOriginalExtension();
           $image->move('cover/', $imgPath);
        }else{
           $imgPath = $updateData->product_img;
        }

        Post::findOrFail($id)->update([
            'category_id'=> $request->category_id,
            'title'=>$request->title,
            'description'=>$request->description,
            'cover_image'=>$imgPath,
        ]);
        return redirect()->route('postList')->with('SUCCESS_MESSAGE', 'Post updade successfully');
    }


    public function destroy($id)
    {
        $deleteData = Post::findOrFail($id);

         if (File::exists("cover/".$deleteData->cover_image)) {
            File::delete("cover/".$deleteData->cover_image);
        }

        if ($deleteData->delete()) {
            return redirect()->route('postList')->with('SUCCESS_MESSAGE', 'Post Delete successfully');
        }
        return redirect()->back()->withInput()->with('ERROR_MESSAGE', 'something went rong !..');
    }
}
