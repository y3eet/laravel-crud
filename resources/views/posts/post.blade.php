<x-layout>
    <div id="post_{{ $post->id }}" class="mx-auto card bg-base-100 shadow-xl mb-3"
        style="max-width: 900px; width: 100vw">
        <input type="hidden" value="{{ $post->id }}" id="postId">
        <div class="card-body flex flex-col gap-3">
            <div class="flex gap-3">
                <div class="avatar placeholder">
                    <div class="bg-neutral text-neutral-content w-12 rounded-full">
                        <span>{{ strtoupper(substr($post->user->name, 0, 2)) }}</span>
                    </div>
                </div>

                <div>
                    <h2 class="card-title text-accent">{{ $post->user->name }}</h2>
                    <p class="text-sm text-gray-500">Posted on {{ $post->created_at->format('F d, Y') }}</p>
                </div>
                @if ($post->user->id === Auth::user()->id)
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
                                    <button data-post-id="{{ $post->id }}" class="editModalBtn text-green-500">
                                        Edit
                                    </button>
                                </li>
                                <li>
                                    <button data-post-id="{{ $post->id }}" class="deleteModalBtn text-red-500">
                                        Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        {{-- Edit Modal --}}
                        <dialog id="editPostModal_{{ $post->id }}" class="modal">
                            <div class="modal-box p-14">
                                <h2 class="card-title mb-5">Edit a Post</h2><span>Post ID: {{ $post->id }}</span>
                                <div class="max-w-2xl mx-auto">
                                    <form id="editPostForm_{{ $post->id }}" method="POST"
                                        data-post-id="{{ $post->id }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="title" class="label">
                                                <span class="label-text">Title</span>
                                            </label>
                                            <input data-post-id="{{ $post->id }}" type="text" name="title"
                                                id="title" value="{{ $post->title }}"
                                                class="input input-bordered w-full" required>
                                        </div>

                                        <div class="mb-4">
                                            <label for="content" class="label">
                                                <span class="label-text">Content</span>
                                            </label>
                                            <textarea name="content" id="content" rows="4" class="textarea textarea-bordered w-full" required>{{ $post->content }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-full">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <form method="dialog" class="modal-backdrop">
                                <button>close</button>
                            </form>
                        </dialog>
                        {{-- Delete Modal --}}
                        <dialog id="deletePostModal_{{ $post->id }}" class="modal">
                            <div class="modal-box p-8">
                                <h2 class="card-title mb-5">Delete Post</h2>
                                <span>Post ID: {{ $post->id }}</span>
                                <p>Are you sure you want to delete this post?</p>
                                <div class="flex mt-10 justify-end">
                                    <button data-post-id="{{ $post->id }}" type="submit"
                                        class="btn btn-error deletePostBtn">Delete</button>
                                </div>
                            </div>
                            <form method="dialog" class="modal-backdrop">
                                <button>close</button>
                            </form>
                        </dialog>
                    </div>
                @endif

            </div>
            <h2 class="card-title" id="title_{{ $post->id }}">{{ $post->title }}</h2>
            <p id="content_{{ $post->id }}">{{ $post->content }}</p>

        </div>
        {{-- <figure>
            <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Post Image" />
        </figure> --}}


        <div class="card-body flex flex-col gap-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <x-heart-button post-id="{{ $post->id }}" count="{{ $post->likes_count }}"
                        filled="{{ $post->liked }}" />
                    <button onclick="comment_modal.showModal()" class="btn btn-sm ml-5">Comment</button>

                    <dialog class="modal" id="comment_modal">
                        <div class="modal-box p-8">
                            <h2 class="card-title mb-5">Comment</h2>
                            <div class="max-w-2xl mx-auto">
                                <form id="commentForm">
                                    @csrf
                                    <div class="mb-4">
                                        <input type="hidden" name="postId" value="{{ $post->id }}">
                                        <textarea name="body" id="comment" rows="3" class="textarea textarea-bordered w-full" required></textarea>
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
        </div>

    </div>
    <div class="mt-5" id="commentSection">
        <span class="loading loading-infinity loading-lg"></span>
    </div>

    <script>
        $(document).ready(function() {

            function toast(message, variant, time = 3000) {
                $('#toast').removeClass('hidden');
                $('#toastMessage').text(message)
                $('#toastVariant').addClass('alert-' + variant)
                setTimeout(function() {
                    $('.toast').addClass('hidden');
                }, time);
            }

            function loadComments() {
                $.ajax({
                    url: `/api/comment`,
                    type: 'GET',
                    data: {
                        postId: Number($("#postId").val())
                    },
                    success: function(response) {
                        $('#commentSection').html(response)
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Error:', error);
                    }
                });
            }
            loadComments()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).off('click', '.deleteModalBtn').on('click', '.deleteModalBtn', function() {
                const postId = $(this).data('post-id');
                const modal = $(`#deletePostModal_${postId}`)[0];
                modal.showModal();
            });
            $(document).off('click', '.deletePostBtn').on('click', '.deletePostBtn', function() {
                const postId = $(this).data('post-id');
                $.ajax({
                    url: `/api/posts/${postId}`,
                    type: 'DELETE',
                    success: function(response) {
                        console.log(response);
                        const modal = $(`#deletePostModal_${postId}`)[0]
                        modal.close();
                        toast(response.message, 'success')
                        window.location.href = '/posts'
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        console.log(xhr.responseText);
                    }
                });
            });
            $(document).off('click', '.editModalBtn').on('click', '.editModalBtn', function() {
                const postId = $(this).data('post-id');
                const modal = $(`#editPostModal_${postId}`)[0];
                modal.showModal();
            });
            $(document).off('submit', "form[id^='editPostForm_']").on('submit', "form[id^='editPostForm_']",
                function(e) {
                    e.preventDefault();
                    const postId = $(this).data('post-id');
                    $.ajax({
                        url: `/api/posts/${postId}`,
                        type: 'PUT',
                        data: $(this).serialize(),
                        success: function(response) {
                            const modal = $(`#editPostModal_${postId}`)[0];
                            const responsePostId = response.post.id;
                            const title = response.post.title;
                            const content = response.post.content;
                            $(`#title_${responsePostId}`).text(title);
                            $(`#content_${responsePostId}`).text(content);
                            modal.close();
                            toast(response.message, 'success')
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('Error:', error);
                        }
                    });
                });
            //Comment Section
            $(document).off('submit', "form[id^='commentForm']").on('submit', "form[id^='commentForm']",
                function(e) {
                    const formData = $(this).serialize();
                    e.preventDefault();
                    $.ajax({
                        url: `/api/comment`,
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            $('#comment_modal').get(0).close();
                            loadComments()
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('Error:', error);
                        }
                    });
                });

            $(document).off('click', '.replyBtn').on('click', '.replyBtn', function() {
                const commentId = $(this).data('comment-id');
                const modal = $(`#replyCommentModal_${commentId}`)[0];
                modal.showModal();

            });
            $(document).off('submit', "form[id^='replyForm_']").on('submit', "form[id^='replyForm_']",
                function(e) {
                    const formData = $(this).serialize();
                    const formDataObj = new URLSearchParams(formData);
                    const commentId = formDataObj.get('parentId');
                    const modal = $(`#replyCommentModal_${commentId}`)[0];
                    e.preventDefault();
                    modal.close()
                    $.ajax({
                        url: `/api/comment`,
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            modal.close()
                            loadComments()
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('Error:', error);
                        }
                    });
                });


        });
    </script>
</x-layout>
