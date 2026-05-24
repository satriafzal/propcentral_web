<div class="bg-white rounded-2xl shadow-sm p-4 group hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 cursor-pointer border border-gray-100 fade-in-section">
    <div class="overflow-hidden rounded-xl mb-4">
        <img src="{{ $image }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
    </div>

    <p class="text-sm font-medium text-gray-500 group-hover:text-amber-600 transition-colors duration-300">{{ $location }}</p>

    <div class="flex justify-between text-sm my-3 text-gray-700">
        <span class="flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" /></svg>{{ $rooms }} Rooms</span>
        <span class="flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" /></svg>{{ $size }} sq ft</span>
    </div>

    <div class="flex justify-between items-center mt-4 border-t pt-4">
        <button class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-amber-600 hover:shadow-md hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
            Sign up
        </button>

        <span class="font-bold text-lg text-gray-900">{{ $price }}</span>
    </div>
</div>