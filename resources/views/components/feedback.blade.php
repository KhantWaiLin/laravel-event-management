@props(['feedback'])
<div>
    <div class="flex gap-1 text-white">
        <h4 class="font-bold">{{$feedback->user->name}}</h4> <span>{{$feedback->user->email}}</span>
    </div>
    <p class="ml-4 text-white">{{$feedback->feedback}}</p>
    <div class="border-zinc-700 border-b w-5/12" />
</div>