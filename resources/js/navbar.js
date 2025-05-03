const btn = document.querySelector(".user-btn");
const modal = document.querySelector(".user-modal");

btn.addEventListener("click", () => {
    if (modal.classList.contains("flex")) {
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    } else {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }
});
