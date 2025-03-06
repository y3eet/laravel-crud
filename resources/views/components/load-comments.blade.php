@foreach ($comments as $comment)
    <x-comment-card :comment="$comment">
        @if ($comment->children->isNotEmpty())
            <div class="replies">
                <x-load-comments :comments="$comment->children"></x-load-comments>
            </div>
        @endif
    </x-comment-card>
@endforeach
