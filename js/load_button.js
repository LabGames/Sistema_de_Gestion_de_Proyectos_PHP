document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".btn-style");

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            button.classList.add("rainbow");
            setTimeout(() => {
                button.classList.remove("rainbow");
            }, 3000);
        });
    });
});
