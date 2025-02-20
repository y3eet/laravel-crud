@props(['post'])
<div class="mx-auto card bg-base-100 shadow-xl mb-3" style="max-width: 900px; width: 100vw">
    <div class="card-body flex flex-col gap-3">
        <div class="flex gap-3">
            <div class="avatar placeholder">
                <div class="bg-neutral text-neutral-content w-12 rounded-full">
                    <span>{{ strtoupper(substr($post->user->name, 0, 2)) }}</span>
                </div>
            </div>
            <div>
                <h2 class="card-title">{{ $post->user->name }}</h2>
                <p class="text-sm text-gray-500">Posted on {{ $post->created_at->format('F d, Y') }}</p>
            </div>
        </div>
        <h2 class="card-title">{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
    </div>
    {{-- Image (Uncomment if needed) --}}
    {{-- <figure>
        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Post Image" />
    </figure> --}}
    <div class="card-body flex flex-col gap-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-2">
                <button class="btn btn-outline btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
                <span>10 likes</span>
            </div>
            <button class="btn btn-outline btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8h2a2 2 0 012 2v10a2 2 0 01-2 2h-6a2 2 0 01-2-2v-2m-4 4h6m-6-4h6m-6-4h6m-6-4h6m-6-4h6m-6-4h6m-6-4h6" />
                </svg>
                <span>Share</span>
            </button>
        </div>
    </div>
</div>
