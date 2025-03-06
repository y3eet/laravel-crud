@props(['comment'])
<div id="comment_{{ $comment->id }}" class="flex gap-4">
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
                        <div class="flex items-center gap-2">
                            <h2 class="card-title text-accent">{{ $comment->user->name }}</h2>
                            {{-- @if (Auth::user()->id === $comment->post_id)
                                <div class="badge badge-secondary">Post Owner</div>
                            @endif --}}
                        </div>
                        <p class="text-sm text-gray-500">{{ $comment->created_at->format('F d, Y') }}</p>
                    </div>
                    @if ($comment->user_id === Auth::user()->id)
                        <div class="ml-auto">
                            <div class="dropdown dropdown-end">
                                <div tabindex="0" role="button" class="btn btn-xs btn-ghost">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                                    </svg>
                                </div>

                                <ul tabindex="0"
                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                    <li>
                                        <button data-comment-id="{{ $comment->id }}"
                                            class="editCommentModalBtn text-green-500">
                                            Edit
                                        </button>
                                    </li>
                                    <li>
                                        <button data-comment-id="{{ $comment->id }}"
                                            class="deleteCommentModalBtn text-red-500">
                                            Delete
                                        </button>
                                    </li>
                                </ul>
                                {{-- Delete Comment Modal --}}
                                <dialog id="deleteCommentModal_{{ $comment->id }}" class="modal">
                                    <div class="modal-box p-8">
                                        <h2 class="card-title mb-5">Delete Comment</h2>
                                        <span>Comment ID: {{ $comment->id }}</span>
                                        <strong>
                                            <p>Are you sure you want to delete this comment?</p>
                                        </strong>
                                        <div class="flex mt-10 justify-end">
                                            <button data-comment-id="{{ $comment->id }}" type="submit"
                                                class="btn btn-error deleteCommentBtn">Delete</button>
                                        </div>
                                    </div>
                                    <form method="dialog" class="modal-backdrop">
                                        <button>close</button>
                                    </form>
                                </dialog>
                                {{-- Edit Comment Modal --}}
                                <dialog id="editCommentModal_{{ $comment->id }}" class="modal">
                                    <div class="modal-box p-8">
                                        <h2 class="card-title mb-5">Edit Comment</h2>
                                        <div class="max-w-2xl mx-auto">
                                            <form id="editCommentForm_{{ $comment->id }}">
                                                @csrf
                                                <div class="mb-4">
                                                    <input type="hidden" name="commentId" value="{{ $comment->id }}">
                                                    <textarea name="body" rows="3" class="textarea textarea-bordered w-full" required>{{ $comment->body }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-full">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <form method="dialog" class="modal-backdrop">
                                        <button>close</button>
                                    </form>
                                </dialog>
                            </div>
                        </div>
                    @endif

                </div>
                <p>{{ $comment->body }}</p>
                <div>
                    <button id="replyBtn" data-post-id="{{ $comment->post_id }}"
                        data-comment-id="{{ $comment->id }}" class="replyBtn btn btn-sm">Reply</button>
                    <dialog id="replyCommentModal_{{ $comment->id }}" class="modal">
                        <div class="modal-box">
                            <form id="replyForm_{{ $comment->id }}" method="POST"">
                                @csrf
                                <h2 class="card-title mb-5">Reply to: <strong>{{ $comment->user->name }}</strong></h2>
                                <div class="mb-4">
                                    <input type="hidden" name="postId" value="{{ $comment->post_id }}">
                                    <input type="hidden" name="parentId" value="{{ $comment->id }}">
                                    <textarea name="body" id="comment" rows="3" class="textarea textarea-bordered w-full" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-full">Submit</button>
                            </form>
                        </div>
                        <form method="dialog" class="modal-backdrop">
                            <button>close</button>
                        </form>
                    </dialog>
                </div>

            </div>
        </div>

        <div class="pl-48 relative flex items-center">
            {{-- <div class="divider divider-horizontal"></div> --}}
            <div class="flex-grow">{{ $slot }}</div>
        </div>
    </div>
</div>
