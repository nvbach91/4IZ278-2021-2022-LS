import Tags from "bootstrap5-tags";

document.getElementById('company-checkbox').addEventListener('change', (e) => {
  const companySection = document.getElementById('company-section')
  const inputs = [].slice.call(companySection.querySelectorAll('input,select'))

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

Tags.init('#tags')