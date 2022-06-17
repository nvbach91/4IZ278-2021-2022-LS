const companyDeleteModal = document.getElementById('company-delete-modal')

if (companyDeleteModal !== null) {
  companyDeleteModal.addEventListener('show.bs.modal', e => {
    const button = e.relatedTarget
    const formAction = button.getAttribute('data-bs-form-action')
    const form = companyDeleteModal.getElementsByTagName('form')[0]
    form.setAttribute('action', formAction)
  })

  companyDeleteModal.addEventListener('hide.bs.modal', e => {
    const form = companyDeleteModal.getElementsByTagName('form')[0]
    form.setAttribute('action', '#')
  })
}
