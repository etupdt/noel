
let noel = new Date(2023, 11, 26);
let timer = 0
let change = 0
let pas = 1
let minutes, ancMinutes
let hours, ancHours
let days, ancDays
let scenario = 0
let isMoving = false

let crClientX = 0
let crClientY = 0

const typesUnities = ['days', 'hours', 'minutes', 'secondes']
let unities = {}

typesUnities.forEach(typeUnity => {
  unities[typeUnity] = {}
  unities[typeUnity].div = window.document.getElementById(`rebours-${typeUnity}`)
  unities[typeUnity].newCounter = window.document.getElementById(`rebours-${typeUnity}-new-counter`)
  unities[typeUnity].counter = window.document.getElementById(`rebours-${typeUnity}-counter`)
})

const intervalID = setInterval(() => {

  if (timer === 5) {

    secondes = Math.floor((noel - new Date()) / 1000)
    days = Math.floor(secondes / 86400) 
    unities.days.counter.innerText = days
    hours = Math.floor(secondes / 3600) - (days * 24)
    unities.hours.counter.innerText = hours
    minutes = Math.floor(secondes / 60) - (days * 1440) - (hours * 60)
    unities.minutes.counter.innerText = minutes
    unities.secondes.counter.innerText = secondes - (days * 86400) - (hours * 3600) - (minutes * 60)

  }

  if (timer === -15) {

    unities.secondes.counter.style.transform = (scenario % 2) === 1 ? `scale(${(5 - change) * 0.20}, 1)` : `scale(1, ${(5 - change) * 0.20})`
    pas = 1
    
  }

  if (timer === 5) {

    pas = -1

  }

  if (timer < 0) {
    change = 0
  } else {
    change = timer
  }

  unities.secondes.counter.style.transform = (scenario % 2) === 1 ? `scale(${(5 - change) * 0.20}, 1)` : `scale(1, ${(5 - change) * 0.20})`
  unities.secondes.counter.style.transform = (scenario % 2) === 1 ? `scale(${(5 - change) * 0.20}, 1)` : `scale(1, ${(5 - change) * 0.20})`
  if (ancMinutes !== minutes) {
    unities.minutes.div.style.transform = (scenario % 2) === 1 ? `scale(${(5 - change) * 0.20}, 1)` : `scale(1, ${(5 - change) * 0.20})`
  }
  if (ancHours !== hours) {
    unities.hours.div.style.transform = (scenario % 2) === 1 ? `scale(${(5 - change) * 0.20}, 1)` : `scale(1, ${(5 - change) * 0.20})`
  }
  if (ancDays !== days) {
    unities.days.div.style.transform = (scenario % 2) === 1 ? `scale(${(5 - change) * 0.20}, 1)` : `scale(1, ${(5 - change) * 0.20})`
  }
  
  if (timer === 0) {
    ancMinutes = minutes
    ancHours = hours
    ancDays = days
    scenario = Math.floor(Math.random(2) * 2)
    scenario = 0
  }

  timer += pas

}, 25);

const compteRebours = window.document.getElementById('compte-rebours')

compteRebours.style.display = 'flex'
if (undefined !== localStorage.getItem("crX")) {
  compteRebours.style.left = Math.min(localStorage.getItem("crX") , window.innerWidth - compteRebours.offsetWidth) + 'px'
  compteRebours.style.top = localStorage.getItem("crY") + 'px'
}


window.addEventListener('beforeunload', () => {
  localStorage.setItem("crX", compteRebours.offsetLeft)
  localStorage.setItem("crY", compteRebours.offsetTop)
})

addEventListener('resize', () => {
  moveToXY(compteRebours.offsetLeft, compteRebours.offsetTop, compteRebours.offsetWidth, compteRebours.offsetHeight)
})
compteRebours.addEventListener('mousedown', (e) => {
  crClientX = e.clientX - compteRebours.offsetLeft
  crClientY = e.clientY - compteRebours.offsetTop
  isMoving = true
})
window.addEventListener('mousemove', (e) => {
  if (isMoving) {moveToXY(e.clientX - crClientX, e.clientY - crClientY, compteRebours.offsetWidth, compteRebours.offsetHeight)}
})
window.addEventListener('mouseup', (e) => isMoving = false)

function moveToXY (x, y, w, h) {
  if (x < window.scrollX) x = window.scrollX
  if (y < window.scrollY) y = window.scrollY
  if (x + w > window.innerWidth + window.scrollX) x = window.innerWidth + window.scrollX - w
  if (y + h > window.innerHeight + window.scrollY) y = window.innerHeight + window.scrollY - h
  compteRebours.style.left = x + 'px'
  compteRebours.style.top = y + 'px'
}

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
