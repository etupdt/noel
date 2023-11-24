
window.document.getElementById(`letter-validate`).addEventListener("click", () => letterValidate())

for (let input of window.document.getElementById('letterpage').getElementsByTagName('input')) {
  input.addEventListener("click", () => letterValidate())
}

async function letterValidate () {
  console.log(window.document.getElementById('button-logout').style.display)
  if (window.document.getElementById('button-logout').style.display === 'none') {
    displayModal('login')
  }  
}
