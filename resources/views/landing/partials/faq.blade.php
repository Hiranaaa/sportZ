{{-- FAQ Section --}}
<section id="faq" class="py-20 lg:py-28 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 rounded-full text-sm font-semibold mb-4">FAQ</span>
            <h2 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">Pertanyaan yang <span class="bg-gradient-to-r from-amber-500 to-orange-500 bg-clip-text text-transparent">Sering Diajukan</span></h2>
        </div>
        <div x-data="{ open: null }" class="space-y-4">
            @forelse($faqs ?? [] as $i => $faq)
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 overflow-hidden transition-all duration-300" :class="open === {{ $i }} ? 'shadow-lg shadow-cyan-500/5 border-cyan-500/30' : ''">
                <button @click="open = open === {{ $i }} ? null : {{ $i }}" class="w-full flex items-center justify-between p-6 text-left">
                    <span class="font-heading font-semibold text-gray-900 dark:text-white pr-4">{{ $faq->question }}</span>
                    <svg class="w-5 h-5 text-gray-500 flex-shrink-0 transition-transform duration-300" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === {{ $i }}" x-collapse x-cloak class="px-6 pb-6">
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed">{{ $faq->answer }}</p>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-500">Belum ada FAQ.</p>
            @endforelse
        </div>
    </div>
</section>
