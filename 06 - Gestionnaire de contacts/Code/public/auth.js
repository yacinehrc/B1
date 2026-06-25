const API_URL = '../api';

document.addEventListener('DOMContentLoaded', () => {
    const showRegisterBtn = document.getElementById('show-register');
    const showLoginBtn = document.getElementById('show-login');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const authTitle = document.getElementById('auth-title');
    const authSubtitle = document.getElementById('auth-subtitle');

    // Toggle forms
    showRegisterBtn.addEventListener('click', () => {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        authTitle.textContent = 'Inscription';
        authSubtitle.textContent = 'Créez votre compte';
    });

    showLoginBtn.addEventListener('click', () => {
        registerForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
        authTitle.textContent = 'Connexion';
        authSubtitle.textContent = 'Accédez à votre répertoire';
    });

    // Handle Login
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData.entries());

        try {
            const res = await fetch(`${API_URL}/login.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await res.json();

            if (res.ok) {
                window.location.href = 'dashboard.html';
            } else {
                alert(result.error || 'Erreur de connexion');
            }
        } catch (err) {
            console.error(err);
            alert('Erreur réseau');
        }
    });

    // Handle Register
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData.entries());

        if (data.password !== data.password_confirm) {
            alert('Les mots de passe ne correspondent pas.');
            return;
        }

        try {
            const res = await fetch(`${API_URL}/register.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await res.json();

            if (res.ok) {
                alert('Compte créé avec succès ! Connectez-vous.');
                registerForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
                authTitle.textContent = 'Connexion';
                authSubtitle.textContent = 'Accédez à votre répertoire';
            } else {
                alert(result.error || 'Erreur d\'inscription');
            }
        } catch (err) {
            console.error(err);
            alert('Erreur réseau');
        }
    });

    // Theme Management
    const themeToggle = document.getElementById('theme-toggle');

    function toggleTheme() {
        const html = document.documentElement;
        const currentTheme = html.getAttribute('data-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        html.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);

        const icon = themeToggle.querySelector('i');
        icon.className = newTheme === 'light' ? 'fa-solid fa-moon' : 'fa-solid fa-sun';
    }

    function loadTheme() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        const icon = themeToggle.querySelector('i');
        icon.className = savedTheme === 'light' ? 'fa-solid fa-moon' : 'fa-solid fa-sun';
    }

    themeToggle.addEventListener('click', toggleTheme);
    loadTheme();
});
