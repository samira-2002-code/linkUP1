<p>{{ $post->comments_count }} commentaires</p>
<form action="{{ route('comments.store', $post) }}" method="POST">
    @csrf

    <input 
        type="text" 
        name="content" 
        placeholder="Écrire un commentaire..." 
        required
    >

    <button type="submit">
        Envoyer
    </button>
</form>
@foreach ($post->comments as $comment)
    <div>
        <strong>{{ $comment->user->name }}</strong>
        <span>{{ $comment->user->headline }}</span>

        <p>{{ $comment->content }}</p>
    </div>
@endforeach