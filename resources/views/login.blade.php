<x-layout>
    <div class="flex justify-center items-center min-h-[70vh]">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="card bg-neutral text-neutral-content w-96">
                <div class="card-body flex flex-col gap-5">
                    <h1 class="card-title">Login</h1>
                    <input required type="email" placeholder="Email" id="email" name="email" class="input"
                        value="{{ old('email') }}" />
                    <input type="password" placeholder="Password" id="password" name="password" class="input" />
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="{{ route('show.register') }}">Don't Have an Accoount?</a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
