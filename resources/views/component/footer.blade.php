<footer class="bg-[#d2b8a3] mt-20 p-10">
    <div class="grid grid-cols-4 gap-10">

        <div>
            <h1 class="font-bold text-lg mb-2">PropCentral</h1>
            <p>Bringing you closer to your dream home.</p>
        </div>

        <div>
            <h2 class="font-semibold">About</h2>
            <ul class="text-sm mt-2 space-y-1">
                <li>Our Story</li>
                <li>Careers</li>
                <li>Team</li>
            </ul>
        </div>

        <div>
            <h2 class="font-semibold">Support</h2>
            <ul class="text-sm mt-2 space-y-1">
                <li>FAQ</li>
                <li>Contact</li>
                <li>Help Center</li>
            </ul>
        </div>

        <div>
            <h2 class="font-semibold">Social</h2>
            <ul class="text-sm mt-2 space-y-1">
                <li>Instagram</li>
                <li>Facebook</li>
                <li>Twitter</li>
            </ul>
        </div>

    </div>

    {{-- for notification succes and error--}}
    @if(session('success') || session('error') || $errors->any() )
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top', 
                    showConfirmButton: false,
                    timer: 5000, 
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                @if(session('success'))
                    Toast.fire({
                        icon: 'success',
                        title: '{!! session("success") !!}' 
                    });
                @endif

                @if(session('error'))
                    Toast.fire({
                        icon: 'error',
                        title: '{!! session("error") !!}' 
                    });
                @endif

                @if($errors->any())
                    Toast.fire({
                        icon: 'error',
                        title: '{!! $errors->first() !!}' 
                    });
                @endif
            });
        </script>
    @endif
</footer>