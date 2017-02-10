<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class AccountController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return json_encode($request->user());
    }

    public function app() {
        return view('account.index');
    }

    public function update(Request $request) {
        $user = $request->user();
        $data = array();
        if($user) {
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->update();
            $data['message'] = "update successful";
        }
        return json_encode($data);
    }
}
