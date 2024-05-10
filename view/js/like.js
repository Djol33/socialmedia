let like = document.querySelectorAll('.like-button');

like.forEach(function(element) {
  element.addEventListener("click", function(e) {

    let id = element.getAttribute("data-post-id");
    let url = '/like';
    let like_emoji = element.querySelector("#like");
    if(like_emoji.classList.contains("fa-solid")){
      like_emoji.classList.remove("fa-solid")
      like_emoji.classList.add("fa-regular")
    }
    else{
      like_emoji.classList.remove("fa-regular")
      like_emoji.classList.add("fa-solid")
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          console.log("Success");
          var responseData = xhr.responseText;
          let like_field = element.querySelector(".num_of_likes");
          like_field.innerHTML=parseInt(responseData);
        } else {
          // Handle errors here
          console.error('Request failed:', xhr.status, xhr.statusText);
        }
      }
    };

    // Send the ID as JSON in the request body
    xhr.send(JSON.stringify({ id: id }));
  });
});
