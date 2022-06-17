import Tags from "bootstrap5-tags";

const positionTags = document.getElementById('position-tags')

if (positionTags !== null) {
  Tags.init('#position-tags')
}

const positionDeleteModal = document.getElementById('position-delete-modal')

if (positionDeleteModal !== null) {
  positionDeleteModal.addEventListener('show.bs.modal', e => {
    const button = e.relatedTarget
    const formAction = button.getAttribute('data-bs-form-action')
    const form = positionDeleteModal.getElementsByTagName('form')[0]
    form.setAttribute('action', formAction)
  })

  positionDeleteModal.addEventListener('hide.bs.modal', e => {
    const form = positionDeleteModal.getElementsByTagName('form')[0]
    form.setAttribute('action', '#')
  })
}
