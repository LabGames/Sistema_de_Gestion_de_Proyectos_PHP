$(document).ready(function () {
  listar();
});
let tabla;

function showTab(tabId, event) {
  document
    .querySelectorAll(".tab-content")
    .forEach((c) => c.classList.remove("active"));
  document
    .querySelectorAll(".tab")
    .forEach((t) => t.classList.remove("active"));
  document.getElementById(tabId).classList.add("active");
  event.target.classList.add("active");
}

function listar() {
  const formData = new FormData();
  formData.append("id", clienteId);
  fetch(`${BASE_URL}/Contactos/Listar`, { method: "POST", body: formData })
    .then((response) => response.json())
    .then((data) => {
      if (tabla) {
        tabla.clear();
        tabla.rows.add(data);
        tabla.draw();
      } else {
        tabla = new DataTable("#tablaContactos", {
          pageLength: 5,
          lengthMenu: [5, 10, 25, 50],
          data: data,
          columns: [
            { data: "nombre" },
            { data: "correo" },
            {
              data: "telefono",
            },
            {
              data: null,
              render: function (row) {
                return `
                      <button title="Editar" class="btn-accion btn-editar" onclick="editarContacto(${row.id})">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </button>
                      <button title="Eliminar" class="btn-accion btn-eliminar" onclick="eliminarContacto(${row.id})">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    `;
              },
            },
          ],
          language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
            emptyTable: "No hay datos registrados",
          },
        });
      }
    })
    .catch((error) => console.error("Error al cargar contactos:", error));
}

function editarContacto(id) {
  const modal = document.getElementById("contactoModal");
  const formData = new FormData();
  formData.append("id", id);

  fetch(`${BASE_URL}/Contactos/ObtenerContacto`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((cliente) => {
      document.getElementById("id_user").value = cliente.user_id;
      document.getElementById("id_cliente").value = cliente.id;
      document.getElementById("nombre_modal").value = cliente.nombre_cliente;
      document.getElementById("empresa_modal").value = cliente.empresa;
      document.getElementById("rubro_modal").value = cliente.rubro;
      document.getElementById("estado_modal").value = cliente.estado_id;

      listarContactos(id, cliente.contacto_principal);

      modal.classList.add("show");
    })
    .catch((error) => console.error("Error al obtener usuario:", error));
}
