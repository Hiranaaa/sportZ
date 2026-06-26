import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import Swal from 'sweetalert2';

/* ══════════════════════════════════════════════════
   GLOBAL SETUP
   ══════════════════════════════════════════════════ */
window.Alpine = Alpine;
window.Chart = Chart;
window.Swal = Swal;

/* ══════════════════════════════════════════════════
   ALPINE.JS DATA STORES & COMPONENTS
   ══════════════════════════════════════════════════ */

// Theme Toggle Store
Alpine.store('theme', {
    dark: localStorage.getItem('theme') === 'dark' ||
          (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),

    init() {
        this.apply();
    },

    toggle() {
        this.dark = !this.dark;
        this.apply();
    },

    apply() {
        if (this.dark) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    }
});

// Sidebar Store
Alpine.store('sidebar', {
    open: window.innerWidth >= 1024,
    mobileOpen: false,

    toggle() {
        if (window.innerWidth < 1024) {
            this.mobileOpen = !this.mobileOpen;
        } else {
            this.open = !this.open;
        }
    },

    close() {
        this.mobileOpen = false;
    }
});

// Notification Store
Alpine.store('notifications', {
    items: [],
    unreadCount: 0,

    markAsRead(id) {
        const item = this.items.find(n => n.id === id);
        if (item && !item.read) {
            item.read = true;
            this.unreadCount = Math.max(0, this.unreadCount - 1);
        }
    },

    markAllAsRead() {
        this.items.forEach(n => n.read = true);
        this.unreadCount = 0;
    }
});

/* ══════════════════════════════════════════════════
   ALPINE.JS DATA COMPONENTS
   ══════════════════════════════════════════════════ */

// Testimonial Carousel
Alpine.data('testimonialCarousel', () => ({
    currentSlide: 0,
    totalSlides: 0,
    autoplayInterval: null,

    init() {
        this.totalSlides = this.$refs.track ? this.$refs.track.children.length : 0;
        this.startAutoplay();
    },

    next() {
        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
    },

    prev() {
        this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
    },

    goTo(index) {
        this.currentSlide = index;
    },

    startAutoplay() {
        this.autoplayInterval = setInterval(() => this.next(), 5000);
    },

    stopAutoplay() {
        clearInterval(this.autoplayInterval);
    },

    destroy() {
        this.stopAutoplay();
    }
}));

// FAQ Accordion
Alpine.data('faqAccordion', () => ({
    activeIndex: null,

    toggle(index) {
        this.activeIndex = this.activeIndex === index ? null : index;
    },

    isOpen(index) {
        return this.activeIndex === index;
    }
}));

// Booking Wizard
Alpine.data('bookingWizard', () => ({
    step: 1,
    totalSteps: 3,
    selectedCourt: null,
    selectedDate: null,
    selectedTime: null,
    voucherCode: '',
    discount: 0,

    nextStep() {
        if (this.step < this.totalSteps) this.step++;
    },

    prevStep() {
        if (this.step > 1) this.step--;
    },

    goToStep(s) {
        if (s <= this.step) this.step = s;
    },

    get progress() {
        return (this.step / this.totalSteps) * 100;
    }
}));

// Image Gallery
Alpine.data('imageGallery', () => ({
    currentImage: 0,
    images: [],

    init() {
        // images should be passed via x-init or props
    },

    next() {
        this.currentImage = (this.currentImage + 1) % this.images.length;
    },

    prev() {
        this.currentImage = (this.currentImage - 1 + this.images.length) % this.images.length;
    },

    selectImage(index) {
        this.currentImage = index;
    }
}));

/* ══════════════════════════════════════════════════
   GLOBAL HELPER FUNCTIONS
   ══════════════════════════════════════════════════ */

// SweetAlert2 Helpers
window.showSuccess = (title, text = '') => {
    return Swal.fire({
        icon: 'success',
        title: title,
        text: text,
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        customClass: {
            popup: 'rounded-2xl'
        }
    });
};

window.showError = (title, text = '') => {
    return Swal.fire({
        icon: 'error',
        title: title,
        text: text,
        customClass: {
            popup: 'rounded-2xl'
        }
    });
};

window.showConfirm = (title, text = '', confirmText = 'Ya, Lanjutkan') => {
    return Swal.fire({
        icon: 'warning',
        title: title,
        text: text,
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: 'Batal',
        customClass: {
            popup: 'rounded-2xl',
            confirmButton: 'btn-primary',
            cancelButton: 'btn-ghost'
        }
    });
};

window.showToast = (title, icon = 'success') => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({ icon: icon, title: title });
};

// Format currency (IDR)
window.formatCurrency = (amount) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    }).format(amount);
};

// Format date
window.formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};

/* ══════════════════════════════════════════════════
   INTERSECTION OBSERVER - Scroll Animations
   ══════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px',
        }
    );

    document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right').forEach((el) => {
        observer.observe(el);
    });
});

/* ══════════════════════════════════════════════════
   COUNTER ANIMATION
   ══════════════════════════════════════════════════ */
window.animateCounter = (element, target, duration = 2000) => {
    let start = 0;
    const startTime = performance.now();

    const step = (currentTime) => {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easeOut = 1 - Math.pow(1 - progress, 3);
        const current = Math.floor(easeOut * target);

        element.textContent = current.toLocaleString('id-ID');

        if (progress < 1) {
            requestAnimationFrame(step);
        } else {
            element.textContent = target.toLocaleString('id-ID');
        }
    };

    requestAnimationFrame(step);
};

/* ══════════════════════════════════════════════════
   CHART.JS DEFAULTS
   ══════════════════════════════════════════════════ */
Chart.defaults.font.family = 'Inter, system-ui, sans-serif';
Chart.defaults.font.size = 12;
Chart.defaults.plugins.legend.labels.usePointStyle = true;
Chart.defaults.plugins.legend.labels.padding = 16;
Chart.defaults.plugins.tooltip.cornerRadius = 12;
Chart.defaults.plugins.tooltip.padding = 12;
Chart.defaults.elements.bar.borderRadius = 8;
Chart.defaults.elements.line.tension = 0.4;
Chart.defaults.scale.grid.display = true;
Chart.defaults.scale.grid.drawBorder = false;

// Set chart colors based on theme
const updateChartDefaults = () => {
    const isDark = document.documentElement.classList.contains('dark');
    Chart.defaults.color = isDark ? '#94a3b8' : '#64748b';
    Chart.defaults.scale.grid.color = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';
};
updateChartDefaults();

// Watch for theme changes
const themeObserver = new MutationObserver(updateChartDefaults);
themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

/* ══════════════════════════════════════════════════
   START ALPINE
   ══════════════════════════════════════════════════ */
Alpine.start();
