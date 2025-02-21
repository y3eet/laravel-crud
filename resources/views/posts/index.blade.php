<x-layout>
    <div id="posts">

    </div>
    <button class="btn fixed bottom-4 right-4" id="postModalBtn">Post</button>
    <dialog id="postModal" class="modal">
        <div class="modal-box p-14">
            <div class="max-w-2xl mx-auto">
                <h2 class="card-title mb-5">Create a Post</h2>
                <form id="createPostForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="label">
                            <span class="label-text">Title</span>
                        </label>
                        <input type="text" name="title" id="title" class="input input-bordered w-full"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="label">
                            <span class="label-text">Content</span>
                        </label>
                        <textarea name="content" id="content" rows="4" class="textarea textarea-bordered w-full" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-full">Submit</button>
                </form>

            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        $(document).ready(function() {
            function loadPosts() {
                $.ajax({
                    url: '/api/posts',
                    type: 'GET',
                    success: function(response) {
                        $('#posts').html(response)
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        console.log(xhr.responseText);
                    }
                });
            }
            $('#postModalBtn').on('click', function() {
                const modal = $('#postModal')[0];
                modal.showModal();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            loadPosts()
            $("#createPostForm").on('submit', function(e) {
                e.preventDefault();
                console.log("add")
                $.ajax({
                    url: '/api/posts',
                    type: 'POST',
                    data: $(this).serialize(),

                    success: function(response) {
                        loadPosts();
                        const modal = $('#postModal')[0];
                        modal.close();
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
