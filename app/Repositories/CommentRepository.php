<?php
namespace App\Repositories;

use App\Image;
use App\Comment;
use App\User;
use Bican\Roles\Models\Permission;

class CommentRepository {

    public function forImage($image) {
        return Comment::where('image_id', $image)->orderBy('created_at', 'asc')->get();
    }

    public function usernameById($user_id) {
        return User::where('id', $user_id)->value('name');
    }

    public function saveToDB(Comment $comment, User $user) {
        $user->attachPermission(Permission::where('slug' , 'destroy.comment')->first());
        $comment->save();

        return $comment;
    }

}