// Fungsi untuk update waktu real-time
function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('id-ID', { hour12: false });
    const timeElement = document.getElementById('current-time');
    if (timeElement) timeElement.textContent = timeString;

    const dateString = now.toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    const dateElement = document.getElementById('current-date');
    if (dateElement) dateElement.textContent = dateString;
}

// Fungsi untuk status sistem (placeholder)
function updateSystemStatus() {
    // Bisa ditambahkan logika untuk cek koneksi database atau status server
    // Untuk sekarang, selalu online
}

// Animasi hover untuk cards
function initCardAnimations() {
    const cards = document.querySelectorAll('.glass');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.05)';
            this.style.boxShadow = '0 15px 30px rgba(0,0,0,0.5)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 8px 20px rgba(0,0,0,0.3)';
        });
    });
}

// Inisialisasi Particles.js untuk dashboard
function initParticles() {
    const particlesElement = document.getElementById('particles-js');
    if (particlesElement && typeof particlesJS !== 'undefined') {
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: '#ffffff' },
                shape: { type: 'circle' },
                opacity: { value: 0.5, random: true },
                size: { value: 3, random: true },
                line_linked: { enable: true, distance: 150, color: '#ffffff', opacity: 0.4, width: 1 },
                move: { enable: true, speed: 2, direction: 'none', random: true, straight: false, out_mode: 'out' }
            },
            interactivity: {
                detect_on: 'canvas',
                events: { onhover: { enable: true, mode: 'repulse' }, onclick: { enable: true, mode: 'push' } },
                modes: { repulse: { distance: 200, duration: 0.4 }, push: { particles_nb: 4 } }
            },
            retina_detect: true
        });
    }
}

// Inisialisasi dashboard
function initDashboard() {
    initCardAnimations();
    initParticles();
    // Update waktu setiap detik
    updateTime();
    setInterval(updateTime, 1000);
}

// Jalankan saat DOM loaded
document.addEventListener('DOMContentLoaded', function() {
    initCardAnimations(); // For all pages
    if (document.getElementById('particles-js')) {
        initDashboard();
    }
});
