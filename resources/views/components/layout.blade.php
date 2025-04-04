<!DOCTYPE html>
@php
    $themes = [
        'light',
        'dark',
        'cupcake',
        'bumblebee',
        'emerald',
        'corporate',
        'synthwave',
        'retro',
        'cyberpunk',
        'valentine',
        'halloween',
        'garden',
        'forest',
        'aqua',
        'lofi',
        'pastel',
        'fantasy',
        'wireframe',
        'black',
        'luxury',
        'dracula',
        'cmyk',
        'autumn',
        'business',
        'acid',
        'lemonade',
        'night',
        'coffee',
        'winter',
        'dim',
        'nord',
        'sunset',
    ];
    $currentTheme = Auth::check() ? Auth::user()->theme : 'dracula';
@endphp
<html lang="en" data-theme="{{ $currentTheme }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Crud</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav>
            <div class="navbar bg-base-200 rounded-xl p-4 flex flex-wrap items-center justify-between">
                <div class="flex items-center">
                    <a class="btn btn-ghost text-xl flex items-center" href="/posts">
                        <img src="https://static-00.iconduck.com/assets.00/laravel-icon-1990x2048-xawylrh0.png"
                            class="h-10 w-10 mr-2" alt="Laravel Icon">Laravel Crud</a>
                </div>
                <div class="dropdown">
                    <button tabindex="0" role="button" class="btn m-1">Themes</button>
                    <div tabindex="0"
                        class="dropdown-content card card-compact bg-primary text-primary-content z-[1] w-64 p-2 shadow">
                        <div class="card-body">
                            <h3 class="card-title">Themes</h3>
                            <div class="flex flex-col gap-2 max-h-96 overflow-auto">
                                @foreach ($themes as $theme)
                                    <button class="themeBtn btn bg-base-100" data-theme="{{ $theme }}">
                                        {{ $theme }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @auth
                    <div class="dropdown dropdown-left dropdown-bottom">
                        <div tabindex="0" role="button" class="btn m-1"><svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>{{ Auth::user()->name }}</div>
                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left text-red-500">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div>
                        <a href="{{ route('login') }}" class="btn flex items-center">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="btn flex items-center">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </nav>
    </header>
    <main>
        <div id="toast" class="toast toast-top toast-end hidden">
            <div id="toastVariant" class="alert">
                <span id="toastMessage"></span>
            </div>
        </div>
        <div class="flex flex-col justify-center items-center p-4">
            {{ $slot }}
        </div>
    </main>
</body>
<script>
    $(document).ready(function() {
        $('.themeBtn').on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const selectedTheme = $(this).data('theme');

            $('html').attr('data-theme', selectedTheme);
            $.ajax({
                url: '/api/user/theme',
                type: 'POST',
                data: {
                    theme: selectedTheme,
                },
                success: function(response) {
                    console.log(response)
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

</html>
