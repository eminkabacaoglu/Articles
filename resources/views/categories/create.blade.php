<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Yeni Ketegori Kayıt') }}
        </h2>
    </x-slot>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        Kategori Adı: <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
        <br>{{ $message }}
        @enderror
        <br>
        <br>
        <button class="btn btn-primary" type="submit">Kategori Ekle</button>
    </form>
    <hr>
    <div>
        <a href="{{ route('categories.index') }}">Kategori Listesine Geri Dön</a>
    </div>
</x-app-layout>