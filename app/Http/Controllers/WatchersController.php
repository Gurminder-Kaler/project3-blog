<?php

namespace App\Http\Controllers;
use App\Watcher;
use Auth;
use Session;
use Illuminate\Http\Request;

class WatchersController extends Controller
{
    //
    public function watch($id){
        $user=Watcher::create([
            'discussion_id'=>$id,
            'user_id'=>Auth::id()


        ]);
        Session::flash('success','You will be notified by email about any changes in this discussion');
    return redirect()->back();
    }
    public function unwatch($id){
        $watcher = Watcher::where('discussion_id',$id)->where('user_id',Auth::id());
        $watcher->delete();
        Session::flash('succses','You will not receive any notification, Since you Unwatched the discussion');
            return redirect()->back();
    }
}
