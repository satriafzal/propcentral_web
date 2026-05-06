<div class="bg-white rounded-xl shadow p-4">
    <img src="{{ $image }}" class="rounded-lg mb-3">

    <p class="text-sm text-gray-500">{{ $location }}</p>

    <div class="flex justify-between text-sm my-2">
        <span>{{ $rooms }} Rooms</span>
        <span>{{ $size }} sq ft</span>
    </div>

    <div class="flex justify-between items-center">
        <button class="bg-black text-white px-3 py-1 rounded text-sm">
            Sign up
        </button>

        <span class="font-bold">{{ $price }}</span>
    </div>
</div>