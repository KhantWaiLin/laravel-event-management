@props(['name','description','image','status'])

<div class="flex flex-col gap-2">
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
    @if($image)
    <div class="w-[300px] h-[200px]">
        <img src="{{"/storage/".$image}}" class="object-cover w-full h-full" />
    </div>
    <h1 class="text-white">{{$name}}</h1>
    <p class="text-white">{{$description}}</p>
    @endif
    <x-primary-button class="flex items-center justify-center">
        <a href="{{route('event.create')}}">
          View More
        </a>
    </x-primary-button>
</div>