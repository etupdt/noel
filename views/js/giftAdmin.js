
// import {Cropper} from '/views/js/cropperjs';

const image = document.getElementById('imageName_image');
const cropper = new Cropper(image, {
    aspectRatio: 4 / 4,
    crop(event) {
      console.log(event.detail.x);
      console.log(event.detail.y);
      console.log(event.detail.width);
      console.log(event.detail.height);
      console.log(event.detail.rotate);
      console.log(event.detail.scaleX);
      console.log(event.detail.scaleY);
    },
  });

addEventListener('click', () => {
    console.log('toto')
    cropper.rotate(-90)
    cropper.scaleX = 0.5
})
