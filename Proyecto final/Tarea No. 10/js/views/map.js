const incidencias = [
  {
    id: 1,
    title: "Robo en Sector X",
    type: "robo",
    x: 22,
    y: 36,
    when: "Hoy 08:12",
    province: "Provincia A",
    municipality: "Municipio B",
    muertos: 0,
    heridos: 0,
    perdida: 15000,
    desc: "Se reporta hurto a mano armada en la vía pública.",
  },
  {
    id: 2,
    title: "Accidente Carretera Y",
    type: "accidente",
    x: 60,
    y: 48,
    when: "Hoy 02:40",
    province: "Provincia C",
    municipality: "Municipio D",
    muertos: 1,
    heridos: 3,
    perdida: 50000,
    desc: "Colisión múltiple; tránsito detenido momentáneamente.",
  },
  {
    id: 3,
    title: "Pelea en Barrio Z",
    type: "pelea",
    x: 45,
    y: 22,
    when: "Hace 3h",
    province: "Provincia A",
    municipality: "Municipio E",
    muertos: 0,
    heridos: 2,
    perdida: 0,
    desc: "Conflicto entre dos grupos; intervención de la policía.",
  },
  {
    id: 4,
    title: "Robo en tienda",
    type: "robo",
    x: 24,
    y: 40,
    when: "Hace 5h",
    province: "Provincia A",
    municipality: "Municipio B",
    muertos: 0,
    heridos: 1,
    perdida: 8000,
    desc: "Robo con intimidación dentro de comercio.",
  },
  {
    id: 5,
    title: "Accidente motocicleta",
    type: "accidente",
    x: 78,
    y: 62,
    when: "Ayer",
    province: "Provincia F",
    municipality: "Municipio G",
    muertos: 0,
    heridos: 2,
    perdida: 7000,
    desc: "Motociclista perdió el control y colisionó.",
  },
];

const mapEl = document.getElementById("map");
const filterType = document.getElementById("filterType");
const toggleCluster = document.getElementById("toggleCluster");
const searchInput = document.getElementById("search");
const btnSearch = document.getElementById("btnSearch");

let currentViewIncidents = [...incidencias];
let activeItem = null;

function clearMap() {
  // elimina markers y clusters
  Array.from(mapEl.querySelectorAll(".marker, .cluster")).forEach((n) =>
    n.remove()
  );
}

// distancia en px entre dos elementos
function pixelDist(a, b) {
  return Math.hypot(a.x - b.x, a.y - b.y);
}

function renderMarkers() {
  clearMap();
  // calcula posiciones reales en pixels
  const rect = mapEl.getBoundingClientRect();
  const items = currentViewIncidents.map((it) => {
    return {
      ...it,
      px: rect.width * (it.x / 100),
      py: rect.height * (it.y / 100),
    };
  });

  if (toggleCluster.checked) {
    // versión simple de clustering: agrupa por proximidad (50px)
    const clusters = [];
    const used = new Set();
    for (let i = 0; i < items.length; i++) {
      if (used.has(i)) continue;
      const group = [items[i]];
      used.add(i);
      for (let j = i + 1; j < items.length; j++) {
        if (used.has(j)) continue;
        if (pixelDist(items[i], items[j]) < 50) {
          group.push(items[j]);
          used.add(j);
        }
      }
      clusters.push(group);
    }

    clusters.forEach((group) => {
      if (group.length === 1) {
        // dibujar marcador normal
        const it = group[0];
        addMarkerElement(it);
      } else {
        // dibujar cluster
        const avgX = group.reduce((s, g) => s + g.px, 0) / group.length;
        const avgY = group.reduce((s, g) => s + g.py, 0) / group.length;
        addClusterElement(avgX, avgY, group);
      }
    });
  } else {
    // sin cluster: pintar todos
    items.forEach(addMarkerElement);
  }
}

function addMarkerElement(it) {
  const el = document.createElement("div");
  el.className = "marker type-" + it.type;
  el.style.left = it.x + "%";
  el.style.top = it.y + "%";
  el.title = it.title;
  el.setAttribute("data-id", it.id);
  // texto corto dentro del marcador (opcional)
  el.textContent = it.type[0].toUpperCase();
  el.addEventListener("click", (e) => {
    e.stopPropagation();
    openModalFor(it.id);
  });
  mapEl.appendChild(el);
}

function addClusterElement(px, py, group) {
  const el = document.createElement("div");
  el.className = "cluster";
  // posición en px convertida a % para el contenedor
  const rect = mapEl.getBoundingClientRect();
  const left = (px / rect.width) * 100;
  const top = (py / rect.height) * 100;
  el.style.left = left + "%";
  el.style.top = top + "%";
  el.innerHTML = `<strong>${group.length}</strong>&nbsp;inc.`;
  el.addEventListener("click", () => {
    toggleCluster.checked = false;
    const ids = new Set(group.map((g) => g.id));
    currentViewIncidents = incidencias.filter((i) => ids.has(i.id));
    renderMarkers();
  });
  mapEl.appendChild(el);
}

// Modal functions
function openModalFor(id) {
  const it = incidencias.find((i) => i.id === id);
  if (!it) return;
  activeItem = it;
  document.getElementById("modalTitle").textContent = `${
    it.title
  } • ${capitalize(it.type)}`;
  document.getElementById(
    "modalWhen"
  ).textContent = `${it.when} • ${it.province} • ${it.municipality}`;
  document.getElementById("modalDesc").textContent = it.desc;
  document.getElementById("modalMuertos").textContent = it.muertos;
  document.getElementById("modalHeridos").textContent = it.heridos;
  document.getElementById("modalPerdida").textContent = `RD$ ${numberWithCommas(
    it.perdida
  )}`;
  document.getElementById("modal").style.display = "flex";
  document.getElementById("modal").setAttribute("aria-hidden", "false");
}

function closeModal() {
  document.getElementById("modal").style.display = "none";
  document.getElementById("modal").setAttribute("aria-hidden", "true");
}

function goToIncident() {
  if (activeItem) {
    location.href = "incident.html";
  } else {
    location.href = "incident.html";
  }
}

// utilidades
function capitalize(s) {
  return s.charAt(0).toUpperCase() + s.slice(1);
}
function numberWithCommas(x) {
  return String(x).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// filtros y búsqueda
function applyFilters() {
  const type = filterType.value;
  const q = searchInput.value.trim().toLowerCase();
  currentViewIncidents = incidencias.filter((i) => {
    if (type !== "all" && i.type !== type) return false;
    if (
      q &&
      !i.title.toLowerCase().includes(q) &&
      !i.desc.toLowerCase().includes(q)
    )
      return false;
    return true;
  });
  renderMarkers();
}

// eventos UI
filterType.addEventListener("change", () => {
  applyFilters();
});
toggleCluster.addEventListener("change", () => {
  applyFilters();
});
btnSearch.addEventListener("click", () => {
  applyFilters();
});
searchInput.addEventListener("keydown", (e) => {
  if (e.key === "Enter") applyFilters();
});

// click fuera del modal cierra
document.getElementById("modal").addEventListener("click", (e) => {
  if (e.target.id === "modal") closeModal();
});

// resize -> re-renderizar posiciones
window.addEventListener("resize", () => {
  renderMarkers();
});

// render inicial
applyFilters();
