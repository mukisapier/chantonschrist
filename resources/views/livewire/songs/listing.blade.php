<div>
    <div class="min-h-screen {{ $this->bgColor }} pb-20 transition-colors relative">
        <!-- Main Content -->
        <div class="max-w-2xl mx-auto px-4 pt-[100px]">


            <!-- Search Input -->
            <div class="mb-6">
                <div class="relative bg-white rounded-xl shadow-sm">
                    <i
                        class="ph ph-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                    <input type="text" wire:model.live.debounce.500ms="search"
                        placeholder="Recherche par titre ou numéro..."
                        class="w-full pl-12 pr-12 py-3.5 rounded-xl border border-gray-300 focus:border-[#1e3a8a] focus:outline-none focus:ring-2 focus:ring-blue-100 text-gray-700 placeholder-gray-400 transition">

                    <!-- Loading Spinner -->
                    @if ($loading)
                        <div wire:loading wire:target="search"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2">
                            <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>



            <!-- Songs List -->
            <div wire:loading.class="opacity-50" wire:target="search,type">
                @if (count($songs) > 0)

                    @foreach ($songs as $song)
                        <livewire:songs.item :song="$song" key="{{ $song['id'] }}" />
                    @endforeach
                @else
                    <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-gray-600">
                            @if ($search)
                                Aucun cantique trouvé pour "{{ $search }}"
                            @else
                                Aucun cantique disponible
                            @endif
                        </p>
                    </div>
                @endif
            </div>


        </div>
    </div>
</div>
