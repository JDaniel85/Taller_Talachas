<script>
let items = [];

function actualizarResumen() {
    let total = 0;
    items.forEach(i => total += i.total);

    if (items.length === 0) {
        document.getElementById('resumen').innerHTML = "No hay ítems agregados";
    } else {
        document.getElementById('resumen').innerHTML = 
            `Total actual: <strong>$${total.toFixed(2)}</strong>`;
    }
}

function renderItems() {
    const cont = document.getElementById('items');
    cont.innerHTML = '';

    items.forEach((item, index) => {
        cont.innerHTML += `
            <div class="border rounded p-2 mb-2 bg-white">
                <strong>${item.tipo === 'servicio' ? 'Servicio' : 'Refacción'}:</strong> 
                ${item.nombre} - Cant: ${item.cantidad} - $${item.total.toFixed(2)}
                <button type="button" class="btn btn-sm btn-danger float-end" onclick="eliminarItem(${index})">
                    Eliminar
                </button>
            </div>
        `;
    });

    actualizarResumen();
}

function addServicio() {
    const sel = document.getElementById('servicio_select');
    const id = sel.value;
    if (!id) return;

    const precio = parseFloat(sel.options[sel.selectedIndex].dataset.precio);
    const nombre = sel.options[sel.selectedIndex].textContent;

    items.push({
        tipo: 'servicio',
        id: id,
        nombre: nombre,
        cantidad: 1,
        precio_unitario: precio,
        total: precio
    });

    renderItems();
}

function addRefaccion() {
    const sel = document.getElementById('refaccion_select');
    const id = sel.value;
    if (!id) return;

    const precio = parseFloat(sel.options[sel.selectedIndex].dataset.precio);
    const stock = parseInt(sel.options[sel.selectedIndex].dataset.stock);
    let cantidad = parseInt(document.getElementById('ref_cant').value);

    if (cantidad > stock) {
        alert("No hay stock suficiente.");
        return;
    }

    const nombre = sel.options[sel.selectedIndex].textContent;

    items.push({
        tipo: 'refaccion',
        id: id,
        nombre: nombre,
        cantidad: cantidad,
        precio_unitario: precio,
        total: precio * cantidad
    });

    renderItems();
}

function eliminarItem(index) {
    items.splice(index, 1);
    renderItems();
}

// ✅ Enviar items como JSON al backend
document.getElementById('facturaForm').addEventListener('submit', function() {
    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'items_json';
    hidden.value = JSON.stringify(items);
    this.appendChild(hidden);
});
</script>
