<?php

namespace App\Http\Controllers\Panel\Product;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::query();
        $comments->when(\request()->status == 'approved', function ($query) {
            $query->where('is_approved', Comment::APPROVED);
        });

        $comments->when(\request()->status == 'not_approved', function ($query) {
            $query->where('is_approved', Comment::NOT_APPROVED);
        });
        $comments = $comments->latest()->paginate();
        return view('panel.comments.index', compact('comments'));
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();
        return back();
    }

    public function changeStatus(Comment $comment)
    {
        if ($comment->is_approved == Comment::STATUS_APPROVED) {
            $comment->is_approved = Comment::STATUS_NOT_APPROVED;
        } elseif ($comment->is_approved == Comment::STATUS_NOT_APPROVED) {
            $comment->is_approved = Comment::STATUS_APPROVED;
        }else{
            $comment->is_approved = Comment::STATUS_APPROVED;
        }
        $comment->save();
        return response()->json(['data' => $comment, 'message' => 'وضعیت با موفقیت تغییر کرد.']);
    }
}
