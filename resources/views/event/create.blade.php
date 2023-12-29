<x-app-layout :create="false">
    <section id="create-event" class="w-full h-full flex flex-col justify-center items-center" style="height: calc(100vh - 4.5em);">
        <div class="p-6 flex flex-col  gap-3 bg-white rounded-lg ">
            <h1 class="font-bold text-xl">Create Event</h1>
            <form method="post" action="{{route('event.store')}}" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="flex gap-5">
                    <div>
                        <div class="flex flex-col gap-2 mb-6">
                            <label class="text-md">Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter name" value="" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="flex flex-col gap-2 mb-6">
                            <label class="text-md">Description</label>
                            <input type="text" id="description" name="description" placeholder="Enter Description" value="" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <div class="mb-6 flex w-full gap-6">
                            <div class="flex flex-col flex-1">
                                <label>From Date</label>
                                <div>
                                    <input type="date" name="from_date" class="w-full" placeholder="Select" />
                                    <x-input-error class="mt-2" :messages="$errors->get('from_date')" />
                                </div>
                            </div>
                            <div class="flex flex-col flex-1">
                                <label>To Date</label>
                                <div>
                                    <input type="date" name="to_date" class="w-full" placeholder="Select" />
                                    <x-input-error class="mt-2" :messages="$errors->get('to_date')" />
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-6 mb-6">
                            <div class="flex-1">
                                <label>From Time</label>
                                <input type="time" name="from_time" format="hh:mm a" class="w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('from_time')" />
                            </div>
                            <div class="flex-1">
                                <label>To Time</label>
                                <input type="time" name="to_time" format="hh:mm a" class="w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('to_time')" />
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col mb-6">
                        <div class="flex justify-center mb-5 w-full bg-green-50 h-[200px]">
                            <img src="#" id="show-image" class="object-contain w-fit hidden" />
                            <div class="flex justify-center items-center" id="no-img-text">
                                <p class="text-gray-500">The chosen image will appear here.</p>
                            </div>
                        </div>
                        <div class="flex justify-center w-full">
                            <input type="file" name="attachment" id="attachment" class="w-full" value="" placeholder="Select" />
                            <x-input-error class="mt-2" :messages="$errors->get('attachment')" />
                        </div>
                    </div>

                </div>
                <div class="flex justify-end gap-5">
                    <a href="{{route('event.index')}}">
                        <button type="button" class="p-1 pl-3 pr-3 rounded-lg hover:bg-slate-200 bg-slate-100 text-black border-[1px] border-black">Cancel</button>
                    </a>
                    <button type="submit" class="p-1 pl-3 pr-3 rounded-lg hover:bg-slate-900 bg-slate-800 text-white">Create</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        const imageInput = document.getElementById("attachment");
        const previewImg = document.getElementById("show-image");
        const noImg = document.getElementById('no-img-text');

        imageInput.addEventListener("change", (event) => {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = (event) => {
                    console.log(event);
                    previewImg.src = event.target.result;
                    previewImg.style.display = "block";
                    noImg.style.display = "none"
                };

                reader.readAsDataURL(file);
            } else {
                previewImg.style.display = "none";
                noImg.style.display = "flex"
            }
        });
    </script>
</x-app-layout>