const toggleModal = (id) => {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.toggle('hidden');
        if (!modal.classList.contains('hidden')) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    } else {
        console.error(`Modal dengan ID "${id}" tidak ditemukan.`);
    }
};

window.toggleModal = toggleModal;

/**
 * Fungsi Global untuk Delete Alert
 */
window.confirmDelete = (url, itemName = "data ini") => {
    Swal.fire({
        title: 'Hapus Data?',
        text: `Apakah kamu yakin ingin menghapus ${itemName}? Tindakan ini tidak bisa dibatalkan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444', // Red 600
        cancelButtonColor: '#64748b',  // Slate 500
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(url, {
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            })
            .then(res => {
                Swal.fire('Terhapus!', res.data.message, 'success').then(() => location.reload());
            })
            .catch(err => {
                Swal.fire('Gagal!', 'Data tidak bisa dihapus karena masih digunakan di tabel lain.', 'error');
            });
        }
    });
};

/**
 * Fungsi Global untuk Open Edit Modal & Auto Fill
 */
window.openEditModal = (modalId, formId, data) => {
    const form = document.getElementById(formId);
    if (!form) return;

    // Reset form dan isi data
    form.reset();
    Object.keys(data).forEach(key => {
        if (form.elements[key]) {
            form.elements[key].value = data[key];
        }
    });

    // Simpan ID di form attribute untuk mempermudah axios update
    form.dataset.id = data.id;
    window.toggleModal(modalId);
};