@foreach ($comments as $comment)
    <x-comment-card :comment="$comment">
        @if ($comment->children->isNotEmpty())
            <div class="replies">
                <x-comment-card :comment="$comment"></x-comment-card>
            </div>
        @endif
    </x-comment-card>
@endforeach
