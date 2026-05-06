@extends('layout.layout')

@section('content')

<section class="bg-[#cdb7a7] min-h-screen py-16 px-10">
    
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center">

        {{-- LEFT IMAGE --}}
        <div>
            <img src="/images/house-contact.png"
                 class="rounded-[40px] w-full object-cover">
        </div>

        {{-- RIGHT FORM --}}
        <div class="bg-[#e9e2dc] p-10 rounded-lg shadow">

            <h2 class="text-3xl font-bold mb-4 flex items-center gap-2">
                Contact US 
                <span>👤</span>
            </h2>

            <p class="text-gray-600 mb-10">
                Ada pertanyaan terkait rumah yang ingin dibeli? 
                Silahkan hubungi kami. Kami akan membantu Anda menemukan rumah impian.
            </p>

            <form action="#" method="POST" class="space-y-8">
                @csrf

                {{-- NAME --}}
                <div>
                    <label class="block mb-2 font-medium">Name</label>
                    <input type="text" name="name"
                        class="w-full border-b border-gray-500 bg-transparent focus:outline-none py-2">
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block mb-2 font-medium">Email</label>
                    <input type="email" name="email"
                        class="w-full border-b border-gray-500 bg-transparent focus:outline-none py-2">
                </div>

                {{-- MESSAGE --}}
                <div>
                    <label class="block mb-2 font-medium">Pertanyaan</label>
                    <textarea name="message" rows="3"
                        class="w-full border-b border-gray-500 bg-transparent focus:outline-none py-2"></textarea>
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                    class="bg-black text-white px-6 py-2 rounded mt-4">
                    Kirim
                </button>
            </form>

        </div>

    </div>

</section>

@endsection