<x-app-layout>

    <div class="max-w-xl mx-auto mt-10">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-xl font-bold mb-4">Edit Post</h2>

            <form method="POST" action="{{ route('posts.update', $post) }}">
                @csrf
                @method('PUT')

                <textarea name="content"
                          class="w-full border rounded p-3 focus:ring focus:outline-none"
                          rows="5">{{ $post->content }}</textarea>

                @error('content')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

                <div class="flex justify-end mt-4">
                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Update Post
                    </button>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>









