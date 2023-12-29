@php
use Carbon\Carbon;
@endphp
<x-app-layout :create="false">
    <section id="edit-event" class="w-full h-[100vh] flex flex-col justify-center items-center">
        <div class="p-6 flex flex-col  gap-3 bg-white rounded-lg  h-fit m-auto">
            <h1 class="font-bold text-xl">Edit Event</h1>
            <form method="post" action="{{route('event.update',['event'=>$event])}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="flex items-center gap-10 justify-between">
                    <div class="flex-1">
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
                        <div class="mb-6 flex w-full gap-6">
                            <div class="flex flex-col flex-1">
                                <label>From Date</label>
                                <div>
                                    <input type="date" name="from_date" class="w-full" placeholder="Select" value="{{$event->from_date}}" />
                                    <x-input-error class="mt-2" :messages="$errors->get('from_date')" />
                                </div>
                            </div>
                            <div class="flex flex-col flex-1">
                                <label>To Date</label>
                                <div>
                                    <input type="date" name="to_date" class="w-full" placeholder="Select" value="{{$event->to_date}}" />
                                    <x-input-error class="mt-2" :messages="$errors->get('to_date')" />
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-6 mb-6">
                            <div class="flex-1">
                                <label>From Time</label>
                                <input type="time" name="from_time" format="hh:mm a" class="w-full" value="{{Carbon::parse($event->from_time)->format('H:i')}}" />
                                <x-input-error class="mt-2" :messages="$errors->get('from_time')" />
                            </div>
                            <div class="flex-1">
                                <label>To Time</label>
                                <input type="time" name="to_time" format="hh:mm a" class="w-full" value="{{Carbon::parse($event->to_time)->format('H:i')}}" />
                                <x-input-error class="mt-2" :messages="$errors->get('to_time')" />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-1 flex-col relative">
                        <div class="flex justify-center mb-5 w-full bg-green-50 h-[200px]">
                            @if($event->attachment)
                            <img src="{{"/storage/".$event->attachment}}" id="show-image" class="object-contain w-fit" />
                            @else
                            <img src="#" id="show-image" class="hidden object-contain w-fit" />
                            @endif
                            <div class="hidden" id="no-img-text">
                                <p class="text-gray-500">The chosen image will appear here.</p>
                            </div>
                        </div>

                        <div class="flex mb-5">
                            <input type="file" accept="image/*" name="attachment" id="attachment" class="w-full" value="{{"/storage/".$event->attachment}}" />
                            <x-input-error class="mt-2" :messages="$errors->get('attachment')" />
                        </div>
                        <div class="flex gap-5 mb-5 items-center">
                            <p>Status :</p>
                            <select name="status" class="flex w-fit h-8 justify-center items-center pl-2">
                                <option value="registration unavailable" @if($event->status === 'registration unavailable') selected @endif>Close</option>
                                <option value="registration available" @if($event->status === 'registration available') selected @endif>Open</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="flex justify-end gap-5">
                    <a href="{{route('event.show',$event)}}">
                        <x-secondary-button>Cancel</x-secondary-button>
                    </a>
                    <x-primary-button>Update</x-primary-button>
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
                };

                reader.readAsDataURL(file);
            } else {
                previewImg.style.display = "none";
                noImg.style.display = "flex"
                noImg.style.alignItems = "center"
                noImg.style.justifyContent = "center"
            }
        });
    </script>
</x-app-layout>