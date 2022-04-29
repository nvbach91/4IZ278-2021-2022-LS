require('./bootstrap')

document.querySelectorAll('.logout-btn').forEach(e => {
  e.addEventListener('click', (e) => {
    e.preventDefault()
    document.getElementById('logout-form').submit()
  })
})
