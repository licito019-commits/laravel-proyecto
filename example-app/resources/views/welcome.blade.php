<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adversing System</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    /* ============ PALETA PREMIUM ============ */
    --teal:#1daeae;          /* acento vivo — CTAs y detalles */
    --teal-deep:#0a3d3a;     /* teal profundo — header/footer */
    --teal-deeper:#062826;   /* teal casi negro — refuerzos */
    --ink:#081b18;           /* texto principal */
    --ivory:#faf8f3;         /* fondo cálido, no blanco puro */
    --mist:#eef7f5;          /* tinte suave de sección */
    --mist-2:#dff2ef;        /* tinte medio */
    --gold:#b8935a;          /* acento premium — líneas, detalles */
    --gold-soft:#e7d9c0;
    --white:#ffffff;
    font-size:16px;
  }

  *{box-sizing:border-box;}
  html{scroll-behavior:smooth;}
  html,body{margin:0;padding:0;}
  body{
    font-family:'Inter',sans-serif;
    font-size:.98rem;
    font-weight:400;
    color:var(--ink);
    background:var(--ivory);
    overflow-x:hidden;
    -webkit-font-smoothing:antialiased;
  }
  h1,h2,h3,.brand-font{
    font-family:'Fraunces',serif;
    font-optical-sizing:auto;
    color:var(--ink);
  }
  ul{margin:0;padding:0;list-style:none;}
  img{max-width:100%;display:block;}
  a{text-decoration:none;color:inherit;}

  /* ============ REVEAL AL HACER SCROLL ============ */
  .reveal{
    opacity:0;
    transform:translateY(22px);
    transition:opacity .8s cubic-bezier(.2,.7,.2,1), transform .8s cubic-bezier(.2,.7,.2,1);
  }
  .reveal.visible{
    opacity:1;
    transform:translateY(0);
  }
  @media (prefers-reduced-motion: reduce){
    .reveal{opacity:1;transform:none;transition:none;}
    html{scroll-behavior:auto;}
  }

  /* ============ ETIQUETA / EYEBROW PREMIUM ============ */
  .eyebrow{
    display:flex;
    align-items:center;
    gap:14px;
    font-family:'Inter',sans-serif;
    font-weight:700;
    font-size:.72rem;
    letter-spacing:3px;
    text-transform:uppercase;
    color:var(--ink);
    margin-bottom:34px;
  }
  .eyebrow::before{
    content:'';
    width:34px;
    height:2px;
    background:var(--gold);
    flex-shrink:0;
  }
  .eyebrow.on-teal{color:var(--white);}
  .eyebrow.on-teal::before{background:var(--gold-soft);}

  /* ===================== HEADER ===================== */
  header{
    position:sticky;
    top:0;
    z-index:50;
    height:120px;              /* altura FIJA del fondo verde — no depende del logo */
    background:var(--teal-deep);
    padding:0 6%;
    box-shadow:0 4px 24px rgba(6,20,18,.18);
    overflow:visible;          /* permite que el logo "flote" fuera de la barra */
  }
  .nav-top{
    position:relative;
    height:100%;
    display:flex;
    align-items:center;
    justify-content:center;
  }
  .brand{
    position:absolute;
    left:50%;
    top:50%;
    transform:translate(-50%,-50%);
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:2;
  }
  .brand img{
    height:220px;               /* cambia SOLO este valor para agrandar/achicar el logo */
    width:auto;
    object-fit:contain;
    filter:brightness(0) invert(1);
    pointer-events:none;
  }

  nav.menu{
    position:absolute;
    right:0;
    top:50%;
    transform:translateY(-50%);
    display:flex;
    gap:8px;
    z-index:3;
  }
  nav.menu button{
    background:transparent;
    border:1px solid rgba(255,255,255,.28);
    color:var(--white);
    font-family:'Inter',sans-serif;
    font-weight:600;
    font-size:.74rem;
    letter-spacing:1.8px;
    text-transform:uppercase;
    padding:11px 24px;
    border-radius:2px;
    cursor:pointer;
    transition:.25s ease;
  }
  nav.menu button:hover{
    background:var(--white);
    color:var(--teal-deep);
    border-color:var(--white);
  }
  nav.menu a.active button{
    background:var(--gold);
    border-color:var(--gold);
    color:var(--teal-deeper);
  }
  nav.menu a.active button:hover{
    background:var(--gold);
    color:var(--teal-deeper);
  }
  nav.menu button.btn-fill{
    background:var(--gold);
    border-color:var(--gold);
    color:var(--teal-deeper);
  }
  nav.menu button.btn-fill:hover{
    background:var(--white);
    border-color:var(--white);
    color:var(--teal-deep);
  }

  /* ===================== CARRUSEL HERO ===================== */
  .carousel{
    position:relative;
    width:100%;
    height:560px;
    overflow:hidden;
    background:var(--teal-deeper);
  }
  .carousel-track{
    display:flex;
    height:100%;
    transition:transform .9s cubic-bezier(.65,0,.35,1);
  }
  .carousel-slide{
    min-width:100%;
    height:100%;
    position:relative;
  }
  .carousel-slide img{
    width:100%;
    height:100%;
    object-fit:cover;
  }
  .carousel-slide::after{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(180deg, rgba(6,20,18,.35) 0%, rgba(6,20,18,.15) 42%, rgba(6,20,18,.78) 100%);
  }
  .carousel-caption{
    position:absolute;
    inset:0;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    text-align:center;
    z-index:5;
    padding:0 20px;
  }
  .carousel-caption .rule{
    width:64px;
    height:2px;
    background:var(--gold);
    margin-bottom:26px;
  }
  .carousel-caption .kicker{
    font-family:'Inter',sans-serif;
    font-weight:600;
    font-size:.78rem;
    letter-spacing:4px;
    text-transform:uppercase;
    color:var(--gold-soft);
    margin-bottom:18px;
  }
  .carousel-caption h1{
    color:var(--white);
    font-size:3.4rem;
    font-weight:500;
    font-style:italic;
    line-height:1.18;
    margin:0;
    max-width:820px;
    text-shadow:0 8px 30px rgba(0,0,0,.35);
  }
  .carousel-dots{
    position:absolute;
    bottom:26px;
    left:0;
    right:0;
    display:flex;
    justify-content:center;
    gap:10px;
    z-index:6;
  }
  .carousel-dots button{
    width:8px;
    height:8px;
    border-radius:50%;
    border:1.5px solid var(--white);
    background:transparent;
    cursor:pointer;
    padding:0;
    transition:.25s ease;
  }
  .carousel-dots button.active{background:var(--gold);border-color:var(--gold);}
  .carousel-arrow{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    background:rgba(255,255,255,.12);
    backdrop-filter:blur(6px);
    border:1px solid rgba(255,255,255,.35);
    color:var(--white);
    width:44px;
    height:44px;
    border-radius:50%;
    font-size:1.3rem;
    cursor:pointer;
    z-index:6;
    transition:.25s ease;
  }
  .carousel-arrow:hover{background:var(--gold);border-color:var(--gold);color:var(--teal-deeper);}
  .carousel-arrow.prev{left:26px;}
  .carousel-arrow.next{right:26px;}

  /* ===================== SECCIONES GENERALES ===================== */
  section{
    padding:100px 8% 96px;
  }
  .bg-teal{background:var(--teal-deep);color:var(--white);}
  .bg-teal h2, .bg-teal h1{color:var(--white);}
  .bg-soft{background:var(--mist);}
  .bg-softer{background:var(--ivory);}
  .bg-mid{background:var(--mist-2);}
  .bg-white{background:var(--white);}

  /* Branding section */
  .branding-grid{
    display:grid;
    grid-template-columns:1.1fr 1fr 1fr;
    gap:40px;
    align-items:flex-start;
  }
  .info-box{
    background:rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.22);
    border-radius:2px;
    padding:30px;
    font-size:.92rem;
    line-height:1.85;
    color:rgba(255,255,255,.92);
  }
  .bullet-box{
    border:1px solid rgba(255,255,255,.22);
    border-radius:2px;
    padding:26px 30px;
  }
  .bg-white .bullet-box, .bg-soft .bullet-box, .bg-mid .bullet-box, .bg-softer .bullet-box{
    border-color:rgba(8,27,24,.16);
  }
  .bullet-box li{
    font-size:.9rem;
    line-height:2.1;
    position:relative;
    padding-left:20px;
    letter-spacing:.2px;
  }
  .bullet-box li::before{
    content:'—';
    position:absolute;
    left:0;
    color:var(--gold);
    font-weight:700;
  }
  .lead-statement{
    font-family:'Fraunces',serif;
    font-style:italic;
    font-weight:500;
    font-size:1.5rem;
    line-height:1.45;
    color:var(--white);
  }

  /* Two-column image+text rows */
  .row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:64px;
    align-items:center;
  }
  .row.reverse .row-img{order:2;}
  .row.reverse .row-text{order:1;}
  .row-img{position:relative;}
  .row-img img{
    border-radius:2px;
    box-shadow:0 30px 60px rgba(8,27,24,.22);
    width:100%;
    height:420px;
    object-fit:cover;
  }
  .row-text .tag{
    display:inline-block;
    font-weight:700;
    font-size:.7rem;
    letter-spacing:2.5px;
    text-transform:uppercase;
    color:var(--gold);
    margin-bottom:16px;
  }
  .row-text h2{
    font-size:2.3rem;
    font-weight:500;
    line-height:1.2;
    margin:0 0 20px;
  }
  .row-text p{
    font-size:1rem;
    line-height:1.85;
    margin:0;
    color:rgba(8,27,24,.82);
  }
  .row-text .italic-lead{
    font-family:'Fraunces',serif;
    font-style:italic;
    font-weight:500;
    font-size:1.75rem;
    line-height:1.5;
    color:var(--ink);
  }
  .row-text strong.callout{
    display:block;
    font-family:'Fraunces',serif;
    font-size:1.2rem;
    font-weight:600;
    margin-bottom:14px;
  }

  /* Creatividad section */
  .creativ-grid{
    display:grid;
    grid-template-columns:.9fr 1.25fr 1fr;
    gap:40px;
    align-items:center;
  }
  .creativ-grid img{
    border-radius:2px;
    height:360px;
    object-fit:cover;
    box-shadow:0 30px 60px rgba(8,27,24,.18);
  }
  .creativ-grid .row-text p{
    font-size:.98rem;
    line-height:1.85;
  }

  /* ===================== FOOTER ===================== */
  footer{
    background:var(--teal-deeper);
    padding:70px 8% 40px;
    color:rgba(255,255,255,.85);
  }
  .footer-grid{
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    gap:40px;
    align-items:start;
    padding-bottom:40px;
    border-bottom:1px solid rgba(255,255,255,.14);
  }
  .footer-brand{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:14px;
  }
  .footer-logo{
    position:relative;
    height:70px;                 /* altura FIJA reservada — el footer no se mueve con esto */
    width:100%;
    display:flex;
    align-items:center;
    justify-content:center;
  }
  .footer-logo img{
    position:absolute;
    left:50%;
    top:50%;
    transform:translate(-50%,-50%);
    height:150px;                 /* cambia SOLO este valor para agrandar/achicar el logo */
    width:auto;
    object-fit:contain;
    filter:brightness(0) invert(1);
    pointer-events:none;
  }
  .footer-brand p{
    font-size:.78rem;
    letter-spacing:1px;
    text-transform:uppercase;
    color:var(--gold-soft);
    margin:0;
  }

  .footer-social{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:20px;
  }
  .footer-social .icons{
    display:flex;
    gap:16px;
    font-size:1.15rem;
  }
  .footer-social .icons span{
    width:38px;
    height:38px;
    display:flex;
    align-items:center;
    justify-content:center;
    border:1px solid rgba(255,255,255,.25);
    border-radius:50%;
    transition:.25s ease;
  }
  .footer-social .icons span:hover{
    border-color:var(--gold);
    background:rgba(184,147,90,.14);
  }
  .footer-links{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:14px;
  }
  .footer-links a{
    color:rgba(255,255,255,.85);
    font-weight:600;
    font-size:.75rem;
    letter-spacing:1.5px;
    text-transform:uppercase;
    transition:.2s ease;
  }
  .footer-links a:hover{color:var(--gold-soft);}
  .footer-contact{
    text-align:center;
    font-size:.85rem;
    line-height:2.5;
    justify-self:end;
    color:rgba(255,255,255,.85);
  }
  .footer-contact b{
    display:block;
    letter-spacing:2px;
    margin-bottom:8px;
    font-size:.72rem;
    color:var(--gold-soft);
  }
  .footer-bottom{
    padding-top:26px;
    text-align:center;
    font-size:.72rem;
    letter-spacing:1px;
    color:rgba(255,255,255,.45);
  }

  /* ===================== RESPONSIVE ===================== */
  @media (max-width:980px){
    .branding-grid{grid-template-columns:1fr;}
    .creativ-grid{grid-template-columns:1fr;}
    .creativ-grid img{height:280px;}
    .row{grid-template-columns:1fr;gap:32px;}
    .row.reverse .row-img{order:1;}
    .row.reverse .row-text{order:2;}
    .footer-grid{grid-template-columns:1fr;text-align:center;gap:34px;}
    .footer-contact{justify-self:center;}
    .carousel{height:420px;}
    .carousel-caption h1{font-size:2.2rem;}
    section{padding:70px 7% 66px;}
  }
  @media (max-width:680px){
    header{height:150px;}
    .brand img{height:130px;}
    nav.menu{position:absolute;right:12px;top:auto;bottom:10px;transform:none;}
    .carousel{height:380px;}
    .carousel-caption h1{font-size:1.7rem;}
    .row-img img{height:300px;}
  }
