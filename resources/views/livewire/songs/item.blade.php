<div class="rounded shadow-sm overflow-hidden relative">
    <div class="divide-y divide-gray-100">

        <a href="{{ route('songs.show', ['type' => $this->song['type'], 'song' => $this->song['id']]) }}"
            class="flex items-center gap-4 px-4 py-3 hover:bg-gray-50 transition group {{ $this->bgColor }} {{ $this->bgHoverColor }} {{ $this->textColor }}">
            <div
                class="flex-shrink-0 w-8 h-8 rounded-full {{ $this->bgNumberColor }} {{ $this->numberColor }} flex items-center justify-center text-sm">
                {{ $this->song['number'] }}
            </div>
            <div class="flex-1 min-w-0">
                <h3
                    class="uppercase tracking-wide text-sm leading-tight {{ $this->textHoverColor }} transition {{ $this->textColor }}">
                    {{ $this->song['title'] }}
                </h3>
            </div>
            @if ($this->song['is_favorite'])
                <i class="ph-fill ph-heart text-red-500"></i>
            @endif
        </a>

    </div>
</div>
