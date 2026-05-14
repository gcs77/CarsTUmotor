<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Catálogo - carsTUmotor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
            background: #f8f8f8;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 2rem;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logo i {
            color: #ff6b35;
            font-size: 2rem;
        }

        .logo span {
            background: linear-gradient(135deg, #ff6b35, #ff9f1c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .nav-user {
            color: rgba(255,255,255,0.9);
            font-weight: 700;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }

        .nav-user i {
            color: #ff9f1c;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-login {
            background: transparent;
            color: #fff;
            border: 2px solid #ff6b35;
        }

        .btn-login:hover {
            background: #ff6b35;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-register {
            background: linear-gradient(135deg, #ff6b35, #ff9f1c);
            color: #fff;
            border: 2px solid transparent;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 107, 53, 0.4);
        }

        .page-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #fff;
            padding: 3.5rem 2rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -60%;
            right: -10%;
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(255, 107, 53, 0.18) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -60%;
            left: -10%;
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(255, 159, 28, 0.12) 0%, transparent 70%);
            border-radius: 50%;
        }

        .header-inner {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .breadcrumbs {
            display: inline-flex;
            gap: 0.5rem;
            align-items: center;
            font-size: 0.95rem;
            color: rgba(255,255,255,0.75);
            margin-bottom: 0.75rem;
        }

        .breadcrumbs a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
        }

        .breadcrumbs a:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        .page-title {
            font-size: 2.6rem;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 0.6rem;
            background: linear-gradient(135deg, #fff, #ff9f1c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            color: rgba(255,255,255,0.78);
            max-width: 720px;
        }

        .filters-wrap {
            max-width: 1200px;
            margin: -1.5rem auto 0;
            padding: 0 2rem;
        }

        .filters {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0,0,0,0.06);
            padding: 1rem;
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr auto;
            gap: 0.8rem;
            align-items: center;
        }

        .input {
            display: flex;
            gap: 0.6rem;
            align-items: center;
            background: #f6f6f6;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 10px;
            padding: 0.8rem 0.9rem;
            color: #333;
        }

        .input i {
            color: #ff6b35;
        }

        .input input,
        .input select {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-size: 1rem;
        }

        .btn-action {
            padding: 0.85rem 1.2rem;
            background: linear-gradient(135deg, #ff6b35, #ff9f1c);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            justify-content: center;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.25);
        }

        .catalog {
            max-width: 1200px;
            margin: 1.8rem auto 0;
            padding: 0 2rem 4rem;
        }

        .catalog-top {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 1rem;
            margin: 1.5rem 0 1rem;
        }

        .catalog-top h2 {
            font-size: 1.6rem;
            color: #1a1a2e;
        }

        .catalog-top p {
            color: #666;
            font-size: 0.98rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.4rem;
        }

        .card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0,0,0,0.06);
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 36px rgba(255, 107, 53, 0.14);
            border-color: rgba(255, 107, 53, 0.35);
        }

        .media {
            position: relative;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);
            aspect-ratio: 16 / 10;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.8);
            overflow: hidden;
        }

        .media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            padding: 0.35rem 0.6rem;
            border-radius: 999px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            backdrop-filter: blur(10px);
        }

        .media i.fallback-icon {
            font-size: 2.8rem;
            opacity: 0.9;
        }

        .content {
            padding: 1rem 1rem 1.1rem;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            flex: 1;
        }

        .title-row {
            display: flex;
            justify-content: space-between;
            gap: 0.8rem;
            align-items: baseline;
        }

        .title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #1a1a2e;
        }

        .price-tag {
            font-size: 1.05rem;
            font-weight: 900;
            color: #ff6b35;
        }

        .meta {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.6rem;
        }

        .meta-item {
            background: #f6f6f6;
            border: 1px solid rgba(0,0,0,0.06);
            padding: 0.55rem 0.6rem;
            border-radius: 12px;
            text-align: center;
            font-size: 0.9rem;
            color: #444;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.35rem;
        }

        .meta-item i {
            color: #ff6b35;
        }

        .card-actions {
            margin-top: auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.7rem;
        }

        .btn-solid {
            padding: 0.8rem 0.9rem;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #ff6b35, #ff9f1c);
            color: #fff;
            font-weight: 900;
            text-decoration: none;
            text-align: center;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-solid:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(255, 107, 53, 0.22);
        }

        .btn-solid:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .state-msg {
            grid-column: 1 / -1;
            text-align: center;
            padding: 2.5rem 1rem;
            background: #fff;
            border-radius: 14px;
            border: 1px dashed rgba(0,0,0,0.12);
            color: #555;
            font-weight: 700;
        }

        .state-msg.error {
            border-color: rgba(255, 107, 53, 0.35);
            color: #6a2a1c;
            background: #fff2f2;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 15, 30, 0.55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            padding: 1.2rem;
        }

        .modal-backdrop.open {
            display: flex;
        }

        .modal {
            background: #fff;
            border-radius: 16px;
            max-width: 560px;
            width: 100%;
            max-height: 92vh;
            overflow: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            border: 1px solid rgba(0,0,0,0.06);
        }

        .modal-head {
            padding: 1.2rem 1.25rem;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 1rem;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
        }

        .modal-head h3 {
            font-size: 1.25rem;
            font-weight: 900;
            line-height: 1.25;
        }

        .modal-close {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .modal-close:hover {
            background: rgba(255,255,255,0.2);
        }

        .modal-body {
            padding: 1.25rem;
            display: grid;
            gap: 0.85rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.65rem 0.75rem;
            border-radius: 12px;
            background: #f6f6f6;
            border: 1px solid rgba(0,0,0,0.06);
            font-size: 0.95rem;
        }

        .detail-row span:first-child {
            color: #666;
            font-weight: 800;
        }

        .detail-row span:last-child {
            color: #1a1a2e;
            font-weight: 800;
            text-align: right;
        }

        .modal-actions {
            padding: 0 1.25rem 1.25rem;
            display: grid;
            gap: 0.65rem;
        }

        .btn-ghost {
            padding: 0.8rem 0.9rem;
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.12);
            background: #fff;
            color: #1a1a2e;
            font-weight: 800;
            text-align: center;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-ghost:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 107, 53, 0.5);
            box-shadow: 0 10px 26px rgba(0,0,0,0.06);
        }

        .field {
            display: grid;
            gap: 0.45rem;
        }

        .label {
            font-weight: 800;
            color: #1a1a2e;
            font-size: 0.95rem;
        }

        .control {
            width: 100%;
            background: #f6f6f6;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 12px;
            padding: 0.75rem 0.85rem;
            font-size: 1rem;
            font-family: inherit;
        }

        textarea.control {
            min-height: 110px;
            resize: vertical;
        }

        .hint {
            font-size: 0.88rem;
            color: #666;
            font-weight: 600;
        }

        .form-error {
            background: #fff2f2;
            border: 1px solid rgba(255, 107, 53, 0.25);
            color: #6a2a1c;
            padding: 0.75rem 0.85rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.92rem;
        }

        footer {
            background: #0f0f1e;
            color: #999;
            padding: 2rem;
            text-align: center;
            font-size: 0.9rem;
        }

        footer p {
            margin: 0.5rem 0;
        }

        @media (max-width: 900px) {
            .filters {
                grid-template-columns: 1fr;
            }

            .catalog-top {
                flex-direction: column;
                align-items: start;
            }
        }

        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .page-title {
                font-size: 2rem;
            }

            .filters-wrap {
                padding: 0 1.1rem;
            }

            .catalog {
                padding: 0 1.1rem 3.2rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="/" class="logo">
            <i class="fas fa-car-side"></i>
            <span>carsTUmotor</span>
        </a>
        <div class="nav-buttons">
            <span class="nav-user"><i class="fas fa-user-circle"></i> {{ auth()->user()->name }}</span>
            <form action="/logout" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-login" style="cursor:pointer;">
                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </nav>

    <header class="page-header">
        <div class="header-inner">
            <div class="breadcrumbs">
                <a href="/">Inicio</a>
                <span>/</span>
                <span>Catálogo</span>
            </div>
            <h1 class="page-title">Catálogo de vehículos</h1>
            <p class="page-subtitle">Consultá fichas con precio y características. Para avanzar con la compra, agendá una cita y te contactamos.</p>
        </div>
    </header>

    <div class="filters-wrap">
        <div class="filters">
            <div class="input">
                <i class="fas fa-magnifying-glass"></i>
                <input type="text" id="filter-buscar" placeholder="Buscar por marca o modelo" autocomplete="off">
            </div>
            <div class="input">
                <i class="fas fa-palette"></i>
                <select id="filter-color">
                    <option value="">Todos los colores</option>
                </select>
            </div>
            <div class="input">
                <i class="fas fa-sort"></i>
                <select id="filter-orden">
                    <option value="precio_asc">Precio: menor a mayor</option>
                    <option value="precio_desc">Precio: mayor a menor</option>
                    <option value="marca">Marca A–Z</option>
                </select>
            </div>
            <button type="button" class="btn-action" id="btn-aplicar-filtros">
                <i class="fas fa-bolt"></i> Aplicar
            </button>
        </div>
    </div>

    <main class="catalog" id="catalogo">
        <div class="catalog-top">
            <div>
                <h2>Vehículos disponibles</h2>
            </div>
            <p id="contador-resultados">Cargando…</p>
        </div>

        <div class="grid" id="vehiculos-grid">
            <div class="state-msg" id="vehiculos-estado">Cargando catálogo…</div>
        </div>
    </main>

    <div class="modal-backdrop" id="modal-detalle" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="modal">
            <div class="modal-head">
                <h3 id="modal-titulo">Detalle</h3>
                <button type="button" class="modal-close" id="modal-cerrar" aria-label="Cerrar"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" id="modal-detalle-body"></div>
            <div class="modal-actions" id="modal-detalle-actions"></div>
        </div>
    </div>

    <div class="modal-backdrop" id="modal-comprar" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="modal">
            <div class="modal-head">
                <h3 id="comprar-titulo">Solicitar compra</h3>
                <button type="button" class="modal-close" id="comprar-cerrar" aria-label="Cerrar"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p class="hint" id="comprar-sub"></p>
                <div class="field">
                    <div class="label">Fecha y hora preferida</div>
                    <input class="control" type="datetime-local" id="comprar-fecha">
                </div>
                <div class="field">
                    <div class="label">Mensaje (mín. 10 caracteres)</div>
                    <textarea class="control" id="comprar-motivo" placeholder="Contanos cómo querés avanzar con la compra, financiación o entrega."></textarea>
                </div>
                <div class="form-error" id="comprar-error" style="display:none;"></div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-solid" id="comprar-enviar"><i class="fas fa-check"></i> Confirmar solicitud</button>
                <button type="button" class="btn-ghost" id="comprar-volver"><i class="fas fa-arrow-left"></i> Volver al detalle</button>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 carsTUmotor. Todos los derechos reservados.</p>
        <p>Términos de servicio | Política de privacidad | Contáctanos</p>
    </footer>

    <script>
        (function () {
            const api = (path, opts = {}) =>
                fetch(path, {
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        ...(opts.headers || {}),
                    },
                    ...opts,
                });

            const grid = document.getElementById('vehiculos-grid');
            const estado = document.getElementById('vehiculos-estado');
            const contador = document.getElementById('contador-resultados');
            const inputBuscar = document.getElementById('filter-buscar');
            const selColor = document.getElementById('filter-color');
            const selOrden = document.getElementById('filter-orden');

            const modalDetalle = document.getElementById('modal-detalle');
            const modalComprar = document.getElementById('modal-comprar');
            const modalTitulo = document.getElementById('modal-titulo');
            const modalBody = document.getElementById('modal-detalle-body');
            const modalActions = document.getElementById('modal-detalle-actions');
            const modalCerrar = document.getElementById('modal-cerrar');

            const comprarTitulo = document.getElementById('comprar-titulo');
            const comprarSub = document.getElementById('comprar-sub');
            const comprarFecha = document.getElementById('comprar-fecha');
            const comprarMotivo = document.getElementById('comprar-motivo');
            const comprarError = document.getElementById('comprar-error');
            const comprarEnviar = document.getElementById('comprar-enviar');
            const comprarCerrar = document.getElementById('comprar-cerrar');
            const comprarVolver = document.getElementById('comprar-volver');

            let listaCompleta = [];
            let seleccion = null;

            function esc(s) {
                const d = document.createElement('div');
                d.textContent = s == null ? '' : String(s);
                return d.innerHTML;
            }

            function formatMoney(n) {
                const x = Number(n);
                if (Number.isNaN(x)) return '—';
                return new Intl.NumberFormat('es-AR', { style: 'currency', currency: 'ARS', maximumFractionDigits: 0 }).format(x);
            }

            function uniqColors(items) {
                const s = new Set();
                items.forEach(v => { if (v.color) s.add(v.color); });
                return Array.from(s).sort((a, b) => a.localeCompare(b));
            }

            function aplicarFiltros() {
                const q = (inputBuscar.value || '').trim().toLowerCase();
                const color = selColor.value;
                let rows = listaCompleta.filter(v => v.disponible);
                if (q) {
                    rows = rows.filter(v =>
                        (String(v.marca || '').toLowerCase().includes(q)) ||
                        (String(v.modelo || '').toLowerCase().includes(q))
                    );
                }
                if (color) {
                    rows = rows.filter(v => String(v.color) === color);
                }
                const orden = selOrden.value;
                rows = [...rows];
                if (orden === 'precio_asc') rows.sort((a, b) => Number(a.precio_cliente) - Number(b.precio_cliente));
                if (orden === 'precio_desc') rows.sort((a, b) => Number(b.precio_cliente) - Number(a.precio_cliente));
                if (orden === 'marca') rows.sort((a, b) => String(a.marca).localeCompare(String(b.marca)));
                return rows;
            }

            function renderMedia(v) {
                if (v.imagen && /^https?:\/\//i.test(String(v.imagen))) {
                    try {
                        const u = new URL(String(v.imagen)).href;
                        return `<img src="${esc(u)}" alt="">`;
                    } catch (e) {
                        return `<i class="fas fa-car fallback-icon"></i>`;
                    }
                }
                return `<i class="fas fa-car fallback-icon"></i>`;
            }

            function renderCards(items) {
                grid.innerHTML = '';
                if (!items.length) {
                    const el = document.createElement('div');
                    el.className = 'state-msg';
                    el.textContent = 'No hay vehículos que coincidan con tu búsqueda.';
                    grid.appendChild(el);
                    contador.textContent = 'Resultados: 0';
                    return;
                }

                contador.textContent = 'Resultados: ' + items.length;

                items.forEach(v => {
                    const art = document.createElement('article');
                    art.className = 'card';
                    art.innerHTML = `
                        <div class="media">
                            <span class="badge"><i class="fas fa-tag"></i> ${v.disponible ? 'Disponible' : 'No disponible'}</span>
                            ${renderMedia(v)}
                        </div>
                        <div class="content">
                            <div class="title-row">
                                <div class="title">${esc(v.marca)} ${esc(v.modelo)}</div>
                                <div class="price-tag">${formatMoney(v.precio_cliente)}</div>
                            </div>
                            <div class="meta">
                                <div class="meta-item"><i class="fas fa-palette"></i> ${esc(v.color || '—')}</div>
                                <div class="meta-item"><i class="fas fa-door-open"></i> ${esc(v.puertas ?? '—')} p.</div>
                                <div class="meta-item"><i class="fas fa-gauge-high"></i> ${esc(v.hp ?? '—')} HP</div>
                            </div>
                            <div class="card-actions">
                                <button type="button" class="btn-solid btn-ver" data-id="${v.id}">
                                    <i class="fas fa-eye"></i> Ver ficha
                                </button>
                            </div>
                        </div>
                    `;
                    grid.appendChild(art);
                });

                grid.querySelectorAll('.btn-ver').forEach(btn => {
                    btn.addEventListener('click', () => openDetalle(Number(btn.getAttribute('data-id'))));
                });
            }

            async function cargar() {
                estado.style.display = '';
                grid.innerHTML = '';
                grid.appendChild(estado);
                estado.className = 'state-msg';
                estado.textContent = 'Cargando catálogo…';

                const res = await api('/api/vehiculos');
                if (!res.ok) {
                    estado.className = 'state-msg error';
                    estado.textContent = 'No pudimos cargar el catálogo. Probá recargar la página.';
                    contador.textContent = 'Resultados: —';
                    return;
                }

                listaCompleta = await res.json();
                estado.remove();

                const colors = uniqColors(listaCompleta);
                const prev = selColor.value;
                selColor.innerHTML = '<option value="">Todos los colores</option>';
                colors.forEach(c => {
                    const o = document.createElement('option');
                    o.value = c;
                    o.textContent = c;
                    selColor.appendChild(o);
                });
                if ([...selColor.options].some(o => o.value === prev)) selColor.value = prev;

                renderCards(aplicarFiltros());
            }

            function setModal(open, el) {
                el.classList.toggle('open', open);
                el.setAttribute('aria-hidden', open ? 'false' : 'true');
            }

            function row(label, value) {
                const displayed = value == null || value === '' ? '—' : String(value);
                return `<div class="detail-row"><span>${esc(label)}</span><span>${esc(displayed)}</span></div>`;
            }

            async function openDetalle(id) {
                seleccion = null;
                modalBody.innerHTML = '<div class="state-msg">Cargando ficha…</div>';
                modalActions.innerHTML = '';
                modalTitulo.textContent = 'Detalle';
                setModal(true, modalDetalle);

                const res = await api('/api/vehiculos/' + id);
                if (!res.ok) {
                    modalBody.innerHTML = '<div class="state-msg error">No se encontró el vehículo.</div>';
                    modalActions.innerHTML = '<button type="button" class="btn-ghost" id="md-only-close">Cerrar</button>';
                    document.getElementById('md-only-close').addEventListener('click', () => setModal(false, modalDetalle));
                    return;
                }

                const v = await res.json();
                seleccion = v;
                modalTitulo.textContent = `${v.marca} ${v.modelo}`;
                modalBody.innerHTML = `
                    <div style="border-radius:12px;overflow:hidden;border:1px solid rgba(0,0,0,0.08);background:#f6f6f6;">
                        <div class="media" style="aspect-ratio:16/9;border-radius:0;">
                            ${renderMedia(v)}
                        </div>
                    </div>
                    ${row('Precio', formatMoney(v.precio_cliente))}
                    ${row('Color', esc(v.color))}
                    ${row('Puertas', esc(v.puertas))}
                    ${row('Potencia (HP)', esc(v.hp))}
                    ${row('Estado', v.disponible ? 'Disponible' : 'No disponible')}
                `;

                const puede = !!v.disponible;
                modalActions.innerHTML = `
                    <button type="button" class="btn-solid" id="btn-comprar" ${puede ? '' : 'disabled'}>
                        <i class="fas fa-cart-shopping"></i> Quiero comprarlo
                    </button>
                    <button type="button" class="btn-ghost" id="btn-md-cerrar"><i class="fas fa-times"></i> Cerrar</button>
                `;

                document.getElementById('btn-md-cerrar').addEventListener('click', () => setModal(false, modalDetalle));
                const bCompra = document.getElementById('btn-comprar');
                if (puede) {
                    bCompra.addEventListener('click', () => openComprar(v));
                }
            }

            function minFechaLocal() {
                const d = new Date();
                d.setMinutes(d.getMinutes() + 30);
                d.setSeconds(0, 0);
                const pad = n => String(n).padStart(2, '0');
                return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate()) + 'T' + pad(d.getHours()) + ':' + pad(d.getMinutes());
            }

            function openComprar(v) {
                comprarError.style.display = 'none';
                comprarError.textContent = '';
                comprarMotivo.value = `Hola, quiero avanzar con la compra del ${v.marca} ${v.modelo} (ID ${v.id}). `;
                comprarFecha.min = minFechaLocal();
                comprarFecha.value = '';
                comprarTitulo.textContent = 'Solicitar compra';
                comprarSub.textContent = `Vamos a registrar una cita comercial vinculada a este vehículo. Un asesor te va a contactar.`;
                setModal(false, modalDetalle);
                setModal(true, modalComprar);
                seleccion = v;
            }

            modalCerrar.addEventListener('click', () => setModal(false, modalDetalle));
            modalDetalle.addEventListener('click', (e) => { if (e.target === modalDetalle) setModal(false, modalDetalle); });

            comprarCerrar.addEventListener('click', () => setModal(false, modalComprar));
            comprarVolver.addEventListener('click', () => {
                setModal(false, modalComprar);
                if (seleccion) openDetalle(seleccion.id);
            });
            modalComprar.addEventListener('click', (e) => { if (e.target === modalComprar) setModal(false, modalComprar); });

            comprarEnviar.addEventListener('click', async () => {
                comprarError.style.display = 'none';
                comprarError.textContent = '';
                if (!seleccion) return;

                const fecha = comprarFecha.value;
                const motivo = comprarMotivo.value.trim();
                if (!fecha) {
                    comprarError.textContent = 'Elegí fecha y hora.';
                    comprarError.style.display = 'block';
                    return;
                }
                if (motivo.length < 10) {
                    comprarError.textContent = 'El mensaje debe tener al menos 10 caracteres.';
                    comprarError.style.display = 'block';
                    return;
                }

                comprarEnviar.disabled = true;
                const res = await api('/api/citas', {
                    method: 'POST',
                    body: JSON.stringify({
                        vehiculo_id: seleccion.id,
                        fecha_hora: new Date(fecha).toISOString(),
                        motivo: motivo,
                    }),
                });
                comprarEnviar.disabled = false;

                if (res.ok) {
                    setModal(false, modalComprar);
                    alert('¡Listo! Registramos tu solicitud. Te vamos a contactar para coordinar los siguientes pasos.');
                    return;
                }

                let msg = 'No pudimos registrar la solicitud.';
                try {
                    const data = await res.json();
                    if (data.message) msg = data.message;
                    if (data.errors) {
                        const parts = Object.values(data.errors).flat();
                        if (parts.length) msg = parts.join(' ');
                    }
                } catch (e) {}
                comprarError.textContent = msg;
                comprarError.style.display = 'block';
            });

            document.getElementById('btn-aplicar-filtros').addEventListener('click', () => {
                document.getElementById('catalogo').scrollIntoView({ behavior: 'smooth', block: 'start' });
                renderCards(aplicarFiltros());
            });

            inputBuscar.addEventListener('input', () => renderCards(aplicarFiltros()));
            selColor.addEventListener('change', () => renderCards(aplicarFiltros()));
            selOrden.addEventListener('change', () => renderCards(aplicarFiltros()));

            cargar();
        })();
    </script>
</body>
</html>
