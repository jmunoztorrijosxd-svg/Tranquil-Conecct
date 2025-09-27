<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tranquil_Connect 💙</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    /* Reset */
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
    html, body { height: 100%; }
    body { display: flex; flex-direction: column; background-color: #e6f0ff; color: #000; }

    header {
        background-color: #4d9cff;
        padding: 20px 0;
        text-align: center;
        color: white;
        position: relative;
    }
    header h1 { font-size: 2rem; }
    nav {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
        flex-wrap: wrap;
    }
    nav a {
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #80bfff;
        color: white;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s;
    }
    nav a:hover { background-color: #3399ff; }
    nav a.active { background-color: #0066cc; }
    .btn-login { background-color: #4CAF50; }
    .btn-login:hover { background-color: #3e8e41; }
    .btn-register { background-color: #FF5722; }
    .btn-register:hover { background-color: #e64a19; }

    /* Main y secciones */
    main, #grupos, #agendar, #foro_social {
        flex: 1;
        padding: 20px;
        position: relative;
    }

    /* Tarjetas de Inicio */
    #inicio {
        display: flex; 
        flex-wrap: wrap; 
        gap: 20px;
        justify-content: center;
    }

    .card {
        background-color: white;
        width: 300px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .card-icon {
        background-color: #cce0ff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #0066cc;
    }

    .user-name {
        position: absolute;
        top: 20px;
        right: 20px;
        font-weight: bold;
        color: white;
        background-color: #0066cc;
        padding: 8px 15px;
        border-radius: 20px;
    }

    /* Estilos para las secciones ocultas */
    #grupos, #agendar, #foro_social { 
        display: none;
        flex-direction: column;
        justify-content: flex-start; 
        align-items: center;
        gap: 15px;
        animation: fadeIn 0.5s ease-in-out;
    }

    #foro_social .content { 
        max-width: 600px;
        width: 100%;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        text-align: center;
    }

    /* Estilos específicos de Agendar (Contenedor principal) */
    #agendar {
        display: flex; 
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    .agendar-message {
        margin-top: 5px;
        line-height: 1.6;
        color: #333;
        text-align: center;
        max-width: 700px;
    }

    /* Estilos para la lista/tabla de psicólogos */
    #psicologos-container {
        width: 100%;
        max-width: 700px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 10px; 
    }

    .psicologo-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        transition: transform 0.2s, background-color 0.2s;
    }
    .psicologo-item:hover { background-color: #f0f8ff; transform: translateY(-2px); }

    .psicologo-info {
        display: flex;
        align-items: center;
        gap: 15px;
        text-align: left;
    }

    .psicologo-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #0066cc;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .psicologo-details div {
        line-height: 1.3;
    }
    .psicologo-details .nombre { font-weight: bold; color: #333; }
    .psicologo-details .especialidad { font-size: 0.9rem; color: #4d9cff; }
    .psicologo-details .email { font-size: 0.85rem; color: gray; }

    .btn-agendar-psicologo {
        background-color: #4CAF50; 
        color: white;
        border: none;
        padding: 8px 15px;
        font-size: 0.9rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn-agendar-psicologo:hover { background-color: #3e8e41; }

    /* Estilos para Grupos */
    #grupo-lista {
        width: 100%;
        max-width: 500px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .grupo-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: background-color 0.2s, transform 0.2s;
    }
    .grupo-item:hover { background-color: #d6eaff; transform: translateY(-2px); }

    .grupo-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #4d9cff;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 15px;
        font-size: 1.2rem;
    }

    footer {
        text-align: center;
        padding: 20px;
        background-color: #4d9cff;
        color: white;
    }

    .logo {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 130px;
        height: 130px;
    }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* Botón flotante circular */
    #btn-agregar-grupo {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #4CAF50;
        color: white;
        font-size: 2rem;
        border: none;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        transition: background-color 0.3s, transform 0.2s;
        z-index: 100;
    }
    #btn-agregar-grupo:hover { background-color: #3e8e41; transform: scale(1.1); }

    /* Modal */
    #modal-agregar {
        display:none;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background-color:rgba(0,0,0,0.5);
        justify-content:center;
        align-items:center;
        z-index:200;
    }
    #modal-agregar .modal-content {
        background:white;
        padding:20px;
        border-radius:10px;
        width:300px;
        position:relative;
    }
    #modal-agregar input { width:100%; padding:8px; margin:10px 0; }
    #modal-agregar button { cursor:pointer; border:none; border-radius:5px; padding:10px 20px; }
    #modal-agregar .btn-cancel { background:#ccc; color:black; margin-left:10px; }
    #modal-agregar .btn-submit { background:#4CAF50; color:white; }
</style>

</head>

<body>

<header>
    <img src="{{ asset('images/tranquil_connect_new_logo.png') }}"
         onerror="this.onerror=null;this.src='https://placehold.co/130x130/4d9cff/ffffff?text=Logo';"
         alt="Tranquil Connect" class="logo">
    <h1>Tranquil Connect</h1>
    @auth
        <span class="user-name">{{ Auth::user()->name }}</span>
    @endauth
    <nav>
        <a href="#" id="btn-inicio" class="active">Inicio</a>
        <a href="#" id="btn-grupos">Grupos</a>
        <a href="#" id="btn-agendar">Agendar</a>
        <a href="#" id="btn-foro_social">Foro social</a>
        @auth
            <a href="{{ route('dashboard') }}">Registros</a>
        @endauth
        @guest
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Registro</a>
        @endguest
    </nav>
</header>

<main id="inicio">
    <div class="card">
        <div class="card-icon">📄</div>
        <h3>Documentacion</h3>
        <p>Encuentra toda la documentación de Tranquil Connect.</p>
    </div>
    <div class="card">
        <div class="card-icon">👥</div>
        <h3>Comunidad</h3>
        <p>Únete a la comunidad y aprende junto a otros usuarios.</p>
    </div>
    <div class="card">
        <div class="card-icon">🛠️</div>
        <h3>Soporte</h3>
        <p>Obtén ayuda rápida y sencilla con nuestro soporte.</p>
    </div>
    <div class="card">
        <div class="card-icon">⚙️</div>
        <h3>Configuracion</h3>
        <p>Configura tu cuenta y personaliza tu experiencia.</p>
    </div>
</main>

<section id="grupos">
    <div id="grupo-lista">
        </div>
</section>

<section id="agendar">
    <h2>Agendamiento de Citas con Psicólogos</h2>
    <p class="agendar-message">
        Selecciona un profesional de la lista de abajo para ver sus horarios disponibles y agendar tu sesión individual.
    </p>

    <div id="psicologos-container">
        <p style='text-align:center; padding: 15px; color: gray;'>Presiona "Agendar" en el menú superior para cargar la lista.</p>
    </div>
    
    <p style="margin-top: 25px; font-weight: bold; color: #0066cc; font-size: 0.9rem;">
        *Revisa tu correo para confirmar los detalles de la sesión.
    </p>
</section>

<section id="foro_social">
    <div class="content">
        <h2>Comunidad y Apoyo Mutuo</h2>
        <p class="agendar-message">
            Bienvenido al **Foro Social**. Aquí puedes conectar con otros usuarios, compartir experiencias, hacer preguntas y ofrecer apoyo en un entorno seguro y respetuoso.
        </p>
        
        <a href="#" class="btn-citas-psicologo" style="background-color: #3399ff;" onclick="alert('¡Accediendo al Foro Social!'); return false;">
            Explorar el Foro 💬
        </a>
        
        <p style="margin-top: 25px; font-weight: bold; color: #0066cc; font-size: 0.9rem;">
            Las reglas de la comunidad se aplican. Se promueve la empatía y el respeto.
        </p>
    </div>
</section>

<button id="btn-agregar-grupo">+</button>

<div id="modal-agregar">
    <div class="modal-content">
        <h3>Agregar Grupo</h3>
        <form id="form-agregar-grupo" method="POST">
            <label>Nombre del Grupo:</label>
            <input type="text" name="nombre" id="input-nombre-grupo" required>
            <label>Número de Miembros:</label>
            <input type="number" name="num_miembros" id="input-miembros-grupo" required>
            <button type="submit" class="btn-submit">Agregar</button>
            <button type="button" id="cerrar-modal" class="btn-cancel">Cancelar</button>
        </form>
    </div>
</div>

<footer>© 2025 Tranquil_Connect. Todos los derechos reservados.</footer>

<script>
const inicio = document.getElementById('inicio');
const grupos = document.getElementById('grupos');
const agendar = document.getElementById('agendar');
const foroSocial = document.getElementById('foro_social'); 

const btnInicio = document.getElementById('btn-inicio');
const btnGrupos = document.getElementById('btn-grupos');
const btnAgendar = document.getElementById('btn-agendar');
const btnForoSocial = document.getElementById('btn-foro_social'); 

const btnAgregar = document.getElementById('btn-agregar-grupo');
const modal = document.getElementById('modal-agregar');
const cerrarModal = document.getElementById('cerrar-modal');
const formAgregarGrupo = document.getElementById('form-agregar-grupo');
const psicologosContainer = document.getElementById('psicologos-container');

const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '';

function resetSections() {
    inicio.style.display = 'none';
    grupos.style.display = 'none';
    agendar.style.display = 'none';
    foroSocial.style.display = 'none';
    btnAgregar.style.display = 'none';
    document.querySelectorAll('nav a').forEach(a => {
        if (!a.classList.contains('btn-login') && !a.classList.contains('btn-register') && !a.getAttribute('href').includes('dashboard')) {
            a.classList.remove('active');
        }
    });
}

btnGrupos.addEventListener('click', e => {
    e.preventDefault();
    resetSections();
    grupos.style.display = 'flex';
    btnGrupos.classList.add('active');
    btnAgregar.style.display = 'flex';
    cargarGrupos();
});

btnAgendar.addEventListener('click', e => {
    e.preventDefault();
    resetSections();
    agendar.style.display = 'flex';
    btnAgendar.classList.add('active');
    cargarPsicologos();
});

btnForoSocial.addEventListener('click', e => {
    e.preventDefault();
    resetSections();
    foroSocial.style.display = 'flex';
    btnForoSocial.classList.add('active');
});

btnInicio.addEventListener('click', e => {
    e.preventDefault();
    resetSections();
    inicio.style.display = 'flex';
    btnInicio.classList.add('active');
});

btnAgregar.addEventListener('click', () => {
    modal.style.display = 'flex';
});

cerrarModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

// Función para cargar psicólogos con email
function cargarPsicologos() {
    psicologosContainer.innerHTML = "<p style='text-align:center; padding: 15px; color: gray;'>Cargando psicólogos de la base de datos...</p>";

    fetch('/api/psicologos/data') 
    .then(response => {
        if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
        return response.json();
    })
    .then(data => {
        psicologosContainer.innerHTML = "";
        if (data.length === 0) {
            psicologosContainer.innerHTML = "<p style='text-align:center; padding: 15px; color: gray;'>No hay psicólogos disponibles en la base de datos.</p>";
            return;
        }
        data.forEach(psicologo => {
            const item = document.createElement('div');
            item.className = 'psicologo-item';
            const inicial = psicologo.nombre ? psicologo.nombre.charAt(0) : '?';
            item.innerHTML = `
                <div class="psicologo-info">
                    <div class="psicologo-avatar">${inicial}</div>
                    <div class="psicologo-details">
                        <div class="nombre">${psicologo.nombre}</div>
                        <div class="especialidad">${psicologo.especialidad}</div>
                        <div class="email">${psicologo.email || 'Sin email'}</div>
                    </div>
                </div>
                <button class="btn-agendar-psicologo" 
                        onclick="alert('Agendar cita con ${psicologo.nombre}. ID: ${psicologo.psicologo_id}. Esto abriría el formulario de agendamiento.');">
                    Agendar
                </button>
            `;
            psicologosContainer.appendChild(item);
        });
    })
    .catch(err => {
        console.error("Error al cargar los psicólogos, usando datos estáticos:", err);
        const staticPsicologos = [
            { nombre: "Dr. Ana Gómez", especialidad: "Terapia Cognitivo-Conductual", email: "ana@email.com" },
            { nombre: "Lic. Juan Pérez", especialidad: "Psicología Clínica", email: "juan@email.com" },
        ];
        psicologosContainer.innerHTML = "";
        staticPsicologos.forEach(psicologo => {
            const item = document.createElement('div');
            item.className = 'psicologo-item';
            const inicial = psicologo.nombre.charAt(0);
            item.innerHTML = `
                <div class="psicologo-info">
                    <div class="psicologo-avatar">${inicial}</div>
                    <div class="psicologo-details">
                        <div class="nombre">${psicologo.nombre} (Estático)</div>
                        <div class="especialidad">${psicologo.especialidad}</div>
                        <div class="email">${psicologo.email}</div>
                    </div>
                </div>
                <button class="btn-agendar-psicologo" 
                        onclick="alert('Agendar cita con ${psicologo.nombre} (Datos Estáticos)');">
                    Agendar
                </button>
            `;
            psicologosContainer.appendChild(item);
        });
        const warning = document.createElement('p');
        warning.style = 'text-align:center; padding-top: 15px; color: red; font-size: 0.8rem;';
        warning.innerHTML = '*Advertencia: No se pudieron cargar los datos reales del servidor (API: /api/psicologos/data).';
        psicologosContainer.appendChild(warning);
    });
}

// Función para cargar grupos
function cargarGrupos() {
    let contenedor = document.getElementById('grupo-lista');
    contenedor.innerHTML = ""; 

    fetch('/api/grupos/data')
    .then(response => {
        if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
        return response.json();
    })
    .then(data => {
        if (data.length === 0) {
            contenedor.innerHTML = "<p style='text-align:center; padding: 15px; color: gray;'>No hay grupos disponibles (API)</p>";
            return;
        }
        data.forEach(grupo => {
            let div = document.createElement('div');
            div.className = 'grupo-item';
            div.innerHTML = `
                <div class="grupo-avatar">${grupo.nombre.charAt(0)}</div>
                <div>
                    <div style="font-weight:bold;">${grupo.nombre}</div>
                    <div style="font-size: 0.9rem; color: gray;">${grupo.num_miembros} miembros</div>
                </div>
            `;
            div.addEventListener('click', () => console.log("Abriste el grupo: " + grupo.nombre));
            contenedor.appendChild(div);
        });
    })
    .catch(err => {
        console.error("Error al cargar los grupos, usando datos estáticos:", err);
        contenedor.innerHTML = `
            <div class="grupo-item"><div class="grupo-avatar">G</div><div><div style="font-weight:bold;">Grupo Test (Estático)</div><div style="font-size: 0.9rem; color: gray;">10 miembros</div></div></div>
            <p style='text-align:center; padding-top: 15px; color: red; font-size: 0.8rem;'>*Advertencia: No se pudieron cargar los datos reales del servidor (API: /api/grupos/data).</p>
        `;
    });
}

// Manejo del formulario de agregar grupo
formAgregarGrupo.addEventListener('submit', async function(e) {
    e.preventDefault();
    const nombre = document.getElementById('input-nombre-grupo').value;
    const num_miembros = document.getElementById('input-miembros-grupo').value;
    try {
        const response = await fetch('/grupos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ nombre: nombre, num_miembros: num_miembros, motivo_salida: '' })
        });
        if (!response.ok) {
            if (response.status === 419) {
                alert('Error de Seguridad (419): La sesión expiró. Recarga la página y vuelve a intentarlo.');
            } else {
                let errorData = {};
                try { errorData = await response.json(); } catch { alert(`Error ${response.status}: Servidor devolvió error inesperado.`); return; }
                alert('Error al guardar el grupo: ' + (errorData.message || 'Error desconocido'));
            }
            return;
        }
        await response.json();
        modal.style.display = 'none';
        formAgregarGrupo.reset();
        cargarGrupos();
        alert("¡Grupo agregado con éxito!");
    } catch (error) {
        console.error('Error en la comunicación con el servidor:', error);
        alert('Hubo un error de conexión al agregar el grupo.');
    }
});

document.addEventListener('DOMContentLoaded', () => {
    resetSections(); 
    inicio.style.display = 'flex';
    btnInicio.classList.add('active');
    btnAgregar.style.display = 'none'; 
});
</script>

</body>
</html>
