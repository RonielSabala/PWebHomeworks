document.getElementById("btnCreate").addEventListener("click", () => {
  alert("Cuenta creada. Serás llevado al panel.");
  window.location = "/app/user/dashboard.html";
});
document
  .getElementById("btnBack")
  .addEventListener("click", () => (window.location = "../../index.html"));
