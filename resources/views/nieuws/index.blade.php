@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">Nieuws</h1>

    @if(auth()->check() && auth()->user()->role === 'eigenaar')
        <div class="mb-4">
            <a href="{{ route('nieuws.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Maak Nieuw Nieuws
            </a>
        </div>
    @endif

    @foreach ($nieuws as $item)
        <div class="bg-white shadow p-4 rounded mb-4">
            <button onclick="toggleNews" class="text-lg font-bold text-left w-full">
                {{ $item->titel }}
            </button>
            <div id="news-{{ $item->id }}" class="hidden mt-3">
                <p>{{ $item->inhoud }}</p>
            </div>
        </div>
    @endforeach
</div>

<script>
    function toggleNews(id) {
        const element = document.getElementById(`news-${id}`);
        element.classList.toggle('hidden');
    }
</script>
@endsection
