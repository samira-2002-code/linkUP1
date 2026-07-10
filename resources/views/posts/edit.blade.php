<x-app-layout>

<div class="max-w-2xl mx-auto py-10">

    <div class="bg-white shadow-lg rounded-xl p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            ✏️ Edit your post
        </h2>

        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')

            <textarea
                name="content"
                rows="6"
                class="w-full border border-gray-300 rounded-lg p-4 focus:border-blue-500 focus:ring-blue-500"
                placeholder="Update your post...">{{ old('content', $post->content) }}</textarea>

            @error('content')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror

            <div class="flex justify-end gap-3 mt-6">

                <a href="{{ route('feed') }}"
                   class="px-5 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-gray-800 font-semibold">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold">
                    Update Post
                </button>

            </div>

        </form>

    </div>

</div>

</x-app-layout>