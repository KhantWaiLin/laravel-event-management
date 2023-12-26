<x-app-layout :create="false">
    <div class="flex flex-col justify-center p-10 gap-5">
        <div class="flex justify-center gap-2">
            <div class="grow flex flex-col gap-2">
                <h1 class="text-white text-lg">{{$event->name}}</h1>
                <p class="text-white">{{$event->description}}</p>
                @if($event->attachment)
                <div class="mt-5">
                    <img src="{{"/storage/".$event->attachment}}" />
                </div>
                @endif
                @if($event->admin->email != $auth_user->email)
                @if($event->status == $event_status[0]->value)
                <div class="mt-5 flex w-full justify-end">
                    <button class="w-fit bg-white p-1 font-sans">
                        <a href="{{ route('event.register_get', ['event' => $event, 'user' => $auth_user]) }}">
                            Register
                        </a>
                    </button>
                </div>
                @elseif($event->status == $event_status[1]->value)
                <button class="bg-white p-1 font-sans">Close</button>
                @endif
                @elseif($event->admin->email == $auth_user->email)
                <div class="mt-5 flex w-full justify-between">
                    <p class="text-white">Status: {{$event->status}}</p>
                    <div class="flex gap-3">
                        <form action="{{route('event.destroy',['event'=>$event])}}" method="post">
                            @csrf
                            @method('delete')
                            <button class=" w-fit bg-white p-1 pl-3 pr-3 font-sans">
                                Delete
                            </button>
                        </form>
                        <button class=" w-fit bg-white p-1 pl-3 pr-3 font-sans">
                            <a href="{{route('event.edit',['event'=>$event])}}">
                                Edit
                            </a>
                        </button>
                    </div>
                </div>
                @endif
            </div>
            <div class="lg:flex-none w-[300px] flex-auto">
                <div class="w-full h-[300px] border-2 border-zinc-700 p-3">
                    <div>
                        <h3 class="text-white mb-3">Event Detail</h3>
                        <div class="text-white flex gap-10">
                            <p>Admin:</p>
                            <p>{{$event->admin->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h4 class="text-white mb-3">Feedbacks</h4>
            <div class="flex flex-col gap-2 mb-5">
                @forelse($feedbacks as $feedback)
                <x-feedback :feedback="$feedback" />
                @empty
                <p class="flex items text-white">There is no feedbacks.</p>
                @endforelse
            </div>
            <form action="{{route('feedback.store')}}" method="post">
                @csrf
                @method("post")
                <input type="hidden" name="event_id" value="{{$event->id}}" />
                <input type="hidden" name="user_id" value="{{$auth_user->id}}" />
                <div class="flex gap-5 w-full justify-between">
                    <input type="text" name="feedback" value="" class="p-1 flex-1" autocomplete="FALSE">
                    <button type="submit" class="p-1 pl-3 pr-3 h-fit bg-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>