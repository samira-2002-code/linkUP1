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
        }

        .post-author .headline {
            color: #666;
            font-size: 13px;
        }

        .post-content {
            margin-top: 10px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #0a66c2;
            color: white;
        }

        .btn-warning {
            background: orange;
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .btn-danger {
            background: red;
            color: white;
        }
    </style>

    <div class="max-w-3xl mx-auto py-6">

        {{-- Create Post --}}
        <div class="post">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                <textarea
                    name="content"
                    rows="4"
                    placeholder="Share something...">{{ old('content') }}</textarea>

                @error('content')
                <p style="color:red">{{ $message }}</p>
                @enderror

                <button class="btn btn-primary">
                    Publish
                </button>
            </form>
        </div>

        {{-- Posts --}}
        @foreach ($posts as $post)

        <div class="post">

            <div class="post-header">

                <img src="https://i.pravatar.cc/150?u={{ $post->user->id }}"
                    class="w-10 h-10 rounded-full"
                    alt="{{ $post->user->name }}">

                <div class="post-author">

                    <div class="name">
                        {{ $post->user->name }}
                    </div>

                    <div class="headline">
                        {{ $post->user->headline }}

                        @if($post->user->company)
                        • {{ $post->user->company }}
                        @endif
                    </div>

                    <small>
                        {{ $post->created_at->format('d M Y') }}
                    </small>

                </div>

            </div>

            <div class="post-content">
                {{ $post->content }}
            </div>

            <br>

            @can('update', $post)
            <a
                href="{{ route('posts.edit', $post) }}"
                class="btn-warning">
                Edit
            </a>
            @endcan

            @can('delete', $post)

            <form
                action="{{ route('posts.destroy', $post) }}"
                method="POST"
                style="display:inline">

                @csrf
                @method('DELETE')

                <button
                    class="btn btn-danger"
                    onclick="return confirm('Delete this post ?')">

                    Delete

                </button>

            </form>

            @endcan

        </div>

        @endforeach

    </div>

</x-app-layout>