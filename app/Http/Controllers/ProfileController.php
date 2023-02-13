<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profiles;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $posts = Profiles::all()->sortByDesc('updated_at');
        
        // profile/index.blade.php ファイルを渡している
        // また View テンプレートに posts、という変数を渡している
        return view('profile.index', ['posts' => $posts]);
    }
}