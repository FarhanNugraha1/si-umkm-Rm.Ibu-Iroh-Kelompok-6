function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0
    }).format(number || 0);
}

function updateOrderTotal() {
    const menuSelect = document.getElementById('menuSelect');
    const quantityInput = document.getElementById('quantityInput');
    const totalPreview = document.getElementById('totalPreview');

    if (!menuSelect || !quantityInput || !totalPreview) return;

    const selected = menuSelect.options[menuSelect.selectedIndex];
    const price = Number(selected?.dataset?.price || 0);
    const quantity = Number(quantityInput.value || 1);

    totalPreview.textContent = formatRupiah(price * quantity);
}

function toggleAddress() {
    const serviceType = document.getElementById('serviceType');
    const addressWrapper = document.getElementById('addressWrapper');

    if (!serviceType || !addressWrapper) return;

    addressWrapper.style.display = serviceType.value === 'delivery' ? 'block' : 'none';
}

function initPasswordValidation() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const charLength = document.getElementById('char-length');
    const charNumber = document.getElementById('char-number');
    const charUpper = document.getElementById('char-upper');
    const passwordMatch = document.getElementById('password-match');
    const registerForm = document.getElementById('registerForm');

    if (!password || !confirmPassword || !registerForm) return;

    function setState(element, valid) {
        if (!element) return;
        element.classList.toggle('requirement-met', valid);
        element.classList.toggle('requirement-unmet', !valid);
    }

    function validatePassword() {
        const pass = password.value;
        const confirm = confirmPassword.value;

        setState(charLength, pass.length >= 8);
        setState(charNumber, /\d/.test(pass));
        setState(charUpper, /[A-Z]/.test(pass));

        if (passwordMatch) {
            const match = confirm !== '' && pass === confirm;
            setState(passwordMatch, match);
            passwordMatch.textContent = match ? '✓ Password cocok' : '✗ Password belum cocok';
        }
    }

    password.addEventListener('keyup', validatePassword);
    confirmPassword.addEventListener('keyup', validatePassword);

    registerForm.addEventListener('submit', function (e) {
        const pass = password.value;

        if (pass !== confirmPassword.value) {
            e.preventDefault();
            alert('Password dan konfirmasi password tidak cocok!');
            return;
        }

        if (pass.length < 8) {
            e.preventDefault();
            alert('Password minimal 8 karakter!');
            return;
        }

        if (!/\d/.test(pass)) {
            e.preventDefault();
            alert('Password harus mengandung minimal 1 angka!');
            return;
        }

        if (!/[A-Z]/.test(pass)) {
            e.preventDefault();
            alert('Password harus mengandung minimal 1 huruf besar!');
        }
    });
}

function initActiveNavbar() {
    const sections = ['beranda', 'profil', 'menu-andalan', 'kontak'];
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    const hasHashLinks = Array.from(navLinks).some(link => (link.getAttribute('href') || '').includes('#'));

    if (!hasHashLinks || !sections.some(id => document.getElementById(id))) return;

    function setActiveNavLink() {
        let currentSection = '';
        const scrollPosition = window.scrollY + 100;

        for (const section of sections) {
            const element = document.getElementById(section);
            if (!element) continue;

            const offsetTop = element.offsetTop;
            const offsetBottom = offsetTop + element.offsetHeight;

            if (scrollPosition >= offsetTop && scrollPosition < offsetBottom) {
                currentSection = section;
                break;
            }
        }

        if (window.scrollY < 100) currentSection = 'beranda';

        navLinks.forEach(link => {
            const href = link.getAttribute('href') || '';
            link.classList.remove('active');

            if (href.endsWith('#' + currentSection)) {
                link.classList.add('active');
            }
        });
    }

    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href') || '';
            const hashIndex = href.indexOf('#');
            if (hashIndex === -1) return;

            const targetId = href.substring(hashIndex + 1);
            const targetElement = document.getElementById(targetId);
            if (!targetElement) return;

            e.preventDefault();
            window.scrollTo({
                top: targetElement.offsetTop - 76,
                behavior: 'smooth'
            });
        });
    });

    window.addEventListener('scroll', setActiveNavLink);
    setActiveNavLink();
}

document.addEventListener('DOMContentLoaded', function () {
    updateOrderTotal();
    toggleAddress();
    initPasswordValidation();
    initActiveNavbar();

    document.getElementById('menuSelect')?.addEventListener('change', updateOrderTotal);
    document.getElementById('quantityInput')?.addEventListener('input', updateOrderTotal);
    document.getElementById('serviceType')?.addEventListener('change', toggleAddress);
});
