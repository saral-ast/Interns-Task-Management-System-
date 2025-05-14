<?php

namespace App\Http\Controllers\Intern;

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
            // Ensure the task is assigned to the authenticated user
            if (!$task->assignedUsers->contains(Auth::guard('user')->id())) {
                return redirect()->back()->with('error', 'You are not authorized to add comments to this task.');
            }

            $validated = $request->validated();
            
            $this->createComment(
                $task,
                'intern',
                Auth::guard('user')->id(),
                $validated['comment']
            );

            return redirect()->back()->with('success', 'Comment added successfully.');
        } catch (Exception $e) {
            Log::error('Error storing intern comment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while adding the comment. Please try again.')
                ->withInput();
        }
    }

    public function destroy(Task $task, Comment $comment)
    {
        try {
            // Interns can only delete their own comments
            if ($comment->user_type !== 'intern' || $comment->user_id !== Auth::guard('user')->id()) {
                return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
            }

            $this->deleteComment($comment);

            return redirect()->back()->with('success', 'Comment deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting intern comment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the comment'
            ], 500);
        }
    }
}