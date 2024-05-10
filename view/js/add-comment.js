let comments = document.querySelectorAll(".group")
comments.forEach(function(comment){
    let com_button_pop_up = comment.querySelector(".func-com")
    let com_box = comment.querySelector(".comments")
    let id = com_button_pop_up.getAttribute("data-post-id")
    let button_submit = comment.querySelector(".fa-paper-plane")


    com_button_pop_up.addEventListener("click", function(){
        let popup  = comment.querySelector(".comments")
 
        if(popup.style.display == "none" || popup.style.display==""){
        popup.style.display="block"
        let input = comment.querySelector(".comment-box")
        input.focus()
        }else 
        {popup.style.display="none"
      }
    })
    button_submit.addEventListener("click", function(e){

        let input_val = comment.querySelector(".comment-box")
        
        let url = "make-comment"
        let xhr = new XMLHttpRequest();
        let data = {
            id: id,
            content:input_val.value
        }
        xhr.open("POST", url, true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              console.log("Success");
              input_val.value=""
              } else {
              // Handle errors here
              console.error('Request failed:', xhr.status, xhr.statusText);
            }
          }
        }
        xhr.send(JSON.stringify(data));
    })


}


)