<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Detay') }}
        </h2>
    </x-slot>
    <h1>Başlık: {{ $article->title }}</h1>
    <h5>
        <a href="{{ route('categories.show', $article->category) }}">
            Kategori: {{ $article->category->name }}
        </a>
    </h5>
    <hr>
    <p>
        İçerik: {{ $article->content }}
    </p>
    <hr>
    <p>
        Yazar: {{ $article->user->name }}
    </p>
    <hr>
    <p>
        {{ __('Tags') }}: 
        @foreach ($article->tags as $tag)
            {{$tag->name}}
        @endforeach
    </p>
    <hr>
    <a href="/articles">Article Listesi</a> |
    <a href="/articles/edit/{{ $article->id }}/{{$article->user_id}}">Düzenle</a>
    <br>
    <br>
        <a href="/articles/delete/{{ $article->id }}" class="btn btn-danger">Sil</a>
</x-app-layout>