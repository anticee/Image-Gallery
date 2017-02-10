<?php
namespace App\Services;

use App\Comment;
use App\Repositories\CommentRepository;
use App\User;
use Bican\Roles\Models\Permission;

class CommentService {

    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function saveToDB($comment_id, $comment_str, User $user) {
        if($user->can('upload.comment')) {
            $comment = new Comment();
            $comment->comment = $comment_str;
            $comment->image_id = $comment_id;
            $comment->user_id = $user->id;

            $com = $this->commentRepository->saveToDB($comment, $user);
            $username = User::find($user->id);
            return (array($com, $username));
        }
        return ($data = "not_auth");
    }
}