<?php

namespace App\Http\Controllers;
use App\Discussion;
use Auth;
use App\Reply;
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
        return view('discussions.show')->with('d',$d);
    }

    public function reply($id){
        $d = Discussion::findorFail($id);
        $reply = Reply::create([
            'user_id'=>Auth::id(),
            'discussion_id'=>$id,
            'content'=>request()->reply

        ]);
        Session::flash('success','Replied to discussion');
        return redirect()->back();
    }




}
