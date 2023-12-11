<x-app-layout :create="false">
    <div class="flex flex-wrap gap-10 m-auto items-center justify-center mt-10">
        @forelse ($events as $event)
        <x-event-card :name="$event->name" :description="$event->description" :image="$event->attachment" />
        @empty
        <p>There is no events available.</p>
        @endforelse
    </div>
    {{$events->links()}}
</x-app-layout>