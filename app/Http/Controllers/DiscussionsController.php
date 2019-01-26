<?php

namespace App\Http\Controllers;
use App\Discussion;
use App\Notifications\NewReplyAdded;
use Auth;
use Notification;
use App\Reply;
use App\User;
use Session;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    //
    public function create(){

        return view('discuss');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'channel_id'=>'required',
            'content'=>'required',
            'title'=>"required"
        ]);

        $disc= Discussion::create([
            'title'=>$request->title,
             'content'=>$request->content,
            'channel_id'=>$request->channel_id,
            'user_id'=>Auth::id(),
            'slug'=>str_slug($request->title),
        ]);
        Session::flash('success','Discussion Successfully created');
        return redirect()->route('discussion',['slug'=>$disc->slug]);


    }
    public function show($slug){
        $d = Discussion::where('slug',$slug)->first();
        $best_answer = $d->replies()->where('best_answer',1)->first();
        return view('discussions.show')->with('d',$d)->with('best_answer',$best_answer);
    }

    public function reply($id){
        $d = Discussion::findorFail($id);

//        dd($watchers);
        $reply = Reply::create([
            'user_id'=>Auth::id(),
            'discussion_id'=>$id,
            'content'=>request()->reply

        ]);
        $watchers =array();
        foreach ($d->watchers as $watcher):
            array_push($watchers,User::findorFail($watcher->id));
        endforeach;
        Notification::send($watchers,new NewReplyAdded($d));

        Session::flash('success','Replied to discussion');
        return redirect()->back();
    }




}
