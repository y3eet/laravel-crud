<!DOCTYPE html>
<html lang="en" data-theme="winter">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Crud</title>
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav>
            <div class="navbar bg-base-200 rounded-xl p-4 flex flex-wrap items-center">
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
                            <div id="theme-list" class="flex flex-col gap-2 max-h-96 overflow-auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="flex flex-col justify-center items-center p-4">
            {{ $slot }}
        </div>
    </main>
</body>

<script>
    var themes = [
        "light",
        "dark",
        "cupcake",
        "bumblebee",
        "emerald",
        "corporate",
        "synthwave",
        "retro",
        "cyberpunk",
        "valentine",
        "halloween",
        "garden",
        "forest",
        "aqua",
        "lofi",
        "pastel",
        "fantasy",
        "wireframe",
        "black",
        "luxury",
        "dracula",
        "cmyk",
        "autumn",
        "business",
        "acid",
        "lemonade",
        "night",
        "coffee",
        "winter",
        "dim",
        "nord",
        "sunset",
    ]
    $(document).ready(function() {
        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'winter';
        $('html').attr('data-theme', savedTheme);

        // Populate theme list
        const themeList = $('#theme-list');
        themes.forEach(theme => {
            const activeClass = theme === savedTheme ? 'btn-active' : '';
            themeList.append(`
                    <button class="btn bg-base-100 ${activeClass}" data-theme="${theme}">
                        ${theme}
                    </button>
                `);
        });

        // Handle theme selection
        themeList.on('click', 'button', function() {
            const selectedTheme = $(this).data('theme');
            $('html').attr('data-theme', selectedTheme);
            localStorage.setItem('theme', selectedTheme);

            // Update active state
            themeList.find('button').removeClass('btn-active');
            $(this).addClass('btn-active');
        });
    });
</script>

</html>
