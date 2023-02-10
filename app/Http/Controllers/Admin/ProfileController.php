<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Profile Modelを扱う一文追記
use App\Models\Profiles;
//ProfileHistory Modelの使用を宣言する為追記
use App\Models\ProfileHistory;
//Carbonの使用を追記
use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    public function create(Request $request)
    {
        //Validationを行う
        $this->validate($request, Profiles::$rules);
        
        $profiles = new Profiles;
        $form = $request->all();
        
        //フォームから送信されてきた _token を削除する
        unset($form['_token']);

        //データベースに保存する
        $profiles->fill($form);
        $profiles->save();
        
        return redirect('admin/profile/create');
    }
    public function edit(Request $request)
    {
        $profiles = Profiles::find($request->id);
        if (empty($profiles)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profiles_form' => $profiles]);
    }
    public function update(Request $request)
    {
        $this->validate($request, Profiles::$rules);
        $profiles = Profiles::find($request->id);
        $profiles_form = $request->all();
        unset($profiles_form['_token']);
        
        $profiles->fill($profiles_form)->save();
        
        $profile_history = new ProfileHistory();
        $profile_history->profiles_id = $profiles->id;
        $profile_history->edited_at = Carbon::now();
        $profile_history->save();
        
        return redirect('admin/profile/');
    }
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        if ($cond_name != '') {
            $posts = Profiles::where('name', $cond_name)->get();
        } else {
            $posts = Profiles::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    public function delete(Request $request)
    {
        $profiles = Profiles::find($request->id);
        $profiles->delete();
        return redirect('admin/profile/');
    }
}