@props(['review'])

<div class="card-modern rounded-2xl p-5">
    <div class="flex items-start gap-4">
        {{-- Avatar --}}
        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-400 to-royal-600 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
            {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
        </div>

        <div class="flex-1 min-w-0">
            {{-- Name & Date --}}
            <div class="flex items-start justify-between gap-2">
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $review->user->name ?? 'Pengguna' }}</h4>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ $review->created_at ? $review->created_at->diffForHumans() : '2 hari yang lalu' }}</p>
                </div>

                {{-- Star Rating --}}
                <div class="flex items-center gap-0.5 flex-shrink-0">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= ($review->rating ?? 5))
                            <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" /></svg>
                        @else
                            <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" /></svg>
                        @endif
                    @endfor
                </div>
            </div>

            {{-- Comment --}}
            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ $review->comment ?? 'Lapangan sangat bersih dan terawat. Fasilitasnya lengkap dan pelayanannya ramah. Sangat recommended!' }}
            </p>

            {{-- Court Info --}}
            @if(isset($review->court))
                <div class="mt-3 flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg>
                    {{ $review->court->name ?? 'Lapangan' }}
                </div>
            @endif

            {{-- Admin Reply --}}
            @if(isset($review->admin_reply) && $review->admin_reply)
                <div class="mt-4 pl-4 border-l-2 border-cyan-200 dark:border-cyan-500/30">
                    <div class="flex items-center gap-2 mb-1.5">
                        <div class="w-5 h-5 rounded-full bg-gradient-to-br from-cyan-400 to-royal-600 flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-900 dark:text-white">Admin SportZ</span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $review->admin_reply }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
