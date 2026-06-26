{{-- Admin Sidebar --}}
<aside class="fixed inset-y-0 left-0 z-50 flex flex-col bg-white dark:bg-navy-950 border-r border-gray-100 dark:border-white/5 transition-all duration-300"
       :class="[
           sidebarOpen ? 'w-72' : 'w-20',
           mobileSidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
       ]">

    {{-- Logo --}}
    <div class="flex items-center h-16 px-4 border-b border-gray-100 dark:border-white/5 flex-shrink-0">
        <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-2.5 overflow-hidden">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-royal-600 flex items-center justify-center shadow-lg shadow-cyan-500/20 flex-shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                </svg>
            </div>
            <span x-show="sidebarOpen" x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" class="text-xl font-heading font-bold text-gray-900 dark:text-white whitespace-nowrap">
                Sport<span class="text-cyan-500">Z</span>
            </span>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 no-scrollbar">
        {{-- Main Menu --}}
        <div class="mb-4" x-show="sidebarOpen">
            <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-600">Menu Utama</p>
        </div>

        {{-- Dashboard --}}
        <a href="{{ url('/admin/dashboard') }}"
           class="{{ request()->is('admin/dashboard*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Dashboard">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Dashboard</span>
        </a>

        {{-- Courts --}}
        <a href="{{ url('/admin/courts') }}"
           class="{{ request()->is('admin/courts*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Lapangan">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Lapangan</span>
        </a>

        {{-- Bookings --}}
        <a href="{{ url('/admin/bookings') }}"
           class="{{ request()->is('admin/bookings*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Booking">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Booking</span>
        </a>

        {{-- Payments --}}
        <a href="{{ url('/admin/payments') }}"
           class="{{ request()->is('admin/payments*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Pembayaran">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Pembayaran</span>
        </a>

        {{-- Separator --}}
        <div class="my-4 border-t border-gray-100 dark:border-white/5"></div>

        <div class="mb-4" x-show="sidebarOpen">
            <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-600">Marketing</p>
        </div>

        {{-- Promotions --}}
        <a href="{{ url('/admin/promotions') }}"
           class="{{ request()->is('admin/promotions*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Promosi">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Promosi</span>
        </a>

        {{-- Vouchers --}}
        <a href="{{ url('/admin/vouchers') }}"
           class="{{ request()->is('admin/vouchers*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Voucher">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Voucher</span>
        </a>

        {{-- Banners --}}
        <a href="{{ url('/admin/banners') }}"
           class="{{ request()->is('admin/banners*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Banner">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Banner</span>
        </a>

        {{-- Separator --}}
        <div class="my-4 border-t border-gray-100 dark:border-white/5"></div>

        <div class="mb-4" x-show="sidebarOpen">
            <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-600">Konten</p>
        </div>

        {{-- Reviews --}}
        <a href="{{ url('/admin/reviews') }}"
           class="{{ request()->is('admin/reviews*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Ulasan">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Ulasan</span>
        </a>

        {{-- Testimonials --}}
        <a href="{{ url('/admin/testimonials') }}"
           class="{{ request()->is('admin/testimonials*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Testimoni">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Testimoni</span>
        </a>

        {{-- FAQs --}}
        <a href="{{ url('/admin/faqs') }}"
           class="{{ request()->is('admin/faqs*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="FAQ">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">FAQ</span>
        </a>

        {{-- Separator --}}
        <div class="my-4 border-t border-gray-100 dark:border-white/5"></div>

        <div class="mb-4" x-show="sidebarOpen">
            <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-600">Sistem</p>
        </div>

        {{-- Users --}}
        <a href="{{ url('/admin/users') }}"
           class="{{ request()->is('admin/users*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Pengguna">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Pengguna</span>
        </a>

        {{-- Reports --}}
        <a href="{{ url('/admin/reports') }}"
           class="{{ request()->is('admin/reports*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Laporan">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Laporan</span>
        </a>

        {{-- Activity Logs --}}
        <a href="{{ url('/admin/activity-logs') }}"
           class="{{ request()->is('admin/activity-logs*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Log Aktivitas">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Log Aktivitas</span>
        </a>

        {{-- Settings --}}
        <a href="{{ url('/admin/settings') }}"
           class="{{ request()->is('admin/settings*') ? 'sidebar-link-active' : 'sidebar-link' }}"
           title="Pengaturan">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Pengaturan</span>
        </a>
    </nav>

    {{-- Bottom Section --}}
    <div class="p-3 border-t border-gray-100 dark:border-white/5 flex-shrink-0">
        <a href="{{ url('/') }}" class="sidebar-link" title="Kembali ke Website">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Ke Website</span>
        </a>
    </div>
</aside>
