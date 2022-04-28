<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Düzenle') }}
        </h2>
    </x-slot>
    <form action="/articles/{{ $article->id }}" method="POST">
        @csrf
        @method('PUT')
        Kategori<br>
        <div>
        <select name="category_id" class="custom-select" style="width:auto;">
            @foreach($categories as $category)
                @if ($category->id==$article->category_id)
                <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>           
                @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
        <hr>
    
        Başlık<br>
        <input type="text" class="form-control" style="width:auto;" name="title"  value="{{ old('title') ?  old('title') : $article->title }}">
        @error('title')
        <br>{{ $message }}
        @enderror
        <hr>
        İçerik<br>
        <textarea style="width:auto;" class="form-control" name="content">{{ old('content') ?  old('content') : $article->content }}</textarea>
        @error('content')
        <br>{{ $message }}
        @enderror
        <hr>
        <p>Yazar: {{$article->user->name}}</p>
        <hr>
        <br>
        <button class="btn btn-primary" type="submit">Article Güncelle</button>
        <a class="btn btn-warning" style="text-decoration: none;color:inherit;" href="/articles">İptal</a>
        <button class="btn btn-warning">Geri</button>
    </form>
    <hr>
    
    
</x-app-layout>
