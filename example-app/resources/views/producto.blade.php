<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adversing System - Producto</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Inter:wght@400;500;600;700;800&family=Questrial&family=Playfair+Display:wght@400;700&family=Montserrat:wght@400;700&family=Poppins:wght@400;600&family=Bebas+Neue&family=Oswald:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
<style>
  :root{
    --teal:#1daeae;
    --teal-deep:#0a3d3a;
    --teal-deeper:#062826;
    --navy:#081b18;
    --white:#ffffff;
    --ivory:#faf8f3;
    --mist:#eef7f5;
    --gold:#b8935a;
    --gold-soft:#e7d9c0;

    --blue-light:#dff2ef;
    --blue-mid:#1daeae;
    --blue-strong:#0a3d3a;
    --blue-strong-dark:#062826;
    --grey-input:#e6e6e6;
    --grey-border:#cfcfcf;
    --orange:#b8935a;
    --green:#2fae6e;
    --error:#d63b3b;
  }
  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}
  body{font-family:'Inter',sans-serif;color:var(--navy);background:var(--ivory);}
  h1,h2,h3{font-family:'Fraunces',serif;margin:0;font-weight:500;}
  ul{margin:0;padding:0;list-style:none;}
  img{max-width:100%;display:block;}
  button{font-family:'Inter',sans-serif;}

  header{
    position:sticky;
    top:0;
    z-index:50;
    height:120px;
    background:var(--teal-deep);
    padding:0 6%;
    box-shadow:0 4px 24px rgba(6,20,18,.18);
    overflow:visible;
  }
  .header-inner{position:relative;height:100%;display:flex;align-items:center;justify-content:center;}
  .back-btn{
    position:absolute;left:0;top:50%;transform:translateY(-50%);
    width:46px;height:46px;border-radius:50%;
    background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.35);
    color:var(--white);display:flex;align-items:center;justify-content:center;
    font-size:1.35rem;text-decoration:none;transition:.25s ease;z-index:3;
  }
  .back-btn:hover{background:var(--gold);border-color:var(--gold);color:var(--teal-deeper);}
  .logo-box{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);z-index:2;}
  .logo-box img{height:200px;width:auto;object-fit:contain;filter:brightness(0) invert(1);pointer-events:none;}

  .screen{display:none;}
  .screen.active{display:block;}
  .page-pad{padding:40px 6% 70px;}
  .catalog-category-title{text-align:center;font-size:1.9rem;font-weight:500;font-style:italic;margin:46px 0 26px;}
 .catalog-row{display:grid;grid-template-columns:repeat(auto-fill, minmax(220px,260px));justify-content:start;gap:22px;}
  .catalog-card{border-radius:6px;overflow:hidden;cursor:pointer;box-shadow:0 10px 26px rgba(7,26,26,.15);transition:.2s ease;background:#f1f1f1;width:100%;max-width:260px;}
  .catalog-card:hover{transform:translateY(-6px);box-shadow:0 16px 32px rgba(7,26,26,.25);}
  .catalog-card img{width:100%;height:260px;object-fit:cover;}

  footer{background:var(--teal-deeper);padding:50px 8% 36px;color:rgba(255,255,255,.85);}
  .footer-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:30px;align-items:start;}
  .footer-brand{display:flex;flex-direction:column;align-items:center;gap:10px;}
  .footer-brand img{height:200px;filter:brightness(0) invert(1);}
  .footer-social{display:flex;flex-direction:column;align-items:center;gap:16px;}
  .footer-social .icons{display:flex;gap:18px;font-size:1.4rem;}
  .footer-links{display:flex;flex-direction:column;align-items:center;gap:12px;}
  .footer-links a{color:rgba(255,255,255,.85);font-weight:700;font-size:.85rem;letter-spacing:.5px;text-decoration:none;transition:.2s ease;}
  .footer-links a:hover{color:var(--gold-soft);}
  .footer-contact{text-align:center;font-size:.8rem;line-height:2.7;justify-self:end;color:rgba(255,255,255,.85);}
  .footer-contact b{display:block;letter-spacing:1px;margin-bottom:4px;color:var(--gold-soft);}

  .editor-grid{display:grid;grid-template-columns:1fr 360px;gap:50px;align-items:start;margin-top:30px;}
  .editor-preview img{width:100%;border-radius:6px;box-shadow:0 18px 40px rgba(7,26,26,.18);}
  .editor-box{border:1.5px solid var(--navy);border-radius:6px;padding:24px;position:relative;}
  .editor-box-label{position:absolute;top:-11px;left:18px;background:var(--white);padding:0 8px;font-weight:800;font-size:.8rem;letter-spacing:1px;}
  .dropdown-btn{width:100%;background:var(--blue-mid);border:none;color:var(--white);font-weight:700;font-size:.95rem;padding:13px;border-radius:8px;cursor:pointer;display:flex;justify-content:space-between;align-items:center;margin-top:18px;}
  .dropdown-panel{display:none;margin-top:8px;flex-direction:column;gap:8px;max-height:260px;overflow-y:auto;}
  .dropdown-panel.open{display:flex;}
  .option-chip{background:var(--blue-light);border:2px solid transparent;color:var(--navy);font-weight:600;font-size:.95rem;padding:12px;border-radius:8px;cursor:pointer;text-align:center;transition:.15s ease;}
  .option-chip.active{border-color:var(--navy);background:var(--blue-strong);color:var(--white);}
  .font-preview{margin-top:24px;font-size:1.3rem;text-align:center;color:#444;transition:.2s ease;}
  .primary-btn{width:100%;background:var(--blue-strong);color:var(--white);border:none;padding:15px;border-radius:8px;font-weight:700;font-size:1rem;cursor:pointer;margin-top:30px;transition:.2s ease;}
  .primary-btn:hover{background:var(--blue-strong-dark);}
  .secondary-btn{background:var(--white);color:var(--blue-strong);border:2px solid var(--blue-strong);padding:15px;border-radius:8px;font-weight:700;font-size:1rem;cursor:pointer;transition:.2s ease;}
  .secondary-btn:hover{background:var(--mist);}
  .articulo-title{font-size:2rem;font-weight:500;font-style:italic;margin:10px 0 26px;font-family:'Fraunces',serif;}
  .articulo-grid{display:grid;grid-template-columns:1.4fr 1fr;gap:30px;align-items:start;}
  .card-box{border:1.5px solid var(--navy);border-radius:10px;padding:26px;}
  .articulo-top{display:grid;grid-template-columns:140px 1fr;gap:22px;}
  .articulo-top img{border-radius:6px;width:140px;height:180px;object-fit:cover;}
  .articulo-meta p{margin:4px 0;font-size:.95rem;}
  .qty-row{display:flex;align-items:center;gap:14px;margin-top:16px;}
  .qty-row button{width:38px;height:38px;border-radius:50%;border:1.5px solid var(--grey-border);background:var(--white);font-size:1.2rem;cursor:pointer;}
  .qty-row input{width:90px;text-align:center;font-size:1.3rem;border:1.5px solid var(--grey-border);border-radius:8px;padding:8px;font-family:'Inter',sans-serif;}
  .qty-price{margin-left:auto;border:1.5px solid var(--grey-border);border-radius:8px;padding:10px 16px;font-size:1.2rem;font-weight:700;}
  .tipo-box{margin-top:26px;}
  .resumen h3{font-size:1.5rem;margin-bottom:16px;}
  .resumen-row{display:flex;justify-content:space-between;margin:10px 0;font-weight:700;font-size:.95rem;}
  .resumen ul{margin:10px 0 16px;}
  .resumen li{font-size:.9rem;line-height:1.7;position:relative;padding-left:14px;}
  .resumen li::before{content:'·';position:absolute;left:0;font-weight:900;}
  .resumen p.desc{font-size:.88rem;line-height:1.6;color:#333;}
  .resumen .total-row{border-top:2px solid var(--navy);margin-top:18px;padding-top:16px;display:flex;justify-content:space-between;align-items:center;font-size:1.3rem;font-weight:700;}
  .resumen .total-row span.amount{color:var(--orange);}
  .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
  .field{margin-top:18px;}
  .field label{font-weight:700;font-size:.9rem;display:block;margin-bottom:6px;}
  .field input{width:100%;padding:13px 14px;border:1.5px solid var(--grey-border);border-radius:8px;background:var(--grey-input);font-family:'Inter',sans-serif;font-size:.95rem;}
  .field input.error{border-color:var(--error);background:#fde8e8;}
  .field textarea{width:100%;padding:13px 14px;border:1.5px solid var(--grey-border);border-radius:8px;background:var(--grey-input);font-family:'Inter',sans-serif;font-size:.95rem;resize:vertical;min-height:90px;}
  .field textarea.error{border-color:var(--error);background:#fde8e8;}
  .field-error-msg{color:var(--error);font-size:.78rem;margin-top:4px;display:none;}
  .field-error-msg.show{display:block;}
  .shipping-title{font-weight:700;font-size:1.1rem;margin:30px 0 14px;}
  .shipping-option{display:flex;align-items:center;gap:16px;border:1.5px solid var(--grey-border);background:var(--blue-light);border-radius:10px;padding:16px 20px;margin-bottom:12px;cursor:pointer;transition:.15s ease;}
  .shipping-option.selected{border-color:var(--green);background:#eafaf1;}
  .shipping-radio{width:20px;height:20px;border-radius:50%;border:2px solid var(--navy);flex-shrink:0;position:relative;}
  .shipping-option.selected .shipping-radio::after{content:'';position:absolute;inset:3px;border-radius:50%;background:var(--green);}
  .shipping-info{flex:1;}
  .shipping-info b{display:block;font-size:1rem;}
  .shipping-info span{font-size:.85rem;color:#555;}
  .shipping-price{font-weight:700;font-size:1rem;}
  .shipping-price.free{color:var(--green);}
  .shipping-price.cost{color:var(--orange);}
  .actions-row{display:flex;gap:16px;margin-top:30px;}
  .actions-row > *{flex:1;margin-top:0;}
  .pay-tabs{display:flex;gap:14px;margin-bottom:26px;}
  .pay-tab{flex:1;border:2px solid var(--blue-mid);background:var(--blue-light);border-radius:10px;padding:16px 8px;text-align:center;cursor:pointer;font-weight:700;color:var(--navy);transition:.15s ease;}
  .pay-tab.active{background:var(--orange);border-color:var(--orange);color:var(--white);}
  .pay-tab .icon{font-size:1.5rem;display:block;margin-bottom:6px;}
  .card-visual{background:linear-gradient(135deg, var(--blue-light), var(--blue-mid));border-radius:12px;padding:24px;color:var(--white);margin-bottom:24px;}
  .card-visual .brand{font-weight:700;text-align:right;letter-spacing:1px;}
  .card-visual .dots{font-size:1.4rem;letter-spacing:6px;margin:30px 0 24px;}
  .card-visual .row{display:flex;justify-content:space-between;font-size:.8rem;}
  .card-visual .row b{display:block;font-size:.95rem;margin-top:2px;}
  .pay-alt-msg{background:var(--mist);border:1.5px dashed var(--blue-mid);border-radius:10px;padding:30px;text-align:center;font-size:.95rem;color:var(--navy);}
  .confirm-overlay{position:fixed;inset:0;background:rgba(7,26,26,.6);display:none;align-items:center;justify-content:center;z-index:100;}
  .confirm-overlay.show{display:flex;}
  .confirm-box{background:var(--white);border-radius:14px;padding:42px 50px;text-align:center;max-width:380px;box-shadow:0 30px 60px rgba(0,0,0,.3);}
  .confirm-box .check{font-size:3rem;color:var(--green);}
  .confirm-box h2{font-size:1.6rem;margin:14px 0 8px;}
  .confirm-box p{font-size:.9rem;color:#444;margin-bottom:22px;}
  .server-error-box{background:#fde8e8;border:1.5px solid var(--error);color:var(--error);border-radius:8px;padding:14px 18px;font-size:.85rem;margin-bottom:20px;display:none;}
  .server-error-box.show{display:block;}
  @media (max-width:900px){
    .editor-grid{grid-template-columns:1fr;}
    .articulo-grid{grid-template-columns:1fr;}
    .form-grid{grid-template-columns:1fr;}
    .footer-grid{grid-template-columns:1fr;text-align:center;}
    .footer-contact{justify-self:center;}
    .articulo-top{grid-template-columns:100px 1fr;}
  }
  @media (max-width:680px){
    header{height:150px;}
    .logo-box img{height:120px;}
    .back-btn{left:6%;}
  }
</style>
</head>
<body>

<!-- HEADER -->
<header>
  <div class="header-inner">
    <a href="{{ route('dashboard.cliente') }}" class="back-btn" aria-label="Volver al inicio">&larr;</a>
    <a href="{{ route('dashboard.cliente') }}" class="logo-box">
      <img src="{{ asset('img/logo.png.png') }}" alt="Adversing System">
    </a>
  </div>
</header>

<!-- ============================================================ -->
<!-- PANTALLA 1: CATALOGO (productos reales, organizados por categoría) -->
<!-- ============================================================ -->
<section class="screen active" id="screen-producto">
  <div class="page-pad">

    @if($productos->isEmpty())
      <p style="text-align:center;">Todavía no hay productos cargados en la base de datos.</p>
    @else
      @php
        // Closure en vez de "function" normal: si esta vista llega a incluirse
        // más de una vez en el mismo request, una function() global explotaría
        // con "Cannot redeclare function". Un closure guardado en variable no.
        $categoriaSlug = function($nombreCategoria) {
          $n = strtolower($nombreCategoria ?? '');
          $n = str_replace(['á','é','í','ó','ú','ñ'], ['a','e','i','o','u','n'], $n);
          if (str_contains($n, 'poster') || str_contains($n, 'cartel')) return 'poster';
          if (str_contains($n, 'folleto') || str_contains($n, 'flyer')) return 'folleto';
          return 'otros';
        };

        $grupos = ['folleto' => [], 'poster' => [], 'otros' => []];
        foreach ($productos as $producto) {
          $slug = $categoriaSlug($producto->categoria->nombre ?? '');
          $grupos[$slug][] = $producto;
        }
        $titulosCategoria = [
          'folleto' => 'Folletos y Flyers',
          'poster'  => 'Carteles y Posters',
          'otros'   => 'Otros Servicios',
        ];
      @endphp

      @foreach($grupos as $slug => $productosCategoria)
        @if(count($productosCategoria) > 0)
          <h2 class="catalog-category-title">{{ $titulosCategoria[$slug] }}</h2>
          <div class="catalog-row">
            @foreach($productosCategoria as $producto)
              @php
                // Imagen fija por categoría (no por producto), como se acordó.
                $imagenProducto = $slug . '.1.jpg';
              @endphp
              <div class="catalog-card"
                   onclick="abrirEditor('{{ $slug }}', {{ $producto->id }}, {{ $producto->precio_base }}, '{{ $imagenProducto }}', '{{ addslashes($producto->nombre) }}')">
                <img src="{{ asset('img/' . $imagenProducto) }}" alt="{{ $producto->nombre }}">
              </div>
            @endforeach
          </div>
        @endif
      @endforeach
    @endif
  </div>

  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <img src="{{ asset('img/logo.png.png') }}" alt="Logo Adversing System">
      </div>
      <div class="footer-social">
        <div class="icons"><span>📘</span><span>📷</span><span>✖️</span></div>
        <div class="footer-links">
          <a href="#">POLÍTICA DE PRIVACIDAD</a>
          <a href="#">TÉRMINOS DE USO</a>
          <a href="#">CONTACTO</a>
        </div>
      </div>
      <div class="footer-contact">
        <b>CONTACTO:</b>
        Contacto09@gmail.com<br>3000900095<br>Colombia
      </div>
    </div>
  </footer>
</section>

<!-- ============================================================ -->
<!-- PANTALLA 2: EDITOR (color / fuente) -->
<!-- ============================================================ -->
<section class="screen" id="screen-editor">
  <div class="page-pad">
    <h2 class="articulo-title" id="editorBoxLabel">FOLLETO</h2>
    <div class="editor-grid">
      <div class="editor-preview">
        <img id="editorPreviewImg" src="" alt="Vista previa del producto">
      </div>
      <div>
        <div class="editor-box">
          <span class="editor-box-label">COLOR</span>
          <div class="dropdown-panel open" id="colorPanel"></div>
        </div>

        <div class="editor-box" style="margin-top:26px;">
          <span class="editor-box-label">FUENTE</span>
          <button class="dropdown-btn" onclick="toggleDropdown('fontPanel')">Elegir fuente <span>▾</span></button>
          <div class="dropdown-panel" id="fontPanel"></div>
          <div class="font-preview" id="fontPreview">Vista previa de texto</div>
        </div>

        <div class="actions-row">
          <button class="secondary-btn" onclick="mostrarPantalla('screen-producto')">Volver</button>
          <button class="primary-btn" onclick="irAArticulo()">Continuar</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================ -->
<!-- PANTALLA 3: ARTICULO / CARRITO -->
<!-- ============================================================ -->
<section class="screen" id="screen-articulo">
  <div class="page-pad">
    <h2 class="articulo-title">Articulo</h2>
    <div class="articulo-grid">
      <div class="card-box">
        <div class="articulo-top">
          <img id="articuloImg" src="" alt="Vista previa">
          <div class="articulo-meta">
            <h3 id="articuloNombre" style="font-family:'Inter',sans-serif;font-size:1.3rem;">Folletos</h3>
            <p>Color: <b id="articuloColor">Cafe</b></p>
            <p>Fuente: <b id="articuloFuente">Questrial</b></p>
          </div>
        </div>
        <div class="qty-row">
          <button onclick="cambiarCantidad(-10)">−</button>
          <input type="number" id="qtyInput" value="100" min="10" step="10" onchange="actualizarTotales()">
          <button onclick="cambiarCantidad(10)">+</button>
          <div class="qty-price" id="qtyPrice">$ 60.000</div>
        </div>
        <div class="tipo-box">
          <button class="dropdown-btn" id="tipoDropdownBtn" onclick="toggleDropdown('tipoPanel')">Tipo de Folleto <span>▾</span></button>
          <div class="dropdown-panel" id="tipoPanel">
            <button class="option-chip active" data-tipo="Normal" onclick="seleccionarTipo('Normal')">Normal</button>
            <button class="option-chip" data-tipo="Alta Calidad" onclick="seleccionarTipo('Alta Calidad')">Alta Calidad</button>
            <button class="option-chip" data-tipo="Premium" onclick="seleccionarTipo('Premium')">Premium</button>
          </div>
        </div>
        <button class="primary-btn" onclick="irAEnvio()">Continuar con el envío</button>
      </div>

      <div class="card-box resumen">
        <h3>Resumen de pedido</h3>
        <div class="resumen-row"><span>SubTotal:</span><span id="resSubtotal">$ 60.000</span></div>
        <div class="resumen-row"><span>Envío estimado:</span><span id="resEnvioEstimado">$ 9.500</span></div>
        <div class="resumen-row"><span>Tipo:</span><span id="resTipo">Normal</span></div>
        <p style="font-weight:700;margin-top:14px;">Características:</p>
        <ul id="resCaracteristicas"></ul>
        <p style="font-weight:700;">Descripción:</p>
        <p class="desc" id="resDescripcion"></p>
        <div class="total-row">
          <span>Total:</span>
          <span class="amount" id="resTotal">$ 69.500</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================ -->
<!-- PANTALLA 4: DATOS DE ENVIO -->
<!-- ============================================================ -->
<section class="screen" id="screen-envio">
  <div class="page-pad">
    <h2 class="articulo-title">Articulo</h2>
    <div class="articulo-grid">
      <div class="card-box">
        <h3 style="font-size:1.4rem;font-family:'Inter',sans-serif;">Datos de envíos</h3>
        <div class="field">
          <label>Nombre completo</label>
          <input type="text" id="inputNombre" placeholder="Ej. Maria Garcia">
          <p class="field-error-msg">Este campo es obligatorio.</p>
        </div>
        <div class="form-grid">
          <div class="field">
            <label>Correo electrónico</label>
            <input type="text" id="inputCorreo" placeholder="correo@ejemplo.com">
            <p class="field-error-msg">Ingresa un correo válido.</p>
          </div>
          <div class="field">
            <label>Teléfono</label>
            <input type="text" id="inputTelefono" placeholder="+57 300 000 0000">
            <p class="field-error-msg">Este campo es obligatorio.</p>
          </div>
        </div>
        <div class="field">
          <label>Dirección</label>
          <input type="text" id="inputDireccion" placeholder="Calle 10 #45-60">
          <p class="field-error-msg">Este campo es obligatorio.</p>
        </div>
        <div class="field">
          <label>Descripción</label>
          <textarea id="inputDescripcion" placeholder="Instrucciones especiales, referencias de entrega, etc."></textarea>
          <p class="field-error-msg">Este campo es obligatorio.</p>
        </div>
        <div class="form-grid">
          <div class="field">
            <label>Ciudad</label>
            <input type="text" id="inputCiudad" placeholder="Bogotá">
            <p class="field-error-msg">Este campo es obligatorio.</p>
          </div>
          <div class="field">
            <label>Departamento</label>
            <input type="text" id="inputDepartamento" placeholder="Distrito Capital">
            <p class="field-error-msg">Este campo es obligatorio.</p>
          </div>
        </div>
        <p class="shipping-title">Método de envío</p>
        <div class="shipping-option" data-metodo="Estandar" onclick="seleccionarEnvio('Estandar')">
          <div class="shipping-radio"></div>
          <div class="shipping-info"><b>Estandar</b><span>8-10 días hábiles</span></div>
          <div class="shipping-price free">Gratis</div>
        </div>
        <div class="shipping-option selected" data-metodo="Express" onclick="seleccionarEnvio('Express')">
          <div class="shipping-radio"></div>
          <div class="shipping-info"><b>Express</b><span>5-7 días hábiles</span></div>
          <div class="shipping-price cost">$ 9.900</div>
        </div>
        <div class="shipping-option" data-metodo="Prioritario" onclick="seleccionarEnvio('Prioritario')">
          <div class="shipping-radio"></div>
          <div class="shipping-info"><b>Prioritario</b><span>2-4 días hábiles</span></div>
          <div class="shipping-price cost">$ 100.000</div>
        </div>
        <div class="actions-row">
          <button class="secondary-btn" onclick="mostrarPantalla('screen-articulo')">Volver</button>
          <button class="primary-btn" onclick="validarFormularioEnvio()">Continuar con el pago</button>
        </div>
      </div>

      <div class="card-box resumen">
        <h3>Tu pedido</h3>
        <div class="articulo-top" style="margin-bottom:16px;">
          <img id="envioImg" src="" alt="Producto" style="width:100px;height:130px;">
          <div>
            <p style="font-weight:700;margin:0;" id="envioNombreItem">FOLLETOS</p>
            <p style="margin:4px 0;" id="envioCantidadItem">x 100</p>
          </div>
        </div>
        <div class="total-row">
          <span>Total:</span>
          <span class="amount" id="envioTotal">$ 69.900</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================ -->
<!-- PANTALLA 5: METODO DE PAGO -->
<!-- ============================================================ -->
<section class="screen" id="screen-pago">
  <div class="page-pad">
    <h2 class="articulo-title">Articulo</h2>
    <div class="articulo-grid">
      <div class="card-box">
        <h3 style="font-size:1.4rem;font-family:'Inter',sans-serif;margin-bottom:20px;">Método de Pago</h3>

        <div class="server-error-box" id="serverErrorBox"></div>

        <div class="pay-tabs">
          <div class="pay-tab active" data-metodo="Tarjeta" onclick="seleccionarPago('Tarjeta')"><span class="icon">💳</span>Tarjeta</div>
          <div class="pay-tab" data-metodo="PSE" onclick="seleccionarPago('PSE')"><span class="icon">🏦</span>PSE</div>
          <div class="pay-tab" data-metodo="Efectivo" onclick="seleccionarPago('Efectivo')"><span class="icon">💵</span>Efectivo</div>
        </div>

        <div id="panelTarjeta">
          <div class="card-visual">
            <div class="brand">ADVERSING SYSTEM</div>
            <div class="dots">•••• •••• •••• ••••</div>
            <div class="row">
              <div>TITULAR<br><b>NOMBRE APELLIDO</b></div>
              <div>VENCE<br><b>MM/AA</b></div>
            </div>
          </div>
          <div class="field">
            <label>Número de Tarjeta</label>
            <input type="text" id="inputTarjeta" placeholder="0000 0000 0000 0000" maxlength="19" oninput="formatearTarjeta(this)">
            <p class="field-error-msg">Ingresa un número de tarjeta válido.</p>
          </div>
          <div class="field">
            <label>Nombre en la Tarjeta</label>
            <input type="text" id="inputNombreTarjeta" placeholder="NOMBRE APELLIDO">
            <p class="field-error-msg">Este campo es obligatorio.</p>
          </div>
          <div class="form-grid">
            <div class="field">
              <label>Fecha de vencimiento</label>
              <input type="text" id="inputVencimiento" placeholder="MM/AA" maxlength="5">
              <p class="field-error-msg">Este campo es obligatorio.</p>
            </div>
            <div class="field">
              <label>CVV</label>
              <input type="text" id="inputCVV" placeholder="•••" maxlength="3">
              <p class="field-error-msg">Este campo es obligatorio.</p>
            </div>
          </div>
        </div>

        <div id="panelPSE" style="display:none;">
          <div class="pay-alt-msg">Al continuar, serás redirigido a tu banco para completar el pago por PSE de forma segura.</div>
        </div>
        <div id="panelEfectivo" style="display:none;">
          <div class="pay-alt-msg">Recibirás un código de pago para abonar en efectivo en cualquier punto autorizado (Efecty, Baloto u otros) dentro de las próximas 24 horas.</div>
        </div>

        <div class="actions-row">
          <button class="secondary-btn" onclick="mostrarPantalla('screen-envio')">Volver</button>
          <button class="primary-btn" onclick="confirmarPago()">Continuar con el pago</button>
        </div>
      </div>

      <div class="card-box resumen">
        <h3>Tu pedido</h3>
        <div class="articulo-top" style="margin-bottom:16px;">
          <img id="pagoImg" src="" alt="Producto" style="width:100px;height:130px;">
          <div>
            <p style="font-weight:700;margin:0;" id="pagoNombreItem">FOLLETOS</p>
            <p style="margin:4px 0;" id="pagoCantidadItem">x 100</p>
          </div>
        </div>
        <div class="resumen-row"><span>Envío:</span><span id="pagoEnvioMetodo">Express</span></div>
        <div class="resumen-row"><span>Costo envío:</span><span id="pagoEnvioCosto">$ 9.900</span></div>
        <div class="total-row">
          <span>Total:</span>
          <span class="amount" id="pagoTotal">$ 69.900</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CONFIRMACION FINAL -->
<div class="confirm-overlay" id="confirmOverlay">
  <div class="confirm-box">
    <div class="check">✔</div>
    <h2>¡Pedido confirmado!</h2>
    <p>Gracias por tu compra en Adversing System. Te enviaremos un correo con los detalles de tu pedido.</p>
    <button class="primary-btn" onclick="reiniciarFlujo()">Ir a mi cuenta</button>
  </div>
</div>

<script>
window.BASE_URL = "{{ url('') }}";
window.CSRF_TOKEN = "{{ csrf_token() }}";
window.RUTA_GUARDAR_PEDIDO = "{{ route('pedido.store') }}";

/* ============================================================
   ESTADO GLOBAL DE LA APP
   ============================================================ */
const app = {
  productoId: null,
  type: 'folleto',        // 'folleto' | 'poster' | 'otros'
  color: 'Cafe',
  font: 'Questrial',
  tipo: 'Normal',
  qty: 100,
  envioMetodo: 'Express',
  pagoMetodo: 'Tarjeta',
  precioUnitario: 600,
  imagenProducto: '',     // URL completa de la imagen real del producto clicado
  nombreProducto: 'Producto'
};

function assetUrl(path){
  return (window.BASE_URL || '') + '/' + path;
}

const colorNombres = {
  folleto: ['Cafe', 'Amarillo', 'Rojo'],
  poster:  ['Negro', 'Rojo', 'Cafe'],
  otros:   ['Estandar', 'Personalizado']
};

const imagenesPorColor = {
  folleto: { 'Cafe': 'folleto.cafe.jpg', 'Amarillo': 'folleto.amarillo.jpg', 'Rojo': 'folleto.rojo.jpg' },
  poster:  { 'Cafe': 'poster.cafe.jpg', 'Negro': 'poster.negro.jpg', 'Rojo': 'poster.rojo.jpg' }
};

/* Fuentes disponibles para el diseño, con su familia CSS real.
   Cada botón del panel se muestra escrito en su propia fuente. */
const fontFamilies = {
  'Questrial':       "'Questrial', sans-serif",
  'Playfair Display':"'Playfair Display', serif",
  'Montserrat':      "'Montserrat', sans-serif",
  'Poppins':         "'Poppins', sans-serif",
  'Bebas Neue':      "'Bebas Neue', cursive",
  'Oswald':          "'Oswald', sans-serif",
  'Merriweather':    "'Merriweather', serif"
};

const multiplicadorTipo = { 'Normal': 1, 'Alta Calidad': 1.5, 'Premium': 2.2 };

const infoTipoFolleto = {
  'Normal': {
    caracteristicas: ['Papel estándar','Impresión básica a color','Diseño simple','Acabado sin laminado','Durabilidad media','Bajo costo'],
    descripcion: 'Un folleto normal está diseñado para brindar información básica de manera clara y económica. Generalmente incluye impresión a color estándar, papel delgado tipo couché o bond, diseño sencillo y acabado básico sin efectos especiales. Es ideal para promociones rápidas, eventos, publicidad local o entregas masivas.'
  },
  'Alta Calidad': {
    caracteristicas: ['Papel couché de mayor gramaje','Impresión full color de alta resolución','Diseño con acabados visuales mejorados','Laminado mate o brillante','Durabilidad alta','Costo medio'],
    descripcion: 'Un folleto de alta calidad utiliza papel de mayor gramaje y una impresión más nítida, logrando un acabado más profesional. Incluye laminado para mayor resistencia y mejor presentación visual, ideal para marcas que buscan transmitir una imagen más cuidada en ferias, presentaciones corporativas o material de venta directa.'
  },
  'Premium': {
    caracteristicas: ['Papel especial de alto gramaje (250g+)','Impresión de máxima calidad y color','Diseño exclusivo con detalles especiales','Laminado UV o en relieve','Durabilidad muy alta','Costo elevado'],
    descripcion: 'El folleto premium está pensado para causar una primera impresión memorable. Usa papel de alto gramaje, acabados especiales como laminado UV o relieve, y un proceso de impresión de máxima calidad. Es la opción ideal para lanzamientos de producto, eventos exclusivos o clientes que buscan diferenciarse con un material de altísima gama.'
  }
};

const infoTipoPoster = {
  'Normal': {
    caracteristicas: ['Papel propalcote estándar','Impresión básica a color','Diseño simple','Sin laminado','Durabilidad media','Bajo costo'],
    descripcion: 'Un póster normal está pensado para comunicar un mensaje de forma rápida y económica. Usa papel estándar e impresión a color básica, ideal para campañas cortas, eventos puntuales o publicidad temporal en espacios interiores.'
  },
  'Alta Calidad': {
    caracteristicas: ['Papel fotográfico satinado','Impresión full color de alta resolución','Colores más vivos y nítidos','Laminado mate o brillante','Durabilidad alta','Costo medio'],
    descripcion: 'El póster de alta calidad utiliza papel fotográfico y una impresión de mayor resolución, logrando colores más vivos y un acabado más resistente. Es ideal para vitrinas, puntos de venta o exhibiciones que estarán expuestas por más tiempo.'
  },
  'Premium': {
    caracteristicas: ['Papel fotográfico de alto gramaje','Impresión de máxima calidad','Acabado UV resistente a la intemperie','Laminado premium','Durabilidad muy alta','Costo elevado'],
    descripcion: 'El póster premium está diseñado para exteriores y exhibiciones de alto impacto. Su acabado UV lo protege del sol y la humedad, ofreciendo colores intensos y larga duración. Ideal para vallas, fachadas o eventos de gran formato.'
  }
};

const infoTipoOtros = {
  'Normal': {
    caracteristicas: ['Entrega estándar','Revisión incluida','Diseño base','Tiempo de entrega regular'],
    descripcion: 'Servicio en su versión estándar, pensado para necesidades generales con buena calidad a un costo accesible.'
  },
  'Alta Calidad': {
    caracteristicas: ['Entrega prioritaria','2 rondas de revisión','Diseño personalizado','Materiales de mayor calidad'],
    descripcion: 'Servicio de alta calidad con mayor atención al detalle, ideal para marcas que buscan una presentación más cuidada.'
  },
  'Premium': {
    caracteristicas: ['Entrega express','Revisiones ilimitadas','Diseño 100% a medida','Materiales premium'],
    descripcion: 'Servicio premium con el mayor nivel de personalización y cuidado, ideal para proyectos exclusivos o de alto impacto.'
  }
};

const etiquetasCategoria = {
  folleto: { box: 'FOLLETO', dropdown: 'Tipo de Folleto' },
  poster:  { box: 'POSTER',  dropdown: 'Tipo de Poster' },
  otros:   { box: 'SERVICIO', dropdown: 'Tipo de Servicio' }
};

const costosEnvio = { 'Estandar':0, 'Express':9900, 'Prioritario':100000 };
const ENVIO_ESTIMADO = 9500;

function formatoCOP(numero){ return '$ ' + Math.round(numero).toLocaleString('es-CO'); }
function mostrarPantalla(id){
  document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  window.scrollTo({top:0, behavior:'smooth'});
}
function toggleDropdown(id){ document.getElementById(id).classList.toggle('open'); }

function obtenerInfoTipo(categoria, tipo){
  if (categoria === 'folleto') return infoTipoFolleto[tipo];
  if (categoria === 'poster') return infoTipoPoster[tipo];
  return infoTipoOtros[tipo];
}

/* tipoProducto: 'folleto' | 'poster' | 'otros'
   imagenArchivo: nombre del archivo (ej. 'folleto.cafe.jpg') tal cual viene de la BD
   nombreProducto: nombre real del producto, para mostrarlo en las siguientes pantallas */
function abrirEditor(tipoProducto, productoId, precioBase, imagenArchivo, nombreProducto){
  app.type = tipoProducto;
  app.productoId = productoId;
  app.precioUnitario = precioBase;
  app.imagenProducto = assetUrl('img/' + imagenArchivo);
  app.nombreProducto = nombreProducto || 'Producto';

  const coloresDisponibles = colorNombres[tipoProducto] || colorNombres.otros;
  app.color = coloresDisponibles[0];
  app.font = 'Questrial';
  app.tipo = 'Normal';

  document.getElementById('editorBoxLabel').textContent = etiquetasCategoria[tipoProducto].box;

  const colorPanel = document.getElementById('colorPanel');
  colorPanel.innerHTML = '';
  coloresDisponibles.forEach(color => {
    const btn = document.createElement('button');
    btn.className = 'option-chip' + (color === app.color ? ' active' : '');
    btn.textContent = color.toUpperCase();
    btn.dataset.color = color;
    btn.onclick = () => seleccionarColor(color);
    colorPanel.appendChild(btn);
  });

  const fontPanel = document.getElementById('fontPanel');
  fontPanel.innerHTML = '';
  Object.keys(fontFamilies).forEach(font => {
    const btn = document.createElement('button');
    btn.className = 'option-chip' + (font === app.font ? ' active' : '');
    btn.style.fontFamily = fontFamilies[font];
    btn.textContent = 'Aa ' + font;
    btn.dataset.font = font;
    btn.onclick = () => seleccionarFuente(font);
    fontPanel.appendChild(btn);
  });
  document.getElementById('fontPreview').style.fontFamily = fontFamilies['Questrial'];

  actualizarPreviewEditor();
  mostrarPantalla('screen-editor');
}

function seleccionarColor(color){
  app.color = color;
  document.querySelectorAll('#colorPanel .option-chip').forEach(b => b.classList.toggle('active', b.dataset.color === color));

  const mapaColores = imagenesPorColor[app.type];
  if (mapaColores && mapaColores[color]) {
    app.imagenProducto = assetUrl('img/' + mapaColores[color]);
    actualizarPreviewEditor();
  }
}

function seleccionarFuente(fontFamily){
  app.font = fontFamily;
  document.querySelectorAll('#fontPanel .option-chip').forEach(b => b.classList.toggle('active', b.dataset.font === fontFamily));
  document.getElementById('fontPreview').style.fontFamily = fontFamilies[fontFamily];
}

function actualizarPreviewEditor(){
  document.getElementById('editorPreviewImg').src = app.imagenProducto;
}

function irAArticulo(){
  app.qty = 100;
  app.tipo = 'Normal';
  document.getElementById('articuloImg').src = app.imagenProducto;
  document.getElementById('articuloNombre').textContent = app.nombreProducto;
  document.getElementById('articuloColor').textContent = app.color;
  document.getElementById('articuloFuente').textContent = app.font;
  document.getElementById('tipoDropdownBtn').innerHTML = etiquetasCategoria[app.type].dropdown + ' <span>▾</span>';
  document.getElementById('qtyInput').value = app.qty;
  document.querySelectorAll('#tipoPanel .option-chip').forEach(b => b.classList.toggle('active', b.dataset.tipo === 'Normal'));
  actualizarTotales();
  mostrarPantalla('screen-articulo');
}

function cambiarCantidad(delta){
  const input = document.getElementById('qtyInput');
  let valor = parseInt(input.value || '0', 10) + delta;
  if (valor < 10) valor = 10;
  input.value = valor;
  actualizarTotales();
}

function seleccionarTipo(tipo){
  app.tipo = tipo;
  document.querySelectorAll('#tipoPanel .option-chip').forEach(b => b.classList.toggle('active', b.dataset.tipo === tipo));
  actualizarTotales();
}

function precioUnitarioActual(){ return app.precioUnitario * multiplicadorTipo[app.tipo]; }

function actualizarTotales(){
  app.qty = parseInt(document.getElementById('qtyInput').value || '0', 10);
  const subtotal = precioUnitarioActual() * app.qty;
  const total = subtotal + ENVIO_ESTIMADO;

  document.getElementById('qtyPrice').textContent = formatoCOP(subtotal);
  document.getElementById('resSubtotal').textContent = formatoCOP(subtotal);
  document.getElementById('resEnvioEstimado').textContent = formatoCOP(ENVIO_ESTIMADO);
  document.getElementById('resTipo').textContent = app.tipo;
  document.getElementById('resTotal').textContent = formatoCOP(total);

  const info = obtenerInfoTipo(app.type, app.tipo);
  const lista = document.getElementById('resCaracteristicas');
  lista.innerHTML = '';
  info.caracteristicas.forEach(c => {
    const li = document.createElement('li');
    li.textContent = c;
    lista.appendChild(li);
  });
  document.getElementById('resDescripcion').textContent = info.descripcion;
}

function irAEnvio(){
  document.getElementById('envioImg').src = app.imagenProducto;
  document.getElementById('envioNombreItem').textContent = app.nombreProducto.toUpperCase();
  document.getElementById('envioCantidadItem').textContent = 'x ' + app.qty;
  actualizarTotalEnvio();
  mostrarPantalla('screen-envio');
}

function seleccionarEnvio(metodo){
  app.envioMetodo = metodo;
  document.querySelectorAll('.shipping-option').forEach(el => el.classList.toggle('selected', el.dataset.metodo === metodo));
  actualizarTotalEnvio();
}

function actualizarTotalEnvio(){
  const subtotal = precioUnitarioActual() * app.qty;
  const envio = costosEnvio[app.envioMetodo];
  document.getElementById('envioTotal').textContent = formatoCOP(subtotal + envio);
}

function validarFormularioEnvio(){
  const campos = [
    {id:'inputNombre', tipo:'texto'},
    {id:'inputCorreo', tipo:'correo'},
    {id:'inputTelefono', tipo:'texto'},
    {id:'inputDireccion', tipo:'texto'},
    {id:'inputDescripcion', tipo:'texto'},
    {id:'inputCiudad', tipo:'texto'},
    {id:'inputDepartamento', tipo:'texto'}
  ];
  let valido = true;
  campos.forEach(campo => {
    const input = document.getElementById(campo.id);
    const errorMsg = input.parentElement.querySelector('.field-error-msg');
    const valor = input.value.trim();
    let ok = valor.length > 0;
    if (ok && campo.tipo === 'correo'){ ok = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/.test(valor); }
    input.classList.toggle('error', !ok);
    errorMsg.classList.toggle('show', !ok);
    if (!ok) valido = false;
  });
  if (!valido) return;
  irAPago();
}

function irAPago(){
  document.getElementById('pagoImg').src = app.imagenProducto;
  document.getElementById('pagoNombreItem').textContent = app.nombreProducto.toUpperCase();
  document.getElementById('pagoCantidadItem').textContent = 'x ' + app.qty;
  document.getElementById('pagoEnvioMetodo').textContent = app.envioMetodo;

  const subtotal = precioUnitarioActual() * app.qty;
  const envio = costosEnvio[app.envioMetodo];
  document.getElementById('pagoEnvioCosto').textContent = formatoCOP(envio);
  document.getElementById('pagoTotal').textContent = formatoCOP(subtotal + envio);

  mostrarPantalla('screen-pago');
}

function seleccionarPago(metodo){
  app.pagoMetodo = metodo;
  document.querySelectorAll('.pay-tab').forEach(t => t.classList.toggle('active', t.dataset.metodo === metodo));
  document.getElementById('panelTarjeta').style.display = metodo === 'Tarjeta' ? 'block' : 'none';
  document.getElementById('panelPSE').style.display = metodo === 'PSE' ? 'block' : 'none';
  document.getElementById('panelEfectivo').style.display = metodo === 'Efectivo' ? 'block' : 'none';
}

function formatearTarjeta(input){
  let digitos = input.value.replace(/\D/g,'').slice(0,16);
  input.value = digitos.replace(/(.{4})/g,'$1 ').trim();
}

function confirmarPago(){
  if (app.pagoMetodo === 'Tarjeta'){
    const campos = ['inputTarjeta','inputNombreTarjeta','inputVencimiento','inputCVV'];
    let valido = true;
    campos.forEach(id => {
      const input = document.getElementById(id);
      const errorMsg = input.parentElement.querySelector('.field-error-msg');
      const ok = input.value.trim().length > 0;
      input.classList.toggle('error', !ok);
      errorMsg.classList.toggle('show', !ok);
      if (!ok) valido = false;
    });
    if (!valido) return;
  }

  const subtotal = precioUnitarioActual() * app.qty;
  const envio = costosEnvio[app.envioMetodo];
  const total = subtotal + envio;

  const payload = {
    producto_id: app.productoId,
    cantidad: app.qty,
    tipo_acabado: app.tipo,
    color: app.color,
    fuente: app.font,
    metodo_envio: app.envioMetodo,
    metodo_pago: app.pagoMetodo,
    subtotal: subtotal,
    costo_envio: envio,
    total: total,
    nombre: document.getElementById('inputNombre').value,
    correo: document.getElementById('inputCorreo').value,
    telefono: document.getElementById('inputTelefono').value,
    direccion: document.getElementById('inputDireccion').value,
    descripcion: document.getElementById('inputDescripcion').value,
    ciudad: document.getElementById('inputCiudad').value,
    departamento: document.getElementById('inputDepartamento').value
  };

  const btn = document.querySelector('#screen-pago .primary-btn');
  const textoOriginal = btn.textContent;
  btn.textContent = 'Procesando...';
  btn.disabled = true;

  fetch(window.RUTA_GUARDAR_PEDIDO, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': window.CSRF_TOKEN,
      'Accept': 'application/json'
    },
    body: JSON.stringify(payload)
  })
  .then(async (response) => {
    const data = await response.json();
    if (!response.ok) { throw new Error(data.message || 'No se pudo guardar el pedido.'); }
    return data;
  })
  .then(() => {
    document.getElementById('confirmOverlay').classList.add('show');
  })
  .catch((error) => {
    const errorBox = document.getElementById('serverErrorBox');
    errorBox.textContent = error.message;
    errorBox.classList.add('show');
  })
  .finally(() => {
    btn.textContent = textoOriginal;
    btn.disabled = false;
  });
}

function reiniciarFlujo(){
  document.getElementById('confirmOverlay').classList.remove('show');
  window.location.href = "{{ route('dashboard.cliente') }}";
}
</script>
</body>
</html>