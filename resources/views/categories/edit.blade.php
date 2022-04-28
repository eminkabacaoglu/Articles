<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Güncelle') }}
        </h2>
    </x-slot>
<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    Kategori Adı: <input type="text" name="name" value="{{ old('name') ?  old('name') : $category->name }}">
    @error('name')
        <br>{{ $message }}
    @enderror
    <br>
    <button type="submit">Kategoriyi Güncelle</button>
</form>
<hr>
<a href="{{ route('categories.show', $category) }}">Kategori Detayına Geri Dön</a>
</x-app-layout>