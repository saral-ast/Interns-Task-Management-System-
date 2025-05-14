<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommentController as BaseCommentController;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class CommentController extends BaseCommentController
{
    public function store(CommentRequest $request, Task $task)
    {
        try {
            $validated = $request->validated();
            
            $this->createComment(
                $task,
                'admin',
                Auth::guard('admin')->id(),
                $validated['comment']
            );

            return redirect()->back()->with('success', 'Comment added successfully.');
        } catch (Exception $e) {
            Log::error('Error storing admin comment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while adding the comment. Please try again.')
                ->withInput();
        }
    }

    public function destroy(Task $task, Comment $comment)
    {
        try {
            // Admins can delete any comment
            return $this->deleteComment($comment);
        } catch (Exception $e) {
            Log::error('Error deleting admin comment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the comment'
            ], 500);
        }
    }
}