@props(['postId', 'count' => 0, 'filled' => false, 'class' => ''])

<button type="button" data-post-id="{{ $postId }}" data-filled="{{ $filled }}"
    class="likeBtn btn btn-ghost btn-sm {{ $class }} ">
    <svg id="like" xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 {{ $filled ? 'text-red-500 fill-red-500' : 'text-gray-500 fill-gray-500' }}" viewBox="0 0 24 24"
        fill="currentColor">
        <path id="heartFilled"
            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
    </svg>

</button>
<span id="likeCount_{{ $postId }}">{{ $count }}</span><span>like{{ $count > 1 ? 's' : '' }}</span>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function() {
        $('.likeBtn').off().on('click', function() {
            let like = $(this).data('filled');
            let postId = $(this).data('post-id');
            let button = $(this);
            let likeCount = Number($(`#likeCount_${postId}`).text());

            $.ajax({
                url: `/api/like/${postId}`,
                type: like ? 'DELETE' : 'PUT',
                success: function(response) {
                    button.data('filled', like ? 0 : 1);
                    button.find('svg').toggleClass(
                        'text-red-500 fill-red-500 text-gray-500 fill-gray-500');
                    $(`#likeCount_${postId}`).text(!like ? likeCount + 1 : likeCount - 1)

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.log(xhr.responseText);
                }
            });

        });
    });
</script>
