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