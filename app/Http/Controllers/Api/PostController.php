<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index()
    {
        $posts =  Post::all();

        if ($posts->count() > 0) {
            $data =  PostResource::collection($posts);
            $status = 200;
            $message = "Done";
        } else {
            $data = null;
            $status = 404;
            $message = "There are no Posts";
        }
        return response()->json([
            'data' => $data,
            'status' => $status,
            'message' => $message

        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);
        if (isset($post)) {
            $data = new PostResource($post);
            $status = 200;
            $message = "Done";
        } else {
            $data = null;
            $status = 404;
            $message = "Not Found";
        }
        return response()->json([

            'data' => $data,
            'status' => $status,
            'message' => $message

        ]);
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'data' => new PostResource($post),
            'status' => 200,
            'message' => "Adding new Post Done"
        ]);
    }
    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'data' => new PostResource($post),
            'status' => 200,
            'message' => "Update Post Done"
        ]);
    }
}