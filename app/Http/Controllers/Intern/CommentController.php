<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\CommentController as BaseCommentController;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends BaseCommentController
{
    public function store(Request $request, Task $task)
    {
        // Ensure the task is assigned to the authenticated user
        if (!$task->assignedUsers->contains(Auth::guard('user')->id())) {
            abort(403);
        }

        $validated = $this->validateComment($request);
        
        $comment = $this->createComment(
            $task,
            'intern',
            Auth::guard('user')->id(),
            $validated['comment']
        );

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function destroy(Task $task, Comment $comment)
    {
        // Interns can only delete their own comments
        if ($comment->user_type !== 'intern' || $comment->user_id !== Auth::guard('user')->id()) {
            abort(403);
        }

        return $this->deleteComment($comment);
    }
}