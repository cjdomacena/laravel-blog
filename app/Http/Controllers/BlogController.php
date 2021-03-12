<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function index()
    {
        //Get All blogs.
        $blogs=Blog::all();

        return view('welcome',compact('blogs'));
    }


    public function show($id)
    {
        //Search for the blog that corresponds to given blog id
        $blog = Blog::query()->where('id',$id)->get()->first();

        //Get the User related to the blog
        $user = User::query()
            ->where('id',$blog->user_id)
            ->get('name')
            ->first();

        //store user's name to author
        $author = $user['name'];

        //Return information to blog-layout
        return view('components.blog-layout',compact('blog','author'));
    }
}
