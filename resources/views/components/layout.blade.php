<!DOCTYPE html>
<html lang="en" data-theme="winter">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Crud</title>
    @vite('resources/css/app.css')
</head>

<body>
    <header>
        <nav>
            <div class="navbar bg-base-200 rounded-xl">
                <a class="btn btn-ghost text-xl">daisyUI</a>
            </div>
        </nav>
    </header>
    <main class="card-body">
        <div
            class="flex flex-col justify-center items-center border-2 border-base-300 rounded-xl my-5 p-4 mx-4 md:mx-24 lg:mx-48 xl:mx-96">
            {{ $slot }}</div>
    </main>
</body>

</html>
