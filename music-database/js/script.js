function getAlbumImage() {
   var a = document.getElementById("shirt");
   var selectedAlbum = a.options[a.selectedIndex].value;
   var albumImage = '/img/img_placeholder.png';

   if(selectedAlbum == 'Avenged Sevenfold') {
    albumImage = 'img/AvengedSevenfold.jpg'
   }
   else if(selectedAlbum == 'Nightmare') {
    albumImage = 'img/Nightmare.jpg';
   }
   else if(selectedAlbum == 'Candlebox') {
    albumImage = 'img/Candlebox.jpg';
   }
   else if(selectedAlbum == 'Happy Pills') {
    albumImage = 'img/candleboxHappyPills.jpg';
   }
   else if(selectedAlbum == 'Hats Off to the Bull') {
    albumImage = 'img/chevelle.jpg';
   }
   else if(selectedAlbum == 'The Sickness') {
    albumImage = 'img/TheSickness.jpg';
   }
   else if(selectedAlbum == 'Hysteria') {
    albumImage = 'img/Hysteria.jpg';
   }
   else if(selectedAlbum == 'Asking Alexandria') {
    albumImage = 'img/askingAlexandria.jpg';
   }
   else if(selectedAlbum == 'Evans Blue') {
    albumImage = 'img/evansBlue.jpg';
   }
   else if(selectedAlbum == 'Phobia') {
    albumImage = 'img/breakingBenjamin.jpg';
   }
   else if(selectedAlbum == 'Cryptic Writings') {
    albumImage = 'img/megadeth.jpg';
   }
   else if(selectedAlbum == 'Black Album') {
    albumImage = 'img/metallica.jpg';
   }
   else if(selectedAlbum == 'Alice in Chains') {
    albumImage = 'img/aliceinchains.jpg';
   }
   else if(selectedAlbum == 'Get off on the Pain') {
    albumImage = 'img/garyallan.jpg';
   }
   else if(selectedAlbum == 'Night Train') {
    albumImage = 'img/nightTrain.jpg';
   }
   else
    albumImage = 'img/tshirt.jpg';

   return albumImage;

}

function showShirtImage() {
    var imagePath = getAlbumImage();
    document.getElementById("album-image").src = imagePath;
    console.log(imagePath);
    }

function getChosenTshirt() {
   var shirtImageTitle = document.getElementById('shirt-image-title').innerHTML;
   console.log(shirtImageTitle);
   var shirtImage = 'img/tshirt.jpg';
   if(shirtImageTitle == 'The Avenged Sevenfold Shirt') {
      shirtImage = 'img/AvengedSevenfold.jpg'
     }
     else if(shirtImageTitle== 'The Nightmare Shirt') {
      shirtImage = 'img/Nightmare.jpg';
     }
     else if(shirtImageTitle == 'The Candlebox Shirt') {
      shirtImage = 'img/Candlebox.jpg';
     }
     else if(shirtImageTitle == 'The Happy Pills Shirt') {
      shirtImage = 'img/candleboxHappyPills.jpg';
     }
     else if(shirtImageTitle == 'The Hats Off to the Bull Shirt') {
      shirtImage = 'img/chevelle.jpg';
     }
     else if(shirtImageTitle == 'The The Sickness Shirt') {
      shirtImage = 'img/TheSickness.jpg';
     }
     else if(shirtImageTitle == 'The Hysteria Shirt') {
      shirtImage = 'img/Hysteria.jpg';
     }
     else if(shirtImageTitle == 'The Asking Alexandria Shirt') {
      shirtImage = 'img/askingAlexandria.jpg';
     }
     else if(shirtImageTitle == 'The Evans Blue Shirt') {
      shirtImage = 'img/evansBlue.jpg';
     }
     else if(shirtImageTitle == 'The Phobia Shirt') {
      shirtImage = 'img/breakingBenjamin.jpg';
     }
     else if(shirtImageTitle == 'The Cryptic Writings Shirt') {
      shirtImage = 'img/megadeth.jpg';
     }
     else if(shirtImageTitle == 'The Black Album Shirt') {
      shirtImage = 'img/metallica.jpg';
     }
     else if(shirtImageTitle == 'The Alice in Chains Shirt') {
      shirtImage = 'img/aliceinchains.jpg';
     }
     else if(shirtImageTitle == 'The Get off on the Pain Shirt') {
      shirtImage = 'img/garyallan.jpg';
     }
     else if(shirtImageTitle == 'The Night Train Shirt') {
      shirtImage = 'img/nightTrain.jpg';
     }
     else
     shirtImage = 'img/tshirt.jpg';
  
     return shirtImage;
}

function showShirtImageInConfirmation() {
   var imagePath = getChosenTshirt();
   document.getElementById("shirt-image").src = imagePath;
   console.log(imagePath);
   }