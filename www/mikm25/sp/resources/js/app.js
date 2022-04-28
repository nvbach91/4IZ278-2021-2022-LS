require('./bootstrap')

document.getElementById('logout-btn').addEventListener('click', (e) => {
  e.preventDefault()
  document.getElementById('logout-form').submit()
})
