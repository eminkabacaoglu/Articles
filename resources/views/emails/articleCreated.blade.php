@component('mail::message')
# Post Created

Your {{ $article->title }} post has been created!

@component('mail::button', ['url' => route('articles.goster', $article)])
Read Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
