<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posted;
use Auth;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Posted::where('is_deleted','0')->orderBy('id','desc')->get();
        // echo '<pre>';print_r($post);die;
        return view('home')->with(['post'=>$post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.set-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Posted;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->slug = Str::slug($request->title);
        $post->user_id = Auth::user()->id;
        if($request->file('featured_image') != ''){
            $request->validate([
                'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $result = array($request->file('featured_image')->getClientOriginalExtension());
            $file = $request->file('featured_image');
            $files = $file->getClientOriginalName();
            $file->move('images', $files);
            $name = $files;
        }

        if($name != ''){
            $newUser->featured_image = $name;
        }
        
        $post->save();
        return redirect()->back()->with(['status','Post Added Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posted::find($id);
        return view('partials.set-post')->with(['post'=>$post]);
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
        $post =Posted::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->slug = Str::slug($request->title);
        // $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->back()->with(['status','Post Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posted::where('id',$id)->update(['is_deleted'=>'1']);
        return redirect()->back()->with(['status'=>'Post Deleted Successfully!!']);
    }
}
