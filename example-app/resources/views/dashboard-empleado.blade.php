<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel de Diseñador · Adversing System</title>
<style>
  :root{
    --navy: #0c2b20;
    --orange: #154334;
    --orange-dark: #154334;
    --bg: #f4f5f7;
    --card: #ffffff;
    --text: #1c2333;
    --muted: #7a8199;
    --border: #ececf1;
    --red: #ef5b5b;
    --red-bg: #fdeaea;
    --green: #2fa96b;
    --green-bg: #e5f7ee;
    --amber: #e0a527;
    --amber-bg: #fdf3d8;
    --blue: #3b7ddd;
    --blue-bg: #e8f0fd;
    --purple: #8b5cf6;
    --purple-bg: #f1ebfe;
  }
  *{ box-sizing: border-box; }
  body{
    margin:0;
    font-family: -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    background: var(--bg);
    color: var(--text);
  }
  .app{ display:flex; min-height:100vh; }

  .sidebar{
    width:250px; flex-shrink:0; background: var(--navy); color:#cfd6e6;
    display:flex; flex-direction:column; overflow:hidden;
    transition: width .25s ease; white-space:nowrap;
  }
  .sidebar.collapsed{ width:0; }
  .brand{ display:flex; align-items:center; justify-content:center; padding:22px 20px; border-bottom:1px solid rgba(255,255,255,0.08); }
  .brand-icon{ display:flex;align-items:center;justify-content:center; }
  .brand-icon img{ width:180px; height:auto; object-fit:contain; }
  .nav{ padding:14px 12px; flex:1; }
  .nav-item{ display:flex; align-items:center; gap:12px; padding:11px 14px; border-radius:10px; margin-bottom:4px; color:#aeb6cc; font-size:14px; font-weight:500; cursor:pointer; border:1px solid transparent; transition: background .15s ease; }
  .nav-item:hover{ background: rgba(255,255,255,0.05); }
  .nav-item.active{ background: #c9a24b; border-color: #c9a24b; color: #ffffff; }
  .nav-icon{ width:18px; text-align:center; }
  .badge-count{ margin-left:auto; background: var(--red); color:#fff; font-size:11px; font-weight:700; padding:2px 7px; border-radius:999px; }
  .sidebar-user{ display:flex; align-items:center; gap:10px; padding:16px 18px; border-top:1px solid rgba(255,255,255,0.08); }
  .avatar{ width:36px;height:36px;border-radius:50%; background: var(--orange); color:#fff; display:flex;align-items:center;justify-content:center; font-weight:700; font-size:13px; }
  .user-name{ font-size:13px; font-weight:600; color:#fff; }
  .user-role{ font-size:12px; color:#8a92ab; }

  .main{ flex:1; padding:26px 32px; min-width:0; }
  .topbar{ display:flex; align-items:center; gap:18px; margin-bottom:24px; flex-wrap:wrap; }
  .menu-btn{ background:none;border:none;font-size:20px;color:var(--text);cursor:pointer; }
  .topbar-title h1{ margin:0; font-size:18px; }
  .topbar-title p{ margin:2px 0 0; font-size:12.5px; color: var(--muted); }
  .search{ flex:1; max-width:420px; display:flex; align-items:center; gap:8px; background:#fff; border:1px solid var(--border); border-radius:10px; padding:9px 14px; color:var(--muted); font-size:13.5px; }
  .search input{ border:none;outline:none;flex:1;font-size:13.5px;background:transparent; }
  .logout-btn{ margin-left:auto; background: var(--red-bg); color: var(--red); border:none; padding:10px 18px; border-radius:9px; font-weight:600; font-size:13.5px; cursor:pointer; }

  .view{ display:none; }
  .view.active{ display:block; }

  .stats{ display:grid; grid-template-columns:repeat(4,1fr); gap:18px; margin-bottom:20px; }
  .stat-card{ background: var(--card); border-radius:14px; padding:18px 20px; display:flex; gap:14px; align-items:flex-start; border:1px solid var(--border); }
  .stat-icon{ width:44px;height:44px; border-radius:12px; display:flex;align-items:center;justify-content:center; font-size:19px; flex-shrink:0; }
  .stat-num{ font-size:24px; font-weight:800; line-height:1; }
  .stat-label{ font-size:13px; color:var(--muted); margin-top:4px; }
  .stat-sub{ font-size:12px; font-weight:600; margin-top:3px; }

  .alert{ background: var(--amber-bg); border:1px solid #f2e0a8; border-radius:12px; padding:14px 20px; display:flex; align-items:center; gap:10px; margin-bottom:20px; font-size:14px; flex-wrap:wrap; }
  .alert b{ font-weight:700; }
  .alert-link{ margin-left:auto; background:#fff; border:1px solid var(--orange); color: var(--orange-dark); font-weight:700; font-size:13px; padding:8px 16px; border-radius:8px; cursor:pointer; white-space:nowrap; }

  .filter-bar{ background:#fff; border:1px solid var(--border); border-radius:12px; padding:14px 18px; display:flex; align-items:center; gap:10px; margin-bottom:22px; flex-wrap:wrap; }
  .filter-label{ font-size:12.5px; font-weight:700; color:var(--muted); letter-spacing:0.4px; margin-right:4px;}
  .filter-chip{ border:1px solid var(--border); background:#fff; color:var(--text); padding:7px 16px; border-radius:999px; font-size:13px; font-weight:600; cursor:pointer; }
  .filter-chip.active{ border-color: var(--orange); color: var(--orange-dark); background: #fff3ec; }

  .tasks{ display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:20px; }
  .task-card{
    background:#fff; border-radius:14px; border:1px solid var(--border); border-top:4px solid var(--orange);
    padding:18px 20px 20px; cursor:pointer; transition: box-shadow .15s ease, transform .15s ease;
  }
  .task-card:hover{ box-shadow: 0 8px 20px rgba(0,0,0,0.07); transform: translateY(-2px); }
  .task-top{ display:flex; justify-content:space-between; align-items:flex-start; gap:10px; margin-bottom:10px; }
  .task-cat-row{ display:flex; align-items:center; gap:9px; }
  .task-cat-icon{ width:34px;height:34px;border-radius:9px; display:flex;align-items:center;justify-content:center; font-size:16px; background:#fdeee3; }
  .task-cat{ font-size:11.5px; font-weight:700; letter-spacing:0.3px; color: var(--orange-dark); text-transform: uppercase; }
  .task-title{ font-size:15px; font-weight:700; margin-top:2px; }
  .priority{ font-size:11.5px; font-weight:700; padding:4px 10px; border-radius:999px; white-space:nowrap; display:flex; align-items:center; gap:5px; }
  .priority::before{ content:""; width:6px;height:6px; border-radius:50%; background:currentColor; }
  .priority.alta{ background: var(--red-bg); color:#c53030; }
  .priority.media{ background: var(--amber-bg); color:#9a7211; }
  .priority.baja{ background: var(--green-bg); color:#1f7a4d; }

  .task-client{ display:flex; align-items:center; gap:8px; font-size:13.5px; font-weight:600; margin-bottom:14px; }
  .client-avatar{ width:22px;height:22px; border-radius:50%; background: var(--purple-bg); color: var(--purple); font-size:11px; font-weight:800; display:flex;align-items:center;justify-content:center; }

  .task-grid{ display:grid; grid-template-columns:1fr 1fr; gap:10px 16px; background:#f8f9fb; border-radius:10px; padding:12px 14px; margin-bottom:12px; }
  .task-meta{ font-size:11.5px; color:var(--muted); display:flex; align-items:center; gap:5px; margin-bottom:2px;}
  .task-value{ font-size:13.5px; font-weight:700; }
  .task-estado{ font-size:13px; color:var(--muted); margin-bottom:8px; }
  .task-estado b{ color:var(--text); }
  .task-comment{ background:#fef6ec; border-radius:9px; padding:9px 12px; font-size:12.5px; font-weight:600; color:#a8621a; display:flex; gap:7px; align-items:flex-start; }

  .notif-grid{ display:grid; grid-template-columns:repeat(auto-fill, minmax(230px, 1fr)); gap:24px; }
  .notif-card{ position:relative; background: linear-gradient(180deg, #1b5340 0%, #154334 100%); border-radius:20px; padding:44px 20px 24px; text-align:center; overflow:visible; }
  .notif-card.leida{ background: linear-gradient(180deg, #eef0f4 0%, #e6e8ed 100%); }
  .notif-bell-wrap{ position:absolute; top:-26px; left:50%; transform:translateX(-50%); width:64px;height:64px; border-radius:50%; background:#fff; display:flex;align-items:center;justify-content:center; font-size:28px; box-shadow: 0 6px 14px rgba(0,0,0,0.12); }
  .notif-badge{ position:absolute; top:-4px; right:-2px; background: var(--red); color:#fff; font-size:11px; font-weight:800; width:20px;height:20px; border-radius:50%; display:flex;align-items:center;justify-content:center; border:2px solid #fff; }
  .notif-inner{ background:#fff; border-radius:14px; padding:22px 16px 18px; box-shadow: 0 10px 20px rgba(0,0,0,0.06); }
  .notif-title{ font-size:15px; font-weight:800; margin-bottom:4px; }
  .notif-sub{ font-size:12px; color:var(--muted); margin-bottom:16px; line-height:1.4; }
  .notif-open-btn{ background:#154334; color:#fff; border:none; padding:10px 26px; border-radius:999px; font-weight:700; font-size:13px; cursor:pointer; }
  .notif-open-btn:hover{ opacity:0.92; }
  .notif-time{ margin-top:12px; font-size:11px; color:#cfe4da; font-weight:600; }
  .notif-card.leida .notif-time{ color: var(--muted); }

  .modal-overlay{ display:none; position:fixed; inset:0; background: rgba(20,20,30,0.45); align-items:center; justify-content:center; padding:20px; z-index:100; }
  .modal-overlay.active{ display:flex; }
  .modal-card{ background:#fff; border-radius:18px; max-width:440px; width:100%; padding:26px 26px 22px; position:relative; box-shadow: 0 20px 50px rgba(0,0,0,0.25); }
  .modal-close{ position:absolute; top:14px; right:16px; background:none; border:none; font-size:18px; color:var(--muted); cursor:pointer; }
  .modal-header{ display:flex; align-items:center; gap:12px; margin-bottom:16px; }
  .modal-icon{ width:46px;height:46px; border-radius:12px; background:#fdeee3; display:flex;align-items:center;justify-content:center; font-size:20px; flex-shrink:0; }
  .modal-cat{ font-size:11px; font-weight:700; letter-spacing:0.3px; color: var(--orange-dark); text-transform: uppercase; }
  .modal-title{ font-size:16px; font-weight:800; margin-top:2px; }
  .modal-client{ font-size:13px; color:var(--muted); margin-bottom:16px; display:flex; align-items:center; gap:6px; }
  .modal-grid{ display:grid; grid-template-columns:1fr 1fr; gap:10px 16px; background:#f8f9fb; border-radius:10px; padding:14px 16px; margin-bottom:14px; }
  .modal-comment{ background:#fef6ec; border-radius:9px; padding:10px 12px; font-size:12.5px; font-weight:600; color:#a8621a; margin-bottom:14px; }
  .modal-actions{ display:flex; justify-content:flex-end; }
  .modal-actions button{ background: var(--orange); color:#fff; border:none; padding:10px 22px; border-radius:9px; font-weight:700; font-size:13px; cursor:pointer; }

  /* ---- Modal de detalle de tarea (estilo Brief / Detalles / Historial) ---- */
  .tmodal-overlay{ display:none; position:fixed; inset:0; background: rgba(15,20,25,0.55); align-items:center; justify-content:center; padding:20px; z-index:110; }
  .tmodal-overlay.active{ display:flex; }
  .tmodal-card{
    background:#fff; border-radius:20px; max-width:640px; width:100%; max-height:88vh; overflow-y:auto;
    padding:26px 28px 24px; position:relative; box-shadow: 0 24px 60px rgba(0,0,0,0.3);
  }
  .tmodal-close{ position:absolute; top:18px; right:18px; background:#f4f5f7; border:none; width:30px;height:30px; border-radius:50%; font-size:15px; color:var(--muted); cursor:pointer; display:flex; align-items:center; justify-content:center; }
  .tmodal-top{ display:flex; justify-content:space-between; align-items:flex-start; gap:14px; padding-right:38px; }
  .tmodal-id-row{ display:flex; gap:12px; align-items:flex-start; }
  .tmodal-icon-box{ width:44px;height:44px;border-radius:12px; background:#eef0f4; display:flex;align-items:center;justify-content:center; font-size:20px; flex-shrink:0; }
  .tmodal-cat{ font-size:11px; font-weight:700; letter-spacing:0.4px; color: var(--orange-dark); text-transform: uppercase; }
  .tmodal-title{ font-size:17px; font-weight:800; margin-top:2px; }
  .tmodal-badges{ display:flex; gap:8px; flex-shrink:0; }
  .badge-pill{ font-size:11px; font-weight:700; padding:5px 12px; border-radius:999px; display:flex; align-items:center; gap:5px; white-space:nowrap; }
  .badge-pill::before{ content:""; width:6px;height:6px;border-radius:50%; background:currentColor; }
  .badge-pill.media{ background: var(--amber-bg); color:#9a7211; }
  .badge-pill.alta{ background: var(--red-bg); color:#c53030; }
  .badge-pill.baja{ background: var(--green-bg); color:#1f7a4d; }
  .badge-pill.estado{ background: var(--navy); color:#fff; }
  .tmodal-client-line{ font-size:13px; color:var(--muted); margin:8px 0 18px 56px; }

  .tmodal-tabs{ display:flex; gap:22px; border-bottom:1px solid var(--border); margin-bottom:18px; }
  .tmodal-tab{ padding:9px 2px; font-size:13.5px; font-weight:600; color:var(--muted); cursor:pointer; border-bottom:2px solid transparent; }
  .tmodal-tab.active{ color:var(--text); border-bottom-color: var(--orange); }

  .tmodal-panel{ display:none; }
  .tmodal-panel.active{ display:block; }

  .tmodal-brief-box{ background:#f8f9fb; border-radius:10px; padding:12px 14px; margin-bottom:18px; }
  .tmodal-brief-label{ font-size:10.5px; font-weight:700; color:var(--muted); letter-spacing:0.4px; margin-bottom:6px; text-transform:uppercase; }
  .tmodal-brief-text{ font-size:13.5px; color: var(--text); line-height:1.5; }

  .tmodal-grid{ display:grid; grid-template-columns:repeat(3,1fr); gap:16px 18px; margin-bottom:20px; }
  .tmodal-field-label{ font-size:10.5px; font-weight:700; color:var(--muted); letter-spacing:0.3px; margin-bottom:5px; text-transform:uppercase; }
  .tmodal-field-value{ font-size:13.5px; font-weight:700; }

  .tmodal-attach-title{ font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; }
  .tmodal-attach-empty{ font-size:12.5px; color:var(--muted); }

  .tmodal-historial-item{ display:flex; gap:10px; padding:10px 0; border-bottom:1px solid var(--border); font-size:13px; }
  .tmodal-historial-item:last-child{ border-bottom:none; }
  .tmodal-historial-dot{ width:8px;height:8px; border-radius:50%; background: var(--orange); margin-top:5px; flex-shrink:0; }

  @media (max-width:1000px){
    .stats{ grid-template-columns: repeat(2,1fr); }
    .sidebar{ display:none; }
  }
</style>
</head>
<body>

<div class="app">

  <aside class="sidebar collapsed" id="sidebar">
    <div class="brand">
      <div class="brand-icon">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
      </div>
    </div>

    <nav class="nav">
      <div class="nav-item active" data-vista="tareas">
        <span class="nav-icon">📋</span> Mis Tareas
      </div>
      <div class="nav-item" data-vista="mensajes">
        <span class="nav-icon">💬</span> Mensajes
        @php $noLeidas = $notificaciones->where('leida', false)->count(); @endphp
        @if($noLeidas > 0)
          <span class="badge-count">{{ $noLeidas }}</span>
        @endif
      </div>
    </nav>

    <div class="sidebar-user">
      <div class="avatar">{{ strtoupper(substr($usuario->name, 0, 2)) }}</div>
      <div>
        <div class="user-name">{{ $usuario->name }}</div>
        <div class="user-role">{{ $usuario->rol ?? 'Diseñador(a)' }}</div>
      </div>
    </div>
  </aside>

  <main class="main">

    <section class="view active" id="vista-tareas">

      <div class="topbar">
        <button class="menu-btn">☰</button>
        <div class="topbar-title">
          <h1>Panel de Diseñador</h1>
          <p>Gestión de tareas asignadas</p>
        </div>
        <div class="search">
          🔍 <input type="text" id="buscarTarea" placeholder="Buscar tarea...">
        </div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-btn">Cerrar Sesión</button>
        </form>
      </div>

      <section class="stats">
        <div class="stat-card">
          <div class="stat-icon" style="background: var(--amber-bg);">📋</div>
          <div>
            <div class="stat-num">{{ $stats['activas'] }}</div>
            <div class="stat-label">Tareas activas</div>
            <div class="stat-sub" style="color:var(--muted);">&nbsp;</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background: var(--blue-bg);">⏳</div>
          <div>
            <div class="stat-num">{{ $stats['revision'] }}</div>
            <div class="stat-label">En revisión</div>
            <div class="stat-sub" style="color:var(--blue);">Requieren acción</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background: var(--green-bg);">✅</div>
          <div>
            <div class="stat-num">{{ $stats['completadas'] }}</div>
            <div class="stat-label">Completadas</div>
            <div class="stat-sub" style="color:var(--green);">Este mes</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background: var(--purple-bg);">🗓️</div>
          <div>
            <div class="stat-num">{{ $stats['entregas_semana'] }}</div>
            <div class="stat-label">Entregas</div>
            <div class="stat-sub" style="color:var(--purple);">Esta semana</div>
          </div>
        </div>
      </section>

      @if($stats['urgentes'] > 0)
      <div class="alert">
        ⚠️ Tienes <b>{{ $stats['urgentes'] }} tarea{{ $stats['urgentes'] > 1 ? 's' : '' }}</b> con fecha límite esta semana.
        <button class="alert-link" onclick="document.querySelector('[data-filtro=\'todas\']').click()">Ver urgentes →</button>
      </div>
      @endif

      <div class="filter-bar">
        <span class="filter-label">FILTRAR:</span>
        <button class="filter-chip active" data-filtro="todas">Todas</button>
        <button class="filter-chip" data-filtro="pendiente">Pendientes</button>
        <button class="filter-chip" data-filtro="revision">Revisión</button>
        <button class="filter-chip" data-filtro="aprobada">Aprobadas</button>
        <button class="filter-chip" data-filtro="rechazada">Rechazadas</button>
      </div>

      <section class="tasks" id="listaTareas">
        @forelse($tareas as $t)
        <article
          class="task-card"
          data-estado="{{ $t->estado }}"
          data-titulo="{{ strtolower($t->titulo_display) }}"
          data-id="{{ $t->id }}"
          data-categoria="{{ $t->categoria_display }}"
          data-nombre-tarea="{{ $t->titulo_display }}"
          data-cliente="{{ $t->nombre_cliente_display ?? ($t->cliente->name ?? 'Cliente') }}"
          data-email="{{ $t->correo_cliente_display ?? ($t->correo ?? '') }}"
          data-prioridad="{{ $t->prioridad_display }}"
          data-tamano="{{ $t->tamano_display ?: '—' }}"
          data-cantidad="{{ $t->cantidad ?? '—' }}"
          data-presupuesto="{{ $t->presupuesto_display ?: '—' }}"
          data-ubicacion="{{ $t->ubicacion_display ?: '—' }}"
          data-limite="{{ $t->fecha_limite_display ?: '—' }}"
          data-disenador="{{ $usuario->name }}"
          data-contacto="{{ $t->contacto_display ?: '—' }}"
          data-progreso="{{ $t->progreso_display }}"
          data-descripcion="{{ $t->descripcion ?: 'Sin descripción.' }}"
          data-historial='{{ json_encode($t->historial ?? []) }}'
          onclick="abrirModalTarea(this)"
        >
          <div class="task-top">
            <div class="task-cat-row">
              <div class="task-cat-icon">🖼️</div>
              <div>
                <div class="task-cat">{{ $t->categoria_display }}</div>
                <div class="task-title">{{ $t->titulo_display }}</div>
              </div>
            </div>
            <span class="priority {{ $t->prioridad_display }}">{{ ucfirst($t->prioridad_display) }}</span>
          </div>

          <div class="task-client">
            <span class="client-avatar">{{ strtoupper(substr($t->nombre_cliente_display ?? ($t->cliente->name ?? '?'), 0, 1)) }}</span>
            {{ $t->nombre_cliente_display ?? ($t->cliente->name ?? 'Cliente') }}
          </div>

          <div class="task-grid">
            <div>
              <div class="task-meta">📏 Tamaño</div>
              <div class="task-value">{{ $t->tamano_display ?: '—' }}</div>
            </div>
            <div>
              <div class="task-meta">🔢 Cantidad</div>
              <div class="task-value">{{ $t->cantidad ?? '—' }}</div>
            </div>
            <div>
              <div class="task-meta">📆 Límite</div>
              <div class="task-value">{{ $t->fecha_limite_display ?? '—' }}</div>
            </div>
            <div>
              <div class="task-meta">📊 Progreso</div>
              <div class="task-value">{{ $t->progreso_display }}%</div>
            </div>
            <div>
              <div class="task-meta">👤 Contacto</div>
              <div class="task-value">{{ $t->contacto_display }}</div>
            </div>
            <div>
              <div class="task-meta">💰 Presupuesto</div>
              <div class="task-value">{{ $t->presupuesto_display }}</div>
            </div>
            <div>
              <div class="task-meta">📍 Ubicación</div>
              <div class="task-value">{{ $t->ubicacion_display ?: '—' }}</div>
            </div>
          </div>

          <div class="task-estado">Estado: <b>{{ $t->estado }}</b></div>

          @if($t->descripcion)
          <div class="task-comment">💬 {{ $t->descripcion }}</div>
          @endif
        </article>
        @empty
        <p style="color:var(--muted);">No tienes pedidos asignados por ahora.</p>
        @endforelse
      </section>

    </section>

    <section class="view" id="vista-mensajes">

      <div class="topbar">
        <button class="menu-btn">☰</button>
        <div class="topbar-title">
          <h1>Mensajes</h1>
          <p>Conversaciones con clientes y equipo</p>
        </div>
        <div class="search">
          🔍 <input type="text" id="buscarMensaje" placeholder="Buscar conversación...">
        </div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-btn">Cerrar Sesión</button>
        </form>
      </div>

      <div class="notif-grid" id="notifGrid"></div>

    </section>

    <!-- Modal simple de notificaciones (Mensajes) -->
    <div class="modal-overlay" id="modalOverlay">
      <div class="modal-card">
        <button class="modal-close" onclick="cerrarModal()">✕</button>

        <div class="modal-header">
          <div class="modal-icon" id="modalIcon">🖼️</div>
          <div>
            <div class="modal-cat" id="modalCat">Categoría</div>
            <div class="modal-title" id="modalTitle">Título</div>
          </div>
        </div>

        <div class="modal-client" id="modalClient">👤 Cliente</div>
        <div class="modal-grid" id="modalGrid"></div>
        <div class="modal-comment" id="modalComment" style="display:none;"></div>

        <div class="modal-actions">
          <button onclick="cerrarModal()">Entendido</button>
        </div>
      </div>
    </div>

    <!-- Modal de detalle de tarea con pestañas Brief / Detalles / Historial -->
    <div class="tmodal-overlay" id="tmodalOverlay">
      <div class="tmodal-card">
        <button class="tmodal-close" onclick="cerrarModalTarea()">✕</button>

        <div class="tmodal-top">
          <div class="tmodal-id-row">
            <div class="tmodal-icon-box" id="tmodalIcon">🖨️</div>
            <div>
              <div class="tmodal-cat" id="tmodalCat">Categoría</div>
              <div class="tmodal-title" id="tmodalTitle">Título</div>
            </div>
          </div>
          <div class="tmodal-badges">
            <span class="badge-pill" id="tmodalPrioridad">Media</span>
            <span class="badge-pill estado" id="tmodalEstado">Aprobada</span>
          </div>
        </div>
        <div class="tmodal-client-line" id="tmodalClient">gutierrez · brisa@gmail.com</div>

        <div class="tmodal-tabs">
          <div class="tmodal-tab active" data-tab="brief">Brief</div>
          <div class="tmodal-tab" data-tab="detalles">Detalles</div>
          <div class="tmodal-tab" data-tab="historial">Historial</div>
        </div>

        <!-- BRIEF -->
        <div class="tmodal-panel active" id="panel-brief">
          <div class="tmodal-brief-box">
            <div class="tmodal-brief-label">Briefing del cliente</div>
            <div class="tmodal-brief-text" id="tmodalDescripcion">Sin descripción.</div>
          </div>

          <div class="tmodal-grid">
            <div>
              <div class="tmodal-field-label">Acabado / color</div>
              <div class="tmodal-field-value" id="tmodalTamano">—</div>
            </div>
            <div>
              <div class="tmodal-field-label">Cantidad</div>
              <div class="tmodal-field-value" id="tmodalCantidad">—</div>
            </div>
            <div>
              <div class="tmodal-field-label">Total</div>
              <div class="tmodal-field-value" id="tmodalPresupuesto">—</div>
            </div>
            <div>
              <div class="tmodal-field-label">Ubicación / Destino</div>
              <div class="tmodal-field-value" id="tmodalUbicacion">—</div>
            </div>
            <div>
              <div class="tmodal-field-label">Fecha límite</div>
              <div class="tmodal-field-value" id="tmodalLimite">—</div>
            </div>
            <div>
              <div class="tmodal-field-label">Diseñador asignado</div>
              <div class="tmodal-field-value" id="tmodalDisenador">—</div>
            </div>
            <div>
              <div class="tmodal-field-label">Contacto</div>
              <div class="tmodal-field-value" id="tmodalContacto">—</div>
            </div>
          </div>

          <div class="tmodal-attach-title">Archivos adjuntos</div>
          <div class="tmodal-attach-empty" id="tmodalAdjuntos">Sin archivos adjuntos</div>
        </div>

        <!-- DETALLES -->
        <div class="tmodal-panel" id="panel-detalles">
          <div class="tmodal-grid">
            <div>
              <div class="tmodal-field-label">Progreso</div>
              <div class="tmodal-field-value" id="tmodalProgreso">—</div>
            </div>
            <div>
              <div class="tmodal-field-label">Estado actual</div>
              <div class="tmodal-field-value" id="tmodalEstadoDetalle">—</div>
            </div>
            <div>
              <div class="tmodal-field-label">Prioridad</div>
              <div class="tmodal-field-value" id="tmodalPrioridadDetalle">—</div>
            </div>
          </div>
        </div>

        <!-- HISTORIAL -->
        <div class="tmodal-panel" id="panel-historial">
          <div id="tmodalHistorialLista"></div>
        </div>

      </div>
    </div>

  </main>
</div>

<script>
  const CSRF_TOKEN = "{{ csrf_token() }}";
  const notificaciones = @json($notificaciones);

  // ---- Mostrar / ocultar el sidebar con el botón ☰ ----
  const sidebar = document.getElementById('sidebar');
  document.querySelectorAll('.menu-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
    });
  });

  // ---- Navegación entre vistas ----
  const navItems = document.querySelectorAll('.nav-item[data-vista]');
  const vistas = document.querySelectorAll('.view');

  navItems.forEach(item => {
    item.addEventListener('click', () => {
      const destino = item.dataset.vista;

      navItems.forEach(n => n.classList.remove('active'));
      item.classList.add('active');

      vistas.forEach(v => v.classList.remove('active'));
      document.getElementById('vista-' + destino).classList.add('active');
    });
  });

  // ---- Filtro por estado ----
  const chips = document.querySelectorAll('.filter-chip');
  const tarjetas = document.querySelectorAll('.task-card');

  chips.forEach(chip => {
    chip.addEventListener('click', () => {
      chips.forEach(c => c.classList.remove('active'));
      chip.classList.add('active');
      const filtro = chip.dataset.filtro;

      tarjetas.forEach(tarjeta => {
        tarjeta.style.display = (filtro === 'todas' || tarjeta.dataset.estado === filtro) ? '' : 'none';
      });
    });
  });

  // ---- Buscador de tareas ----
  document.getElementById('buscarTarea').addEventListener('input', (e) => {
    const texto = e.target.value.toLowerCase().trim();
    tarjetas.forEach(tarjeta => {
      tarjeta.style.display = tarjeta.dataset.titulo.includes(texto) ? '' : 'none';
    });
    chips.forEach(c => c.classList.remove('active'));
    document.querySelector('[data-filtro="todas"]').classList.add('active');
  });

  // ---- Notificaciones (vienen del servidor, no están quemadas) ----
  const notifGrid = document.getElementById('notifGrid');

  function renderNotificaciones() {
    notifGrid.innerHTML = '';
    notificaciones.forEach(n => {
      const card = document.createElement('div');
      card.className = 'notif-card' + (n.leida ? ' leida' : '');
      card.innerHTML = `
        <div class="notif-bell-wrap">
          🔔
          ${!n.leida ? '<span class="notif-badge">1</span>' : ''}
        </div>
        <div class="notif-inner">
          <div class="notif-title">${n.leida ? 'Notificación leída' : 'Notificación'}</div>
          <div class="notif-sub">${n.remitente}: ${n.resumen}</div>
          <button class="notif-open-btn" data-id="${n.id}">Abrir</button>
        </div>
        <div class="notif-time">${n.hora}</div>
      `;
      notifGrid.appendChild(card);
    });

    notifGrid.querySelectorAll('.notif-open-btn').forEach(btn => {
      btn.addEventListener('click', () => abrirModal(btn.dataset.id));
    });
  }

  const modalOverlay = document.getElementById('modalOverlay');

  function abrirModal(id) {
    const n = notificaciones.find(x => x.id == id);
    if (!n) return;

    if (!n.leida) {
      n.leida = true;
      // Persiste el "leído" en la base de datos
      fetch(`/dashboard/empleado/${id}/leida`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json' },
      });
    }
    renderNotificaciones();

    document.getElementById('modalIcon').textContent = n.categoria.includes('Folleto') ? '📄' : '🖼️';
    document.getElementById('modalCat').textContent = n.categoria;
    document.getElementById('modalTitle').textContent = n.titulo;
    document.getElementById('modalClient').textContent = '👤 ' + n.cliente;

    const grid = document.getElementById('modalGrid');
    grid.innerHTML = '';
    Object.entries(n.detalles).forEach(([label, valor]) => {
      grid.innerHTML += `
        <div>
          <div class="task-meta">${label}</div>
          <div class="task-value">${valor}</div>
        </div>
      `;
    });

    const comentario = document.getElementById('modalComment');
    if (n.comentario) {
      comentario.style.display = '';
      comentario.textContent = '💬 ' + n.comentario;
    } else {
      comentario.style.display = 'none';
    }

    modalOverlay.classList.add('active');
  }

  function cerrarModal() {
    modalOverlay.classList.remove('active');
  }

  modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) cerrarModal();
  });

  renderNotificaciones();

  // ---- Buscador de notificaciones ----
  document.getElementById('buscarMensaje').addEventListener('input', (e) => {
    const texto = e.target.value.toLowerCase().trim();
    document.querySelectorAll('.notif-card').forEach((card, i) => {
      const n = notificaciones[i];
      const coincide = (n.titulo + ' ' + n.remitente).toLowerCase().includes(texto);
      card.style.display = coincide ? '' : 'none';
    });
  });

  // =====================================================================
  // ---- Modal de detalle de TAREA (Brief / Detalles / Historial) ----
  // =====================================================================
  const tmodalOverlay = document.getElementById('tmodalOverlay');

  function iconoPorCategoria(categoria) {
    const c = (categoria || '').toLowerCase();
    if (c.includes('folleto')) return '📄';
    if (c.includes('cartel') || c.includes('poster') || c.includes('póster')) return '🖨️';
    return '🖼️';
  }

  function abrirModalTarea(el) {
    const d = el.dataset;

    document.getElementById('tmodalIcon').textContent = iconoPorCategoria(d.categoria);
    document.getElementById('tmodalCat').textContent = d.categoria;
    document.getElementById('tmodalTitle').textContent = d.nombreTarea;

    const clienteTexto = d.email ? `${d.cliente} · ${d.email}` : d.cliente;
    document.getElementById('tmodalClient').textContent = clienteTexto;

    // Badge de prioridad
    const badgePrioridad = document.getElementById('tmodalPrioridad');
    badgePrioridad.className = 'badge-pill ' + (d.prioridad || 'media');
    badgePrioridad.textContent = (d.prioridad || 'media').charAt(0).toUpperCase() + (d.prioridad || 'media').slice(1);

    // Badge de estado
    const badgeEstado = document.getElementById('tmodalEstado');
    badgeEstado.className = 'badge-pill estado';
    badgeEstado.textContent = (d.estado || '').charAt(0).toUpperCase() + (d.estado || '').slice(1);

    // Pestaña Brief
    document.getElementById('tmodalDescripcion').textContent = d.descripcion || 'Sin descripción.';
    document.getElementById('tmodalTamano').textContent = d.tamano || '—';
    document.getElementById('tmodalCantidad').textContent = (d.cantidad || '—') + (d.cantidad && d.cantidad !== '—' ? ' unid.' : '');
    document.getElementById('tmodalPresupuesto').textContent = d.presupuesto || '—';
    document.getElementById('tmodalUbicacion').textContent = d.ubicacion || '—';
    document.getElementById('tmodalLimite').textContent = d.limite || '—';
    document.getElementById('tmodalDisenador').textContent = d.disenador || '—';
    document.getElementById('tmodalContacto').textContent = d.contacto || '—';
    document.getElementById('tmodalAdjuntos').textContent = 'Sin archivos adjuntos';

    // Pestaña Detalles
    document.getElementById('tmodalProgreso').textContent = (d.progreso || '0') + '%';
    document.getElementById('tmodalEstadoDetalle').textContent = d.estado || '—';
    document.getElementById('tmodalPrioridadDetalle').textContent = d.prioridad || '—';

    // Pestaña Historial
    const historialLista = document.getElementById('tmodalHistorialLista');
    historialLista.innerHTML = '';
    let historial = [];
    try { historial = JSON.parse(d.historial || '[]'); } catch (e) { historial = []; }

    if (Array.isArray(historial) && historial.length > 0) {
      historial.forEach(h => {
        const item = document.createElement('div');
        item.className = 'tmodal-historial-item';
        const texto = typeof h === 'string' ? h : (h.texto || h.mensaje || JSON.stringify(h));
        const fecha = (typeof h === 'object' && h.fecha) ? h.fecha : '';
        item.innerHTML = `
          <span class="tmodal-historial-dot"></span>
          <div>
            <div>${texto}</div>
            ${fecha ? `<div style="color:var(--muted);font-size:11.5px;margin-top:2px;">${fecha}</div>` : ''}
          </div>
        `;
        historialLista.appendChild(item);
      });
    } else {
      historialLista.innerHTML = '<div class="tmodal-attach-empty">Aún no hay historial de cambios para esta tarea.</div>';
    }

    // Reiniciar a la pestaña Brief cada vez que se abre
    tmodalOverlay.querySelectorAll('.tmodal-tab').forEach(t => t.classList.remove('active'));
    tmodalOverlay.querySelector('.tmodal-tab[data-tab="brief"]').classList.add('active');
    tmodalOverlay.querySelectorAll('.tmodal-panel').forEach(p => p.classList.remove('active'));
    document.getElementById('panel-brief').classList.add('active');

    tmodalOverlay.classList.add('active');
  }

  function cerrarModalTarea() {
    tmodalOverlay.classList.remove('active');
  }

  tmodalOverlay.addEventListener('click', (e) => {
    if (e.target === tmodalOverlay) cerrarModalTarea();
  });

  // Cambio de pestañas dentro del modal de tarea
  tmodalOverlay.querySelectorAll('.tmodal-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      tmodalOverlay.querySelectorAll('.tmodal-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      tmodalOverlay.querySelectorAll('.tmodal-panel').forEach(p => p.classList.remove('active'));
      document.getElementById('panel-' + tab.dataset.tab).classList.add('active');
    });
  });
</script>

</body>
</html>