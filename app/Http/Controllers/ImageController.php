<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Image;
use App\Repositories\CommentRepository;
use App\Repositories\ImageRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Bican\Roles\Models\Permission;

class ImageController extends Controller
{
    protected $images;

    public function __construct(ImageRepository $images)
    {
        $this->images = $images;
    }

    public function index(Request $request) {
        return $this->images->forAll();
    }

    public function imageIndex($image, Request $request) {
        return view('images.index', [
            'image' => $this->images->byId($image),
            'username' => User::find($this->images->getUserId($image))->name
        ]);
    }

    public function store(Request $request) {
        $data = null;
        if($request->user() != null && $request->user()->can('upload.image')) {
            $file = Input::file('file');
            if ($file) {
                $request->user()->attachPermission(Permission::where('slug' , 'destroy.image')->first());

                $extension = $file->getClientOriginalExtension();
                $path = $this->images->getMaxId() + 1;
                $filename = $path . "." . $extension;
                Storage::disk('images')->put($filename, File::get($file));
                $request->user()->images()->create([
                    'path' => $path,
                    'extension' => $extension,
                    'name' => $request->name,
                    'description' => $request->description
                ]);
            } else {
                $data = "bad_file";
            }
        } else {
            $data = "not_auth";
        }
        return $data;
    }

    public function destroy(Request $request, Image $image, CommentRepository $comment)
    {
        if($request->user()->allowed('destroy.image', $image) || $request->user()->is('admin')) {
            $image->delete();
            //move to repo under deleteCommentsForImage function?
            DB::table('comments')->where('image_id' , $image->id)->delete();
            return redirect('/');
        } else {
            return response()->view('errors.unauthorized');
        }
    }
}
