let profile = document.querySelector("#profile")
profile.addEventListener("click", function(e){
    let popup = profile.querySelector(".profile_functions");
    let computedStyle = window.getComputedStyle(popup); // Get the computed style

    if (computedStyle.display === "none") {
        popup.style.display = "block";
    } else {
        popup.style.display = "none";
    }
});