</style>
</head>
<body>

  <!-- HEADER -->
  <header>
    <div class="nav-top">
      <div class="brand">
        <img src="{{ asset('img/logo.png.png') }}" alt="Logo Adversing System">
      </div>

      <nav class="menu">
        <a href="{{ route('login') }}"><button type="button">Iniciar sesión</button></a>
        <a href="{{ route('register') }}"><button type="button" class="btn-fill">Registrarse</button></a>
      </nav>
    </div>
  </header>

  <!-- CARRUSEL DE IMÁGENES (HERO) -->
  <div class="carousel" id="carousel">
    <button class="carousel-arrow prev" id="prevBtn" type="button">‹</button>
    <button class="carousel-arrow next" id="nextBtn" type="button">›</button>

    <div class="carousel-track" id="carouselTrack">
      <div class="carousel-slide"><img src="{{ asset('img/inicio.1.jpg') }}" alt="Adversing System 1"></div>
      <div class="carousel-slide"><img src="{{ asset('img/inicio.2.jpg') }}" alt="Adversing System 2"></div>
      <div class="carousel-slide"><img src="{{ asset('img/inicio.3.jpg') }}" alt="Adversing System 3"></div>
      <div class="carousel-slide"><img src="{{ asset('img/inicio.4.jpg') }}" alt="Adversing System 4"></div>
      <div class="carousel-slide"><img src="{{ asset('img/inicio.5.jpg') }}" alt="Adversing System 5"></div>
      <div class="carousel-slide"><img src="{{ asset('img/inicio.6.jpg') }}" alt="Adversing System 6"></div>
    </div>

    <div class="carousel-caption">
      <span class="kicker">Adversing System</span>
      <h1>Donde las ideas se<br>convierten en impacto</h1>
      <div class="rule"></div>
    </div>

    <div class="carousel-dots" id="carouselDots"></div>
  </div>

  <!-- BRANDING Y DISEÑO GRÁFICO -->
  <section class="bg-teal">
    <span class="eyebrow on-teal reveal">Branding y diseño gráfico</span>
    <div class="branding-grid">
      <div class="info-box reveal">
        Ofrecemos servicios de diseño: materiales de impresión, identidad corporativa, naming,
        packaging, diseño editorial, diseño publicitario. Trabajamos en estrecha colaboración
        con nuestros clientes para entender sus negocios y brindar soluciones de diseño que
        reflejen su marca y atraigan a su público objetivo.
      </div>
      <div class="bullet-box reveal">
        <ul>
          <li>Concepto y filosofía de marca</li>
          <li>Nombre de la marca: Naming</li>
          <li>Registro de Marca</li>
          <li>Slogan de marca</li>
          <li>StoryTelling: Marcas contando historias</li>
          <li>Arquitectura de marca</li>
          <li>Diseño de empaques: Packaging</li>
        </ul>
      </div>
      <div class="reveal">
        <p class="lead-statement">Diseñamos sistemas de marca inteligentes que ayudan a las empresas a progresar.</p>
      </div>
    </div>
  </section>

  <!-- LIDERAZGO EN MARKETING (imagen producto) -->
  <section class="bg-soft">
    <div class="row">
      <div class="row-img reveal"><img src="{{ asset('img/inicio.1.jpg') }}" alt="Producto de marca"></div>
      <div class="row-text reveal">
        <span class="tag">Posicionamiento</span>
        <p class="italic-lead">Establecemos el estándar de liderazgo en marketing y ventas al construir
        constantemente marcas más sólidas y ofrecer resultados superiores.</p>
      </div>
    </div>
  </section>

  <!-- CREATIVIDAD Y CONTENIDOS -->
  <section class="bg-white">
    <span class="eyebrow reveal">Creatividad y contenidos</span>
    <div class="creativ-grid">
      <div class="bullet-box reveal">
        <ul>
          <li>Proyecto Campaña Creativa</li>
          <li>Administración de redes sociales</li>
          <li>Motion y Animación</li>
          <li>Producción de Video</li>
          <li>Locución o Cuña Radial</li>
          <li>Central de Medios Offline</li>
          <li>Blogging Contenido</li>
          <li>Diseño de Piezas gráficas</li>
          <li>Producción Podcast</li>
          <li>Estrategia PR</li>
        </ul>
      </div>
      <img class="reveal" src="{{ asset('img/inicio.2.jpg') }}" alt="Anuncio publicitario en parada de bus">
      <div class="row-text reveal">
        <p>Herramientas visuales grandes que se usan para atraer la atención y comunicar un mensaje claro en poco tiempo.</p>
      </div>
    </div>
  </section>

  <!-- ANUNCIOS EN TRANSPORTES -->
  <section class="bg-softer">
    <div class="row">
      <div class="row-text reveal">
        <span class="tag">Medios exteriores</span>
        <h2>Anuncios en transportes</h2>
        <p>Se refiere a la práctica de promocionar productos, servicios o marcas a través de
        espacios publicitarios en vehículos y estaciones de transporte público, como buses, etc.</p>
      </div>
      <div class="row-img reveal"><img src="{{ asset('img/inicio.3.jpg') }}" alt="Anuncio publicitario en bus"></div>
    </div>
  </section>

  <!-- FLYERS O FOLLETO -->
  <section class="bg-mid">
    <div class="row reverse">
      <div class="row-img reveal"><img src="{{ asset('img/inicio.4.jpg') }}" alt="Flyer publicitario"></div>
      <div class="row-text reveal">
        <span class="tag">Impresos</span>
        <h2>Flyers o folleto</h2>
        <p>Los folletos son hojas de papel impresas utilizadas para promover eventos, productos
        o servicios específicos. Los flyers se pueden distribuir en mano, colocar en puntos
        estratégicos o incluir en correo directo.</p>
      </div>
    </div>
  </section>

  <!-- CARTELES O POSTERS -->
  <section class="bg-soft">
    <div class="row">
      <div class="row-text reveal">
        <span class="tag">Vía pública</span>
        <h2>Carteles o posters</h2>
        <strong class="callout">Es el soporte físico de algún tipo de anuncio</strong>
        <p>mensaje o diseño artístico. Generalmente consiste en una lámina de papel, cartón o
        algún material semejante, en el que se inscribe un contenido de tipo visual y/o
        textual o tipográfico.</p>
      </div>
      <div class="row-img reveal"><img src="{{ asset('img/inicio.5.jpg') }}" alt="Pared de carteles publicitarios"></div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="footer-logo">
          <img src="{{ asset('img/logo.png.png') }}" alt="Logo Adversing System">
        </div>
        <p>Ideas con impacto global</p>
      </div>

      <div class="footer-social">
        <div class="icons">
          <span>📘</span><span>📷</span><span>✖️</span>
        </div>
        <div class="footer-links">
          <a href="#">Política de privacidad</a>
          <a href="#">Términos de uso</a>
          <a href="#">Contacto</a>
        </div>
      </div>

      <div class="footer-contact">
        <b>Contacto</b>
        Contacto09@gmail.com<br>
        3000900095<br>
        Colombia
      </div>
    </div>
    <div class="footer-bottom">© 2026 Adversing System. Todos los derechos reservados.</div>
  </footer>

