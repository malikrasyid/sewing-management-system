// resources/js/nexus.js

const toggleModal = (id) => {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.toggle('hidden');
        
        // Opsional: Lock scroll saat modal buka
        if (!modal.classList.contains('hidden')) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    } else {
        console.error(`Modal dengan ID "${id}" tidak ditemukan.`);
    }
};

// Pastikan menempel ke global window
window.toggleModal = toggleModal;