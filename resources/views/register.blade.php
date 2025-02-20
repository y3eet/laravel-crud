<x-layout>
    <div class="flex justify-center items-center min-h-[70vh]">
        <form action="">
            <div class="card bg-neutral text-neutral-content w-96">
                <div class="card-body flex flex-col gap-5">
                    <h1 class="card-title">Register</h1>
                    <input required type="text" placeholder="Name" id="name" class="input" />
                    <input required type="email" placeholder="Email" id="email" class="input" />
                    <input type="password" placeholder="Password" id="password" class="input" />
                    <input type="password" placeholder="Confirm Password" id="confirmPassword" class="input" />
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="login">Already Have an Accoount?</a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
