@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 bg-gradient-to-b from-gray-50 to-gray-100 rounded-lg shadow-lg">
    <h1 class="text-4xl font-extrabold mb-8 text-center text-blue-800">Nieuws</h1>

    @if(auth()->check() && auth()->user()->role === 'eigenaar')
        <div class="flex justify-end mb-6">
            <a href="{{ route('nieuws.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition duration-200 ease-in-out transform hover:scale-105">
                Nieuw Nieuws Toevoegen
            </a>
        </div>
    @endif

    @if($nieuws->isEmpty())
        <p class="text-gray-500 text-center text-lg italic">Er is momenteel geen nieuws beschikbaar.</p>
    @else
        <div class="space-y-6">
            @foreach ($nieuws as $item)
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 ease-in-out">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2">
                            <!-- Een simpel icoon voor visuele flair -->
                            <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h14a1 1 0 011 1v5c0 .331-.133.646-.368.879l-2.74 2.74-2.333 2.333a1 1 0 01-1.414 0l-2.335-2.334-2.74-2.74A1.241 1.241 0 014 8V3zM2 10c0 .331.133.646.368.879l2.74 2.74 2.335 2.333a1 1 0 001.414 0l2.333-2.334 2.74-2.74A1.241 1.241 0 0016 10H2z"/>
                            </svg>
                            <h2 class="text-xl font-semibold text-gray-800">{{ $item->titel }}</h2>
                        </div>
                        <button onclick="toggleNews({{ $item->id }})" class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-200 transition duration-200 ease-in-out">
                            Meer
                        </button>
                    </div>

                    <!-- Aanmaakdatum mooi weergeven -->
                    <div class="text-sm text-gray-500 mb-4">
                        {{ $item->created_at->format('d M Y, H:i') }}
                    </div>

                    <div id="news-{{ $item->id }}" class="hidden text-gray-700">
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
