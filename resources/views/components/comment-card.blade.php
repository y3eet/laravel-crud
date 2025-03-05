@props(['comment'])
<div class="flex gap-4">
    <div class="flex flex-col gap-0 w-full">
        <div class="mx-auto card bg-base-100 shadow-xl mb-5" style="max-width: 900px; width: 100vw">
            <div class="card-body flex flex-col gap-3">
                <div class="flex gap-3">
                    <div class="avatar placeholder">
                        <div class="bg-neutral text-neutral-content w-12 rounded-full">
                            <span>{{ strtoupper(substr($comment->user->name, 0, 2)) }}</span>
                        </div>
                    </div>
                    <div>
                        <h2 class="card-title text-accent">{{ $comment->user->name }}</h2>
                        <p class="text-sm text-gray-500">Commented on {{ $comment->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
                <p>{{ $comment->body }}</p>
                <div>
                    <button class="btn btn-sm">Reply</button>
                </div>
            </div>
        </div>

        <div class="pl-48 relative flex items-center">
            {{-- <div class="divider divider-horizontal"></div> --}}
            <div class="flex-grow">{{ $slot }}</div>
        </div>
    </div>
</div>
