<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    protected function validateComment(Request $request)
    {
        try {
            return $request->validate([
                'comment' => 'required|string|max:1000'
            ]);
        } catch (Exception $e) {
            Log::error('Error validating comment: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function createComment(Task $task, string $userType, int $userId, string $comment)
    {
        try {
            return Comment::create([
                'task_id' => $task->id,
                'user_type' => $userType,
                'user_id' => $userId,
                'comment' => $comment
            ]);
        } catch (Exception $e) {
            Log::error('Error creating comment: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function deleteComment(Comment $comment)
    {
        try {
            $comment->delete();
            return response()->json(['message' => 'Comment deleted successfully']);
        } catch (Exception $e) {
            Log::error('Error deleting comment: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete comment'], 500);
        }
    }
}