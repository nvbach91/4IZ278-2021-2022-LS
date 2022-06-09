document.querySelectorAll('.position-interested-btn').forEach(element => {
  element.addEventListener('click', e => {
    const positionForm = document.querySelector('.position-reaction-form')

    if (positionForm) {
      positionForm.scrollIntoView(true, {
        behavior: 'smooth'
      })
    }
  })
})


const reactionFormHasErrors = document.querySelector('.position-reaction-form .form-control.is-invalid') !== null

if (reactionFormHasErrors) {
  const positionForm = document.querySelector('.position-reaction-form')

  if (positionForm) {
    positionForm.scrollIntoView(true, {
      behavior: 'smooth'
    })
  }
}