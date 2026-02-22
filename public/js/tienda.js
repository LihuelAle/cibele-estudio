let seleccionados = {};

function toggleProducto(card) {
    if (card.dataset.stock == 0) return;
    const id = card.dataset.id;
    if (seleccionados[id]) {
        delete seleccionados[id];
        card.classList.remove('seleccionado');
    } else {
        seleccionados[id] = { nombre: card.dataset.nombre, precio: parseFloat(card.dataset.precio) };
        card.classList.add('seleccionado');
    }
    actualizarBarra();
}

function actualizarBarra() {
    const ids = Object.keys(seleccionados);
    const bar = document.getElementById('seleccionBar');
    if (ids.length === 0) { bar.classList.remove('visible'); return; }
    bar.classList.add('visible');
    document.getElementById('countLabel').textContent = ids.length;
    const nombres = ids.map(id => seleccionados[id].nombre);
    document.getElementById('nombresLabel').textContent =
        nombres.length > 2 ? nombres.slice(0,2).join(', ') + '...' : nombres.join(', ');
}

function abrirModalPedido() {
    const ids = Object.keys(seleccionados);
    const resumen = document.getElementById('resumenItems');
    resumen.innerHTML = '';
    ids.forEach(id => {
        const d = document.createElement('div');
        d.className = 'resumen-item';
        d.innerHTML = `<span>${seleccionados[id].nombre}</span><span class="resumen-precio">$${seleccionados[id].precio.toFixed(2)}</span>`;
        resumen.appendChild(d);
    });
    document.getElementById('productosIdsInput').value = ids.join(',');
    abrirModal('modalPedido');
}

function abrirContacto(e) { e.preventDefault(); abrirModal('modalContacto'); }
function abrirModal(id) { document.getElementById(id).classList.add('open'); document.body.style.overflow = 'hidden'; }
function cerrarModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow = ''; }
function cerrarModalFuera(e, id) { if (e.target === document.getElementById(id)) cerrarModal(id); }
document.addEventListener('keydown', e => { if (e.key === 'Escape') { cerrarModal('modalPedido'); cerrarModal('modalContacto'); } });