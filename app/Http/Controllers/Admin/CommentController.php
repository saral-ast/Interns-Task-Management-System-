<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommentController as BaseCommentController;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends BaseCommentController
{
    public function store(Request $request, Task $task)
    {
        $validated = $this->validateComment($request);
        
        $comment = $this->createComment(
            $task,
            'admin',
            Auth::guard('admin')->id(),
            $validated['comment']
        );

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function destroy(Task $task, Comment $comment)
    {
        // Admins can delete any comment
        return $this->deleteComment($comment);
    }
}