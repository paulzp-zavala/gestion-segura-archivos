// MODO CLARO / OSCURO
const body = document.body;
const toggle = document.getElementById("themeToggle");

if (toggle) {
    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark-mode");
    }

    toggle.addEventListener("click", () => {
        body.classList.toggle("dark-mode");

        localStorage.setItem(
            "theme",
            body.classList.contains("dark-mode") ? "dark" : "light"
        );
    });
}

// BUSCADOR EN TIEMPO REAL
const buscador = document.getElementById("buscador");

if (buscador) {
    buscador.addEventListener("keyup", function () {
        const texto = this.value.toLowerCase();

        document.querySelectorAll("#tablaArchivos tbody tr").forEach((fila) => {
            fila.style.display = fila.innerText.toLowerCase().includes(texto)
                ? ""
                : "none";
        });
    });
}

// DRAG & DROP + PREVIEW
const dropArea = document.getElementById("dropArea");
const archivoInput = document.getElementById("archivoInput");
const uploadText = document.getElementById("uploadText");
const previewBox = document.getElementById("previewBox");

if (dropArea && archivoInput) {
    ["dragenter", "dragover"].forEach((evento) => {
        dropArea.addEventListener(evento, (e) => {
            e.preventDefault();
            dropArea.classList.add("drag-over");
        });
    });

    ["dragleave", "drop"].forEach((evento) => {
        dropArea.addEventListener(evento, (e) => {
            e.preventDefault();
            dropArea.classList.remove("drag-over");
        });
    });

    dropArea.addEventListener("drop", (e) => {
        const archivos = e.dataTransfer.files;

        if (archivos.length > 0) {
            archivoInput.files = archivos;
            mostrarPreview(archivos[0]);
        }
    });

    archivoInput.addEventListener("change", () => {
        if (archivoInput.files.length > 0) {
            mostrarPreview(archivoInput.files[0]);
        }
    });
}

function mostrarPreview(archivo) {
    if (!previewBox || !uploadText) return;

    const tamanoKB = (archivo.size / 1024).toFixed(2);
    const tipo = archivo.type;

    uploadText.textContent = archivo.name;

    previewBox.innerHTML = "";

    const contenedor = document.createElement("div");
    contenedor.className = "preview-content";

    if (tipo.startsWith("image/")) {
        const img = document.createElement("img");
        img.src = URL.createObjectURL(archivo);
        img.alt = "Vista previa";
        contenedor.appendChild(img);
    } else {
        const icono = document.createElement("i");
        icono.className = "fa-solid fa-file-pdf preview-icon";
        contenedor.appendChild(icono);
    }

    const info = document.createElement("p");
    info.innerHTML = `<strong>${archivo.name}</strong><br>${tamanoKB} KB`;

    contenedor.appendChild(info);
    previewBox.appendChild(contenedor);
}

// CONFIRMACIÓN ELEGANTE AL ELIMINAR
document.querySelectorAll(".delete-link").forEach((link) => {
    link.addEventListener("click", function (e) {
        e.preventDefault();

        const url = this.href;

        Swal.fire({
            title: "¿Eliminar archivo?",
            text: "Esta acción no se puede deshacer.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            cancelButtonColor: "#64748b",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});

// TOAST AUTOMÁTICO PARA MENSAJES
const toastMessage = document.querySelector(".toast-message");

if (toastMessage) {
    setTimeout(() => {
        toastMessage.style.opacity = "0";
        toastMessage.style.transform = "translateY(-10px)";

        setTimeout(() => {
            toastMessage.remove();
        }, 400);
    }, 3500);
}

// CONTADOR ANIMADO
document.querySelectorAll(".counter").forEach((counter) => {
    const target = parseInt(counter.dataset.target || "0", 10);
    let current = 0;

    if (target === 0) {
        counter.textContent = "0";
        return;
    }

    const increment = Math.ceil(target / 30);

    const updateCounter = () => {
        current += increment;

        if (current >= target) {
            counter.textContent = target;
        } else {
            counter.textContent = current;
            requestAnimationFrame(updateCounter);
        }
    };

    updateCounter();
});

/*=========================================
=            GRÁFICO DASHBOARD            =
=========================================*/

const grafico = document.getElementById("graficoArchivos");

if (grafico && typeof Chart !== "undefined") {

    new Chart(grafico, {

        type: "doughnut",

        data: {

            labels: ["PDF", "Imágenes"],

            datasets: [{

                data: [

                    chartData.pdf,

                    chartData.imagenes

                ],

                borderWidth: 2

            }]

        },

        options: {

            responsive: true,

            plugins: {

                legend: {

                    position: "bottom"

                }

            }

        }

    });

}