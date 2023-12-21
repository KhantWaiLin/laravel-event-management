<x-app-layout :create="true">
    <div class="flex flex-wrap gap-10 m-auto items-center justify-center mt-10">
        @forelse ($events as $event)
        <x-event-card :event="$event" />
        @empty
        <p class="flex items text-white">There is no events available.</p>
        @endforelse
    </div>
    {{$events->links()}}
</x-app-layout>