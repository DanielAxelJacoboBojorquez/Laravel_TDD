<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function store(){
        $data = request()->validate([
            'title' => '',
            'content' => ''
        ]);
        Post::create($data);
    }
}
