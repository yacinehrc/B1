const API_URL = '../api';

// State
let currentTab = 'pro'; // 'pro' or 'perso'
let contacts = [];
let userId = null;

// DOM Elements
const themeToggle = document.getElementById('theme-toggle');
const contactList = document.getElementById('contact-list');
const favoritesList = document.getElementById('favorites-list');
const favoritesSection = document.getElementById('favorites-section');
const listTitle = document.getElementById('list-title');
const searchInput = document.getElementById('search-input');

// Modals
const modalAdd = document.getElementById('modal-add');
const modalImport = document.getElementById('modal-import');
const btnAdd = document.getElementById('btn-add');
const btnImport = document.getElementById('btn-import');
const closeBtns = document.querySelectorAll('.close-btn');
const addContactForm = document.getElementById('add-contact-form');
const importForm = document.getElementById('import-form');

// Edit state
let isEditMode = false;
let editingContactId = null;
let editingContactType = null;

// Initialization
document.addEventListener('DOMContentLoaded', async () => {
    await checkAuth();
    fetchContacts();
    setupEventListeners();
    loadTheme();
});

async function checkAuth() {
    try {
        const res = await fetch(`${API_URL}/check_auth.php`);
        const data = await res.json();
        if (!data.authenticated) {
            window.location.href = 'index.html';
        } else {
            userId = data.user_id;
            const greeting = document.getElementById('user-greeting');
            if (greeting && data.username) {
                greeting.textContent = `Bonjour, ${data.username}`;
            }
        }
    } catch (err) {
        window.location.href = 'index.html';
    }
}

function setupEventListeners() {
    // Theme Toggle
    themeToggle.addEventListener('click', toggleTheme);

    // Sidebar Navigation
    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(btn => {
        btn.addEventListener('click', () => {
            navItems.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentTab = btn.dataset.tab;
            updateUI();
        });
    });

    // Modals
    btnAdd.addEventListener('click', () => {
        isEditMode = false;
        editingContactId = null;
        editingContactType = null;
        document.getElementById('modal-title').textContent = 'Nouveau Contact';
        document.getElementById('contact-type').value = currentTab;
        toggleFieldsForTab(currentTab);
        addContactForm.reset();
        modalAdd.classList.add('show');
    });

    btnImport.addEventListener('click', () => modalImport.classList.add('show'));

    closeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            modalAdd.classList.remove('show');
            modalImport.classList.remove('show');
        });
    });

    // Forms
    addContactForm.addEventListener('submit', handleAddContact);
    importForm.addEventListener('submit', handleImport);

    // Search
    searchInput.addEventListener('input', updateUI);

    // Logout
    const logoutBtn = document.getElementById('logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', async () => {
            try {
                await fetch(`${API_URL}/logout.php`);
                window.location.href = 'index.html';
            } catch (err) {
                console.error('Logout error:', err);
            }
        });
    }
}

// Theme Management
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
    if (icon) {
        icon.className = savedTheme === 'light' ? 'fa-solid fa-moon' : '  fa-solid fa-sun';
    }
}

// Data Fetching
async function fetchContacts() {
    try {
        const res = await fetch(`${API_URL}/get_contacts.php`);
        if (res.status === 401) {
            window.location.href = 'index.html';
            return;
        }
        contacts = await res.json();
        updateUI();
    } catch (err) {
        console.error('Error fetching contacts:', err);
    }
}

// UI Updates
function updateUI() {
    const searchTerm = searchInput.value.toLowerCase();

    // Filter contacts based on tab and search
    const filteredContacts = contacts.filter(c => {
        const matchesTab = c.type === currentTab;
        const matchesSearch = c.name.toLowerCase().includes(searchTerm) ||
            (c.company && c.company.toLowerCase().includes(searchTerm));
        return matchesTab && matchesSearch;
    });

    const tabFavorites = filteredContacts.filter(c => c.is_favorite);
    const tabRegulars = filteredContacts.filter(c => !c.is_favorite);

    // Render Lists
    renderList(favoritesList, tabFavorites);
    renderList(contactList, tabRegulars);

    // Toggle Favorites Section Visibility
    if (tabFavorites.length > 0) {
        favoritesSection.classList.remove('hidden');
    } else {
        favoritesSection.classList.add('hidden');
    }

    // Update Titles
    listTitle.textContent = currentTab === 'pro' ? 'Contacts Professionnels' : 'Contacts Personnels';
}

