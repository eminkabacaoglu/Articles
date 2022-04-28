<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __("Güncelle") }}
        </h2>
    </x-slot>
    <h1>{{ $category->name }}</h1>
    <ul>
        @foreach ($category->articles as $article)
        <li>
            <a href="/articles/{{ $article->id }}">
                {{ $article->title }}
            </a>
        </li>
        @endforeach
    </ul>
    <hr />
    <a href="{{ route('categories.edit', $category) }}">Düzenle</a> |
    <a href="{{ route('categories.index') }}">Kategori Listesine Geri Dön</a> |
    <form action="{{ route('categories.destroy', $category) }}" method="POST">
        @method('DELETE') @csrf
        <br />
        <div>
        @can('update',$category)
            <button class="btn btn-danger" type="submit">Sil</button>
        @endcan
            @if($category->isFollowedBy(Auth::id()))
            <a href="{{ route('categories.unfollow', $category) }}"
                class="btn btn-sm btn-outline-success">{{ __('Unfollow Category') }}</a>
            @else
            <a href="{{ route('categories.follow', $category) }}"
                class="btn btn-sm btn-success">{{ __('Follow Category') }}</a>
            @endif
        </div>
    </form>
</x-app-layout>