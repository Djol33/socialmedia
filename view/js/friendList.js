 

 
    let url = window.location.pathname
    url = url.split("/")
 

    let data;
    if(url[1] == "my-profile"){
        data="session";
    }
    else{
        data = url[2];
    }
    let url2 = "/friend-list/data=" + data;
    document.addEventListener("DOMContentLoaded", function(){
        let xhr = new XMLHttpRequest()
        console.log(data)
        xhr.open("GET", url2, true)
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log("Success");
                    var responseData = JSON.parse(xhr.responseText);
 
                    let friendlistdiv = document.getElementById("friend-list");
                    let posttext = document.createElement("div");
                    posttext.id = "header-friends"
                    friendlistdiv.appendChild(posttext)
                    let h1 = document.createElement("h1")
                    h1.id = "h1-friends"
                    h1.innerHTML="Friends:"
                    let seemore = document.createElement("p")
                    seemore.id ="see-more-friends"
                    seemore.innerHTML = "See More"
    
                    posttext.appendChild(h1)
                    posttext.appendChild(seemore)
                    seemore.addEventListener("click", function(){allFriendList()})
                    let anchor_div = document.createElement("div")
                    anchor_div.id="anchor-div"
                    friendlistdiv.appendChild(anchor_div)
                    responseData.forEach(element => {
                       
                        let anchor = document.createElement("a")
                        anchor.href = "/user-profile/" + element.id;
                        anchor.className="friend-list-anchor"
                        
                        let newElement = document.createElement("div");
                        newElement.className = "one-friend";
                        anchor.appendChild(newElement)
                        anchor_div.appendChild(anchor)
                        let name = document.createElement("p");
                        let gradient = document.createElement("div")
                        gradient.className = "gradient"
                        anchor.appendChild(gradient)
                        name.className = "one-friend-text"
                        name.innerText = element.name
                        newElement.appendChild(name)
                        function setHeight(){
                            let widthcontainer = window.getComputedStyle(friendlistdiv).getPropertyValue("width")
                            let width = (parseFloat(widthcontainer) -125) / 4    
 
                        width = parseInt(width) + "px"
                            //newElement.style.width = width
                            //newElement.style.height = width
                            anchor.style.height = width
                            anchor.style.width =  width
                         }
                        setHeight()
                        window.addEventListener("resize", function(){
                            setHeight()
                        })

                        
                        newElement.style.backgroundImage = "url(" + element.pfp_loc + ")"
                    });

                    













                } else {
                    console.log("Request failed with status: " + xhr.status);
                }
            }
        };
 
        xhr.send(JSON.stringify());
        
    })


    function allFriendList(){
        let body = document.querySelector("body")
        
        let gray_background = document.createElement("div")
        gray_background.className ="gray_background"
        body.insertBefore(gray_background, document.querySelector("footer"))

        /* LIST OF FRIENDS SKELETON */
        let body_list_of_friends = document.createElement("div")
        body_list_of_friends.id = "allFriends"
        let header_list_of_friends = document.createElement("div")
        header_list_of_friends.id="header_list_of_friends"
        let header_item_p = document.createElement("p")
        header_item_p.id = "p_list_of_friends"
        header_item_p.innerHTML = "All Friends:"
        header_list_of_friends.appendChild(header_item_p)
        header_list_of_friends.innerHTML+='<i id = "fax" class="fa-solid fa-xmark"></i>'

        body_list_of_friends.appendChild(header_list_of_friends)
        gray_background.appendChild(body_list_of_friends)
        let fax = document.getElementById("fax")
        fax.addEventListener("click", function(){
            gray_background.remove()
        })
    
    }
    