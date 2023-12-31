@php
use Carbon\Carbon;
@endphp
<x-app-layout :create="false">
    <div class="flex flex-col justify-center sm:p-10  lg:pl-[10rem] lg:pr-[10rem]  gap-5">
        <div class="flex flex-col lg:flex-row justify-center gap-5">
            <div class="grow flex flex-col gap-2">
                <h1 class="text-white text-[3rem]">{{$event->name}}</h1>
                <p class="text-white indent-10 text-justify pr-2">{{$event->description}}</p>
                @if($event->attachment)
                <div class="flex mt-5 h-[300px] bg-gray-200">
                    <img src="{{"/storage/".$event->attachment}}" class="object-contain" />
                </div>
                @endif
                @if($event->admin->email != $auth_user->email)
                @if($event->status == $event_status[0]->value)
                <div class="mt-5 flex w-full justify-end">
                    <button class="w-fit rounded-sm bg-white p-1 pl-2 pr-2 font-sans">
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
            <div class="lg:flex-none w-[350px] flex-auto">
                <div class="w-full h-[200px] border-2 border-zinc-700 p-3">
                    <h3 class="text-white mb-5">Event Detail</h3>
                    <div class="flex flex-col gap-2">
                        <div class="text-white w-full flex relative">
                            <p>Admin:</p>
                            <p class="absolute left-[100px]">{{$event->admin->name}}</p>
                        </div>
                        <div class="text-white flex w-full relative">
                            <p>Date:</p>
                            <p class="absolute left-[100px]">{{$event->from_date}} to {{$event->to_date}}</p>
                        </div>
                        <div class="text-white flex w-full relative">
                            <p>Time:</p>
                            <p class="absolute left-[100px]">{{Carbon::parse($event->from_time)->format('h:i A')}} to {{Carbon::parse($event->to_time)->format('h:i A')}}</p>
                        </div>
                        <div class="text-white flex w-full relative">
                            <p>Attandees:</p>
                            <p class="absolute left-[100px]">{{$event->guest_count}}</p>
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
                    <input type="text" name="feedback" placeholder="Add a feedback" value="" class="p-1 flex-1" autocomplete="FALSE">
                    <button type="submit" class="p-1 pl-3 rounded-sm pr-3 h-fit bg-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>