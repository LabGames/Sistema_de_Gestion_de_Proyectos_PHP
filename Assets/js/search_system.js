document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search_proyect");
    const filterState = document.getElementById("filter_state");
    const filterDate  = document.getElementById("filter_date");
    const rows = document.querySelectorAll(".table-body tr");

    function filterProjects() {
        const searchText   = searchInput.value.toLowerCase();
        const selectedState = filterState.value;
        const selectedDate  = filterDate.value;

        rows.forEach(row => {
            const name = row.querySelector(".proyect-title").textContent.toLowerCase();
            const status = row.querySelector(".proyect-status").textContent.trim();
            const startDate = row.querySelector(".proyect-body p:nth-child(2)").textContent.replace("Inicio:", "").trim();

            let match = true;

            if (searchText && !name.includes(searchText)) match = false;
            if (selectedState && status !== selectedState) match = false;
            if (selectedDate && startDate !== selectedDate) match = false;

            row.style.display = match ? "" : "none";
        });
    }

    searchInput.addEventListener("input", filterProjects);
    filterState.addEventListener("change", filterProjects);
    filterDate.addEventListener("change", filterProjects);
});
