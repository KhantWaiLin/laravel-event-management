<?php

namespace App\Http\Controllers;

use App\Enums\EventStatus;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Admin;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $events = Event::paginate(5);
       
       for($i = 0 ; $i < count($events); $i++){
        $event = $events[$i];
        $admin = Event::find($event->id)->admin;
        $event["admin"] = $admin;
        $events[$i] = $event;
       }
       return view('event.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);
        $user = Auth::user();
        $new_user = Admin::create([
            'name' => $user->name,
            'email' => $user->email,
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);
        if ($request->file('attachment')) {
            $this->storeImage($request, $event);
        }
        // dd($new_user);
        return redirect(route('event.index'));
    }

    public function register_event($event, $user){
        return view('guest.create',compact('event', 'user'));
    }

    public function register_event_store(StoreGuestRequest $request){
        $guest = Guest::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => $request->user_id,
            'event_id' => $request->event_id
        ]);
        $eventId = $request->event_id;
        return redirect()->route('event.show',['event'=>$eventId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event_status = EventStatus::cases();
        $auth_user = Auth::user();
        return view('event.show',compact('event','event_status','auth_user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    protected function storeImage($request, $event)
    {
        $ext = $request->file('attachment')->extension();
        $contents = file_get_contents($request->file('attachment'));
        $filename = Str::random();
        $path = "attachments/.$filename.$ext";
        Storage::disk('public')->put($path, $contents);
        $event->update(['attachment' => $path]);
    }
}
