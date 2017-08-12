<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = [
			'title' => 'Homepage',
			'comments' => Comment::latest()->paginate(3),
			'count' => Comment::count(),
			'users' => User::all(),
		];
		return view('home', $data);
    }
}
