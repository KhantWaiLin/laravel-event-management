<x-app-layout :create="false">
    <section id="create-event" class="w-full h-full flex flex-col justify-center items-center" style="height: calc(100vh - 4.5em);">
        <div class="p-6 flex flex-col  gap-3 bg-white rounded-lg w-[500px] ">
            <h1 class="font-bold text-xl">Create Event</h1>
            <form>
                <div class="flex flex-col gap-2">
                    <label class="text-md">Name</label>
                    <input type="text" placeholder="Enter name" />
                </div>
            </form>
        </div>
    </section>
</x-app-layout>