<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Yeni Article Kayıt') }}
        </h2>
    </x-slot>
    <form action="/articles" method="POST">
        @csrf

        Kategori<br>
        <select name="category_id">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <hr>

        Başlık<br>
        <input class="form-control" style="width:auto;" type="text" name="title" value="{{ old('title') }}">
        @error('title')
        <br>{{ $message }}
        @enderror
        <hr>

        İçerik<br>
        <textarea class="form-control" style="width:auto;" name="content">{{ old('content') }}</textarea>
        @error('content')
        <br>{{ $message }}
        @enderror
        <div class="form-group">
            <label for="inpTags">{{ __('Article Tags') }}</label>
            <input type="text" name="tags" class="form-control" style="width:auto;" id="inpTags" value="{{ old('tags') }}"
                aria-describedby="tagsHelp">
            <small id="tagsHelp" class="form-text text-muted">{{ __('Seperate with commas.') }}</small>
            @error('tags')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Ekle</button>
        <a class="btn btn-warning" style="text-decoration: none;color:inherit;" href="/articles">İptal</a>
    </form>
    <hr>
</x-app-layout>