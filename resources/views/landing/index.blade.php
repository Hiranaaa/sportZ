@extends('layouts.app')

@section('title', 'SportZ - Book Your Game, Anytime')
@section('description', 'Platform booking lapangan olahraga premium terbaik di Indonesia. Pesan lapangan futsal, badminton, basket, tenis & voli dengan mudah dan cepat.')

@section('body')
<div class="min-h-screen">
    {{-- Navbar --}}
    @include('layouts.partials.navbar')

    {{-- Hero Section --}}
    @include('landing.partials.hero')

    {{-- About Section --}}
    @include('landing.partials.about')

    {{-- Facilities Section --}}
    @include('landing.partials.facilities')

    {{-- Popular Courts --}}
    @include('landing.partials.popular-courts')

    {{-- Why Choose Us --}}
    @include('landing.partials.why-choose-us')

    {{-- Testimonials --}}
    @include('landing.partials.testimonials')

    {{-- FAQ --}}
    @include('landing.partials.faq')

    {{-- Contact --}}
    @include('landing.partials.contact')

    {{-- Google Maps --}}
    @include('landing.partials.google-maps')

    {{-- Footer --}}
    @include('layouts.partials.footer')
</div>
@endsection

@push('scripts')
<script>
    // Intersection Observer for scroll animations
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endpush
