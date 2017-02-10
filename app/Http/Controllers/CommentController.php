<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Repositories\ImageRepository;
use App\Services\CommentService;
use App\User;
use Bican\Roles\Models\Permission;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;

use App\Http\Requests;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    protected $comments;

    public function __construct(CommentService $comments)
    {
        $this->comments = $comments;
    }

    public function index($comment) {
        $comments = $this->comments->forImage($comment);
        $data = array();
        for($i = 0; $i < count($comments); $i++) {
            $user = User::find($comments[$i]->user_id);
            $comments->username = $user->name;
            $data[] = array([
                'comment' => $comments[$i],
                'username' => $user->name,
            ]);
        }
        return ($data);
    }

    public function store($comment_id, Request $request, CommentService $commentService) {
        return $commentService->saveToDB($comment_id, $request->comment, $request->user());
    }

    //TODO: remove comments too.
    public function destroy(Request $request, Comment $comment)
    {
        $data = null;
        if($request->user()->allowed('destroy.comment', $comment) || $request->user()->is('admin')) {
            $comment->delete();
            $data = $comment;
        } else
            $data = "not_auth";
        return $data;
    }
}
