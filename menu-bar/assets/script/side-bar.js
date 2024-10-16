const body = document.querySelector("body"),
        sideBar = body.querySelector(".sidebar"),
        barButton = body.querySelector(".menu-bar-button");

barButton.addEventListener("click", () => {
    sideBar.classList.toggle("close");
});