<script>
/* ============================================================
   CARRUSEL DE IMÁGENES — desliza automáticamente cada 4s
   ============================================================ */
const track   = document.getElementById('carouselTrack');
const slides  = track.querySelectorAll('.carousel-slide');
const dotsBox = document.getElementById('carouselDots');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
let current   = 0;
let autoTimer = null;

slides.forEach((_, i) => {
  const dot = document.createElement('button');
  dot.type = 'button';
  if (i === 0) dot.classList.add('active');
  dot.addEventListener('click', () => goTo(i));
  dotsBox.appendChild(dot);
});
const dots = dotsBox.querySelectorAll('button');

function goTo(index){
  current = (index + slides.length) % slides.length;
  track.style.transform = `translateX(-${current * 100}%)`;
  dots.forEach(d => d.classList.remove('active'));
  dots[current].classList.add('active');
}
function nextSlide(){ goTo(current + 1); }
function prevSlide(){ goTo(current - 1); }

function startAuto(){
  stopAuto();
  autoTimer = setInterval(nextSlide, 4000);
}
function stopAuto(){
  if (autoTimer) clearInterval(autoTimer);
}

nextBtn.addEventListener('click', () => { nextSlide(); startAuto(); });
prevBtn.addEventListener('click', () => { prevSlide(); startAuto(); });

const carouselEl = document.getElementById('carousel');
carouselEl.addEventListener('mouseenter', stopAuto);
carouselEl.addEventListener('mouseleave', startAuto);

startAuto();

/* ============================================================
   ANIMACIÓN DE ENTRADA AL HACER SCROLL
   ============================================================ */
const revealEls = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting){
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.15 });
revealEls.forEach(el => observer.observe(el));
</script>
</body>
</html>