let notification = document.querySelector(".fa-bell");
let notificationbox = document.querySelector(".notification-box");

notification.addEventListener("click", function (e){


    notificationbox.innerHTML =""
    if(notificationbox.style.display=="none"    || notificationbox.style.display===""){
        xhr = new XMLHttpRequest();
        let url = "pending-friend-request"
        xhr.open("GET", url, true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest")
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {

                    let res = JSON.parse(xhr.responseText)
                    console.log(               res )
                    if(res.length !=0){
                    res.forEach(function (e){
                        console.log(e.name)
                        notificationbox.innerHTML +=
                            ("<div class='single-notification-holder' id='"+e.id+"'>"+
                                "<img class='pfp-loc-notification' src='" + e["pfp_loc"] + "'/>"+""
                                + e.name +"<div><i data-friend ='" +e.id_friend +"'   class=\"fa-solid fa-check\"></i>   <i data-friend ='" + e.id_friend+"' class=\"fa-solid fa-xmark\"></i></div></div> "
                            )
                    })}
                    else{
                        notificationbox.innerHTML="Nothing new here"
                    }

                    let accept = document.querySelectorAll(".fa-check");

                    let decline = document.querySelectorAll(".fa-xmark");
                    accept.forEach(function (e) {
                        console.log(e)
                        e.addEventListener("click", function(c){
                           let id = e.getAttribute("data-friend")
                            data = {action:"accept",id:id}
                            xhr = new XMLHttpRequest();
                           xhr.open("POST", "follow", true)
                           xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                           xhr.onreadystatechang = function() {
                               if(xhr.readyState ===4){
                                   if(xhr.status==200){
                                       console.log("succes");
                                   }
                               }
                           }
                           xhr.send(JSON.stringify(data))
                            removeElement(e, notificationbox);
                        })

                    })

                    decline.forEach(function (e) {
                        console.log(e)
                        e.addEventListener("click", function(c){
                            let id = e.getAttribute("data-friend")
                            data = {action:"decline",id:id}
                            xhr = new XMLHttpRequest();
                            xhr.open("POST", "follow", true)
                            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                            xhr.onreadystatechang = function() {
                                if(xhr.readyState ===4){
                                    if(xhr.status==200){
                                        console.log("succes");
                                    }
                                }
                            }
                            xhr.send(JSON.stringify(data))
                            removeElement(e, notificationbox);
                        })

                    })



                }
            }

        };
        xhr.send();
        notificationbox.style.display="block";

    }
    else {
        notificationbox.style.display="none";

    }

})

function removeElement(element, parent){
    let elem =element.parentElement.parentElement;
    elem.remove();

if(parent.innerHTML==  ""){
        parent.innerHTML="Nothing new here"
    }
}
