<?php
namespace App\Repositories;

use App\User;
use App\Image;

class ImageRepository {
    public function byId($id) {
        return Image::where('id', $id)->get();
    }

    public function forUser(User $user) {
        return Image::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
    }

    public function forAll() {
        return Image::all();
    }

    public function getUserId($image_id) {
        return Image::where('id', $image_id)->value('user_id');
    }

    public function getUsername($image_id) {
        $lol = Image::where('id', $image_id)->value('name');
    }

    public function getMaxId() {
        return Image::max('id');
    }
}