<x-app-layout>

    <style>
        .post {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .post-header img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }

        .post-author .name {
            font-weight: bold;
            font-size: 15px;
        }

        .post-author .headline {
            font-size: 13px;
            color: #666;
        }

        .post-author .date {
            font-size: 12px;
            color: #999;
        }

        .post-content {
            font-size: 14px;
            line-height: 1.5;
            white-space: pre-line;
        }
    </style>

    @foreach ($posts as $post)
        <div class="post">
            <div class="post-header">
                <img src="{{ $post->user->image_url }}" alt="{{ $post->user->name }}">

                <div class="post-author">
                    <div class="name">{{ $post->user->name }}</div>
                    <div class="headline">
                        {{ $post->user->headline }}
                        @if ($post->user->company)
                            at {{ $post->user->company }}
                        @endif
                    </div>
                    <div class="date">{{ $post->created_at->format('M d, Y') }}</div>
                </div>
            </div>

            <div class="post-content">{{ $post->content }}</div>
        </div>
    @endforeach

</x-app-layout>