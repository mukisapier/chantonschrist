@extends('layouts.app')

@section('title', $type == 1 ? 'Nyimbo Za Wokovu' : ($type == 2 ? 'Chants de Triomphe' : 'Chantons - Jésus Christ'))

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-[#1e3a8a] text-white py-6 px-4">
        <div class="max-w-2xl mx-auto">
            @if($type)
                <a href="{{ route('songs.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 transition mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
            @endif
            <h1 class="text-3xl font-extrabold tracking-wide mb-1">
                <span class="text-[#ff6b35]">CHANTONS</span>
            </h1>
            <p class="text-sm font-medium tracking-wide mb-3">JÉSUS CHRIST</p>
            @if($type)
                <p class="text-xl font-bold tracking-wide uppercase">
                    {{ $type == 1 ? 'Nyimbo Za Wokovu' : 'Chants de Triomphe' }}
                </p>
            @endif
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-2xl mx-auto px-4 py-6">
        <!-- Category Selection (if no type selected) -->
        @if(!$type && !$search)
        <div class="space-y-4 mb-6">
            <a href="{{ route('songs.index', ['type' => 1]) }}" 
               class="block bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition border-l-4 border-[#1e3a8a]">
                <h2 class="text-xl font-bold text-[#1e3a8a] mb-2 uppercase tracking-wide">Nyimbo Za Wokovu</h2>
                <p class="text-gray-600">Swahili songs of salvation and deliverance</p>
            </a>
            
            <a href="{{ route('songs.index', ['type' => 2]) }}" 
               class="block bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition border-l-4 border-[#ff6b35]">
                <h2 class="text-xl font-bold text-[#ff6b35] mb-2 uppercase tracking-wide">Chants de Triomphe</h2>
                <p class="text-gray-600">French worship songs celebrating victory and praise</p>
            </a>
        </div>
        @endif

        <!-- Search Bar -->
        <form method="GET" action="{{ route('songs.index') }}" class="mb-6">
            @if($type)
                <input type="hidden" name="type" value="{{ $type }}">
            @endif
            <div class="relative">
                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search ?? '' }}"
                    placeholder="Recherche"
                    class="w-full pl-12 pr-4 py-3.5 rounded-full border border-gray-300 focus:border-gray-400 focus:outline-none focus:ring-0 text-gray-700 placeholder-gray-400"
                >
            </div>
        </form>

        <!-- Songs List -->
        @if($songs->count() > 0)
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
            <div class="divide-y divide-gray-100">
                @foreach($songs as $song)
                <a href="{{ route('songs.show', $song) }}" class="flex items-center gap-4 p-4 hover:bg-gray-50 transition group">
                    <div class="flex-shrink-0 w-11 h-11 rounded-full {{ $song->type == 1 ? 'bg-[#1e3a8a]' : 'bg-[#ff6b35]' }} flex items-center justify-center text-white font-bold">
                        {{ $song->number }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-900 uppercase tracking-wide text-sm leading-tight group-hover:text-[#1e3a8a] transition">
                            {{ $song->title }}
                        </h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        @if($songs->hasPages())
        <div class="mt-6">
            {{ $songs->links() }}
        </div>
        @endif
        @else
        <div class="bg-white rounded-3xl shadow-sm p-8 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-gray-600">
                @if($search)
                    Aucun cantique trouvé pour "{{ $search }}"
                @else
                    Aucun cantique disponible
                @endif
            </p>
        </div>
        @endif
    </div>
</div>
@endsection

