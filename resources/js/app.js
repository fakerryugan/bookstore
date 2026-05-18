import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Simple script to handle navbar scroll effect
window.addEventListener('scroll', () => {
    const nav = document.getElementById('navbar');
    if (nav) {
        if (window.scrollY > 20) {
            nav.classList.add('shadow-md');
            nav.classList.replace('glass', 'bg-white/95');
        } else {
            nav.classList.remove('shadow-md');
            nav.classList.replace('bg-white/95', 'glass');
        }
    }
});
