<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Auth;
use Illuminate\Http\Request;
use \App\Post;
use \App\Category;
use Session;
use App\Tag;

class PostsController extends Controller
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
        //$this->authorize('isAdmin'); // Limit only for admin &if puted in admin will apply this to all functions

        $posts = Post::orderBy('created_at','desc')->paginate(8);
        //$posts = Category::all()->paginate(2);
        return view('admin.posts.index',compact('posts'))->with('posts', Post::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());

        $this->validate($request, [
            'title' => 'required',
            'featured' => 'required|image',
            'content' => 'required',
            'category_id' => 'required',
            'tags' => 'required'
        ]);

        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/posts', $featured_new_name);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'featured' => 'uploads/posts/'. $featured_new_name,
            'category_id' => $request->category_id,
            'slug' => str_slug($request->title),
            'user_id' => Auth::id()

        ]);

        $post->tags()->attach($request->tags);

          Session::flash('success', 'You successfully added post');

          return redirect(route('posts.index'));

       // return back()->with('success', 'Post Created Successfully');

    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        if($categories->count() == 0 || $tags->count() == 0)
        {
          Session::flash('info', 'You must have categories and tags befor attempting to create a post');
          return redirect()->back();
        }
        return view('admin.posts.create')
                ->with('categories', $categories)
                ->with('tags', $tags);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //$post = Post::find($id);
        return view('admin.posts.create')->with('post', $post)
                                            ->with('categories', Category::all())
                                            ->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $post = Post::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);
           // Handle File Upload
        if($request->hasFile('featured')){
            $featured = $request->featured;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/posts/', $featured_new_name);
            $post->featured = 'uploads/posts/'.$featured_new_name;

        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        $post->save();

        $post->tags()->sync($request->tags); //method go to db delete all tags for that post

        Session::flash('success', 'Post updated successfully');

        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
         $post->delete();

         Session::flash('success', 'You successfully deleted post');

        return redirect(route('posts.index'));

    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(10);

        return view('admin.posts.trashed')->with('posts', $posts);
    }

    public function kill($id)
    {
/*         $post = Post::withTrashed()->where('id', $id)->get();

        //dd($post);
        $post->forceDelete();

        Session::flash('success', 'Post deleted Permently');
 */
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        //dd($post);

        if($post->trashed()) {

            //$post->deleteImage();

            $post->forceDelete();

        } else {
            $post->delete();
        }
        session()->flash('success', 'Post Deleted successfully');

        return redirect(route('posts.trashed'));


    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();

        $post->restore();

        session()->flash('success', 'Post Restored successfully');

        return redirect(route('posts.index'));
    }

}
