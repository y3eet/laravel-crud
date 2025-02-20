<x-layout>
    <div class="flex justify-center items-center min-h-[70vh]">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="card bg-neutral text-neutral-content w-96">
                <div class="card-body flex flex-col gap-5">
                    <h1 class="card-title">Register</h1>
                    <input required type="text" placeholder="Name" id="name" name="name" class="input"
                        value="{{ old('name') }}" />
                    <input required type="email" placeholder="Email" id="email" name="email" class="input"
                        value="{{ old('email') }}" />
                    <input required type="password" placeholder="Password" id="password" name="password"
                        class="input" />
                    <input required type="password" placeholder="Confirm Password" id="password_confirmation"
                        value="{{ old('password') }}" name="password_confirmation" class="input"
                        value="{{ old('password_confirmation') }}" />
                    <button type="submit" class="btn btn-primary">Register</button>
                    @if ($errors->any())
                        <div class="flex flex-col gap-2">
                            @foreach ($errors->all() as $error)
                                <x-alert type="error">{{ $error }}</x-alert>
                            @endforeach
                        </div>
                    @endif
                    <a href="{{ route('show.login') }}">Already Have an Account?</a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
