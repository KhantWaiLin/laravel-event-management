<x-app-layout :create="false">
    <section id="create-guest" class="w-full h-full flex flex-col justify-center items-center" style="height: calc(100vh - 4.5em);">
        <div class="p-6 flex flex-col  gap-3 bg-white rounded-lg w-[500px]">
            <h1 class="font-bold text-xl">Let's register</h1>
            <form method="post" action="{{route('event.register_post')}}" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="flex flex-col gap-2 mb-5">
                    <label class="text-md">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter name" value="" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="flex flex-col gap-2 mb-5">
                    <label class="text-md">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter name" value="" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
                <input type="hidden" id="user_id" name="user_id" value="{{$user}}" />
                <input type="hidden" id="event_id" name="event_id" value="{{$event}}" />
                <div class="flex ">
                    <x-primary-button>Register</x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>