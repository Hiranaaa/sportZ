{{-- Testimonials Section --}}
<section id="testimonials" class="py-20 lg:py-28 bg-white dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 rounded-full text-sm font-semibold mb-4">Testimoni</span>
            <h2 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">Apa Kata <span class="bg-gradient-to-r from-purple-500 to-pink-500 bg-clip-text text-transparent">Mereka</span>?</h2>
            <p class="text-gray-500 dark:text-gray-400 text-lg max-w-2xl mx-auto">Ribuan pelanggan puas bermain di SportZ</p>
        </div>
        <div x-data="{ current: 0, total: {{ count($testimonials ?? []) }}, autoplay: null, init() { this.autoplay = setInterval(() => { this.current = (this.current + 1) % this.total; }, 5000); } }" x-init="init()" class="relative">
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (current * 100) + '%)'">
                    @forelse($testimonials ?? [] as $testimonial)
                    <div class="w-full flex-shrink-0 px-4">
                        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800/50 rounded-2xl p-8 md:p-12 border border-gray-100 dark:border-gray-700/50 shadow-lg text-center">
                            <div class="flex justify-center mb-6">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 text-lg md:text-xl italic leading-relaxed mb-8">"{{ $testimonial->content }}"</p>
                            <div class="flex items-center justify-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white font-bold text-lg">{{ substr($testimonial->name, 0, 1) }}</div>
                                <div class="text-left">
                                    <p class="font-heading font-bold text-gray-900 dark:text-white">{{ $testimonial->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $testimonial->role }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="w-full text-center py-12 text-gray-500">Belum ada testimoni.</div>
                    @endforelse
                </div>
            </div>
            {{-- Navigation Dots --}}
            <div class="flex justify-center gap-2 mt-8">
                @foreach($testimonials ?? [] as $i => $t)
                <button @click="current = {{ $i }}; clearInterval(autoplay)" class="w-3 h-3 rounded-full transition-all duration-300" :class="current === {{ $i }} ? 'bg-cyan-500 w-8' : 'bg-gray-300 dark:bg-gray-600 hover:bg-gray-400'"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>
