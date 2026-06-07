<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PropCentral</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    {{-- Tailwind CDN (sementara) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .fade-in-section {
            opacity: 0;
            transform: translateY(20px);
            visibility: hidden;
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
            will-change: opacity, visibility;
        }
        .fade-in-section.is-visible {
            opacity: 1;
            transform: none;
            visibility: visible;
        }
    </style>
</head>
<body class="bg-[#f5f5f5] text-gray-800 font-[Poppins] scroll-smooth">

    {{-- Navbar --}}
    @include('component.navbar')

    {{-- Search & Filter Bar --}}
    @if(!isset($hideSearchFilter))
        @include('component.search-filter-bar')
    @endif

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('component.footer')

    {{-- Contact Modal --}}
    @include('component.contact-modal')

</body>

<script>
    function openLogin() {
        document.getElementById('loginModal')
            .classList.remove('hidden');
    }

    function closeLogin() {
        document.getElementById('loginModal')
            .classList.add('hidden');
    }

    function openRegister() {
        document.getElementById('registerModal')
            .classList.remove('hidden');
    }

    function closeRegister() {
        document.getElementById('registerModal')
            .classList.add('hidden');
    }

    function openContact() {
        document.getElementById('contactModal')
            .classList.remove('hidden');
    }

    function closeContact() {
        document.getElementById('contactModal')
            .classList.add('hidden');
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Update Saved Badge globally
        const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
        const userId = {{ auth()->check() ? auth()->id() : 'null' }};
        const SAVE_KEY = isLoggedIn ? 'propcentral_saved_' + userId : 'propcentral_saved';
        
        function updateSavedBadge() {
            let savedProps = JSON.parse(localStorage.getItem(SAVE_KEY) || '[]');
            const badge = document.getElementById('savedBadge');
            if (badge) {
                if(savedProps.length > 0) {
                    badge.classList.remove('hidden');
                    badge.innerText = savedProps.length;
                } else {
                    badge.classList.add('hidden');
                }
            }
        }
        updateSavedBadge();
        window.updateSavedBadge = updateSavedBadge;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        const hiddenElements = document.querySelectorAll('.fade-in-section');
        hiddenElements.forEach((el) => observer.observe(el));

        // Dynamically set search filter bar sticky position based on navbar height
        const navbar = document.getElementById('mainNavbar');
        const filterBar = document.getElementById('searchFilterBar');
        if (navbar && filterBar) {
            function updateFilterBarPosition() {
                const navHeight = navbar.offsetHeight;
                filterBar.style.top = navHeight + 'px';
            }
            updateFilterBarPosition();
            window.addEventListener('resize', updateFilterBarPosition);
        }
    });
</script>

</html>