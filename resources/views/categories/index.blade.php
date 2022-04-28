<x-deneme>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Categories') }}
        </h2>

    </x-slot>

    <x-slot name="header2">
        <h2 class="h4 font-weight-bold">
            {{ __('helooo') }}
        </h2>
    </x-slot>


    <x-slot name="slot">
        <div class="card my-4">
            <div class="card-body">
                @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category) }}">
                    {{ $category->name }}
                </a>
                <ul>
                    @foreach ($category->articles as $article)
                    <li>
                        <a href="/articles/{{ $article->id }}">
                            {{ $article->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endforeach
                <hr>
                <a href="{{ route('categories.create') }}">Yeni Kategori</a>
            </div>
        </div>
    </x-slot>

    {{-- <x-slot name="slot2">
        <div class="card my-4">
            <div class="card-body">
                @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category) }}">
                    {{ $category->name }}
                </a>
                <ul>
                    @foreach ($category->articles as $article)
                    <li>
                        <a href="/articles/{{ $article->id }}">
                            {{ $article->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endforeach
                <hr>
                <a href="{{ route('categories.create') }}">asdasdasdasdasd</a>
            </div>
        </div>
    </x-slot> --}}

    

</x-deneme>   
