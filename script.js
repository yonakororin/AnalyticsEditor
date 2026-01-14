import { App } from './modules/App.js';
import { DbBrowserModal, ReadmeModal } from './modules/ui/Modal.js';

// Initialize App immediately (module is deferred so DOM is ready)
const app = new App();

// Expose Classes to Window for HTML onclick handlers
window.DbBrowserModal = DbBrowserModal;
window.ReadmeModal = ReadmeModal;
// User Dropdown Logic
document.addEventListener('DOMContentLoaded', () => {
    const userBtn = document.querySelector('.user-btn');
    const dropdownContent = document.querySelector('.dropdown-content');

    if (userBtn && dropdownContent) {
        userBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownContent.classList.toggle('show');
        });

        document.addEventListener('click', (e) => {
            if (!dropdownContent.contains(e.target) && !userBtn.contains(e.target)) {
                dropdownContent.classList.remove('show');
            }
        });

        dropdownContent.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                dropdownContent.classList.remove('show');
            });
        });
    }
});
