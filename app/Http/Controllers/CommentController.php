<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;

class CommentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$data = [
			'title' => 'Comments',
			'comments' => Comment::all(),
			'count' => Comment::count(),
			'users' => User::all(),
		];
		return view('comment', $data);
	}

	public function post(Authenticatable $user, Request $request)
	{
		$validation = Validator::make($request->all(), [
            'text' => 'string|max:255|min:10',
        ]);

		if( $validation->fails() ) {
			$errors = $validation->messages()->toJson();
			return response()->json([ "errors" => $errors ]);
		}
		
		return Comment::create([
            'uid' => $user->id,
            'text' => $request->text,
        ]);
	}

	public function delete($id, Authenticatable $user, Comment $comment)
	{
		$uid = Comment::find($id)->uid;
		if ($uid == $user->id) {
			Comment::find($id)->delete();
			$result = 'success';
		}
		else {
			$result = 'success';
		}
		return response()->json([ 'result' => $result ]);
	}
}
