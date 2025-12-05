<div>

    <div class="min-h-screen {{ $this->bgColor }} pb-20 transition-colors relative">

        <!-- Song Content -->
        <div class="max-w-2xl mx-auto px-4 pt-[100px]">
            <!-- Lyrics -->
            <div class="{{ $this->bgColor }} rounded-3xl shadow-sm p-6 transition-colors">

                <!-- Song Title -->
                <div>
                    <h3 class="text-xl font-bold uppercase {{ $this->textColor }} mb-2 transition-colors">
                        {{ $song->number }}.
                        {{ $song->title }}
                    </h3>
                    @if ($song->author)
                        <p class="text-sm {{ $this->textColor }} transition-colors">{{ $song->author }}</p>
                    @endif
                </div>


                <div class="prose prose-lg max-w-none">
                    <div class="whitespace-pre-wrap {{ $this->textColor }} leading-relaxed text-base transition-colors"
                        id="lyrics-content">
                        {{ $song->content }}
                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom Action Bar -->
        <livewire:songs.bottom-action-bar :songId="$song->id" />
    </div>

</div>
