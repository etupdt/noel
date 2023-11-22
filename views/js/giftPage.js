
let gifts 

gifts = window.document.getElementsByClassName('gift')

for (let gift of gifts) {
    gift.addEventListener("dblclick", addGiftToCady)
}

function addGiftToCady(event) {

    let giftsCookie = {}

    if (document.cookie) {
        cookieGifts = document.cookie.split("; ").find((row) => row.startsWith('gifts=')).split("=")[1];
        giftsCookie = JSON.parse(decodeURI(cookieGifts))
    }
    
    if (giftsCookie[this.id]) {
        giftsCookie[this.id]++
    } else {
        giftsCookie[this.id] = 1
    }

    document.cookie = 'gifts=' + JSON.stringify(giftsCookie)

}