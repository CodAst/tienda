// assets/js/funciones.js

document.addEventListener("DOMContentLoaded", function () {
    console.log("JS personalizado cargado correctamente.");
});

document.addEventListener("DOMContentLoaded", function () {
    const btn = document.querySelector("form button[type='submit']");
    btn.addEventListener("click", function (e) {
        e.preventDefault(); // Evita el envío normal del formulario

        alert("📦 Tu pedido ha sido registrado y está pendiente de pago.");

        // Redirigir al index.php después de la alerta
        window.location.href = "../index.php";
    });
});