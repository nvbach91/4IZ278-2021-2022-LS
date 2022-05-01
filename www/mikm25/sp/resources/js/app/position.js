document.getElementById('company-checkbox').addEventListener('change', (e) => {
  const companySection = document.getElementById('company-section')
  const inputs = [].slice.call(companySection.getElementsByTagName('input'))

  if (e.target.checked) {
    companySection.classList.remove('d-none')
    inputs.forEach(element => {
      element.disabled = false;
    })
  } else {
    companySection.classList.add('d-none')
    inputs.forEach(element => {
      element.disabled = true;
    })
  }
})

document.getElementById('company-checkbox').dispatchEvent(new Event('change'))

