<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Channel;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    //
    public function index(){
//        $discussions =Discussion::orderBy('created_at','desc')->paginate(3);
        switch (request('filter')){
            case 'me':
                $results= Discussion::where('user_id',Auth::id())->paginate(3);
                break;
            case 'solved':
                $answered =array();
                foreach (Discussion::all() as $d)
                {
                    if($d->hasBestAnswer()){
                        array_push($answered,$d);
                    }
                }
                $results=new Paginator($answered,2);

                break;
            case 'unsolved':
                $unanswered = array();
                foreach (Discussion::all() as $d)
                {
                    if(!$d->hasBestAnswer()){
                        array_push($unanswered,$d);
                    }
                }
                $results = new Paginator($unanswered,3);
                break;

            default:
                $results = Discussion::orderBy('created_at','desc')->paginate(3);
                break;
        }
        return view('forum',['discussions'=>$results]);
    }
    public function channel($slug){
        $channel = Channel::where('slug',$slug)->first();
        return view('channel')->with('discussions',$channel->discussions()->paginate(5));
    }
}
