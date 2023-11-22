<x-app-layout :create="false">
    <section id="create-event" class="w-full h-full flex flex-col justify-center items-center" style="height: calc(100vh - 4.5em);">
        <div class="p-6 flex flex-col  gap-3 bg-white rounded-lg w-[500px] ">
            <h1 class="font-bold text-xl">Create Event</h1>
            <form method="post" action="{{route('event.store')}}" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="flex flex-col gap-2 mb-5">
                    <label class="text-md">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter name" value="" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="flex flex-col gap-2 mb-5">
                    <label class="text-md">Description</label>
                    <input type="text" id="description" name="description" placeholder="Enter Description" value="" />
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
                <div class="flex mb-5">
                    <input type="file" name="attachment" class="w-full" value="" />
                    <x-input-error class="mt-2" :messages="$errors->get('attachment')" />
                </div>
                <div class="flex ">
                    <x-primary-button>Create</x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>