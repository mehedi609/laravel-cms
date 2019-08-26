<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;

class PostsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Post::all();
    return view('posts.index', compact('posts'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Category::all();
    return view('posts.create', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreatePostRequest $request)
  {
    $post = new Post();
    $post->title = $request->title;
    $post->description = $request->description;
    $post->content = $request->post_content;
    $post->published_at = $request->published_at;
    $post->category_id = $request->category;
    if ($request->hasFile('image')) {
      $image = $request->image;
      $ext = $image->getClientOriginalExtension();
      $filename = uniqid() . '.' . $ext;
      $image->storeAs('public/posts', $filename);
      $post->image = $filename;
    }
    $post->save();

    return redirect()
      ->route('posts.index')
      ->with('status', 'Post Created Successful');
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Post $post
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Post $post
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $post)
  {
    $categories = Category::all();
    return view('posts.create', compact('post', 'categories'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Post $post
   * @return \Illuminate\Http\Response
   */
  public function update(UpdatePostRequest $request, Post $post)
  {
    $data = $request->only([
      'title', 'description', 'post_content', 'published_at'
    ]);
    if ($request->hasFile('image')) {
      $image = $request->image;
      $ext = $image->getClientOriginalExtension();
      $filename = uniqid() . '.' . $ext;
      $image->storeAs('public/posts', $filename);
      $post->deleteImage();
//            $post->image = $filename;
      $data['image'] = $filename;
    }
//        $post->save();

    $post->update($data);

    return redirect()
      ->route('posts.index')
      ->with('status', 'Post Updated Successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Post $post
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $post = Post::withTrashed()->where('id', $id)->firstOrFail();

    if ($post->trashed()) {
      $post->deleteImage();
      $post->forceDelete();
    } else {
      $post->delete();
    }

    return redirect()
      ->route('posts.index')
      ->with('status', 'Post Deleted Successful');
  }

  public function trashed()
  {
    $trashed = Post::onlyTrashed()->get();
    return view('posts.index')->withPosts($trashed);
  }

  public function restore($id)
  {
    $post = Post::withTrashed()->where('id', $id)->firstOrFail();
    $post->restore();

    return redirect()
      ->route('posts.index')
      ->with('status', 'Post restored successfully');
  }
}
