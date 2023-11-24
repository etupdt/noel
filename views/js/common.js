
let noel = new Date(2023, 11, 26);

const typesUnities = ['days', 'hours', 'minutes', 'secondes']
let unities = {}

typesUnities.forEach(typeUnity => {
  unities[typeUnity] = window.document.getElementById(`rebours-${typeUnity}`)
})

const intervalID = setInterval(() => {
  console.log('toto')
  secondes = Math.floor((noel - new Date()) / 1000)
  const days = Math.floor(secondes / 86400) 
  unities.days.innerText = days
  const hours = Math.floor(secondes / 3600) - (days * 24)
  unities.hours.innerText = hours
  const minutes = Math.floor(secondes / 60) - (days * 1440) - (hours * 60)
  unities.minutes.innerText = minutes
  unities.secondes.innerText = secondes - (days * 86400) - (hours * 3600) - (minutes * 60)
}, 1000);

for (let a of window.document.getElementsByTagName('a')) {
  const name = a.getAttribute('name')
  if (name && name.indexOf('page-link') > 0) {
    a.addEventListener("click", () => displayModal(name.replace('page-link', '')), false)
  }
}

let displayedModal

const typesModals = ['login', 'logon', 'forgot', 'logout']
let modals = {}

for (let a of window.document.getElementsByTagName('a')) {
  const name = a.getAttribute('name')
  if (name && name.indexOf('page-link') > 0) {
    a.addEventListener("click", () => displayModal(name.replace('page-link', '')), false)
  }
}

window.document.getElementById('button-login').addEventListener("click", () => displayModal('login'), false)
window.document.getElementById('button-logout').addEventListener("click", () => displayModal('logout'), false)

typesModals.forEach(typeModal => {

  modals[typeModal] = {}

  modals[typeModal].modal = new bootstrap.Modal(`#${typeModal}page`, {keyboard: false})
  modals[typeModal].page = window.document.getElementById(`${typeModal}page`)
  modals[typeModal].message = window.document.getElementById(`${typeModal}-error-message`)
  window.document.getElementById(`${typeModal}-validate`).addEventListener("click", () => validate())

  for (let input of modals[typeModal].page.getElementsByTagName('input')) {
    input.addEventListener("focus", () => modals[typeModal].message.style.display = 'none')
  }

})

function displayModal (typeModal) {
  typesModals.forEach(typeModal => modals[typeModal].modal.hide())
  for (let input of modals[typeModal].page.getElementsByTagName('input')) {
    input.value = ''
  }  
  modals[typeModal].modal.show()
  displayedModal = typeModal
}

async function validate () {

  let body = {}

  switch (displayedModal) {
    case 'forgot' : {
      body.email = window.document.getElementById(`${displayedModal}-email`).value
      break
    }
    case 'login' : {
      body.email = window.document.getElementById(`${displayedModal}-email`).value
      body.password = window.document.getElementById(`${displayedModal}-password`).value
      break
    }
    case 'logon' : {
      body.email = window.document.getElementById(`${displayedModal}-email`).value
      body.password = window.document.getElementById(`${displayedModal}-password`).value
      body.confirmPAssword = window.document.getElementById(`${displayedModal}-confirm-password`).value
      break
    }
  }

  const reponse = await fetch(`https://localhost:8000/api/${displayedModal}`, {
    method: "POST",
    mode: "cors",
    cache: "no-cache", 
    credentials: "same-origin", 
    headers: {"Content-Type": "application/json"},
    redirect: "follow",
    referrerPolicy: "no-referrer",
    body: JSON.stringify(body)
  });

  const json = await reponse.json()

  if (json.code === 0) {
//    modals[displayedModal].style.display = 'none'
    modals[displayedModal].modal.hide()
    window.document.getElementById('button-login').style.display='block'
    window.document.getElementById('button-logout').style.display='block'
    window.document.getElementById(`button-${displayedModal}`).style.display='none'
    location.reload()
  } else {
    modals[displayedModal].message.innerText = json.message
    modals[displayedModal].message.style.display = 'block'
  }
  
}
