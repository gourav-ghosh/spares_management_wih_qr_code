document.addEventListener("click",function (e){
    if(e.target.classList.contains("gallery-item")){
      const media_type = e.target.getAttribute("media_type");

      if(media_type == "image"){
            const src = e.target.getAttribute("val");
            document.querySelector(".modal-img").src = src;
            document.getElementById("media_img").style.display = "block";
            document.getElementById("media_vid").style.display = "none";
            document.getElementById("exampleModalLabel").textContent = "Image Proof";
      }

      if(media_type == "video"){
            const src = e.target.getAttribute("val");
            document.querySelector(".modal-vid").src = src;
            document.getElementById("media_img").style.display = "none";
            document.getElementById("media_vid").style.display = "block";
            document.getElementById("exampleModalLabel").textContent = "Video Proof";
      }

      const myModal = new bootstrap.Modal(document.getElementById('gallery-modal'));
      myModal.show();

    }
  }) 