<x-app-layout :create="false">
    <div class="flex justify-center p-10 gap-2">
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
                <button class=" w-fit bg-white p-1 font-sans">
                    <a href="{{ route('event.register_get', ['event' => $event, 'user' => $auth_user]) }}">
                        Register
                    </a>
                </button>
            </div>
            @elseif($event->status == $event_status[1]->value)
            <button>Close</button>
            @endif
            @elseif($event->admin->email == $auth_user->email)
            <div class="mt-5 flex w-full justify-between">
                <p class="text-white">Status: {{$event->status}}</p>
                <button class=" w-fit bg-white p-1 pl-3 pr-3 font-sans">
                    <a href="{{route('event.edit',['event'=>$event])}}">
                       Edit
                    </a>
                </button>
            </div>
            @endif
        </div>
        <div class="lg:flex-none w-[300px] flex-auto">
            <div class="w-full h-[300px] border-2 border-rose-50 p-3">
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
</x-app-layout>