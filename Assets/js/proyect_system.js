document.addEventListener("DOMContentLoaded", () => {
    const BASE_URL = "<?= BASE_URL ?>";

    fetch(BASE_URL + "/Listar_Tipos")
        .then(res => res.json())
        .then(data => {
            let select = document.querySelector("select[name='project_type']");
            select.innerHTML = "";
            data.forEach(tipo => {
                let opt = document.createElement("option");
                opt.value = tipo.id;
                opt.textContent = tipo.nombre;
                select.appendChild(opt);
            });
        });

    fetch(BASE_URL + "/Listar_Estados")
        .then(res => res.json())
        .then(data => {
            let select = document.querySelector("select[name='state']");
            select.innerHTML = "";
            data.forEach(estado => {
                let opt = document.createElement("option");
                opt.value = estado.id;
                opt.textContent = estado.nombre;
                select.appendChild(opt);
            });
        });
});
