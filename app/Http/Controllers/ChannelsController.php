<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChannelEditRequest;
use Illuminate\Http\Request;
use App\Channel;
use Session;

class ChannelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $channels = Channel::orderBy('created_at','desc')->get();
        return view('channels.index')->with('channels',$channels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChannelEditRequest $request)
    {
        //

        Channel::create([
            'title'=>$request->channel,
            'slug'=>str_slug($request->channel)
        ]);
        Session::flash('success','Channel has been created');
        return redirect()->route('channels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $channel = Channel::findorFail($id);
        return view('channels.edit')->with('channel',$channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $value = Channel::findorFail($id);
        $value->title = $request->channel;
        $value->slug = str_slug($request->channel);
        $value->save();
        Session::flash('success','Channel has been updated! ');
        return redirect()->route('channels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $channel = Channel::destroy($id);
//        $channel->delete();
        return redirect()->route('channels.index');
    }
}
