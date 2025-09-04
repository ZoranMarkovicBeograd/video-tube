<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserVideoController extends Controller
{
    public function index(User $user): View
    {
        $videos = $user->videos()->latest()->paginate(12);
        return view('users.videos.index', compact('user','videos'));
    }
}
