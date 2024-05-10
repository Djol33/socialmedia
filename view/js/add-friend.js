let pag = document.getElementById("pagination")
pag.addEventListener("click", function () {

})
let groups = document.querySelectorAll(".group");
groups.forEach(function(group){
    let foll = group.querySelector(".follow")
    if(foll!==null){
        foll.addEventListener("click", function(e){
            ajax(foll)
        })
    }


})

function ajax(follow){
    let url ="follow";
    let id_post = follow.getAttribute("data-post-id");
    let data = {
        id_post :id_post,
        action:"follow"
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {

                var response = xhr.responseText;
                ajax_update_js(groups, response)



            }
        }

    };
    xhr.send(JSON.stringify(data))
}
function ajax_update_js(groups, response) {
    let xhr2 = new XMLHttpRequest();
    xhr2.open("POST", "all-posts", true);
    xhr2.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    let page=1
    if((window.location.pathname).toString().split("/")[2]){

        page =(window.location.pathname).toString().split("/")[2];

    }
    else {
        let page = 1
    }
    let data = {
        action: "updaterow",
        page:page
    };

    xhr2.onreadystatechange = function () {
        if (xhr2.readyState === 4 && xhr2.status === 200) {
            let jsonResponse = JSON.parse(xhr2.responseText);
              jsonResponse.forEach(function (e) {

                let vari = document.querySelectorAll(".follow")
                vari.forEach(function(c){
                    if(c.getAttribute("data-post-id") == e.id){
                        if(e.i_follow== null){
                            c.innerHTML="Follow";

                        }
                        else if(e.i_follow == 1){
                            c.innerHTML="PENDING"
                        }

                    }
                })


            });
        }
    };

    xhr2.send(JSON.stringify(data));
}