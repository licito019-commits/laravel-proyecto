<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Adversing System · Panel de Campañas</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,600&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* ============================================================
   1 SOLO ESQUEMA DE COLOR — verde institucional + dorado
   ============================================================ */
:root{
  --verde-oscuro:#0c2b20;
  --verde:#154334;
  --verde-suave:#e7efe9;
  --verde-linea:#cddcd2;
  --dorado:#c9a24b;
  --dorado-suave:#f6ecd6;
  --crema:#f5f3ee;
  --superficie:#ffffff;
  --texto:#16241d;
  --texto-suave:#5f6f66;
  --borde:#e3ded2;
  --sombra:0 2px 10px rgba(12,43,32,0.06);
  --sombra-alta:0 12px 30px rgba(12,43,32,0.14);
}
*{box-sizing:border-box;}
body{margin:0;font-family:'Montserrat',sans-serif;background:var(--crema);color:var(--texto);}
h1,h2,h3{font-family:'Cormorant Garamond',serif;margin:0;}
::-webkit-scrollbar{width:6px;}
::-webkit-scrollbar-thumb{background:var(--verde-linea);border-radius:3px;}
button{font-family:inherit;}

.app{display:flex;height:100vh;overflow:hidden;}

/* ── SIDEBAR ─────────────────────────────────────────── */
.sidebar{
  width:230px;min-width:230px;background:var(--verde-oscuro);
  display:flex;flex-direction:column;transition:width .2s ease;
  box-shadow:4px 0 18px rgba(0,0,0,.15);
}
.sidebar.collapsed{width:68px;min-width:68px;}
.brand{
  height:110px;overflow:hidden;
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;padding:0 16px;
  border-bottom:1px solid rgba(255,255,255,.08);
}
.brand-logo{max-height:88px;max-width:190px;width:auto;height:auto;object-fit:contain;}
.brand-text span{display:block;color:#9db3a8;font-size:10px;letter-spacing:1px;text-align:center;}

.nav{flex:1;padding:14px 8px;display:flex;flex-direction:column;gap:3px;}
.nav-btn{
  display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:9px;
  border:none;background:transparent;color:#a9bdb1;font-size:13px;font-weight:500;
  cursor:pointer;text-align:left;position:relative;border-left:2px solid transparent;
}
.nav-btn .ic{font-size:16px;flex-shrink:0;}
.nav-btn .lb{flex:1;white-space:nowrap;}
.nav-btn.active{background:rgba(201,162,75,.14);color:var(--dorado);border-left:2px solid var(--dorado);font-weight:700;}
.nav-badge{background:var(--dorado);color:var(--verde-oscuro);border-radius:20px;font-size:10px;font-weight:800;padding:1px 7px;}

.admin{display:flex;align-items:center;gap:10px;padding:14px 12px;border-top:1px solid rgba(255,255,255,.08);}
.admin-avatar{width:34px;height:34px;border-radius:50%;background:var(--dorado);color:var(--verde-oscuro);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px;flex-shrink:0;}
.admin-name{font-size:13px;font-weight:700;color:#e9ede9;}
.admin-role{font-size:10px;color:#8fa398;}
.logout-btn{border:none;background:none;color:#a9bdb1;font-size:16px;cursor:pointer;padding:6px;border-radius:8px;flex-shrink:0;line-height:1;}
.logout-btn:hover{background:rgba(255,255,255,.08);color:var(--dorado);}

/* ── MAIN ────────────────────────────────────────────── */
main{flex:1;display:flex;flex-direction:column;overflow:hidden;}
.topbar{
  height:60px;background:var(--superficie);border-bottom:1px solid var(--borde);
  display:flex;align-items:center;gap:14px;padding:0 24px;box-shadow:var(--sombra);
}
.toggle-btn{border:none;background:none;font-size:18px;color:var(--verde);cursor:pointer;}
.topbar-title b{display:block;font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:700;}
.topbar-title span{font-size:11px;color:var(--texto-suave);}
.search{
  margin-left:auto;display:flex;align-items:center;gap:8px;background:var(--crema);
  border:1px solid var(--borde);border-radius:9px;padding:7px 14px;width:250px;
}
.search input{border:none;background:none;outline:none;font-size:13px;color:var(--texto);width:100%;}

.content{flex:1;overflow:auto;padding:22px 26px;}
.section{display:none;}
.section.active{display:block;}

/* ── ALERTA / RESUMEN DE PENDIENTES ─────────────────── */
.pending-banner{
  background:linear-gradient(120deg,var(--dorado-suave),var(--crema));
  border:1px solid var(--dorado);border-radius:14px;padding:16px 22px;
  display:flex;align-items:center;gap:16px;margin-bottom:20px;
}
.pending-banner .num{font-family:'Cormorant Garamond',serif;font-size:34px;font-weight:700;color:var(--verde-oscuro);}
.pending-banner .txt b{display:block;font-size:13px;color:var(--verde-oscuro);}
.pending-banner .txt span{font-size:11px;color:var(--texto-suave);}
.pending-banner button{
  margin-left:auto;border:1px solid var(--verde-oscuro);background:var(--verde-oscuro);color:#fff;
  border-radius:8px;padding:9px 18px;font-weight:700;font-size:12px;cursor:pointer;
}

/* ── FILTROS ─────────────────────────────────────────── */
.filters{
  background:var(--superficie);border:1px solid var(--borde);border-radius:12px;
  padding:12px 16px;margin-bottom:16px;display:flex;align-items:center;gap:12px;flex-wrap:wrap;
}
.filters .lbl{font-size:11px;font-weight:700;color:var(--texto-suave);letter-spacing:.4px;}
.chip{
  border:1px solid var(--borde);background:#fff;color:var(--texto-suave);border-radius:8px;
  padding:5px 12px;font-size:11px;cursor:pointer;
}
.chip.active{border-color:var(--verde-oscuro);background:var(--verde-suave);color:var(--verde-oscuro);font-weight:700;}
.filters select{border:1px solid var(--borde);border-radius:8px;padding:6px 10px;font-size:11px;background:#fff;color:var(--texto);cursor:pointer;}
.filters .count{margin-left:auto;font-size:12px;color:var(--texto-suave);}

/* ── TARJETAS DE CAMPAÑA ─────────────────────────────── */
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:14px;}
.card{
  background:var(--superficie);border:1px solid var(--borde);border-radius:14px;overflow:hidden;
  cursor:pointer;box-shadow:var(--sombra);transition:transform .15s, box-shadow .15s;
}
.card:hover{transform:translateY(-2px);box-shadow:var(--sombra-alta);}
.card-strip{height:4px;background:var(--verde-oscuro);}
.card-strip.dorado{background:var(--dorado);}
.card-body{padding:16px 18px;}
.card-top{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;gap:8px;}
.card-icon{width:38px;height:38px;border-radius:10px;background:var(--verde-suave);display:flex;align-items:center;justify-content:center;font-size:19px;flex-shrink:0;}
.card-cat{font-size:10px;font-weight:700;color:var(--verde);letter-spacing:.4px;}
.card-title{font-size:14px;font-weight:800;line-height:1.25;font-family:'Montserrat',sans-serif;}
.card-client{display:flex;align-items:center;gap:7px;margin-bottom:10px;font-size:13px;font-weight:600;}
.client-avatar{width:23px;height:23px;border-radius:50%;background:var(--verde-oscuro);color:#fff;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:800;}
.card-meta{display:grid;grid-template-columns:1fr 1fr;gap:8px;background:var(--crema);border-radius:9px;padding:10px 12px;margin-bottom:12px;}
.card-meta div span{display:block;}
.meta-k{font-size:9px;color:var(--texto-suave);font-weight:700;}
.meta-v{font-size:12px;font-weight:700;}
.card-bottom{display:flex;justify-content:space-between;align-items:center;}
.designer{font-size:11px;color:var(--texto-suave);}

.badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;}
.badge .dot{width:6px;height:6px;border-radius:50%;}
.badge-pendiente{background:var(--dorado-suave);color:#8a6a1e;} .badge-pendiente .dot{background:var(--dorado);}
.badge-revision{background:var(--verde-suave);color:var(--verde);} .badge-revision .dot{background:var(--verde);}
.badge-aprobada{background:var(--verde-oscuro);color:#fff;} .badge-aprobada .dot{background:#fff;}
.badge-rechazada{background:#eee9dd;color:#7a7263;} .badge-rechazada .dot{background:#9b9382;}
.badge-alta{background:var(--verde-oscuro);color:#fff;}
.badge-media{background:var(--verde-suave);color:var(--verde);}
.badge-baja{background:#efeee9;color:var(--texto-suave);}

.card-actions{margin-top:12px;display:flex;gap:6px;}
.btn-reject{flex:1;border:1.5px solid var(--borde);background:#fff;color:var(--texto-suave);border-radius:8px;padding:7px;font-weight:700;font-size:12px;cursor:pointer;}
.btn-approve{flex:2;border:none;background:var(--verde-oscuro);color:#fff;border-radius:8px;padding:7px;font-weight:800;font-size:12px;cursor:pointer;}

/* ── PRODUCTOS ───────────────────────────────────────── */
.section-actions{display:flex;align-items:center;gap:12px;margin-bottom:18px;flex-wrap:wrap;}
.section-actions .lbl{font-size:12px;color:var(--texto-suave);}
.btn-new{
  margin-left:auto;border:none;background:var(--verde-oscuro);color:#fff;border-radius:9px;
  padding:10px 18px;font-weight:700;font-size:13px;cursor:pointer;display:flex;align-items:center;gap:6px;
}
.btn-new:hover{background:var(--verde);}
.prod-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;}
.prod-card{background:var(--superficie);border:1px solid var(--borde);border-radius:14px;padding:20px;box-shadow:var(--sombra);position:relative;}
.prod-top{display:flex;align-items:center;gap:12px;margin-bottom:14px;}
.prod-icon{width:46px;height:46px;border-radius:12px;background:var(--verde-suave);display:flex;align-items:center;justify-content:center;font-size:22px;}
.prod-name{font-size:15px;font-weight:800;}
.prod-cat{font-size:11px;color:var(--texto-suave);}
.prod-desc{font-size:12.5px;color:var(--texto-suave);line-height:1.6;margin-bottom:16px;}
.stock-row{display:flex;justify-content:space-between;align-items:baseline;margin-bottom:6px;}
.stock-num{font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:700;color:var(--verde-oscuro);}
.stock-lbl{font-size:10px;font-weight:700;color:var(--texto-suave);letter-spacing:.3px;}
.stock-bar{height:6px;background:var(--verde-suave);border-radius:4px;overflow:hidden;}
.stock-fill{height:100%;background:var(--dorado);border-radius:4px;}
.prod-edit-btn{position:absolute;top:16px;right:16px;border:none;background:var(--crema);color:var(--texto-suave);width:28px;height:28px;border-radius:8px;cursor:pointer;font-size:13px;}
.prod-edit-btn:hover{background:var(--verde-suave);color:var(--verde-oscuro);}

/* ── FORM (modal de producto) ─────────────────────────── */
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;}
.form-row.full{grid-template-columns:1fr;}
.field label{display:block;font-size:11px;font-weight:700;color:var(--texto-suave);letter-spacing:.3px;margin-bottom:6px;}
.field input, .field select, .field textarea{
  width:100%;padding:10px 12px;border-radius:9px;border:1.5px solid var(--borde);font-size:13px;
  outline:none;background:var(--crema);color:var(--texto);font-family:inherit;
}
.field input:focus, .field select:focus, .field textarea:focus{border-color:var(--verde);background:#fff;}
.field textarea{resize:vertical;min-height:70px;}

/* ── CLIENTES ────────────────────────────────────────── */
.client-list{display:flex;flex-direction:column;gap:12px;}
.client-row{
  background:var(--superficie);border:1px solid var(--borde);border-radius:14px;padding:18px 20px;
  display:grid;grid-template-columns:auto 1.4fr 1fr 1fr 1fr;gap:18px;align-items:center;box-shadow:var(--sombra);
}
.client-big-avatar{width:46px;height:46px;border-radius:50%;background:var(--verde-oscuro);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:15px;}
.client-name{font-weight:800;font-size:14px;}
.client-contact{font-size:11px;color:var(--texto-suave);}
.field-lbl{font-size:9px;font-weight:700;color:var(--texto-suave);letter-spacing:.4px;margin-bottom:2px;}
.field-val{font-size:12.5px;font-weight:600;}
.field-val.product{display:flex;align-items:center;gap:6px;}

/* ── DISEÑADORES ─────────────────────────────────────── */
.designer-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;}
.designer-card{background:var(--superficie);border:1px solid var(--borde);border-radius:14px;padding:20px;text-align:center;box-shadow:var(--sombra);}
.designer-avatar{width:56px;height:56px;border-radius:50%;background:var(--verde-oscuro);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:18px;margin:0 auto 10px;}
.designer-count{font-family:'Cormorant Garamond',serif;font-size:26px;font-weight:700;color:var(--verde-oscuro);margin-top:6px;}
.designer-card .btn-assign{margin-top:12px;width:100%;border:none;background:var(--verde-oscuro);color:#fff;border-radius:8px;padding:8px;font-weight:700;font-size:12px;cursor:pointer;}
.designer-card .btn-assign:hover{background:var(--verde);}

/* ── VACÍO ───────────────────────────────────────────── */
.empty{text-align:center;padding:60px 20px;color:var(--texto-suave);}
.empty .ic{font-size:42px;}

/* ── MODAL ───────────────────────────────────────────── */
.overlay{position:fixed;inset:0;background:rgba(12,43,32,.55);backdrop-filter:blur(3px);z-index:100;display:none;align-items:center;justify-content:center;padding:24px;}
.overlay.open{display:flex;}
.modal{background:#fff;border-radius:18px;width:100%;max-width:720px;max-height:88vh;overflow:auto;box-shadow:0 30px 60px rgba(0,0,0,.25);}
.modal-head{padding:24px 26px 0;background:linear-gradient(135deg,var(--verde-suave),#fff);border-bottom:1px solid var(--borde);}
.modal-head-top{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:14px;gap:10px;}
.modal-icon{width:50px;height:50px;border-radius:13px;background:#fff;border:2px solid var(--verde-linea);display:flex;align-items:center;justify-content:center;font-size:24px;}
.modal-cat{font-size:10px;font-weight:700;color:var(--verde);letter-spacing:.4px;}
.modal-title{font-size:19px;font-weight:800;font-family:'Montserrat',sans-serif;margin:2px 0 3px;}
.modal-client{font-size:13px;color:var(--texto-suave);}
.modal-close{border:none;background:var(--crema);border-radius:8px;width:32px;height:32px;cursor:pointer;font-size:15px;color:var(--texto-suave);}
.tabs{display:flex;gap:2px;}
.tab-btn{border:none;background:none;padding:10px 16px;font-weight:500;font-size:13px;color:#8b968f;cursor:pointer;border-bottom:2px solid transparent;}
.tab-btn.active{color:var(--verde-oscuro);font-weight:700;border-bottom:2px solid var(--dorado);}
.modal-body{padding:22px 26px;}
.tab-panel{display:none;}
.tab-panel.active{display:block;}
.brief-box{background:var(--crema);border:1px solid var(--borde);border-radius:12px;padding:16px 20px;margin-bottom:18px;}
.brief-box .lbl{font-size:11px;font-weight:700;color:var(--texto-suave);letter-spacing:.4px;margin-bottom:8px;}
.detail-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:18px;}
.detail-grid .d{background:var(--crema);border-radius:10px;padding:12px 14px;}
.files{display:flex;gap:8px;flex-wrap:wrap;}
.file-chip{display:flex;align-items:center;gap:6px;background:var(--crema);border-radius:8px;padding:6px 12px;font-size:12px;color:var(--texto-suave);font-weight:500;}
.history-item{display:flex;gap:10px;padding-left:8px;border-left:2px solid var(--verde-linea);margin-bottom:12px;font-size:13px;}
.comment-box{background:var(--crema);border-radius:10px;padding:14px;}
.comment-box textarea{width:100%;border:1.5px solid var(--borde);border-radius:8px;padding:10px 12px;font-size:13px;outline:none;resize:vertical;min-height:76px;font-family:inherit;box-sizing:border-box;}
.comment-box button{margin-top:8px;background:var(--verde-oscuro);color:#fff;border:none;border-radius:8px;padding:8px 16px;font-size:12px;font-weight:700;cursor:pointer;}
.modal-footer{padding:16px 26px 24px;border-top:1px solid var(--borde);display:flex;gap:10px;align-items:center;}
.modal-footer .meta{font-size:12px;color:var(--texto-suave);flex:1;}
.btn-outline{border:1.5px solid var(--verde);background:var(--verde-suave);color:var(--verde-oscuro);border-radius:10px;padding:10px 18px;font-weight:700;font-size:13px;cursor:pointer;}
.btn-ghost{border:1.5px solid var(--borde);background:#fff;color:var(--texto-suave);border-radius:10px;padding:10px 18px;font-weight:700;font-size:13px;cursor:pointer;}
.btn-solid{border:none;background:var(--verde-oscuro);color:#fff;border-radius:10px;padding:10px 22px;font-weight:800;font-size:13px;cursor:pointer;}

/* ── USUARIOS ─────────────────────────────────────────── */
.usuarios-block{margin-bottom:28px;}
.usuarios-title{font-size:11px;font-weight:700;color:var(--texto-suave);letter-spacing:.6px;margin-bottom:10px;}
.usuarios-block .client-row{grid-template-columns:auto 1.4fr 1fr 1fr auto auto;}
.usuarios-block .client-row.inactivo{opacity:.55;}
.status-toggle{display:flex;align-items:center;gap:8px;}
.status-toggle .txt{font-size:11px;font-weight:700;}
.status-toggle .txt.on{color:var(--verde);}
.status-toggle .txt.off{color:#9b7a4a;}
.switch{position:relative;display:inline-block;width:38px;height:21px;flex-shrink:0;}
.switch input{opacity:0;width:0;height:0;}
.switch .slider{position:absolute;cursor:pointer;inset:0;background:#d8d2c2;border-radius:20px;transition:.2s;}
.switch .slider::before{content:"";position:absolute;height:15px;width:15px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:.2s;}
.switch input:checked + .slider{background:var(--verde-oscuro);}
.switch input:checked + .slider::before{transform:translateX(17px);}

/* ── MODAL ASIGNAR ───────────────────────────────────── */
.assign-modal{max-width:640px;}
.assign-section-title{font-size:11px;font-weight:700;color:var(--texto-suave);letter-spacing:.4px;margin:18px 0 10px;}
.assign-row{display:flex;align-items:center;gap:12px;background:var(--crema);border:1px solid var(--borde);border-radius:10px;padding:10px 14px;margin-bottom:8px;}
.assign-row-icon{width:34px;height:34px;border-radius:9px;background:#fff;border:1px solid var(--borde);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;}
.assign-row-info{flex:1;}
.assign-row-title{font-size:13px;font-weight:700;}
.assign-row-meta{font-size:11px;color:var(--texto-suave);margin-top:2px;}
.assign-row .btn-solid{padding:7px 14px;font-size:11px;}

/* ── TOAST ───────────────────────────────────────────── */
.toast{position:fixed;bottom:26px;right:26px;background:var(--verde-oscuro);color:#fff;border-radius:12px;padding:12px 20px;font-size:13px;font-weight:600;box-shadow:0 10px 24px rgba(0,0,0,.2);z-index:200;display:none;}
@keyframes slideIn{from{transform:translateY(16px);opacity:0;}to{transform:translateY(0);opacity:1;}}
.toast.show{display:block;animation:slideIn .25s ease;}
</style>
</head>
<body>

<div class="app">

  {{-- ─────────── SIDEBAR ─────────── --}}
  <aside class="sidebar" id="sidebar">
    <div class="brand">
      <div class="brand-text" id="brandText" style="text-align:center;">
        <img src="{{ asset('img/logo.png') }}" alt="Adversing System" class="brand-logo">
        <span>PUBLICIDAD &amp; DISEÑO</span>
      </div>
    </div>

    <nav class="nav" id="navList">
      <button class="nav-btn active" data-target="campanas">
        <span class="ic">📢</span><span class="lb">Campañas</span>
        <span class="nav-badge" id="pendingBadge">0</span>
      </button>
      <button class="nav-btn" data-target="clientes">
        <span class="ic">🏢</span><span class="lb">Clientes</span>
      </button>
      <button class="nav-btn" data-target="productos">
        <span class="ic">🎨</span><span class="lb">Productos</span>
      </button>
      <button class="nav-btn" data-target="disenadores">
        <span class="ic">✏️</span><span class="lb">Diseñadores</span>
      </button>
      <button class="nav-btn" data-target="usuarios">
        <span class="ic">👥</span><span class="lb">Usuarios</span>
      </button>
    </nav>

    @php
      $usuarioActual = auth()->user()->name ?? 'Usuario';
      $palabras = explode(' ', trim($usuarioActual));
      $iniciales = strtoupper(substr($palabras[0] ?? '', 0, 1) . substr($palabras[1] ?? '', 0, 1));
    @endphp
    <div class="admin">
      <div class="admin-avatar">{{ $iniciales }}</div>
      <div id="adminText" style="flex:1;">
        <div class="admin-name">{{ $usuarioActual }}</div>
        <div class="admin-role">{{ auth()->user()->role ?? 'Administrador' }}</div>
      </div>
      <form method="POST" action="{{ route('logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="logout-btn" title="Cerrar sesión">🚪</button>
      </form>
    </div>
  </aside>

  {{-- ─────────── MAIN ─────────── --}}
  <main>
    <header class="topbar">
      <button class="toggle-btn" id="toggleSidebar">☰</button>
      <div class="topbar-title" id="pageTitle">
        <b>Gestión de Campañas</b>
        <span>Aprobación y seguimiento de proyectos</span>
      </div>
      <div class="search">
        <span>🔍</span>
        <input id="searchInput" placeholder="Buscar campaña, cliente...">
      </div>
    </header>

    <div class="content">

      {{-- ============= SECCIÓN: CAMPAÑAS ============= --}}
      <section class="section active" id="section-campanas">

        <div class="pending-banner">
          <div class="num" id="pendingCount">0</div>
          <div class="txt">
            <b>Campañas esperando tu aprobación</b>
            <span>Revisa el brief y aprueba, rechaza o pide ajustes</span>
          </div>
          <button onclick="setStatusFilter('pendiente')">Ver pendientes →</button>
        </div>

        <div class="filters">
          <span class="lbl">FILTRAR:</span>
          <div id="statusChips" style="display:flex;gap:6px;"></div>
          <div style="width:1px;height:20px;background:var(--borde);"></div>
          <select id="productFilter"></select>
          <select id="designerFilter"></select>
          <span class="count" id="resultCount"></span>
        </div>

        <div class="grid" id="campaignGrid"></div>
        <div class="empty" id="campaignEmpty" style="display:none;">
          <div class="ic">🔍</div>
          <div style="font-weight:700;font-size:16px;margin-top:10px;">Sin resultados para los filtros aplicados</div>
        </div>
      </section>

      {{-- ============= SECCIÓN: CLIENTES ============= --}}
      <section class="section" id="section-clientes">
        <div class="client-list" id="clientList"></div>
      </section>

      {{-- ============= SECCIÓN: PRODUCTOS ============= --}}
      <section class="section" id="section-productos">
        <div class="section-actions">
          <span class="lbl" id="productCount"></span>
          <button class="btn-new" onclick="openProductModal()">＋ Nuevo producto</button>
        </div>
        <div class="prod-grid" id="productGrid"></div>
        <div class="empty" id="productEmpty" style="display:none;">
          <div class="ic">🎨</div>
          <div style="font-weight:700;font-size:16px;margin-top:10px;">Aún no tienes productos registrados</div>
          <div style="font-size:13px;margin-top:6px;">Agrega tu primera línea de producto para controlar su inventario y usarla en las campañas.</div>
          <button class="btn-solid" style="margin-top:16px;" onclick="openProductModal()">＋ Agregar producto</button>
        </div>
      </section>

      {{-- ============= SECCIÓN: DISEÑADORES ============= --}}
      <section class="section" id="section-disenadores">
        <div class="designer-grid" id="designerGrid"></div>
      </section>

      {{-- ============= SECCIÓN: USUARIOS ============= --}}
      <section class="section" id="section-usuarios">
        <div class="usuarios-block">
          <div class="usuarios-title">CLIENTES</div>
          <div class="client-list" id="usuariosClientList"></div>
        </div>
        <div class="usuarios-block">
          <div class="usuarios-title">DISEÑADORES</div>
          <div class="client-list" id="usuariosDesignerList"></div>
        </div>
      </section>

    </div>
  </main>
</div>

{{-- ─────────── MODAL DETALLE DE CAMPAÑA ─────────── --}}
<div class="overlay" id="modalOverlay">
  <div class="modal" onclick="event.stopPropagation()">
    <div class="modal-head">
      <div class="modal-head-top">
        <div style="display:flex;gap:14px;align-items:center;">
          <div class="modal-icon" id="modalIcon"></div>
          <div>
            <div class="modal-cat" id="modalCat"></div>
            <h2 class="modal-title" id="modalTitle"></h2>
            <div class="modal-client" id="modalClient"></div>
          </div>
        </div>
        <div style="display:flex;gap:8px;align-items:center;">
          <span id="modalPriority"></span>
          <span id="modalStatus"></span>
          <button class="modal-close" onclick="closeModal()">✕</button>
        </div>
      </div>
      <div class="tabs">
        <button class="tab-btn active" data-tab="brief">Brief</button>
        <button class="tab-btn" data-tab="detalles">Detalles</button>
        <button class="tab-btn" data-tab="historial">Historial</button>
      </div>
    </div>

    <div class="modal-body">
      <div class="tab-panel active" id="tab-brief">
        <div class="brief-box">
          <div class="lbl">BRIEFING DEL CLIENTE</div>
          <p style="margin:0;font-size:14px;line-height:1.7;" id="briefText"></p>
        </div>
        <div class="detail-grid" id="briefMeta"></div>
        <div class="lbl" style="margin-bottom:10px;">ARCHIVOS ADJUNTOS</div>
        <div class="files" id="briefFiles"></div>
      </div>

      <div class="tab-panel" id="tab-detalles">
        <div class="detail-grid" id="detallesGrid" style="grid-template-columns:1fr 1fr;"></div>
      </div>

      <div class="tab-panel" id="tab-historial">
        <div id="historyList"></div>
        <div class="comment-box">
          <div class="lbl">AGREGAR COMENTARIO</div>
          <textarea id="commentInput" placeholder="Escribe tus observaciones antes de aprobar o rechazar..."></textarea>
          <button onclick="addComment()">Guardar comentario</button>
        </div>
      </div>
    </div>

    <div class="modal-footer" id="modalFooter"></div>
  </div>
</div>

{{-- ─────────── MODAL ASIGNAR CAMPAÑAS A DISEÑADOR ─────────── --}}
<div class="overlay" id="assignModalOverlay">
  <div class="modal assign-modal" onclick="event.stopPropagation()">
    <div class="modal-head" style="border-bottom:1px solid var(--borde);padding-bottom:18px;">
      <div class="modal-head-top" style="margin-bottom:0;">
        <h2 class="modal-title" id="assignModalTitle" style="font-size:18px;"></h2>
        <button class="modal-close" onclick="closeAssignModal()">✕</button>
      </div>
    </div>
    <div class="modal-body">
      <div class="assign-section-title">EN CURSO CON ESTE DISEÑADOR</div>
      <div id="assignedList"></div>

      <div class="assign-section-title">CAMPAÑAS SIN ASIGNAR</div>
      <div id="availableList"></div>
    </div>
  </div>
</div>

{{-- ─────────── MODAL NUEVO / EDITAR PRODUCTO ─────────── --}}
<div class="overlay" id="productModalOverlay">
  <div class="modal" style="max-width:560px;" onclick="event.stopPropagation()">
    <div class="modal-head" style="padding-bottom:18px;">
      <div class="modal-head-top" style="margin-bottom:0;">
        <h2 class="modal-title" id="productModalTitle" style="font-size:18px;">Nuevo producto</h2>
        <button class="modal-close" onclick="closeProductModal()">✕</button>
      </div>
    </div>
    <div class="modal-body">
      <form id="productForm" onsubmit="return saveProduct(event)">
  <input type="hidden" id="productId" value="">

  <div class="form-row">
    <div class="field">
      <label>Nombre del producto</label>
      <input type="text" id="productName" placeholder="Ej. Volante A5 full color" required>
    </div>
    <div class="field">
      <label>Categoría</label>
      <select id="productCat" required>
        @foreach($categorias as $categoria)
          <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-row full">
    <div class="field">
      <label>Descripción</label>
      <textarea id="productDesc" placeholder="Detalles del producto, material, acabado..."></textarea>
    </div>
  </div>

  <div class="form-row">
    <div class="field">
      <label>Stock actual</label>
      <input type="number" id="productStock" placeholder="0" min="0" required>
    </div>
    <div class="field">
      <label>Stock máximo</label>
      <input type="number" id="productMax" placeholder="0" min="0" required>
    </div>
  </div>

  <div class="form-row">
    <div class="field">
      <label>Unidad de medida</label>
      <select id="productUnit">
        <option value="unidades">Unidades</option>
        <option value="millares">Millares</option>
        <option value="m²">m²</option>
        <option value="paquetes">Paquetes</option>
      </select>
    </div>
    <div class="field">
      <label>Precio base</label>
      <input type="number" id="productPrecio" placeholder="0" min="0" step="0.01" required>
    </div>
  </div>

  <div class="form-row">
    <div class="field">
      <label>Tamaño estándar</label>
      <input type="text" id="productTamano" placeholder='Ej. A5 (14.8 x 21 cm)'>
    </div>
    <div class="field">
      <label>Estado</label>
      <select id="productEstado">
        <option value="activo">Activo</option>
        <option value="inactivo">Inactivo</option>
        <option value="agotado">Agotado</option>
      </select>
    </div>
  </div>

  <div class="modal-footer" style="padding:16px 0 0;border-top:1px solid var(--borde);">
    <span class="meta"></span>
    <button type="button" class="btn-ghost" onclick="closeProductModal()">Cancelar</button>
    <button type="submit" class="btn-solid">Guardar producto</button>
  </div>
</form>
    </div>
  </div>
</div>

<div class="toast" id="toast"></div>

{{--
    Cuando conectes el controlador de Laravel, en vez de los arreglos
    "campaigns", "clients" y "products" de más abajo, imprime lo que
    te pase la vista, por ejemplo:

        const campaigns = @json($campanas);
        const clients    = @json($clientes);
        const products    = @json($productos);

    Este bloque es un comentario de Blade: nunca llega al navegador,
    así que aquí SÍ se puede escribir @json normal, sin doble arroba.
--}}
<script>
const PRODUCT_ICONS = {
  "Valla Publicitaria":       { icon:"🪧" },
  "Folleto":                  { icon:"📄" },
  "Cartel / Póster":          { icon:"🖼" },
  "Tarjeta de Presentación":  { icon:"💼" },
};
function getIcon(name){ return (PRODUCT_ICONS[name] && PRODUCT_ICONS[name].icon) || "🖨️"; }

// ---- DATOS REALES DESDE EL CONTROLADOR (routes/web.php) ----
let campaigns = @json($pedidos);
const clients = @json($clientes);
let products = @json($productos);
const disenadoresList = @json($disenadores);

/* ============================================================
   ESTADO DE FILTROS
   ============================================================ */
let state = { status:"todos", product:"Todos", designer:"Todos", search:"" };
let activeCampaignId = null;
const money = n => new Intl.NumberFormat("es-CO",{style:"currency",currency:"COP",maximumFractionDigits:0}).format(n || 0);

const STATUS = {
  pendiente: { label:"Pendiente", cls:"badge-pendiente" },
  revision:  { label:"En revisión", cls:"badge-revision" },
  aprobada:  { label:"Aprobada", cls:"badge-aprobada" },
  rechazada: { label:"Rechazada", cls:"badge-rechazada" },
};
function statusInfo(s){ return STATUS[s] || { label: s || "—", cls:"badge-pendiente" }; }

const PRIORITY = {
  alta:{label:"Alta",cls:"badge-alta"}, media:{label:"Media",cls:"badge-media"}, baja:{label:"Baja",cls:"badge-baja"},
};
function priorityInfo(p){ return PRIORITY[p] || PRIORITY.media; }

/* ============================================================
   NAVEGACIÓN ENTRE SECCIONES
   ============================================================ */
const TITLES = {
  campanas:  ["Gestión de Campañas", "Aprobación y seguimiento de proyectos"],
  clientes:  ["Clientes", "Contactos y productos contratados por cada cliente"],
  productos: ["Productos", "Inventario y existencias por línea de producto"],
  disenadores: ["Diseñadores", "Carga de trabajo por diseñador"],
  usuarios: ["Usuarios", "Habilita o inhabilita clientes y diseñadores"],
};

document.querySelectorAll(".nav-btn").forEach(btn=>{
  btn.addEventListener("click",()=>{
    document.querySelectorAll(".nav-btn").forEach(b=>b.classList.remove("active"));
    btn.classList.add("active");
    const target = btn.dataset.target;
    document.querySelectorAll(".section").forEach(s=>s.classList.remove("active"));
    document.getElementById("section-"+target).classList.add("active");
    document.getElementById("pageTitle").innerHTML = `<b>${TITLES[target][0]}</b><span>${TITLES[target][1]}</span>`;
  });
});

document.getElementById("toggleSidebar").addEventListener("click",()=>{
  const sb = document.getElementById("sidebar");
  sb.classList.toggle("collapsed");
  const collapsed = sb.classList.contains("collapsed");
  document.getElementById("brandText").style.display = collapsed ? "none" : "block";
  document.getElementById("adminText").style.display = collapsed ? "none" : "block";
  document.querySelectorAll(".nav-btn .lb, .nav-badge").forEach(el=>el.style.display = collapsed ? "none" : "");
});

/* ============================================================
   RENDER: CAMPAÑAS
   ============================================================ */
function statusChips(){
  const opts = [["todos","Todos"],["pendiente","Pendiente"],["revision","En revisión"],["aprobada","Aprobada"],["rechazada","Rechazada"]];
  document.getElementById("statusChips").innerHTML = opts.map(([v,l])=>
    `<button class="chip ${state.status===v?'active':''}" onclick="setStatusFilter('${v}')">${l}</button>`).join("");
}
function fillSelect(id, options, current){
  document.getElementById(id).innerHTML = options.map(o=>`<option ${o===current?'selected':''}>${o}</option>`).join("");
}
function setStatusFilter(v){ state.status=v; renderCampaigns(); }

function renderCampaigns(){
  statusChips();

  const productNames = [...new Set([...products.map(p=>p.name), ...campaigns.map(c=>c.product)])].filter(Boolean);
  const designerNames = [...new Set([...disenadoresList.map(d=>d.name), ...campaigns.map(c=>c.designer)])].filter(Boolean);

  fillSelect("productFilter", ["Todos", ...productNames], state.product);
  fillSelect("designerFilter", ["Todos", ...designerNames], state.designer);

  const filtered = campaigns.filter(c=>{
    const okStatus = state.status==="todos" || c.status===state.status;
    const okProduct = state.product==="Todos" || c.product===state.product;
    const okDesigner = state.designer==="Todos" || c.designer===state.designer;
    const q = state.search.toLowerCase();
    const okSearch = !q || (c.client||"").toLowerCase().includes(q) || (c.title||"").toLowerCase().includes(q) || (c.id||"").toLowerCase().includes(q);
    return okStatus && okProduct && okDesigner && okSearch;
  });

  document.getElementById("resultCount").textContent = `${filtered.length} resultado${filtered.length!==1?'s':''}`;
  const pendingCount = campaigns.filter(c=>c.status==="pendiente").length;
  document.getElementById("pendingBadge").textContent = pendingCount;
  document.getElementById("pendingCount").textContent = pendingCount;

  const grid = document.getElementById("campaignGrid");
  document.getElementById("campaignEmpty").style.display = filtered.length ? "none":"block";
  grid.innerHTML = filtered.map(c=>{
    const s = statusInfo(c.status), p = priorityInfo(c.priority);
    const isPending = c.status==="pendiente";
    return `
    <div class="card" onclick="openModal('${c.id}')">
      <div class="card-strip ${c.status==='aprobada'||c.status==='pendiente'?'':'dorado'}"></div>
      <div class="card-body">
        <div class="card-top">
          <div style="display:flex;gap:10px;align-items:center;">
            <div class="card-icon">${getIcon(c.product)}</div>
            <div><div class="card-cat">${(c.product||"").toUpperCase()}</div><div class="card-title">${c.title||"Sin título"}</div></div>
          </div>
          <span class="badge ${p.cls}">${p.label}</span>
        </div>
        <div class="card-client"><span class="client-avatar">${(c.client||"?")[0]}</span>${c.client||"Cliente sin nombre"}</div>
        <div class="card-meta">
          <div><span class="meta-k">TAMAÑO</span><span class="meta-v">${c.size||"—"}</span></div>
          <div><span class="meta-k">CANTIDAD</span><span class="meta-v">${(c.qty??0).toLocaleString('es-CO')}</span></div>
          <div><span class="meta-k">PRESUPUESTO</span><span class="meta-v">${money(c.budget)}</span></div>
          <div><span class="meta-k">LÍMITE</span><span class="meta-v">${c.deadline||"—"}</span></div>
        </div>
        <div class="card-bottom">
          <span class="designer">✏️ ${c.designer||"Sin asignar"}</span>
          <span class="badge ${s.cls}"><span class="dot"></span>${s.label}</span>
        </div>
        ${isPending ? `
        <div class="card-actions">
          <button class="btn-reject" onclick="event.stopPropagation();setStatus('${c.id}','rechazada')">✕ Rechazar</button>
          <button class="btn-approve" onclick="event.stopPropagation();setStatus('${c.id}','aprobada')">✓ Aprobar</button>
        </div>`:``}
      </div>
    </div>`;
  }).join("");
}

document.getElementById("searchInput").addEventListener("input", e=>{ state.search=e.target.value; renderCampaigns(); });
document.getElementById("productFilter").addEventListener("change", e=>{ state.product=e.target.value; renderCampaigns(); });
document.getElementById("designerFilter").addEventListener("change", e=>{ state.designer=e.target.value; renderCampaigns(); });

/* ============================================================
   RENDER: PRODUCTOS
   ============================================================ */
function renderProducts(){
  const grid = document.getElementById("productGrid");
  const empty = document.getElementById("productEmpty");
  const countLbl = document.getElementById("productCount");

  countLbl.textContent = `${products.length} producto${products.length!==1?'s':''} registrado${products.length!==1?'s':''}`;

  if(!products.length){
    grid.innerHTML = "";
    empty.style.display = "block";
    return;
  }
  empty.style.display = "none";

  grid.innerHTML = products.map(p=>{
    const pct = p.max ? Math.min(100, Math.round((p.stock/p.max)*100)) : 0;
    return `
    <div class="prod-card">
      <button class="prod-edit-btn" title="Editar" onclick="openProductModal(${p.id})">✎</button>
      <div class="prod-top">
        <div class="prod-icon">${getIcon(p.name)}</div>
        <div><div class="prod-name">${p.name}</div><div class="prod-cat">${p.cat||""}</div></div>
      </div>
      <p class="prod-desc">${p.desc||""}</p>
      <div class="stock-row">
        <span class="stock-num">${(p.stock??0).toLocaleString('es-CO')}</span>
        <span class="stock-lbl">${(p.unit||"unidades").toUpperCase()}</span>
      </div>
      <div class="stock-bar"><div class="stock-fill" style="width:${pct}%"></div></div>
    </div>`;
  }).join("");
}

/* ============================================================
   MODAL: NUEVO / EDITAR PRODUCTO
   ============================================================ */
function openProductModal(id){
  document.getElementById("productForm").reset();
  document.getElementById("productId").value = "";
  document.getElementById("productModalTitle").textContent = "Nuevo producto";

  if(id){
    const p = products.find(x=>x.id===id);
    if(p){
      document.getElementById("productModalTitle").textContent = "Editar producto";
      document.getElementById("productId").value = p.id;
      document.getElementById("productName").value = p.name || "";
      document.getElementById("productCat").value = p.cat || "Otro";
      document.getElementById("productDesc").value = p.desc || "";
      document.getElementById("productStock").value = p.stock ?? 0;
      document.getElementById("productMax").value = p.max ?? 0;
      document.getElementById("productUnit").value = p.unit || "unidades";
      document.getElementById("productCat").value = p.cat_id || "";
      document.getElementById("productPrecio").value = p.precio ?? 0;
      document.getElementById("productTamano").value = p.tamano || "";
      document.getElementById("productEstado").value = p.estado || "activo";
    }
  }
  document.getElementById("productModalOverlay").classList.add("open");
}
function closeProductModal(){
  document.getElementById("productModalOverlay").classList.remove("open");
}
document.getElementById("productModalOverlay").addEventListener("click", closeProductModal);

function saveProduct(e){
  e.preventDefault();
  const id = document.getElementById("productId").value;
    const payload = {
  nombre:          document.getElementById("productName").value.trim(),
  categoria_id:    document.getElementById("productCat").value,
  descripcion:     document.getElementById("productDesc").value.trim(),
  stock_actual:    Number(document.getElementById("productStock").value || 0),
  stock_maximo:    Number(document.getElementById("productMax").value || 0),
  unidad_medida:   document.getElementById("productUnit").value,
  precio_base:     Number(document.getElementById("productPrecio").value || 0),
  tamano_estandar: document.getElementById("productTamano").value.trim(),
  estado:          document.getElementById("productEstado").value,
};

  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  const url = id ? `/productos/${id}` : `/productos`;

  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json',
    },
    body: JSON.stringify(id ? { ...payload, _method: 'PUT' } : payload),
  })
  .then(res => { if(!res.ok) throw new Error(); return res.json(); })
  .then(saved => {
    if(id){
      products = products.map(p => p.id === saved.id ? saved : p);
      showToast("✅ Producto actualizado");
    } else {
      products.push(saved);
      showToast("✅ Producto agregado");
    }
    renderProducts();
    renderCampaigns(); // por si el nuevo producto debe aparecer en los filtros
    closeProductModal();
  })
  .catch(() => {
    showToast("⚠️ No se pudo guardar el producto, intenta de nuevo");
  });

  return false;
}

/* ============================================================
   RENDER: CLIENTES
   ============================================================ */
function renderClients(){
  document.getElementById("clientList").innerHTML = clients.map(c=>`
    <div class="client-row">
      <div class="client-big-avatar">${(c.name||"?")[0]}</div>
      <div>
        <div class="client-name">${c.name||"—"}</div>
        <div class="client-contact">Contacto: ${c.contact||c.name||"—"}</div>
      </div>
      <div><div class="field-lbl">TELÉFONO</div><div class="field-val">${c.phone||"—"}</div></div>
      <div><div class="field-lbl">CORREO</div><div class="field-val">${c.email||"—"}</div></div>
      <div>
        <div class="field-lbl">PRODUCTO COMPRADO</div>
        <div class="field-val product">${getIcon(c.product)} ${c.product||"—"}</div>
        <div style="font-size:11px;color:var(--texto-suave);margin-top:2px;">${c.campaign||""}</div>
      </div>
    </div>`).join("");
}

/* ============================================================
   RENDER: DISEÑADORES
   ============================================================ */
function renderDesigners(){
  const grid = document.getElementById("designerGrid");
  if(!disenadoresList.length){
    grid.innerHTML = `<div class="empty"><div class="ic">✏️</div><div style="font-weight:700;font-size:16px;margin-top:10px;">Aún no hay diseñadores registrados (usuarios con role "empleado")</div></div>`;
    return;
  }
  grid.innerHTML = disenadoresList.map(d=>{
    const own = campaigns.filter(c=>c.designer===d.name);
    const initials = d.name.split(" ").map(w=>w[0]).slice(0,2).join("").toUpperCase();
    return `
    <div class="designer-card">
      <div class="designer-avatar">${initials}</div>
      <div style="font-weight:800;font-size:14px;">${d.name}</div>
      <div style="font-size:11px;color:var(--texto-suave);">${[...new Set(own.map(o=>o.client))].join(", ") || "Sin campañas asignadas"}</div>
      <div class="designer-count">${own.length}</div>
      <div style="font-size:10px;color:var(--texto-suave);font-weight:700;">CAMPAÑAS ASIGNADAS</div>
      <button class="btn-assign" onclick="openAssignModal(${d.id})">📋 Asignar campaña</button>
    </div>`;
  }).join("");
}

/* ============================================================
   ACCIONES SOBRE UNA CAMPAÑA
   ============================================================ */
function setStatus(id, status){
  const campaign = campaigns.find(c => c.id === id);
  if (!campaign) return;

  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

  fetch(`/pedidos/${campaign.real_id}/estado`, {
    method: 'PATCH',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json',
    },
    body: JSON.stringify({ estado: status }),
  })
  .then(async res => {
    // Se lee el JSON también cuando hay error, para mostrar el mensaje del servidor
    const data = await res.json().catch(() => ({}));
    if (!res.ok) throw new Error(data.message || 'Error al guardar');
    return data;
  })
  .then(data => {
    campaigns = campaigns.map(c => c.id === id ? {...c, status} : c);

    // NUEVO: actualizar el stock del producto en la sección Productos sin recargar
    if (data.producto_id && data.stock !== null && data.stock !== undefined) {
      products = products.map(p => p.id === data.producto_id ? {...p, stock: data.stock} : p);
      renderProducts();
    }

    renderCampaigns();
    if (activeCampaignId === id) closeModal();
    const msgs = { aprobada:"✅ Campaña aprobada y guardada", rechazada:"❌ Campaña rechazada y guardada", revision:"🔄 Enviada a revisión y guardada" };
    showToast(msgs[status]);
  })
  .catch(err => {
    // NUEVO: si el servidor dijo "Stock insuficiente...", se muestra ese mensaje
    const generico = err.message === 'Error al guardar' || !err.message;
    showToast("⚠️ " + (generico ? "No se pudo guardar el cambio, intenta de nuevo" : err.message));
  });
}
function addComment(){
  const val = document.getElementById("commentInput").value.trim();
  if(!val) return;
  campaigns = campaigns.map(c=> c.id===activeCampaignId ? {...c, comments:[...(c.comments||[]), val+" — Admin"]} : c);
  document.getElementById("commentInput").value="";
  showToast("Comentario agregado");
  openModal(activeCampaignId, true);
}
function showToast(msg){
  const t = document.getElementById("toast");
  t.textContent = msg; t.classList.add("show");
  setTimeout(()=>t.classList.remove("show"), 2600);
}

/* ============================================================
   MODAL
   ============================================================ */
function openModal(id, keepTab){
  const c = campaigns.find(x=>x.id===id);
  if(!c) return;
  activeCampaignId = id;
  document.getElementById("modalIcon").textContent = getIcon(c.product);
  document.getElementById("modalCat").textContent = (c.product||"").toUpperCase();
  document.getElementById("modalTitle").textContent = c.title||"Sin título";
  document.getElementById("modalClient").textContent = `${c.client||"—"} · ${c.contact||"—"}`;
  document.getElementById("modalPriority").innerHTML = `<span class="badge ${priorityInfo(c.priority).cls}">${priorityInfo(c.priority).label}</span>`;
  document.getElementById("modalStatus").innerHTML = `<span class="badge ${statusInfo(c.status).cls}"><span class="dot"></span>${statusInfo(c.status).label}</span>`;

  document.getElementById("briefText").textContent = c.brief || "Sin descripción.";
  document.getElementById("briefMeta").innerHTML = [
    ["Acabado / Color", c.size||"—"], ["Cantidad", (c.qty??0).toLocaleString('es-CO')+" unid."], ["Total", money(c.budget)],
    ["Ubicación / Destino", c.location||"—"], ["Fecha límite", c.deadline||"—"], ["Diseñador asignado", c.designer||"Sin asignar"],
  ].map(([k,v])=>`<div class="d"><div class="meta-k">${k.toUpperCase()}</div><div class="meta-v">${v}</div></div>`).join("");
  document.getElementById("briefFiles").innerHTML = (c.files||[]).map(f=>`<div class="file-chip">📎 ${f}</div>`).join("") || `<span style="font-size:12px;color:var(--texto-suave);">Sin archivos adjuntos</span>`;

  document.getElementById("detallesGrid").innerHTML = [
    ["ID Producto",c.id],["Cliente",c.client||"—"],["Contacto",c.contact||"—"],["Producto",c.product||"—"],["Acabado / color",c.size||"—"],
    ["Cantidad",(c.qty??0).toLocaleString('es-CO')],["Total",money(c.budget)],["Diseñador",c.designer||"Sin asignar"],
    ["Fecha envío",c.submitted||"—"],["Fecha límite",c.deadline||"—"],["Ubicación",c.location||"—"],["Estado actual",statusInfo(c.status).label],
  ].map(([k,v])=>`<div style="border-bottom:1px solid var(--borde);padding-bottom:12px;"><div style="font-size:11px;color:var(--texto-suave);margin-bottom:3px;">${k}</div><div style="font-size:14px;font-weight:600;">${v}</div></div>`).join("");

  document.getElementById("historyList").innerHTML = `
    <div class="history-item"><div><b style="color:var(--verde-oscuro);">Campaña enviada</b> · ${c.submitted||"—"}<div style="font-size:12px;color:var(--texto-suave);">Por ${c.contact||"—"}</div></div></div>
    ${(c.comments||[]).map(cm=>`<div class="history-item" style="border-left-color:var(--dorado);"><div><b style="color:var(--dorado);">Comentario</b><div style="margin-top:2px;">${cm}</div></div></div>`).join("")}`;

  const footer = document.getElementById("modalFooter");
  if(c.status==="pendiente" || c.status==="revision"){
    footer.style.display="flex";
    footer.innerHTML = `
      <span class="meta">Enviada el ${c.submitted||"—"} · ID ${c.id}</span>
      <button class="btn-outline" onclick="setStatus('${c.id}','revision')">🔄 Solicitar revisión</button>
      <button class="btn-ghost" onclick="setStatus('${c.id}','rechazada')">✕ Rechazar</button>
      <button class="btn-solid" onclick="setStatus('${c.id}','aprobada')">✓ Aprobar campaña</button>`;
  } else { footer.style.display="none"; footer.innerHTML=""; }

  if(!keepTab){
    document.querySelectorAll(".tab-btn").forEach(b=>b.classList.remove("active"));
    document.querySelector('.tab-btn[data-tab="brief"]').classList.add("active");
    document.querySelectorAll(".tab-panel").forEach(p=>p.classList.remove("active"));
    document.getElementById("tab-brief").classList.add("active");
  }
  document.getElementById("modalOverlay").classList.add("open");
}
function closeModal(){ document.getElementById("modalOverlay").classList.remove("open"); activeCampaignId=null; }
document.getElementById("modalOverlay").addEventListener("click", closeModal);
document.querySelectorAll(".tab-btn").forEach(btn=>{
  btn.addEventListener("click",()=>{
    document.querySelectorAll(".tab-btn").forEach(b=>b.classList.remove("active"));
    btn.classList.add("active");
    document.querySelectorAll(".tab-panel").forEach(p=>p.classList.remove("active"));
    document.getElementById("tab-"+btn.dataset.tab).classList.add("active");
  });
});

/* ============================================================
   RENDER: USUARIOS (clientes y diseñadores, activar/desactivar)
   ============================================================ */
function usuarioRow(u, tipo){
  const activo = !!u.activo;
  return `
    <div class="client-row ${activo ? '' : 'inactivo'}">
      <div class="client-big-avatar">${(u.name||"?")[0]}</div>
      <div>
        <div class="client-name">${u.name||"—"}</div>
        <div class="client-contact">${tipo === 'cliente' ? (u.campaign || 'Sin pedidos aún') : 'Diseñador'}</div>
      </div>
      <div><div class="field-lbl">TELÉFONO</div><div class="field-val">${u.phone||"—"}</div></div>
      <div><div class="field-lbl">CORREO</div><div class="field-val">${u.email||"—"}</div></div>
      <div class="status-toggle">
        <span class="txt ${activo ? 'on' : 'off'}">${activo ? 'Activo' : 'Inactivo'}</span>
      </div>
      <label class="switch">
        <input type="checkbox" ${activo ? 'checked' : ''} onchange="toggleUsuario(${u.id}, this.checked, '${tipo}')">
        <span class="slider"></span>
      </label>
    </div>`;
}

function renderUsuarios(){
  document.getElementById("usuariosClientList").innerHTML = clients.length
    ? clients.map(c => usuarioRow(c, 'cliente')).join("")
    : `<div style="font-size:12px;color:var(--texto-suave);">No hay clientes registrados.</div>`;

  document.getElementById("usuariosDesignerList").innerHTML = disenadoresList.length
    ? disenadoresList.map(d => usuarioRow(d, 'disenador')).join("")
    : `<div style="font-size:12px;color:var(--texto-suave);">No hay diseñadores registrados.</div>`;
}

function toggleUsuario(id, activo, tipo){
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

  fetch(`/usuarios/${id}/activo`, {
    method: 'PATCH',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json',
    },
    body: JSON.stringify({ activo }),
  })
  .then(res => { if(!res.ok) throw new Error(); return res.json(); })
  .then(() => {
    if(tipo === 'cliente'){
      const u = clients.find(c => c.id === id);
      if(u) u.activo = activo;
    } else {
      const u = disenadoresList.find(d => d.id === id);
      if(u) u.activo = activo;
    }
    renderUsuarios();
    showToast(activo ? "✅ Usuario activado" : "🚫 Usuario desactivado");
  })
  .catch(() => {
    showToast("⚠️ No se pudo actualizar, intenta de nuevo");
    renderUsuarios(); // revierte el switch visualmente
  });
}

/* ============================================================
   ASIGNAR CAMPAÑAS A DISEÑADOR
   ============================================================ */
let activeDesignerId = null;

function openAssignModal(designerId){
  const designer = disenadoresList.find(d => d.id === designerId);
  if(!designer) return;
  activeDesignerId = designerId;

  document.getElementById("assignModalTitle").textContent = `Asignar campañas a ${designer.name}`;

  const asignadas = campaigns.filter(c => c.designer === designer.name);
  const disponibles = campaigns.filter(c => !c.designer || c.designer === "Sin asignar");

  document.getElementById("assignedList").innerHTML = asignadas.length
    ? asignadas.map(c => assignRow(c, false)).join("")
    : `<div style="font-size:12px;color:var(--texto-suave);">Sin campañas asignadas todavía.</div>`;

  document.getElementById("availableList").innerHTML = disponibles.length
    ? disponibles.map(c => assignRow(c, true)).join("")
    : `<div style="font-size:12px;color:var(--texto-suave);">No hay campañas sin asignar en este momento.</div>`;

  document.getElementById("assignModalOverlay").classList.add("open");
}

function assignRow(c, canAssign){
  return `
    <div class="assign-row">
      <div class="assign-row-icon">${getIcon(c.product)}</div>
      <div class="assign-row-info">
        <div class="assign-row-title">${c.title || "Sin título"}</div>
        <div class="assign-row-meta">${c.client || "Cliente"} · ${c.size || "—"} · ${(c.qty ?? 0).toLocaleString('es-CO')} unid. · ${money(c.budget)}</div>
      </div>
      ${canAssign
        ? `<button class="btn-solid" onclick="assignCampaign('${c.id}')">Asignar</button>`
        : `<span class="badge badge-aprobada">En curso</span>`}
    </div>`;
}

function assignCampaign(campaignId){
  const campaign = campaigns.find(c => c.id === campaignId);
  const designer = disenadoresList.find(d => d.id === activeDesignerId);
  if(!campaign || !designer) return;

  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

  fetch(`/pedidos/${campaign.real_id}/asignar-disenador`, {
    method: 'PATCH',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json',
    },
    body: JSON.stringify({ disenador_id: designer.id }),
  })
  .then(res => { if(!res.ok) throw new Error(); return res.json(); })
  .then(() => {
    campaigns = campaigns.map(c => c.id === campaignId ? {...c, designer: designer.name} : c);
    renderDesigners();
    renderCampaigns();
    openAssignModal(activeDesignerId);
    showToast(`✅ Campaña asignada a ${designer.name}`);
  })
  .catch(() => {
    showToast("⚠️ No se pudo asignar, intenta de nuevo");
  });
}

function closeAssignModal(){
  document.getElementById("assignModalOverlay").classList.remove("open");
  activeDesignerId = null;
}
document.getElementById("assignModalOverlay").addEventListener("click", closeAssignModal);

/* ============================================================
   INICIO
   ============================================================ */
renderCampaigns();
renderProducts();
renderClients();
renderDesigners();
renderUsuarios();
</script>
</body>
</html>