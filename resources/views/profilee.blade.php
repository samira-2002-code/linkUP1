<!DOCTYPE html>
<html lang="fr" class="bg-gray-950 text-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de {{ $user->name }} - DevNetwork</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-950 py-8 px-4">

<div class="max-w-2xl mx-auto space-y-6">

    <!-- ========================= -->
    <!-- CARD PROFIL -->
    <!-- ========================= -->
    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-xl">

        <!-- Bannière -->
        <div class="h-28 bg-gradient-to-r from-slate-800 to-slate-900"></div>

        <div class="relative p-6 pt-0">

            <!-- Photo -->
            <div class="absolute -top-12 left-6">
                <img
                    src="{{ $user->image_url ?? 'https://via.placeholder.com/150' }}"
                    alt="{{ $user->name }}"
                    class="w-24 h-24 rounded-full border-4 border-gray-900 object-cover"
                >
            </div>

            <!-- Bouton modifier -->
            <div class="flex justify-end h-14 items-center">
                @if(auth()->id() === $user->id)
                    <a href="/profile/edit"
                       class="px-4 py-2 rounded-full border border-gray-700 hover:bg-gray-800 text-sm">
                        <i class="fa-solid fa-pen mr-2"></i>
                        Modifier le profil
                    </a>
                @endif
            </div>

            <!-- Infos -->
            <div class="mt-2">

                <h1 class="text-2xl font-bold">
                    {{ $user->name }}
                </h1>

                <p class="text-gray-400 mt-1">
                    {{ $user->headline }}
                </p>

                <div class="mt-4 flex items-center text-gray-400 text-sm">
                    <i class="fa-solid fa-briefcase mr-2"></i>

                    @if($user->company)
                        {{ $user->company }}
                    @else
                        Non spécifiée
                    @endif
                </div>

            </div>

        </div>

    </div>

    <!-- ========================= -->
    <!-- POSTS -->
    <!-- ========================= -->

    <div>

        <h2 class="text-lg font-bold mb-4">
            Publications de {{ $user->name }}
        </h2>

        @forelse($posts as $post)

            <div class="bg-gray-900 border border-gray-800 rounded-xl p-5 mb-4">

                <div class="flex items-center justify-between">

                    <div class="flex items-center space-x-3">

                        <img
                            src="{{ $user->image_url ?? 'https://via.placeholder.com/150' }}"
                            class="w-10 h-10 rounded-full object-cover"
                        >

                        <div>
                            <h3 class="font-semibold">
                                {{ $user->name }}
                            </h3>

                            <p class="text-xs text-gray-500">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>

                    </div>

                </div>

                <div class="mt-4 whitespace-pre-line text-gray-300">
                    {{ $post->content }}
                </div>

                <div class="mt-4 pt-3 border-t border-gray-800 flex gap-6 text-sm text-gray-500">

                    <span>
                        <i class="fa-regular fa-thumbs-up"></i>
                        {{ $post->likes()->count() }}
                    </span>

                    <span>
                        <i class="fa-regular fa-comment"></i>
                        {{ $post->comments()->count() }}
                    </span>

                </div>

            </div>

        @empty

            <div class="bg-gray-900 border border-gray-800 rounded-xl p-8 text-center text-gray-500">

                <i class="fa-regular fa-folder-open text-3xl mb-3"></i>

                <p>Aucune publication pour le moment.</p>

            </div>

        @endforelse

    </div>

</div>

</body>
</html>