document.addEventListener('DOMContentLoaded', () => {
    // State
    let contacts = JSON.parse(localStorage.getItem('contacts')) || [];
    let currentTab = 'professional';
    let isDarkMode = localStorage.getItem('theme') === 'dark';

    // DOM Elements
    const themeToggle = document.getElementById('theme-toggle');
    const contactsList = document.getElementById('contacts-list');
    const navTabs = document.querySelectorAll('.nav-tab');
    const addBtn = document.getElementById('add-btn');
    const modal = document.getElementById('modal');
    const closeModal = document.getElementById('close-modal');
    const cancelBtn = document.getElementById('cancel-btn');
    const contactForm = document.getElementById('contact-form');
    const searchInput = document.getElementById('search-input');
    const typeInputs = document.querySelectorAll('input[name="type"]');
    const proFields = document.getElementById('pro-fields');
    const persoFields = document.getElementById('perso-fields');
    const importBtn = document.getElementById('import-btn');
    const csvInput = document.getElementById('csv-input');

    // Initialization
    if (isDarkMode) document.body.setAttribute('data-theme', 'dark');
    updateThemeIcon();
    renderContacts();

    // Event Listeners
    themeToggle.addEventListener('click', toggleTheme);

    navTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            navTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            currentTab = tab.dataset.tab;
            renderContacts();
        });
    });

    addBtn.addEventListener('click', () => openModal());
    closeModal.addEventListener('click', () => closeModalFunc());
    cancelBtn.addEventListener('click', () => closeModalFunc());

    // Close modal on outside click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModalFunc();
    });

    typeInputs.forEach(input => {
        input.addEventListener('change', (e) => {
            if (e.target.value === 'professional') {
                proFields.classList.remove('hidden');
                persoFields.classList.add('hidden');
            } else {
                proFields.classList.add('hidden');
                persoFields.classList.remove('hidden');
            }
        });
    });

    contactForm.addEventListener('submit', handleFormSubmit);

    searchInput.addEventListener('input', renderContacts);

    importBtn.addEventListener('click', () => csvInput.click());
    csvInput.addEventListener('change', handleCSVImport);

    // Functions
    function toggleTheme() {
        isDarkMode = !isDarkMode;
        document.body.setAttribute('data-theme', isDarkMode ? 'dark' : 'light');
        localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
        updateThemeIcon();
    }

    function updateThemeIcon() {
        const icon = themeToggle.querySelector('i');
        if (isDarkMode) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }
    }

    function renderContacts() {
        const searchTerm = searchInput.value.toLowerCase();

        const filteredContacts = contacts.filter(contact => {
            const matchesTab = contact.type === currentTab;
            const matchesSearch = contact.name.toLowerCase().includes(searchTerm) ||
                (contact.company && contact.company.toLowerCase().includes(searchTerm));
            return matchesTab && matchesSearch;
        });

        contactsList.innerHTML = '';

        if (filteredContacts.length === 0) {
            contactsList.innerHTML = `
                <div style="grid-column: 1/-1; text-align: center; padding: 2rem; color: var(--text-secondary);">
                    <i class="fa-solid fa-user-slash" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                    <p>Aucun contact trouvé.</p>
                </div>
            `;
            return;
        }

        filteredContacts.forEach(contact => {
            const card = document.createElement('div');
            card.className = 'contact-card';

            const initials = contact.name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();

            let detailsHtml = '';
            if (contact.type === 'professional') {
                if (contact.proPhone) detailsHtml += `<div class="detail-item"><i class="fa-solid fa-phone"></i> ${contact.proPhone}</div>`;
                if (contact.proEmail) detailsHtml += `<div class="detail-item"><i class="fa-solid fa-envelope"></i> ${contact.proEmail}</div>`;
            } else {
                if (contact.persoPhone) detailsHtml += `<div class="detail-item"><i class="fa-solid fa-phone"></i> ${contact.persoPhone}</div>`;
                if (contact.persoEmail) detailsHtml += `<div class="detail-item"><i class="fa-solid fa-envelope"></i> ${contact.persoEmail}</div>`;
                if (contact.address) detailsHtml += `<div class="detail-item"><i class="fa-solid fa-location-dot"></i> ${contact.address}</div>`;
            }

            card.innerHTML = `
                <div class="card-header">
                    <div class="avatar">${initials}</div>
                    <button class="fav-btn ${contact.isFavorite ? 'active' : ''}" onclick="toggleFavorite('${contact.id}')">
                        <i class="fa-${contact.isFavorite ? 'solid' : 'regular'} fa-star"></i>
                    </button>
                </div>
                <div class="contact-info">
                    <h3>${contact.name}</h3>
                    ${contact.company ? `<div class="role">${contact.job ? contact.job + ' chez ' : ''}${contact.company}</div>` : ''}
                    <div class="contact-details">
                        ${detailsHtml}
                    </div>
                </div>
            `;

            // We need to attach the event listener for the favorite button dynamically or expose the function globally
            // For simplicity, let's expose a global function for now or attach it here.
            // Better approach: attach event listener to the button directly
            const favBtn = card.querySelector('.fav-btn');
            favBtn.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent card click if we add one later
                toggleFavorite(contact.id);
            });

            contactsList.appendChild(card);
        });
    }

    function openModal() {
        modal.classList.remove('hidden');
    }

    function closeModalFunc() {
        modal.classList.add('hidden');
        contactForm.reset();
        // Reset to default view (Professional)
        typeInputs[0].checked = true;
        proFields.classList.remove('hidden');
        persoFields.classList.add('hidden');
    }

    function handleFormSubmit(e) {
        e.preventDefault();

        const formData = new FormData(contactForm);
        const newContact = {
            id: Date.now().toString(),
            type: formData.get('type'),
            name: formData.get('name'),
            isFavorite: false,
            // Pro fields
            company: formData.get('company'),
            job: formData.get('job'),
            proPhone: formData.get('proPhone'),
            proEmail: formData.get('proEmail'),
            // Perso fields
            persoPhone: formData.get('persoPhone'),
            persoEmail: formData.get('persoEmail'),
            address: formData.get('address')
        };

        contacts.push(newContact);
        saveContacts();
        renderContacts();
        closeModalFunc();
    }

    function toggleFavorite(id) {
        const contact = contacts.find(c => c.id === id);
        if (contact) {
            contact.isFavorite = !contact.isFavorite;
            saveContacts();
            renderContacts();
        }
    }

    function saveContacts() {
        localStorage.setItem('contacts', JSON.stringify(contacts));
    }

    function handleCSVImport(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (event) {
            const text = event.target.result;
            const lines = text.split('\n');
            let importedCount = 0;

            // Simple CSV parser (assumes header: Name,Company,Phone,Email,Type)
            // Skip header if present (simple check)
            const startIndex = lines[0].toLowerCase().includes('name') ? 1 : 0;

            for (let i = startIndex; i < lines.length; i++) {
                const line = lines[i].trim();
                if (!line) continue;

                const parts = line.split(',');
                if (parts.length >= 2) { // Minimum Name and something else
                    const contact = {
                        id: Date.now().toString() + Math.random().toString(36).substr(2, 9),
                        name: parts[0].trim(),
                        company: parts[1] ? parts[1].trim() : '',
                        proPhone: parts[2] ? parts[2].trim() : '',
                        proEmail: parts[3] ? parts[3].trim() : '',
                        type: 'professional', // Default to professional for CSV import
                        isFavorite: false
                    };
                    contacts.push(contact);
                    importedCount++;
                }
            }

            saveContacts();
            renderContacts();
            alert(`${importedCount} contacts importés avec succès !`);
            e.target.value = ''; // Reset input
        };
        reader.readAsText(file);
    }
});
