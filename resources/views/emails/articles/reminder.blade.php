@component('mail::message')
# Weekly Reminder

Hey {{ $user->name }} ! {{ $articles->count() }} new post(s) for you!

@foreach($articles as $article)
- [{{ $article->title }}]({{ route('articles.goster', $article) }})
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
