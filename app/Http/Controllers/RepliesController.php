<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateReplyRequest;
use App\Discussion;
use App\Notifications\NewReplyAdded;
use App\Reply;
use App\Like;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReplyRequest $request, Discussion $discussion)
    {
        auth()->user()->replies()->create([
            'discussion_id' => $discussion->id,
            'content' => $request->reply
        ]);

        if ($discussion->author->id !== auth()->user()->id) {
            $discussion->author->notify(new NewReplyAdded($discussion)); //send mail notification to user and save notification to database
        }

        session()->flash('success', 'Reply added.');

        return redirect()->back();
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
    }

    public function like(Reply $reply)
    {
        Like::create([
            'reply_id' => $reply->id,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back();
    }

    public function unlike(Reply $reply)
    {
        Like::where('reply_id', $reply->id)->where('user_id', auth()->user()->id)->delete();

        return redirect()->back();
    }
}
