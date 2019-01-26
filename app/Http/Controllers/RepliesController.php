<?php

namespace App\Http\Controllers;
use App\Reply;
use Auth;
use Session;
use App\Like;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    //
    public function like($id){
//        $reply = Reply::findorFail($id);
            Like::create([
                'reply_id'=>$id,
                'user_id'=>Auth::id()
            ]);
Session::flash('success','You liked a reply');
return redirect()->back();
    }

    public function unlike($id){
        $like = Like::where('reply_id',$id)->where('user_id',Auth::id())->first();
        $like->delete();
        Session::flash('success','You unliked the reply');
        return redirect()->back();
    }

    public function best_answer($id){
        $reply = Reply::findorFail($id);
        $reply->best_answer =1;
        $reply->save();
        Session::flash('success','Reply is marked as best answer');
        return redirect()->back();
    }
}
