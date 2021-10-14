<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
// use Exception;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()) {
            return view('auth.login');
        }

        $chats = Chat::whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();
        return view('index', compact('chats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = new Chat();
        $insert->name = $request->roomName;
        $insert->user_id = Auth::user()->id;
        $insert->save();
        $insert->users()->attach($insert->user_id);
        return redirect()->route('chats.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $error = null;
        $chat = Chat::findOrFail($id);
        return view('show', compact('chat', 'error'));
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
        $chat = Chat::findOrFail($id);
        $chat->delete();
        /* try {
            $chat = Chat::findOrFail($id);
            $chat->users()->delete();
            $msg = $chat->messages->pluck('id');
            $chat->detach($chat->user_id);
            $chat->delete();
            Message::destroy($msg);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 1);
        } */
        return redirect()->route('chats.index');
    }

    public function sendMessage(Request $request, $id)
    {
        $msg = new Message();
        $msg->username = Auth::user()->name;
        $msg->message = $request->msg;
        $msg->chat_id = $id;
        $msg->user_id = Auth::user()->id;
        $msg->save();
        return redirect()->route('chats.show', $id);
    }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        return view('profile', compact('user'));
    }

    public function addUsers($chat_id)
    {
        $chat = Chat::findOrFail($chat_id);
        return view('profile.add_users', compact('chat'));
    }

    public function storeUsers(Request $request)
    {

        $user = User::where('name', $request->name_search)->first();
        $chat = Chat::findOrFail($request->chat_id);
        $error = "User adaugat";
        if ($user) {
            $verif = $chat->users()->where('user_id', $user->id)->first();
            if (!$verif) {
                $user->chats()->attach($chat->id);
                $user->save();
            } else $error = "User existent in chat";
        } else {
            $error = "Nu exista user";
        }
        return view('show', compact('chat', 'error'));
    }

    public function logOut(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
