<p>A new comment has been posted. Please view the details. </p>

<p>Post: {{ $comment->post->title }} </p>

<p>Comment: {{ $comment->body }} </p>

<p>Commented By: {{ $comment->commenter_name }}</p>

<p>Please login and access the <a href="{{ route('comments.index') }}">comments page</a> to approve this comment.</p>