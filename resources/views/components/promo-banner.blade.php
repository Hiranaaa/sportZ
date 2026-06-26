@props(['promo'])

<div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-royal-600 via-cyan-600 to-cyan-500 p-6 text-white group hover:shadow-xl hover:shadow-cyan-500/20 transition-all duration-300">
    {{-- Decorative Elements --}}
    <div class="absolute -top-6 -right-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
    <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
    <div class="absolute top-3 right-3 opacity-10">
        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M9.375 3a1.875 1.875 0 000 3.75h1.875v4.5H3.375A1.875 1.875 0 011.5 9.375v-.75c0-1.036.84-1.875 1.875-1.875h3.193A3.375 3.375 0 0112 2.753a3.375 3.375 0 015.432 3.997h3.193c1.035 0 1.875.84 1.875 1.875v.75c0 1.036-.84 1.875-1.875 1.875H12.75v-4.5h1.875a1.875 1.875 0 10-1.875-1.875V6.75h-1.5V4.875C11.25 3.839 10.41 3 9.375 3zM11.25 12.75H3v6.75a2.25 2.25 0 002.25 2.25h6v-9zM12.75 12.75v9h6a2.25 2.25 0 002.25-2.25v-6.75h-8.25z" /></svg>
    </div>

    <div class="relative z-10">
        {{-- Title --}}
        <h3 class="font-heading font-bold text-lg mb-1">{{ $promo->title ?? 'Promo Spesial' }}</h3>

        {{-- Discount --}}
        <div class="flex items-baseline gap-2 mb-3">
            <span class="text-3xl font-heading font-bold">
                @if(($promo->type ?? 'percentage') === 'percentage')
                    {{ $promo->discount_value ?? 0 }}%
                @else
                    Rp {{ number_format($promo->discount_value ?? 0, 0, ',', '.') }}
                @endif
            </span>
            <span class="text-white/80 text-sm font-medium">OFF</span>
        </div>

        {{-- Code --}}
        <div class="flex items-center gap-2 mb-3">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/20 backdrop-blur-sm border border-white/30">
                <span class="text-sm font-mono font-bold tracking-wider">{{ $promo->code ?? 'SPORTZ2024' }}</span>
                <button onclick="navigator.clipboard.writeText('{{ $promo->code ?? 'SPORTZ2024' }}'); this.innerHTML='<svg class=\'w-4 h-4 text-emerald-300\' fill=\'none\' viewBox=\'0 0 24 24\' stroke-width=\'2\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M4.5 12.75l6 6 9-13.5\' /></svg>'; setTimeout(() => this.innerHTML='<svg class=\'w-4 h-4\' fill=\'none\' viewBox=\'0 0 24 24\' stroke-width=\'2\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9.75a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184\' /></svg>', 2000);" class="text-white/80 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9.75a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" /></svg>
                </button>
            </div>
        </div>

        {{-- Expiry --}}
        <p class="text-xs text-white/70">
            Berlaku hingga {{ $promo->expires_at ? \Carbon\Carbon::parse($promo->expires_at)->format('d M Y') : '31 Des 2026' }}
        </p>
    </div>
</div>
