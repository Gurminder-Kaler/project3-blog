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
        $reply->user->points+=25;
        $reply->user->save();
        Session::flash('success','Reply is marked as best answer +25 Xp points for you!!');
        return redirect()->back();
    }
    public function edit($id){
        return view('replies.edit',['reply'=>Reply::findorFail($id)]);
    }
    public function update($id){
        $this->validate(request(),[
            'content'=>'required'
        ]);
        $reply = Reply::findorFail($id);
        $reply->content= request()->content;
        $reply->save();
        Session::flash('success','Updated the reply');
        return redirect()->route('discussion',['slug'=>$reply->discussion->slug]);
    }
}
