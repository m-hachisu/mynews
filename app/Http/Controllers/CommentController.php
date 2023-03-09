<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\News;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function show(Request $request)
    {
        $news = News::find($request->id);

        if (empty($news)) {
            abort(404);
        }
        return view('comment', ['news_form' => $news]);
    }
    
    public function create(Request $request)
    {
        //validationを行う
        $this->validate($request, Comment::$rules);
        
        $comments = new Comment;
        $form = $request->all();
        
        //フォームから送信されてきた _token を削除する
        unset($form['_token']);

        //データベースに保存する
        $comments->fill($form);
        $comments->save();

        return redirect('comment?id='.$comments->news_id);
    }
    
    public function delete(Request $request)
    {
        $comments = Comment::find($request->id);
        $comments->delete();
        return redirect('comment?id='.$comments->news_id);
    }
}
