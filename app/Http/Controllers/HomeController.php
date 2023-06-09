<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $data['posts'] = Post::with(['author', 'category'])->paginate();
        return view('home', $data);
    }
}
