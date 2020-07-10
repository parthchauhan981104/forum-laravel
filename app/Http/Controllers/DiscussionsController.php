<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateDiscussionRequest;
use Illuminate\Support\Str;
use App\Discussion;
use App\Reply;

class DiscussionsController extends Controller
{
    
    public function __construct()
    {
        //all users can see discussions without authentication but not create
        $this->middleware(['auth', 'verified'])->only(['create', 'store']); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussions.index', [
            'discussions' => Discussion::filterByChannels()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        auth()->user()->discussions()->create([
            'title' => $request->title,
            'content' => $request->content,
            'channel_id' => $request->channel,
            'slug' => Str::slug($request->title, '-')
        ]);


        session()->flash('success', 'Discussion created successfully.');

        return redirect(route('discussions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion) //using slug not id
    {
        return view('discussions.show', [
            'discussion' => $discussion
        ]);
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

    public function markBestReply(Discussion $discussion, Reply $reply) //using slug for discussion, id for reply
    {
        $discussion->markAsBestReply($reply);

        session()->flash('success', 'Reply marked as best reply.');

        return redirect()->back();
    }

    public function unmarkBestReply(Discussion $discussion, Reply $reply) //using slug for discussion, id for reply
    {
        $discussion->unmarkAsBestReply($reply);

        session()->flash('success', 'Reply unmarked as best reply.');

        return redirect()->back();
    }
}
