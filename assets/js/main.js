// ========================================
// WALES & WEBS - MAIN JAVASCRIPT
// ========================================

document.addEventListener('DOMContentLoaded', function() {

  // Mobile Menu Toggle
  const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
  const navLinks = document.querySelector('.nav-links');

  if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });
  }

  // Scroll Animations (Fade In)
  const fadeElements = document.querySelectorAll('.fade-in');

  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        fadeObserver.unobserve(entry.target);
      }
    });
  }, observerOptions);

  fadeElements.forEach(el => fadeObserver.observe(el));

  // Navbar scroll effect
  const navbar = document.querySelector('.navbar');
  let lastScroll = 0;

  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll > 100) {
      navbar.style.background = 'rgba(5, 5, 8, 0.95)';
    } else {
      navbar.style.background = 'rgba(5, 5, 8, 0.8)';
    }

    lastScroll = currentScroll;
  });

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // Counter Animation for Stats
  const animateCounter = (el, target, duration = 2000) => {
    let start = 0;
    const increment = target / (duration / 16);
    const suffix = el.dataset.suffix || '';
    const prefix = el.dataset.prefix || '';

    const timer = setInterval(() => {
      start += increment;
      if (start >= target) {
        el.textContent = prefix + target + suffix;
        clearInterval(timer);
      } else {
        el.textContent = prefix + Math.floor(start) + suffix;
      }
    }, 16);
  };

  const statElements = document.querySelectorAll('[data-count]');

  const statObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = parseInt(entry.target.dataset.count);
        animateCounter(entry.target, target);
        statObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  statElements.forEach(el => statObserver.observe(el));

  // Newsletter Form
  const newsletterForm = document.querySelector('.newsletter-form');
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const input = newsletterForm.querySelector('input');
      const btn = newsletterForm.querySelector('button');

      if (input.value) {
        const originalText = btn.textContent;
        btn.textContent = 'Subscribed!';
        btn.style.background = 'var(--accent-green)';
        input.value = '';

        setTimeout(() => {
          btn.textContent = originalText;
          btn.style.background = '';
        }, 3000);
      }
    });
  }

  // Parallax effect for floating icons
  const floatIcons = document.querySelectorAll('.float-icon');

  window.addEventListener('mousemove', (e) => {
    const x = e.clientX / window.innerWidth;
    const y = e.clientY / window.innerHeight;

    floatIcons.forEach((icon, index) => {
      const speed = (index + 1) * 10;
      const xOffset = (x - 0.5) * speed;
      const yOffset = (y - 0.5) * speed;
      icon.style.transform = `translate(${xOffset}px, ${yOffset}px)`;
    });
  });

});
