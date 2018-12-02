<?php

namespace App;
use App\Blog;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $table='blog_post';
    
    public  function index()
    {
        // We will create index function
        // we need to show all data from "blog" table

        $blogs = Blog::all();
        // Show data to our view

        return view('blog.index',['blogs' => $blogs]);
    }
}

