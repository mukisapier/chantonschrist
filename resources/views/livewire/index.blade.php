<div>
    <div class="min-h-screen bg-gray-50">

        <!-- Main Content -->
        <div class="max-w-2xl mx-auto px-4 mt-26">

            <!-- Category Selection (if no type selected) -->
            <div class="mb-4">
                <livewire:basics.button-link :route="route('songs.listing', ['type' => 1])" :label="'Nyimbo Za Wokovu'" icon="caret-right" />
            </div>

            <div class="mb-4">
                <livewire:basics.button-link :route="route('songs.listing', ['type' => 2])" :label="'Chants de Triomphe'" :variant="'secondary'" icon="caret-right" />
            </div>

            <!-- Section Title -->
            <div class="mb-6">
                <div class="flex items-center gap-4 mb-3">
                    <div class="flex items-center gap-3">
                        <h2 class="text-xl font-bold text-gray-900 tracking-tight">
                            Chants favoris
                        </h2>
                    </div>
                    <div class="flex-1 h-px bg-[#1e3a8a]"></div>
                </div>
            </div>

            
            <div>
                @if (count($songs) > 0)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden relative">
                        <div class="divide-y divide-gray-100">
                            @foreach ($songs as $song)
                                <livewire:songs.item :song="$song" />
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-gray-600">
                            Aucun cantique favori disponible
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
