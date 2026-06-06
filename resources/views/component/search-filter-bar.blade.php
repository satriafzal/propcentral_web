{{-- Search & Filter Bar - Sticky below navbar --}}
<div id="searchFilterBar" class="sticky top-[72px] z-40 w-full transition-all duration-300">
    <div class="bg-[#d4bfaf] mx-auto shadow-lg" style="backdrop-filter: blur(10px);">
        
        {{-- WAJIB: Bungkus seluruh area filter pakai form --}}
        <form action="{{ url('/property') }}" method="GET" class="max-w-6xl mx-auto px-6 py-5"
            x-data="{
                location: '{{ request('city') }}', locationOpen: false,
                type: '{{ request('type') }}', typeOpen: false,
                price: '{{ request('price') }}', priceOpen: false,
                get hasFilter() { return this.location !== '' || this.type !== '' || this.price !== '' },
                resetAll() { 
                    this.location = ''; this.type = ''; this.price = ''; 
                    window.location.href = '{{ url('/property') }}'; // Reset paksa ke URL awal
                }
            }">
            
            <div class="flex items-center gap-4">

                {{-- 1. Location Filter (Dynamic Autocomplete) --}}
                <div class="relative flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute right-5 top-1/2 -translate-y-1/2 w-5 h-5 text-[#8b6f5a] pointer-events-none">
                        <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 3.834 3.025zM12 12.75a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" clip-rule="evenodd" />
                    </svg>

                    <input type="text" 
                        name="city" 
                        x-model="location"
                        list="daftar-kota-navbar" 
                        placeholder="Lokasi (Ketik kota...)" 
                        autocomplete="off"
                        class="w-full bg-white/90 hover:bg-white border border-[#c4a88a]/30 focus:border-[#5a3e2b] focus:bg-white rounded-xl px-5 py-3.5 pr-12 text-left transition-all duration-200 hover:shadow-md text-sm text-[#3d2b1f] outline-none font-medium placeholder:text-[#5a3e2b]">

                    @if(isset($cities))
                    <datalist id="daftar-kota-navbar">
                        @foreach($cities as $c)
                            <option value="{{ $c }}">
                        @endforeach
                    </datalist>
                    @endif
                </div>

                {{-- 2. Type Filter (Alpine.js) --}}
                <div class="relative flex-1">
                    <input type="hidden" name="type" x-model="type">

                    <button type="button" @click="typeOpen = !typeOpen" @click.outside="typeOpen = false"
                        class="w-full flex items-center justify-between rounded-xl px-5 py-3.5 text-left transition-all duration-200 hover:shadow-md group"
                        :class="type ? 'bg-white border-2 border-[#5a3e2b]' : 'bg-white/90 hover:bg-white border border-[#c4a88a]/30'">
                        <span class="font-medium text-sm" :class="type ? 'text-[#3d2b1f]' : 'text-[#5a3e2b]'" x-text="type || 'Tipe Properti'"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-[#8b6f5a] group-hover:text-[#5a3e2b] transition-colors">
                            <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                            <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625A1.875 1.875 0 0 1 3.75 19.875v-6.198a.75.75 0 0 1 .091-.086L12 5.432Z" />
                        </svg>
                    </button>
                    <div x-show="typeOpen" style="display: none;"
                        class="absolute top-full left-0 mt-2 w-full bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                        @foreach(['Rumah', 'Apartemen', 'Vila', 'Tanah'] as $t)
                            <button type="button" @click="type = '{{ $t }}'; typeOpen = false"
                                class="w-full text-left px-5 py-2.5 text-sm text-[#5a3e2b] hover:bg-[#f5ede6] transition-colors duration-150">
                                {{ $t }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- 3. Price Range Filter (Alpine.js) --}}
                <div class="relative flex-1">
                    <input type="hidden" name="price" x-model="price">

                    <button type="button" @click="priceOpen = !priceOpen" @click.outside="priceOpen = false"
                        class="w-full flex items-center justify-between rounded-xl px-5 py-3.5 text-left transition-all duration-200 hover:shadow-md group"
                        :class="price ? 'bg-white border-2 border-[#5a3e2b]' : 'bg-white/90 hover:bg-white border border-[#c4a88a]/30'">
                        <span class="font-medium text-sm" :class="price ? 'text-[#3d2b1f]' : 'text-[#5a3e2b]'" x-text="price || 'Rentang Harga'"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-[#8b6f5a] group-hover:text-[#5a3e2b] transition-colors">
                            <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                        </svg>
                    </button>
                    <div x-show="priceOpen" style="display: none;"
                        class="absolute top-full left-0 mt-2 w-full bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                        @foreach(['< Rp 500 Juta', 'Rp 500 Juta - Rp 1 M', '> Rp 1 M'] as $range)
                            <button type="button" @click="price = '{{ $range }}'; priceOpen = false"
                                class="w-full text-left px-5 py-2.5 text-sm text-[#5a3e2b] hover:bg-[#f5ede6] transition-colors duration-150">
                                {{ $range }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Cancel Filter Button --}}
                <button type="button" x-show="hasFilter" style="display: none;"
                    @click="resetAll()"
                    class="flex items-center gap-1.5 bg-white/80 hover:bg-red-50 border border-red-300 text-red-600 hover:text-red-700 px-4 py-3.5 rounded-xl font-medium text-sm transition-all duration-200 hover:shadow-md active:scale-95 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                    Hapus Filter
                </button>

                {{-- Search Button (Tipe Submit) --}}
                <button type="submit" class="bg-[#3d2b1f] hover:bg-[#2a1d14] text-white px-8 py-3.5 rounded-xl font-semibold text-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 active:scale-95 whitespace-nowrap flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                    </svg>
                    Cari
                </button>

            </div>
        </form>
    </div>
</div>