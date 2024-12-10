@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 bg-gradient-to-b from-gray-50 to-gray-100 rounded-lg shadow-lg">
    <h1 class="text-4xl font-extrabold mb-8 text-center text-blue-800">Nieuws</h1>

    @if(auth()->check() && auth()->user()->role === 'eigenaar')
        <div class="flex justify-end mb-6">
            <a href="{{ route('nieuws.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition">
                Nieuw Nieuws Toevoegen
            </a>
        </div>
    @endif

    @if($nieuws->isEmpty())
        <p class="text-gray-500 text-center text-lg italic">Er is momenteel geen nieuws beschikbaar.</p>
    @else
        <div class="space-y-6">
            @foreach ($nieuws as $item)
                <div class="bg-white p-6 rounded-lg shadow-md transition hover:shadow-lg">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ $item->titel }}
                        </h2>
                        <button onclick="toggleNews({{ $item->id }})" class="bg-blue-100 text-blue-500 px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-200 transition">
                            Meer
                        </button>
                    </div>
                    <div id="news-{{ $item->id }}" class="hidden mt-4 text-gray-700">
                        <p>{{ $item->inhoud }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    function toggleNews(id) {
        const element = document.getElementById(`news-${id}`);
        element.classList.toggle('hidden');
    }
</script>
@endsection
