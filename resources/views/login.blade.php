<x-layout>
    <div class="flex justify-center items-center min-h-[70vh]">
        <form action="">
            <div class="card bg-neutral text-neutral-content w-96">
                <div class="card-body flex flex-col gap-5">
                    <h1 class="card-title">Login</h1>
                    <input required type="email" placeholder="Email" id="email" class="input" />
                    <input type="password" placeholder="Password" id="password" class="input" />
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="register">Don't Have an Accoount?</a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
