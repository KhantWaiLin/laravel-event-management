<x-app-layout :create="false">
    <section id="edit-event" class="w-full h-full flex flex-col justify-center items-center" style="height: calc(100vh - 4.5em);">
        <div class="p-6 flex flex-col  gap-3 bg-white rounded-lg w-[500px] m-auto">
            <h1 class="font-bold text-xl">Edit Event</h1>
            <form method="post" action="{{route('event.update',['event'=>$event])}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-2 mb-5">
                    <label class="text-md">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter name" value="{{$event->name}}" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="flex flex-col gap-2 mb-5">
                    <label class="text-md">Description</label>
                    <input type="text" id="description" name="description" placeholder="Enter Description" value="{{$event->description}}" />
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
                <div class="flex mb-5">
                    @if($event->attachment)
                    <img src="{{"/storage/".$event->attachment}}" />
                    @endif
                </div>
                <div class="flex mb-5">
                    <input type="file" name="attachment" class="w-full" value="" />
                    <x-input-error class="mt-2" :messages="$errors->get('attachment')" />
                </div>
                <div class="flex gap-5 mb-5 items-center">
                    <p>Status :</p>
                    <select name="status" class="flex w-fit h-8 justify-center items-center pl-2">
                        <option value="registration unavailable" @if($event->status === 'registration unavailable') selected @endif>Close</option>
                        <option value="registration available" @if($event->status === 'registration available') selected @endif>Open</option>
                    </select>
                </div>
                <div class="flex ">
                    <x-primary-button>Update</x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>