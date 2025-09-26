<!DOCTYPE html
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tranquil_Connect 💙</title>
<!-- PASO 1: AÑADIR META TAG PARA EL TOKEN CSRF (Obligatorio en Laravel para llamadas AJAX POST) -->
<!-- Suponemos que la variable de Blade para el token está disponible -->
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
    main, #grupos {
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

    /* Lista de grupos centrada */
    #grupos {
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 15px;
        animation: fadeIn 0.5s ease-in-out;
    }

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
        <a href="#">Configuración</a>
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @endauth
        @guest
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Registro</a>
        @endguest
    </nav>
</header>

<!-- Inicio -->
<main id="inicio">
    <div class="card">
        <div class="card-icon">+</div>
        <h3>Documentation</h3>
        <p>Encuentra toda la documentación de Tranquil Connect.</p>
    </div>
    <div class="card">
        <div class="card-icon">+</div>
        <h3>Community</h3>
        <p>Únete a la comunidad y aprende junto a otros usuarios.</p>
    </div>
    <div class="card">
        <div class="card-icon">0</div>
        <h3>Support</h3>
        <p>Obtén ayuda rápida y sencilla con nuestro soporte.</p>
    </div>
    <div class="card">
        <div class="card-icon">+</div>
        <h3>Settings</h3>
        <p>Configura tu cuenta y personaliza tu experiencia.</p>
    </div>
</main>

<!-- Grupos -->
<section id="grupos">
    <div id="grupo-lista">
        <!-- Data Estática de prueba (se reemplaza si la API funciona) -->
        <div class="grupo-item">
            <div class="grupo-avatar">G</div>
            <div>
                <div style="font-weight:bold;">Grupo Test</div>
                <div style="font-size: 0.9rem; color: gray;">10 miembros</div>
            </div>
        </div>
        <div class="grupo-item">
            <div class="grupo-avatar">G</div>
            <div>
                <div style="font-weight:bold;">Grupo de Programadores</div>
                <div style="font-size: 0.9rem; color: gray;">15 miembros</div>
            </div>
        </div>
        <div class="grupo-item">
            <div class="grupo-avatar">T</div>
            <div>
                <div style="font-weight:bold;">Grupo de Terapia</div>
                <div style="font-size: 0.9rem; color: gray;">7 miembros</div>
            </div>
        </div>
        <div class="grupo-item">
            <div class="grupo-avatar">I</div>
            <div>
                <div style="font-weight:bold;">Grupo de Intereses</div>
                <div style="font-size: 0.9rem; color: gray;">22 miembros</div>
            </div>
        </div>
    </div>
</section>

<!-- Botón flotante para agregar grupo -->
<button id="btn-agregar-grupo">+</button>

<!-- Modal para agregar grupo -->
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
const btnInicio = document.getElementById('btn-inicio');
const btnGrupos = document.getElementById('btn-grupos');
const btnAgregar = document.getElementById('btn-agregar-grupo');
const modal = document.getElementById('modal-agregar');
const cerrarModal = document.getElementById('cerrar-modal');
const formAgregarGrupo = document.getElementById('form-agregar-grupo');

const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '';

// --- Event Listeners de Navegación ---
btnGrupos.addEventListener('click', e => {
    e.preventDefault();
    inicio.style.display = 'none';
    grupos.style.display = 'flex';
    btnInicio.classList.remove('active');
    btnGrupos.classList.add('active');
    btnAgregar.style.display = 'flex'; 
    cargarGrupos();
});

btnInicio.addEventListener('click', e => {
    e.preventDefault();
    grupos.style.display = 'none';
    inicio.style.display = 'flex';
    btnGrupos.classList.remove('active');
    btnInicio.classList.add('active');
    btnAgregar.style.display = 'none'; 
});

btnAgregar.addEventListener('click', () => {
    modal.style.display = 'flex';
});

cerrarModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

// --- Función para Cargar Grupos ---
function cargarGrupos() {
    // Usamos la URL relativa
    fetch('/api/grupos/data') 
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                let errorDetails = `HTTP error! status: ${response.status}. `;
                try {
                    const json = JSON.parse(text);
                    errorDetails += json.message || 'Error desconocido del servidor.';
                } catch {
                    errorDetails += 'Respuesta no JSON o error de ruta (500/404).';
                    console.error("Respuesta del servidor:", text);
                }
                throw new Error(errorDetails);
            });
        }
        return response.json();
    })
    .then(data => {
        let contenedor = document.getElementById('grupo-lista');
        contenedor.innerHTML = ""; // Limpia el contenido estático

        if (data.length === 0) {
            contenedor.innerHTML = "<p style='text-align:center; padding: 15px; color: gray;'>No hay grupos disponibles</p>";
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
        console.error("Error al cargar los datos dinámicos del grupo:", err);
        // Si la carga falla, la data estática se mantiene visible
    });
}

// --- Lógica: Manejar el envío del formulario con JavaScript (AJAX) ---
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
                // Aceptamos solo JSON para forzar a Laravel a no devolver HTML en errores 4xx/5xx
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                nombre: nombre,
                num_miembros: num_miembros,
                motivo_salida: '' 
            })
        });
        
        // Verificamos si la respuesta NO es exitosa (código 4xx o 5xx)
        if (!response.ok) {
            
            if (response.status === 419) {
                // Error específico de CSRF (Sesión expirada)
                alert('Error de Seguridad (419): La sesión expiró. Recarga la página y vuelve a intentarlo.');
                console.error('Error 419: Sesión expirada o token CSRF inválido.');
                
            } else {
                // Intentamos leer el JSON de error (validación, 403, 500)
                let errorData = {};
                try {
                    errorData = await response.json(); 
                } catch (jsonError) {
                    // Si falla la lectura de JSON, es porque nos devolvió HTML (como el error 419/403)
                    console.error("Respuesta del servidor no es JSON. Status:", response.status);
                    alert(`Error ${response.status}: El servidor devolvió un error inesperado (no JSON). Revisa la consola y tu archivo de rutas/controlador.`);
                    return;
                }
                
                // Si logramos leer el JSON, mostramos el mensaje del servidor
                alert('Error al guardar el grupo: ' + (errorData.message || 'Error desconocido'));
                console.error('Error al guardar el grupo:', errorData);
            }
            return; // Detenemos la ejecución aquí si hay un error
        }

        // Si la respuesta es exitosa (response.ok es true)
        const result = await response.json(); 
        
        modal.style.display = 'none';
        formAgregarGrupo.reset(); 
        cargarGrupos();
        alert("¡Grupo agregado con éxito!");
        console.log("Grupo agregado con éxito:", result);

    } catch (error) {
        console.error('Error en la comunicación con el servidor:', error);
        alert('Hubo un error de conexión al agregar el grupo.');
    }
});

document.addEventListener('DOMContentLoaded', () => {
    btnAgregar.style.display = 'none';
});
</script>
</body>
</html>