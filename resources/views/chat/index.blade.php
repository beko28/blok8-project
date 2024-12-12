@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 min-h-screen bg-gradient-to-b from-indigo-50 to-white">
    <div class="flex space-x-8 h-full">
        <!-- Linker kolom: Gesprekken -->
        <div class="w-1/3 bg-white shadow-xl rounded-lg p-6 flex flex-col">
            <div class="flex items-center mb-4">
                <svg class="w-6 h-6 text-blue-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2m4 0h12M9 3v2m0 16v2m12-5h2m-2 2h2m-2 2h2M4 15h2m0 2h2M9 5v6m0 0v6" />
                </svg>
                <h2 class="text-2xl font-bold text-blue-800">Gesprekken</h2>
            </div>

            <div class="flex-1 overflow-y-auto pr-2">
                @if($gesprekken->isEmpty())
                    <p class="text-gray-500 italic">Je hebt nog met niemand gechat.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($gesprekken as $gesprek)
                            @php
                                $hasUnread = $gesprek->has_unread ?? false;
                            @endphp
                            <li>
                                <a href="{{ route('chat.show', $gesprek->email) }}" 
                                   class="block p-3 rounded-lg hover:bg-blue-50 hover:shadow-sm transition @if(isset($ontvanger) && $ontvanger->id === $gesprek->id) bg-blue-100 @endif">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="font-medium text-gray-800">{{ $gesprek->voornaam }} {{ $gesprek->achternaam }}</div>
                                            <div class="text-sm text-gray-500">{{ $gesprek->email }}</div>
                                        </div>
                                        @if($hasUnread)
                                            <span class="inline-block w-2 h-2 bg-red-500 rounded-full ml-2"></span>
                                        @endif
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Rechter kolom: Chatvenster -->
        <div class="w-2/3 bg-white shadow-xl rounded-lg p-6 flex flex-col">
            @if(isset($ontvanger))
                <div class="border-b pb-4 mb-4 flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 bg-blue-500 text-white flex items-center justify-center rounded-full font-bold">
                            {{ strtoupper(substr($ontvanger->voornaam, 0, 1)) }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-800">Chat met {{ $ontvanger->voornaam ?? $ontvanger->name }}</h1>
                        <p class="text-sm text-gray-500">{{ $ontvanger->email }}</p>
                    </div>
                </div>

                <!-- Beperkte hoogte + scrollen -->
                <div id="chatContainer" class="mb-4 p-4 bg-gray-100 rounded-lg overflow-y-auto max-h-96">
                    @forelse($berichten as $bericht)
                        @php
                            $isEigenBericht = $bericht->afzender_id === auth()->id();
                        @endphp
                        <div class="mb-4 flex {{ $isEigenBericht ? 'justify-end' : 'justify-start' }} relative last:mb-0">
                            <div class="max-w-xs p-3 rounded-lg relative {{ $isEigenBericht ? 'bg-blue-500 text-white' : 'bg-white text-gray-800 border border-gray-200' }} hover:shadow-md transition-shadow duration-200">
                                @if($isEigenBericht)
                                    <!-- Paper Airplane icoon voor eigen bericht -->
                                    <div class="absolute -top-2 -right-2 bg-blue-500 text-white rounded-full p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.3 2.3a1 1 0 011.4 0l14 5a1 1 0 010 1.832l-14 5A1 1 0 012 13.003V3.997a1 1 0 01.694-.952zM16.196 8l-9.5-3.393v6.786L16.196 8z"/>
                                        </svg>
                                    </div>
                                @else
                                    <!-- Chat Bubble icoon voor ontvangen bericht -->
                                    <div class="absolute -top-2 -left-2 bg-gray-200 text-gray-600 rounded-full p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H6l-3 3V5z"/>
                                        </svg>
                                    </div>
                                @endif

                                <div class="text-sm font-semibold mb-1">
                                    {{ $isEigenBericht ? 'Jij' : $ontvanger->voornaam }}
                                </div>
                                <div class="text-sm">
                                    {{ $bericht->inhoud }}
                                </div>
                                <div class="text-xs text-gray-400 mt-1">{{ $bericht->created_at->diffForHumans() }}</div>
                            </div>
                            <!-- Dunne lijn onder elk bericht behalve de laatste -->
                            <div class="absolute left-0 right-0 h-px bg-gray-200" style="bottom: -2px;"></div>
                        </div>
                    @empty
                        <p class="italic text-gray-500">Nog geen berichten. Stuur het eerste bericht!</p>
                    @endforelse
                </div>

                <form action="{{ route('chat.store', $ontvanger->email) }}" method="POST" class="mt-2">
                    @csrf
                    <div class="flex space-x-2">
                        <input type="text" name="inhoud" placeholder="Type je bericht..." 
                               class="flex-1 border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 transition">
                            Verstuur
                        </button>
                    </div>
                </form>
            @else
                <div class="flex-1 flex flex-col items-center justify-center">
                    <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M8 14h.01M12 10h.01M12 14h.01m-6 2h3m4.268 0H18M4 8h16M4 4h16M4 20h16"/>
                    </svg>
                    <p class="text-gray-500 italic text-center max-w-sm">Selecteer een gesprek aan de linkerzijde of zoek een speler op om een nieuw gesprek te starten.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@if(session('new_message'))
<div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md text-center">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Nieuwe Chatbericht!</h2>
        <p class="text-gray-600 mb-6">Je hebt een nieuw bericht ontvangen.</p>
        <form method="GET" action="{{ route('chat.show', session('new_message_email')) }}">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Ga naar chat
            </button>
        </form>
    </div>
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatContainer = document.getElementById('chatContainer');
        if(chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    });
</script>
@endsection
