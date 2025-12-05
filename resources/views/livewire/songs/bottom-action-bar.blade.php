<div class="fixed bottom-0 left-0 right-0 {{ $this->bgColor }} border-t {{ $this->borderColor }} px-4 py-3 shadow-lg transition-colors"
    id="action-bar">
    <div class="max-w-2xl mx-auto flex items-center justify-between">
        <!-- Previous Song -->
        @if ($previousSong)
            <a href="{{ route('songs.show', ['type' => $song->type, 'song' => $previousSong]) }}" wire:navigate
                class="h-10 w-10 flex items-center justify-center {{ $this->textColor }} {{ $this->hoverBgColor }} rounded-full transition"
                title="Précédent">
                <i class="ph ph-caret-left"></i>
            </a>
        @else
            <button class="h-10 w-10 flex items-center justify-center {{ $this->textColor }} opacity-30 cursor-not-allowed" disabled
                title="Pas de cantique précédent">
                <i class="ph ph-caret-left"></i>
            </button>
        @endif

        <!-- Favorite -->
        @if ($song->is_favorite)
            <button wire:click="toggleFavorite"
                class="h-10 w-10 flex items-center justify-center {{ $this->hoverBgColor }} rounded-full transition"
                title="Favori">
                <i class="ph-fill ph-heart text-red-500"></i>
            </button>
        @else
            <button wire:click="toggleFavorite"
                class="h-10 w-10 flex items-center justify-center {{ $this->hoverBgColor }} rounded-full transition"
                title="Favori">
                <i class="ph ph-heart {{ $this->textColor }}"></i>
            </button>
        @endif

        <!-- Zoom Out -->
        @if ($fontSizePercentage > 10)
            <button wire:click="zoomOut"
                class="h-10 w-10 flex items-center justify-center {{ $this->hoverBgColor }} rounded-full transition"
                title="Réduire la taille">
                <i class="ph ph-magnifying-glass-minus {{ $this->textColor }}"></i>
            </button>
        @else
            <button class="h-10 w-10 flex items-center justify-center {{ $this->textColor }} opacity-30 cursor-not-allowed" disabled
                title="Taille minimale atteinte">
                <i class="ph ph-magnifying-glass-minus"></i>
            </button>
        @endif

        <!-- Font Size Display -->
        <div class="h-10 w-10 flex items-center justify-center text-sm font-bold {{ $this->textSecondaryColor }}"
            title="Taille actuelle">
            {{ $fontSizePercentage }}%
        </div>

        <!-- Zoom In -->
        @if ($fontSizePercentage < 100)
            <button wire:click="zoomIn"
                class="h-10 w-10 flex items-center justify-center {{ $this->hoverBgColor }} rounded-full transition"
                title="Agrandir">
                <i class="ph ph-magnifying-glass-plus {{ $this->textColor }}"></i>
            </button>
        @else
            <button class="h-10 w-10 flex items-center justify-center {{ $this->textColor }} opacity-30 cursor-not-allowed" disabled
                title="Taille maximale atteinte">
                <i class="ph ph-magnifying-glass-plus"></i>
            </button>
        @endif


        <!-- Scroll to Top -->
        <button wire:click="scrollToTop"
            class="h-10 w-10 flex items-center justify-center {{ $this->hoverBgColor }} rounded-full transition"
            title="Retour en haut">
            <i class="ph ph-arrow-up {{ $this->textColor }}"></i>
        </button>



        <!-- Next Song -->
        @if ($nextSong)
            <a href="{{ route('songs.show', ['type' => $song->type, 'song' => $nextSong]) }}" wire:navigate
                class="h-10 w-10 flex items-center justify-center {{ $this->hoverBgColor }} rounded-full transition"
                title="Suivant">
                <i class="ph ph-caret-right {{ $this->textColor }}"></i>
            </a>
        @else
            <button class="h-10 w-10 flex items-center justify-center {{ $this->textColor }} opacity-30 cursor-not-allowed" disabled
                title="Pas de cantique suivant">
                <i class="ph ph-caret-right"></i>
            </button>
        @endif
    </div>
</div>
