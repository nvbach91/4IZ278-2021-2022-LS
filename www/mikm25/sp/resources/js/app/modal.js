import { Modal } from "bootstrap";

// Auto show of modals
document.querySelectorAll('.modal.show-on-load').forEach(e => {
  const modal = new Modal(e)
  modal.show();
})

// User delete modal
const positionDeleteModal = document.getElementById('user-delete-modal')

if (positionDeleteModal !== null) {
  // Remove validation errors when modal is hid
  positionDeleteModal.addEventListener('hidden.bs.modal', e => {
    const formErrors = positionDeleteModal.querySelector('.form-errors')

    if (formErrors !== null) {
      formErrors.remove()
    }

    const errorField = positionDeleteModal.querySelector('.is-invalid')

    if (errorField) {
      errorField.classList.remove('is-invalid')
    }

    const errorMessage = positionDeleteModal.querySelector('.invalid-feedback')

    if (errorMessage) {
      errorMessage.remove()
    }
  })
}