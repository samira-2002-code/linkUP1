<x-app-layout>

    <style>
        body {
            background: #f3f2ef;
        }

        .feed-container {
            max-width: 750px;
            margin: auto;
            padding: 25px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }

        textarea,
        input[type=text] {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px;
            outline: none;
        }

        textarea:focus,
        input:focus {
            border-color: #0a66c2;
        }

        .btn {
            border: none;
            padding: 10px 18px;
            border-radius: 25px;
            cursor: pointer;
            transition: .3s;
        }

        .btn-primary {
            background: #0a66c2;
            color: white;
        }

        .btn-primary:hover {
            background: #004182;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
        }

        .post-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-name {
            font-weight: bold;
            font-size: 16px;
        }

        .author-headline {
            color: #666;
            font-size: 13px;
        }

        .post-content {
            margin-top: 15px;
            font-size: 15px;
            line-height: 1.7;
        }

        .post-stats {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 14px;
            margin-top: 15px;
        }

        .actions {
            display: flex;
            justify-content: space-around;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
            margin: 15px 0;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #555;
            font-weight: 600;
        }

        .action-btn:hover {
            color: #0a66c2;
        }

        .comment {
            background: #f3f2ef;
            padding: 12px;
            border-radius: 10px;
            margin-top: 10px;
        }

        .comment strong {
            display: block;
        }

        .comment small {
            color: #666;
        }

        .post-time {
            color: #888;
            font-size: 12px;
        }

        .post-content {
            white-space: pre-line;
        }
    </style>

    <div class="feed-container">

        {{-- CREATE POST --}}
        <div class="card">

            <form action="{{ route('posts.store') }}" method="POST">

                @csrf

                <textarea
                    name="content"
                    rows="4"
                    placeholder="✨ Start a post...">{{ old('content') }}</textarea>

                @error('content')
                <p style="color:red">{{ $message }}</p>
                @enderror

                <div style="text-align:right;margin-top:10px;">
                    <button class="btn btn-primary">
                        Publish
                    </button>
                </div>

            </form>

        </div>

        {{-- POSTS --}}
        @foreach($posts as $post)

        <div class="card">

            <div class="post-header">

                <a href="{{ route('profile.show',$post->user->id) }}">

                    <img
                        class="avatar"
                        src="{{ $post->user->image_url ?: 'https://i.pravatar.cc/150?u='.$post->user->id }}">

                </a>

                <div>

                    <div class="author-name">

                        <a
                            href="{{ route('profile.show',$post->user->id) }}"
                            style="text-decoration:none;color:black;">

                            {{ $post->user->name }}

                        </a>

                    </div>

                    <div class="author-headline">

                        {{ $post->user->headline }}

                        @if($post->user->company)

                        • {{ $post->user->company }}

                        @endif

                    </div>

                    <div class="post-time">

                        {{ $post->created_at->diffForHumans() }}

                    </div>
                    @if(auth()->id() != $post->user->id)

                    <form action="{{ route('follow.toggle', $post->user) }}" method="POST" style="margin-top:8px;">
                        @csrf

                        @if(auth()->user()->following->contains($post->user->id))

                        <button class="btn btn-primary">
                            Following
                        </button>

                        @else

                        <button class="btn btn-primary">
                            + Follow
                        </button>

                        @endif

                    </form>

                    @endif

                </div>

            </div>

            <div class="post-content">

                {{ $post->content }}

            </div>
            <div class="post-stats">

                <span>❤️ {{ $post->likes_count }} Likes</span>

                <span>💬 {{ $post->comments_count }} Comments</span>

            </div>

            <div class="actions">

                <form action="{{ route('likes.toggle', $post) }}" method="POST">
                    @csrf
                    <button class="action-btn">
                        ❤️ Like
                    </button>
                </form>

                <button class="action-btn" onclick="document.getElementById('comment{{ $post->id }}').focus()">
                    💬 Comment
                </button>

                @can('update', $post)

                <a
                    href="{{ route('posts.edit',$post) }}"
                    class="action-btn"
                    style="text-decoration:none;">
                    ✏️ Edit
                </a>

                @endcan

                @can('delete', $post)

                <form action="{{ route('posts.destroy',$post) }}" method="POST">

                    @csrf
                    @method('DELETE')

                    <button
                        class="action-btn"
                        onclick="return confirm('Delete this post ?')">

                        🗑 Delete

                    </button>

                </form>

                @endcan

            </div>


            {{-- COMMENTS --}}

            @foreach($post->comments as $comment)

            <div class="comment">

                <strong>{{ $comment->user->name }}</strong>

                <small>

                    {{ $comment->user->headline }}

                </small>

                <p style="margin-top:8px;">

                    {{ $comment->content }}

                </p>

                @can('delete',$comment)

                <form
                    action="{{ route('comments.destroy',$comment) }}"
                    method="POST"
                    style="margin-top:8px;">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">

                        Delete

                    </button>

                </form>

                @endcan

            </div>

            @endforeach



            <form
                action="{{ route('comments.store',$post) }}"
                method="POST"
                style="margin-top:15px;">

                @csrf

                <input
                    id="comment{{ $post->id }}"
                    type="text"
                    name="content"
                    placeholder="Write a comment...">

                @error('content')

                <p style="color:red">{{ $message }}</p>

                @enderror

                <div style="margin-top:10px;text-align:right;">

                    <button class="btn btn-primary">

                        Comment

                    </button>

                </div>

            </form>

        </div>

        @endforeach

    </div>

</x-app-layout>

