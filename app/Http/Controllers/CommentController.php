<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        Comment::create([
            ...$request->validated(),
            'user_id' => $this->authUser->id,
        ]);

        return $this->returnSuccessResponse('Comment added successfully');
    }

    public function delete(Comment $comment)
    {
        abort_unless($comment->user_id === $this->authUser->id, 403);
        $comment->delete();

        return $this->returnSuccessResponse('Comment deleted successfully', url()->previous());
    }
}
