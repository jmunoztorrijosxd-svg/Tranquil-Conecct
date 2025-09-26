<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Grupos - Tranquil Connect</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
body{font-family:Arial;background:#e6f0ff;margin:0;padding:20px}
.header{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
.header h1{color:#0066cc}
.container{display:flex;gap:20px}
.lista{width:360px;background:#fff;border-radius:8px;box-shadow:0 6px 15px rgba(0,0,0,0.08);overflow:hidden}
.grupo-item{display:flex;gap:12px;align-items:center;padding:12px;border-bottom:1px solid #eee;cursor:pointer}
.grupo-item:hover{background:#f0f8ff}
.avatar{width:44px;height:44px;border-radius:50%;background:#4d9cff;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700}
.info h4{margin:0;color:#0066cc}
.info p{margin:0;color:#777;font-size:0.9rem}
.form{flex:1;background:#fff;padding:16px;border-radius:8px;box-shadow:0 6px 15px rgba(0,0,0,0.06)}
.form input{width:100%;padding:8px;margin-bottom:8px;border:1px solid #ddd;border-radius:6px}
.btn{background:#4d9cff;color:#fff;padding:8px 12px;border-radius:6px;border:none;cursor:pointer}
.note{color:#666;font-size:0.9rem}
</style>
</head>
<body>
<div class="header">
    <h1>Mis Grupos</h1>
    <div>
        Bienvenido, <strong>{{ Auth::user()->name ?? 'Invitado' }}</strong>
    </div>
</div>

<div class="container">
    <!-- LISTA -->
    <div class="lista" id="grupo-lista">
        <div style="padding:14px;text-align:center;color:gray">Cargando grupos...</div>
    </div>

    <!-- FORMULARIO CREAR -->
    <div class="form">
        <h3>Crear nuevo grupo</h3>
        <form id="form-crear-grupo">
            @csrf
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del grupo" required>
            <input type="number" name="num_miembros" id="num_miembros" placeholder="Número de miembros">
            <input type="text" name="motivo_salida" id="motivo_salida" placeholder="Motivo de salida">
            <input type="number" name="foro_foro_social" id="foro_foro_social" placeholder="ID foro_foro_social">
            <button class="btn" type="submit">Crear grupo</button>
        </form>
        <p class="note">Los grupos se cargan desde la base de datos y aparecen a la izquierda.</p>
    </div>
</div>

<script>
const apiUrl = "{{ route('grupos.index') }}"; 
const storeUrl = "{{ route('grupos.store') }}";
const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function renderEmpty() {
    document.getElementById('grupo-lista').innerHTML = '<div style="padding:14px;text-align:center;color:gray">No hay grupos disponibles</div>';
}

function cargarGrupos() {
    fetch(apiUrl, { credentials: 'same-origin' })
        .then(r => r.json())
        .then(data => {
            const cont = document.getElementById('grupo-lista');
            cont.innerHTML = '';
            if (!data || data.length === 0) { renderEmpty(); return; }

            data.forEach(g => {
                const item = document.createElement('div');
                item.className = 'grupo-item';
                item.innerHTML = `
                    <div class="avatar">${(g.nombre||'G').charAt(0)}</div>
                    <div class="info">
                        <h4>${g.nombre}</h4>
                        <p>${g.num_miembros} miembros • ${g.motivo_salida ?? ''}</p>
                    </div>
                `;
                item.addEventListener('click', () => {
                    alert('Abriste el grupo: ' + g.nombre + ' (codigo: ' + g.codigo_grupo + ')');
                });
                cont.appendChild(item);
            });
        })
        .catch(() => renderEmpty());
}

document.addEventListener('DOMContentLoaded', () => {
    cargarGrupos();

    document.getElementById('form-crear-grupo').addEventListener('submit', function(e){
        e.preventDefault();
        const data = {
            nombre: document.getElementById('nombre').value,
            num_miembros: document.getElementById('num_miembros').value || 0,
            motivo_salida: document.getElementById('motivo_salida').value || '',
            foro_foro_social: document.getElementById('foro_foro_social').value || 0
        };

        fetch(storeUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json'
            },
            body: JSON.stringify(data),
            credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                document.getElementById('form-crear-grupo').reset();
                cargarGrupos();
            } else {
                alert('Error: ' + (res.message ?? 'No se pudo crear el grupo'));
            }
        })
        .catch(() => alert('Error de red'));
    });
});
</script>
</body>
</html>
