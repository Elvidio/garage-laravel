<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateAnnouncementRequest;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{

    public function list()
    {

        $announcements = Announcement::all();

        return view ('announcement.list', ['announcements' => $announcements]);

    }

    public function add()
    {
        $users = User::all();

        return view ('announcement.add', ['users', $users]);
    }

    public function store(CreateAnnouncementRequest $request): RedirectResponse
    {
        $announcement = Announcement::create([
            'user_id' => $request->user()->id,
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'price' => $request->get('price')
        ]);

        return redirect()->route('announcement.add');
    }

    public function edit($id)
    {
        $announcements = Announcement::findOrFail($id);

        return view ('announcement.edit', ['announcement', $announcements]);
    }

//    public function edited(CreateAnnouncementRequest $request): RedirectResponse
//    {
//        $announcement = Announcement::find([
//            'user_id' => $request->user()->id,
//            'title' => $request->get('title'),
//            'content' => $request->get('content'),
//            'price' => $request->get('price')
//        ]);
//
//        return redirect()->route('announcement.edit');
//    }
}
