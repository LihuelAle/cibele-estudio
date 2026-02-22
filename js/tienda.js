// Estado de selección
let seleccionados = {};

// Cargar productos al iniciar
document.addEventListener('DOMContentLoaded', async () => {
    await cargarProductos();
    document.getElementById('currentYear').textContent = new Date().getFullYear();
});

async function cargarProductos() {
    const { data: productos, error } = await supabase
        .from('productos')
        .select('*')
        .eq('activo', true)
        .order('creado_en', { ascending: false });

    if (error) {
        console.error('Error cargando productos:', error);
        return;
    }

    const grid = document.getElementById('productosGrid');
    grid.innerHTML = productos.map(p => `
        <div class="producto-card" data-id="${p.id}" data-nombre="${p.nombre}" data-precio="${p.precio}" data-stock="${p.cantidad_disponible}" onclick="toggleProducto(this)">
            <div class="check-badge">✓</div>
            ${p.imagen 
                ? `<img class="producto-img" src="${p.imagen}" alt="${p.nombre}">`
                : `<div class="imagen-placeholder">🌸<span>Sin imagen</span></div>`
            }
            <div class="producto-info">
                <h3>${p.nombre}</h3>
                <p class="producto-desc">${p.descripcion || ''}</p>
                <div class="producto-footer">
                    <span class="precio">$${Number(p.precio).toFixed(2)}</span>
                    ${p.cantidad_disponible > 0 
                        ? '<span class="stock-pill stock-ok">Disponible ✓</span>' 
                        : '<span class="stock-pill stock-no">Agotado</span>'}
                </div>
            </div>
            ${p.cantidad_disponible <= 0 ? '<div class="agotado-overlay">Sin stock 🌙</div>' : ''}
        </div>
    `).join('');
}

// Funciones de selección (idénticas a tu original)
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

// Modal pedido
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

// Envío del formulario de pedido
document.getElementById('pedidoForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const ids = document.getElementById('productosIdsInput').value.split(',').map(Number);
    const nombre = document.getElementById('nombre').value.trim();
    const apellido = document.getElementById('apellido').value.trim();
    const telefono = document.getElementById('telefono').value.trim();
    const email = document.getElementById('email').value.trim();
    const direccion = document.getElementById('direccion').value.trim();
    const comentarios = document.getElementById('comentarios').value.trim();

    if (!nombre || !telefono) {
        mostrarError('Nombre y teléfono son obligatorios');
        return;
    }

    // Obtener productos completos para calcular total
    const { data: productos, error: prodError } = await supabase
        .from('productos')
        .select('*')
        .in('id', ids);

    if (prodError || !productos) {
        mostrarError('Error al verificar productos');
        return;
    }

    // Validar stock
    for (let prod of productos) {
        if (prod.cantidad_disponible < 1) {
            mostrarError(`Stock insuficiente para ${prod.nombre}`);
            return;
        }
    }

    // Calcular total
    const total = productos.reduce((sum, p) => sum + p.precio, 0);

    // Insertar pedido
    const nombreCompleto = apellido ? `${nombre} ${apellido}` : nombre;
    const direccionFinal = direccion + (comentarios ? `\n\nComentarios: ${comentarios}` : '');

    const { data: pedido, error: pedidoError } = await supabase
        .from('pedidos')
        .insert([{
            email_cliente: email || 'sin-email@cibele.com',
            nombre_cliente: nombreCompleto,
            telefono: telefono,
            direccion: direccionFinal,
            total: total,
            estado: 'pendiente'
        }])
        .select();

    if (pedidoError) {
        mostrarError('Error al crear el pedido');
        console.error(pedidoError);
        return;
    }

    const pedidoId = pedido[0].id;

    // Insertar detalles y reducir stock
    for (let prod of productos) {
        await supabase
            .from('detalles_pedido')
            .insert([{
                pedido_id: pedidoId,
                producto_id: prod.id,
                cantidad: 1,
                precio_unitario: prod.precio
            }]);

        await supabase
            .from('productos')
            .update({ cantidad_disponible: prod.cantidad_disponible - 1 })
            .eq('id', prod.id);
    }

    // Limpiar selección y redirigir
    seleccionados = {};
    actualizarBarra();
    cerrarModal('modalPedido');
    window.location.href = `confirmacion.html?pedido_id=${pedidoId}`;
});

// Funciones de modal (idénticas)
function abrirContacto(e) { e.preventDefault(); abrirModal('modalContacto'); }
function abrirModal(id) { document.getElementById(id).classList.add('open'); document.body.style.overflow = 'hidden'; }
function cerrarModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow = ''; }
function cerrarModalFuera(e, id) { if (e.target === document.getElementById(id)) cerrarModal(id); }
document.addEventListener('keydown', e => { if (e.key === 'Escape') { cerrarModal('modalPedido'); cerrarModal('modalContacto'); } });

function mostrarError(mensaje) {
    const alerta = document.getElementById('alertContainer');
    alerta.innerHTML = `<div class="alert alert-danger">${mensaje}</div>`;
    alerta.style.display = 'block';
    setTimeout(() => alerta.style.display = 'none', 5000);
}