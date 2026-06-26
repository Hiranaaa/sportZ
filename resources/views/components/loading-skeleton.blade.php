@props(['type' => 'card', 'count' => 3])

@if($type === 'card')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min($count, 4) }} gap-6">
        @for($i = 0; $i < $count; $i++)
            <div class="bg-white dark:bg-navy-900/50 rounded-2xl border border-gray-100 dark:border-white/5 overflow-hidden animate-pulse">
                <div class="aspect-video skeleton"></div>
                <div class="p-5 space-y-3">
                    <div class="skeleton h-5 w-3/4 rounded"></div>
                    <div class="skeleton h-4 w-1/2 rounded"></div>
                    <div class="flex justify-between pt-3 border-t border-gray-100 dark:border-white/5">
                        <div class="skeleton h-6 w-24 rounded"></div>
                        <div class="skeleton h-4 w-20 rounded"></div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@elseif($type === 'table')
    <div class="card-modern rounded-2xl overflow-hidden animate-pulse">
        <div class="p-4 border-b border-gray-100 dark:border-white/5">
            <div class="skeleton h-5 w-48 rounded"></div>
        </div>
        @for($i = 0; $i < $count; $i++)
            <div class="flex items-center gap-4 px-4 py-4 border-b border-gray-50 dark:border-white/[0.03]">
                <div class="skeleton h-4 w-4 rounded"></div>
                <div class="skeleton h-10 w-10 rounded-xl"></div>
                <div class="flex-1 space-y-2">
                    <div class="skeleton h-4 w-1/3 rounded"></div>
                    <div class="skeleton h-3 w-1/4 rounded"></div>
                </div>
                <div class="skeleton h-6 w-20 rounded-full"></div>
                <div class="skeleton h-8 w-16 rounded-lg"></div>
            </div>
        @endfor
    </div>
@elseif($type === 'stat')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ min($count, 4) }} gap-6 animate-pulse">
        @for($i = 0; $i < $count; $i++)
            <div class="bg-white dark:bg-white/5 rounded-2xl border border-gray-100 dark:border-white/10 p-6">
                <div class="flex items-start justify-between">
                    <div class="skeleton w-12 h-12 rounded-xl"></div>
                    <div class="skeleton h-6 w-16 rounded-lg"></div>
                </div>
                <div class="mt-4 space-y-2">
                    <div class="skeleton h-8 w-24 rounded"></div>
                    <div class="skeleton h-4 w-32 rounded"></div>
                </div>
            </div>
        @endfor
    </div>
@elseif($type === 'text')
    <div class="animate-pulse space-y-4">
        @for($i = 0; $i < $count; $i++)
            <div class="space-y-2">
                <div class="skeleton h-4 w-full rounded"></div>
                <div class="skeleton h-4 w-5/6 rounded"></div>
                <div class="skeleton h-4 w-4/6 rounded"></div>
            </div>
        @endfor
    </div>
@elseif($type === 'list')
    <div class="animate-pulse space-y-3">
        @for($i = 0; $i < $count; $i++)
            <div class="flex items-center gap-4 p-4 rounded-xl bg-white dark:bg-white/5 border border-gray-100 dark:border-white/5">
                <div class="skeleton w-12 h-12 rounded-xl flex-shrink-0"></div>
                <div class="flex-1 space-y-2">
                    <div class="skeleton h-4 w-2/3 rounded"></div>
                    <div class="skeleton h-3 w-1/2 rounded"></div>
                </div>
            </div>
        @endfor
    </div>
@endif
