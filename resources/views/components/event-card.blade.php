@props(['event'])

<div class="flex flex-col gap-2">
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
    @if($event->attachment)
    <div class="w-[300px] h-[200px]">
        <img src="{{"/storage/".$event->attachment}}" class="object-cover w-full h-full" />
    </div>
    <h1 class="text-white">{{$event->name}}</h1>
    <p class="text-white">{{$event->description}}</p>
    @endif
    <x-primary-button class="flex items-center justify-center">
        <a href="{{route('event.show',$event->id)}}">
          View More
        </a>
    </x-primary-button>
</div>