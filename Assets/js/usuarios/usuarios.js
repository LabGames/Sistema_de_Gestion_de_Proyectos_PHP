listarRoles();
listar();

function listarRoles() {
  fetch(`${BASE_URL}/Rol/Listar`)
    .then((response) => {
      if (!response.ok) throw new Error("Error al cargar roles");
      return response.json();
    })
    .then((roles) => {
      const select = document.getElementById("rol");
      roles.forEach((r) => {
        const option = document.createElement("option");
        option.value = r.id;
        option.textContent = r.nombre;
        select.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error cargando roles:", error);
    });
}

function listar() {
  fetch(`${BASE_URL}/Usuarios/Listar`)
    .then((response) => response.json())
    .then((data) => {
      new DataTable("#tablaUsuarios", {
        pageLength: 5,
        data: data,
        columns: [
          { data: "nombre" },
          { data: "email" },
          {
            data: "id",
            render: function (id) {
              return `
                <button onclick="editarUsuario(${id})">Editar</button>
                <button onclick="eliminarUsuario(${id})">Eliminar</button>
            `;
            },
          },
        ],
        language: {
          url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
        },
      });
    })
    .catch((error) => console.error("Error al cargar usuarios:", error));
}

function editarUsuario(id) {
  alert("Editar usuario " + id);
}

function eliminarUsuario(id) {
  alert("Eliminar usuario " + id);
}

function registrarUsuario() {
    const name = document.getElementById("nombre").value.trim();
    const rol = document.getElementById("rol").value.trim();
    const email = document.getElementById("correo").value.trim();
    const password = document.getElementById("password").value.trim();
  
    if (!name || !rol || !email || !password) {
      alert("Todos los campos son obligatorios.");
      return;
    }
  
    const formData = new FormData();
    formData.append("name", name);
    formData.append("rol", rol);
    formData.append("email", email);
    formData.append("password", password);
  
    
    fetch(`${BASE_URL}/Usuarios/Registrar`, {
      method: "POST",
      body: formData
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error en la respuesta del servidor");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          alert("Usuario registrado correctamente ✅");
          document.getElementById("formRegistrarUsuario").reset();
          listar();
        } else {
          alert("Error: " + (data.message || "No se pudo registrar el usuario"));
        }
      })
      .catch((error) => console.error("Error al registrar usuarios:", error));
  }
  