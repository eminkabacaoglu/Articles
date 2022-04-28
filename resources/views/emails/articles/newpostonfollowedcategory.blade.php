@component('mail::message')
# A new article added to your followed category: {{ $article->category->name }}

A article titled {{ $article->title }} has been added to {{ $article->category->name }} category on your favorite Web site.

@component('mail::button', ['url' => route('articles.goster', $article)])
Come check it
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
