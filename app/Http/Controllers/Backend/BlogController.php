<?php

namespace EddiesBlog\Http\Controllers\Backend;

use EddiesBlog\Post;
use Illuminate\Http\Request;
use EddiesBlog\Http\Requests;

class BlogController extends Controller
{

    protected $posts;

    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //start to log the queries.
        \DB::enableQueryLog();

        //grab the posts and order them and paginate by 10 per page.
        $posts = $this->posts->with('author')->orderBy('published_at', 'desc')->paginate(10);

        return view('backend.blog.index', compact('posts'));

        //show the db query results.
        dd(\DB::getQueryLog());
    }

    /**
     * Show the form for creating a new BlogPost resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        //dd($post);
        return view('backend.blog.form', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePostRequest $request)
    {
        $this->posts->create(['author_id' => auth()->user()->id] + $request->only('title', 'slug', 'published_at', 'body', 'excerpt'));

        return redirect(route('backend.blog.index'))->with('status', 'Post has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->posts->findOrFail($id);

        return view('backend.blog.form', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePostRequest $request, $id)
    {
        $post = $this->posts->findOrFail($id);

        $post->fill($request->only('title', 'slug', 'published_at', 'body', 'excerpt'))->save();

        return redirect(route('backend.blog.edit', $post->id))->with('status', 'The Post has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = $this->posts->findOrFail($id);

       $post->delete();

       return redirect(route('backend.blog.index'))->with('status', 'The Post has been deleted.');

    }

    public function confirm($id)
    {
        $post = $this->posts->findOrFail($id);

        return view('backend.blog.confirm', compact('post'));
    }




}