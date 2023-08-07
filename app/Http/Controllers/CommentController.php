<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Tables\Comments;
use ProtoneMedia\Splade\Facades\Toast;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('comments.index', [
            'comments' => Comments::class,
        ]);
    }

    public function post(Post $post)
    {
        $comments = Comment::where('post_id', $post->ulid)->with('user')->get();

        $tree = Comment::buildTree($comments);

        $count = $comments->count();

        return response()->json(compact('tree', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        if (auth()->check()) {
            $comment = Comment::create([
                'content' => $request['content'],
                'user_id' => auth()->user()->id,
                'post_id' => $request->post_id,
                'parent_id' => $request->parent_id
            ]);

            $comment->load('user');

            return response()->json($comment);
        } else {
            return response()->json(['message' => 'You must be logged in to comment.'], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        Toast::success(trans('Comment deleted successfully!'))->autoDismiss(5);
        return redirect()->route('comments.index');
    }
}
