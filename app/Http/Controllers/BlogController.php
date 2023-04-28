<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(auth()->user()->status == 2)
        {
            $lists = Blog::orderBy('updated_at','desc')->get();
        }else{
            $lists = Blog::where('user_id',auth()->user()->id)->orderBy('updated_at','desc')->get();
        }
        return view("blog.index")->with('blogs',$lists);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            // 'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        if(isset($request->formFile))
        {
            $imagechange = uniqid() . '.' . $request->formFile->extension();
            $request->formFile->move(public_path('images'), $imagechange);
            $request["image"] = $imagechange;
        }

        // dd($imagechange);

        $request['slug'] = Str::slug($request->title);
        $request['publish_date'] = Carbon::parse($request->publish_date);
        $request['user_id'] = auth()->user()->id;


        // $request['created_at'] = $request->datepicker;
        Blog::create($request->all());
        // dd($request->all());
        return redirect('/blog')->with('message', 'Your post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $blogDetail = Blog::where('slug',$slug)->with('user')->first();
        return view('blog.show')->with("data",$blogDetail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(auth()->user()->status == 2)
        {
            $blog = Blog::where(["id"=>$id])->first();
        }else{
            $blog = Blog::where(["id"=>$id, 'user_id'=> auth()->user()->id])->first();
        }
        if($blog)
        {
            return view('blog.edit')->with('blog',$blog);
        }else{
            return redirect('/blog');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            // 'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        if(isset($request->formFile))
        {
            $imagechange = uniqid() . '.' . $request->formFile->extension();
            $request->formFile->move(public_path('images'), $imagechange);
        }


        $getBlog = Blog::where('id',$id);
        $dataBlog = $getBlog->first();
        $getBlog->update(
            [

                "title" => $request->title,
                "description" => $request->description,
                "slug" => Str::slug($request->title),
                "publish_date" => Carbon::parse($request->publish_date),
                "image" => ($request->formFile ? $imagechange : $dataBlog->image)
            ]
        );

        return redirect('/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Blog::where('id', $id)->delete();
        return redirect('/blog')->with('message', 'Your post has been deleted!');
    }
}
