// Mobile Menu Toggle
const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
const closeMobileMenu = document.getElementById('close-mobile-menu');
const mobileNavOverlay = document.getElementById('mobile-nav-overlay');

mobileMenuToggle.addEventListener('click', () => {
    mobileNavOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
});

closeMobileMenu.addEventListener('click', () => {
    mobileNavOverlay.classList.remove('active');
    document.body.style.overflow = 'auto';
});

// Close mobile menu when clicking on a link
const mobileNavLinks = document.querySelectorAll('.nav-link-mobile');
mobileNavLinks.forEach(link => {
    link.addEventListener('click', () => {
        mobileNavOverlay.classList.remove('active');
        document.body.style.overflow = 'auto';
    });
});

// Header scroll effect
const header = document.querySelector('.header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Animation on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements with animation classes
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.animate-slide-up, .animate-slide-up-left, .animate-slide-up-right');
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        if (el.classList.contains('animate-slide-up')) {
            el.style.transform = 'translateY(30px)';
        } else if (el.classList.contains('animate-slide-up-left')) {
            el.style.transform = 'translateX(-30px) translateY(30px)';
        } else if (el.classList.contains('animate-slide-up-right')) {
            el.style.transform = 'translateX(30px) translateY(30px)';
        }
        
        observer.observe(el);
    });
});