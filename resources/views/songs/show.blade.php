@extends('layouts.app')

@section('title', $song->title . ' - Chantons')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 pb-20 transition-colors">
    <!-- Header -->
    <div class="bg-[#1e3a8a] dark:bg-gray-800 text-white py-6 px-4 transition-colors">
        <div class="max-w-2xl mx-auto">
            <a href="{{ route('songs.index', ['type' => $song->type]) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 transition mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-3xl font-extrabold tracking-wide mb-1">
                <span class="text-[#ff6b35]">CHANTONS</span>
            </h1>
            <p class="text-sm font-medium tracking-wide mb-3">JÉSUS CHRIST</p>
            <p class="text-xl font-bold tracking-wide uppercase">
                {{ $song->category_name }}
            </p>
        </div>
    </div>

    <!-- Song Content -->
    <div class="max-w-2xl mx-auto px-4 py-6">
        <!-- Song Title -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2 transition-colors">{{ $song->number }}. {{ strtoupper($song->title) }}</h2>
            @if($song->author)
            <p class="text-sm text-gray-500 dark:text-gray-400 transition-colors">{{ $song->author }}</p>
            @endif
        </div>

        <!-- Lyrics -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm p-6 transition-colors">
            <div class="prose prose-lg max-w-none">
                <div class="whitespace-pre-wrap text-gray-800 dark:text-gray-200 leading-relaxed text-base transition-colors" id="lyrics-content">{{ $song->content }}</div>
            </div>
        </div>
    </div>

    <!-- Bottom Action Bar -->
    <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 px-4 py-3 shadow-lg transition-colors" id="action-bar">
        <div class="max-w-2xl mx-auto flex items-center justify-between">
            <!-- Previous Song -->
            @if($previousSong)
            <a href="{{ route('songs.show', $previousSong) }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition" title="Précédent">
                <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            @else
            <button class="p-2 opacity-30 cursor-not-allowed" disabled title="Pas de cantique précédent">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            @endif

            <!-- Favorite -->
            <button onclick="toggleFavorite()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition" title="Favori" id="favorite-btn">
                <svg class="w-6 h-6 transition-colors" fill="currentColor" viewBox="0 0 24 24" id="heart-icon">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>

            <!-- Search -->
            <a href="{{ route('songs.index', ['type' => $song->type]) }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition" title="Recherche">
                <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </a>

            <!-- Font Size -->
            <button onclick="resetFontSize()" class="px-3 py-1 text-sm font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition" title="Réinitialiser la taille" id="font-size-btn">
                100%
            </button>

            <!-- Zoom In -->
            <button onclick="zoomIn()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition" title="Agrandir">
                <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                </svg>
            </button>

            <!-- Night Mode -->
            <button onclick="toggleNightMode()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition" title="Mode nuit" id="night-mode-btn">
                <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="brightness-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </button>

            <!-- Next Song -->
            @if($nextSong)
            <a href="{{ route('songs.show', $nextSong) }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition" title="Suivant">
                <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            @else
            <button class="p-2 opacity-30 cursor-not-allowed" disabled title="Pas de cantique suivant">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            @endif
        </div>
    </div>
</div>

<script>
let fontSize = 100;
let isNightMode = false;
let isFavorite = false;

// Check localStorage for saved preferences
const savedFontSize = localStorage.getItem('fontSize_{{ $song->id }}');
if (savedFontSize) {
    fontSize = parseInt(savedFontSize);
    applyFontSize();
}

const savedNightMode = localStorage.getItem('nightMode');
if (savedNightMode === 'true') {
    isNightMode = true;
    applyNightMode();
}

const savedFavorite = localStorage.getItem('favorite_{{ $song->id }}');
if (savedFavorite === 'true') {
    isFavorite = true;
    updateFavoriteIcon();
}

function zoomIn() {
    fontSize = Math.min(fontSize + 10, 200);
    applyFontSize();
    localStorage.setItem('fontSize_{{ $song->id }}', fontSize);
}

function zoomOut() {
    fontSize = Math.max(fontSize - 10, 60);
    applyFontSize();
    localStorage.setItem('fontSize_{{ $song->id }}', fontSize);
}

function resetFontSize() {
    // Cycle through sizes: 100% -> 120% -> 140% -> 80% -> 100%
    if (fontSize === 100) {
        fontSize = 120;
    } else if (fontSize === 120) {
        fontSize = 140;
    } else if (fontSize === 140) {
        fontSize = 80;
    } else {
        fontSize = 100;
    }
    applyFontSize();
    localStorage.setItem('fontSize_{{ $song->id }}', fontSize);
}

function applyFontSize() {
    const content = document.getElementById('lyrics-content');
    if (content) {
        content.style.fontSize = fontSize + '%';
    }
    const btn = document.getElementById('font-size-btn');
    if (btn) {
        btn.textContent = fontSize + '%';
    }
}

function toggleNightMode() {
    isNightMode = !isNightMode;
    applyNightMode();
    localStorage.setItem('nightMode', isNightMode);
}

function applyNightMode() {
    const html = document.documentElement;
    if (isNightMode) {
        html.classList.add('dark');
    } else {
        html.classList.remove('dark');
    }
    updateNightModeIcon();
}

function updateNightModeIcon() {
    const icon = document.getElementById('brightness-icon');
    if (icon) {
        if (isNightMode) {
            // Moon icon for dark mode
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';
        } else {
            // Sun icon for light mode
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>';
        }
    }
}

function toggleFavorite() {
    isFavorite = !isFavorite;
    if (isFavorite) {
        localStorage.setItem('favorite_{{ $song->id }}', 'true');
    } else {
        localStorage.removeItem('favorite_{{ $song->id }}');
    }
    updateFavoriteIcon();
    
    // Show toast notification
    showToast(isFavorite ? 'Ajouté aux favoris ❤️' : 'Retiré des favoris');
}

function updateFavoriteIcon() {
    const icon = document.getElementById('heart-icon');
    if (icon) {
        if (isFavorite) {
            icon.classList.add('text-red-500');
            icon.classList.remove('text-gray-400', 'dark:text-gray-600');
        } else {
            icon.classList.remove('text-red-500');
            icon.classList.add('text-gray-400', 'dark:text-gray-600');
        }
    }
}

function showToast(message) {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'fixed top-20 left-1/2 transform -translate-x-1/2 bg-gray-900 dark:bg-gray-700 text-white px-6 py-3 rounded-full shadow-lg z-50 transition-opacity duration-300';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    // Fade out and remove
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 2000);
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.key === 'ArrowLeft' && e.ctrlKey) {
        @if($previousSong)
        window.location.href = '{{ route('songs.show', $previousSong) }}';
        @endif
    } else if (e.key === 'ArrowRight' && e.ctrlKey) {
        @if($nextSong)
        window.location.href = '{{ route('songs.show', $nextSong) }}';
        @endif
    } else if (e.key === '+' && e.ctrlKey) {
        e.preventDefault();
        zoomIn();
    } else if (e.key === '-' && e.ctrlKey) {
        e.preventDefault();
        zoomOut();
    } else if (e.key === 'f' && e.ctrlKey) {
        e.preventDefault();
        toggleFavorite();
    } else if (e.key === 'n' && e.ctrlKey) {
        e.preventDefault();
        toggleNightMode();
    }
});

// Initialize on load
updateFavoriteIcon();
updateNightModeIcon();
</script>

<style>
@media print {
    .fixed {
        display: none !important;
    }
    body {
        background: white !important;
    }
}
</style>
@endsection

