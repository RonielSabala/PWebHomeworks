const btnLogin = document.getElementById("btnLogin");
const btnRegister = document.getElementById("btnRegister");
const btnQuickSuper = document.getElementById("btnQuickSuper");

btnLogin.addEventListener("click", () => {
  const role = document.getElementById("role").value;
  const email = document.getElementById("email").value.trim();
  const pass = document.getElementById("pass").value.trim();

  if (!email || !pass) {
    alert("Ingresa correo y contraseña (simulado).");
    return;
  }

  // Redirección simple según rol
  if (role === "reportero") {
    // panel para reporteros
    location.href = "user/dashboard.html";
  } else if (role === "usuario") {
    // panel para usuarios (solo visualización)
    location.href = "viewer/dashboard.html";
  } else if (role === "super") {
    // validador
    location.href = "super/index.html";
  } else {
    // fallback
    location.href = "index.html";
  }
});

btnRegister.addEventListener(
  "click",
  () => (location.href = "auth/register.html")
);
btnQuickSuper.addEventListener(
  "click",
  () => (location.href = "super/index.html")
);
