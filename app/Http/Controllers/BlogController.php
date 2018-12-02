<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // we will create index function 
        // we need to show all data from "blog"  table
       // $blogs = Blog::all(); 
        // show data to our view
        //pagingnation using Query Builder
        //$blogs = DB::table('blog_post')->paginate(10);
        //pagingnation using Eloquent

        $blogs = Blog::paginate(10);
        return view('blog.index',['blogs' => $blogs]); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // we will return to our new views
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // We will create validation function here
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->description = $request->description;
        // save all data
        $blog->save();
        //redirect page after save data
        return redirect('blog')->with('message','data hasben update!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        //return to 404 page
        if(!$blog){
            abort(404);
        }
        //display article to single page
        return view('blog.detail')->with('blog',$blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit function here
        $blog = Blog::find($id);

        // return to 404 page
        if(!$blog){
            abort(404);
        }
        // display the article to single page

        return view('blog.edit')->with('blog',$blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // we will create validation function here
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        // save all data
        $blog->save();
        //redirect page after save data
        return redirect('blog')->with('message','data has been edited!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete id
        $blog = Blog::find($id);
        $blog->delete();
        //redirect page after save data
        return redirect('blog')->with('message','data hasbeen deleted!');
    }
}