function renderList(container, items) {
    container.innerHTML = items.map(contact => `
        <div class="contact-card">
            <div class="contact-header">
                <div class="contact-avatar">
                    ${getInitials(contact.name)}
                </div>
                <button class="favorite-btn ${contact.is_favorite ? 'active' : ''}" onclick="toggleFavorite(${contact.id}, ${!contact.is_favorite}, '${contact.type}')">
                    <i class="fa-${contact.is_favorite ? 'solid' : 'regular'} fa-star"></i>
                </button>
            </div>
            <div class="contact-info">
                <h3>${contact.name}</h3>
                ${contact.company ? `<div class="contact-role">${contact.position ? contact.position + ' chez ' : ''}${contact.company}</div>` : ''}
                
                <div class="contact-details">
                    ${contact.phone ? `<div><i class="fa-solid fa-phone"></i> ${contact.phone}</div>` : ''}
                    ${contact.email ? `<div><i class="fa-solid fa-envelope"></i> ${contact.email}</div>` : ''}
                    ${contact.address ? `<div><i class="fa-solid fa-location-dot"></i> ${contact.address}</div>` : ''}
                </div>
            </div>
            <div class="card-actions">
                <button class="edit-btn" onclick="editContact(${contact.id}, '${contact.type}')">
                    <i class="fa-solid fa-pen"></i> Modifier
                </button>
                <button class="delete-btn" onclick="deleteContact(${contact.id}, '${contact.type}')">
                    <i class="fa-solid fa-trash"></i> Supprimer
                </button>
            </div>
        </div>
    `).join('');
}

function getInitials(name) {
    return name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
}

function toggleFieldsForTab(tab) {
    const companyField = document.getElementById('field-company');
    const positionField = document.getElementById('field-position');

    if (tab === 'perso') {
        companyField.style.display = 'none';
        positionField.style.display = 'none';
    } else {
        companyField.style.display = 'block';
        positionField.style.display = 'block';
    }
}

// Actions
async function handleAddContact(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
    data.is_favorite = formData.get('is_favorite') === 'on';

    try {
        let endpoint;

        if (isEditMode) {
            // Update existing contact
            endpoint = `${API_URL}/update_contact.php`;
            data.id = editingContactId;
            data.type = editingContactType;
        } else {
            // Create new contact
            endpoint = `${API_URL}/create_contact.php`;
        }

        const res = await fetch(endpoint, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const text = await res.text();

        if (res.ok) {
            try {
                const json = JSON.parse(text);
                modalAdd.classList.remove('show');
                e.target.reset();
                isEditMode = false;
                editingContactId = null;
                editingContactType = null;
                fetchContacts();
            } catch (e) {
                console.error('Invalid JSON response:', text);
                alert('Erreur serveur (réponse invalide): ' + text.substring(0, 100));
            }
        } else {
            console.error('Server error:', text);
            alert('Erreur serveur (' + res.status + '): ' + text.substring(0, 100));
        }
    } catch (err) {
        console.error('Network error:', err);
        alert('Erreur réseau: ' + err.message);
    }
}

function editContact(id, type) {
    const contact = contacts.find(c => c.id === id && c.type === type);
    if (!contact) {
        alert('Contact non trouvé');
        return;
    }

    // Set edit mode
    isEditMode = true;
    editingContactId = id;
    editingContactType = type;

    // Update modal title
    document.getElementById('modal-title').textContent = 'Modifier le Contact';

    // Pre-fill form
    document.getElementById('contact-type').value = type;
    document.getElementById('name').value = contact.name || '';
    document.getElementById('phone').value = contact.phone || '';
    document.getElementById('email').value = contact.email || '';
    document.getElementById('address').value = contact.address || '';

    if (type === 'pro') {
        document.getElementById('company').value = contact.company || '';
        document.getElementById('position').value = contact.position || '';
    }

    document.getElementById('is_favorite').checked = contact.is_favorite == 1;

    // Show appropriate fields
    toggleFieldsForTab(type);

    // Open modal
    modalAdd.classList.add('show');
}

async function toggleFavorite(id, status, type) {
    try {
        await fetch(`${API_URL}/update_favorite.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, is_favorite: status, type: type })
        });
        fetchContacts();
    } catch (err) {
        console.error('Error toggling favorite:', err);
    }
}

async function deleteContact(id, type) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')) return;

    try {
        await fetch(`${API_URL}/delete_contact.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, type: type })
        });
        fetchContacts();
    } catch (err) {
        console.error('Error deleting contact:', err);
    }
}

async function handleImport(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const type = formData.get('import-type');
    formData.append('type', type);

    try {
        const res = await fetch(`${API_URL}/import.php`, {
            method: 'POST',
            body: formData
        });

        if (res.ok) {
            alert('Import réussi !');
            modalImport.classList.remove('show');
            e.target.reset();
            fetchContacts();
        }
    } catch (err) {
        console.error('Error importing CSV:', err);
    }
}