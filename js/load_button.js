document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector(".btn-style");

    button.addEventListener("click", () => {
        button.classList.add("rainbow");
        setTimeout(() => {
            button.classList.remove("rainbow");
        }, 3000);
    });
});