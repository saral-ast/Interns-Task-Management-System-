<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected function validateComment(Request $request)
    {
        return $request->validate([
            'comment' => 'required|string|max:1000'
        ]);
    }

    protected function createComment(Task $task, string $userType, int $userId, string $comment)
    {
        return Comment::create([
            'task_id' => $task->id,
            'user_type' => $userType,
            'user_id' => $userId,
            'comment' => $comment
        ]);
    }

    protected function deleteComment(Comment $comment)
    {
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}