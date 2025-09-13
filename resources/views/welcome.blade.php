<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tranquil_Connect 💙</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #e6f0ff; /* Fondo azul suave */
            color: #000;
        }

        header {
            background-color: #4d9cff; /* Azul más fuerte */
            padding: 20px 0;
            text-align: center;
            color: white;
        }

        header h1 {
            font-size: 2rem;
        }

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
            border: none;
            border-radius: 5px;
            background-color: #80bfff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #3399ff;
        }

        nav a.active {
            background-color: #0066cc;
        }

        /* Botones especiales de login y registro */
        .btn-login {
            background-color: #4CAF50; /* Verde */
        }

        .btn-login:hover {
            background-color: #3e8e41;
        }

        .btn-register {
            background-color: #FF5722; /* Naranja */
        }

        .btn-register:hover {
            background-color: #e64a19;
        }

        main {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 40px 20px;
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
            background-color: #cce0ff; /* Azul clarito */
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #0066cc;
        }

        .card h3 {
            font-size: 1.2rem;
        }

        .card p {
            font-size: 0.9rem;
            color: #333;
        }

        .cta {
            text-align: center;
            margin-top: 20px;
        }

        .cta button {
            padding: 10px 25px;
            background-color: #3399ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cta button:hover {
            background-color: #0066cc;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #4d9cff;
            color: white;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido a Tranquil_Connect 💙</h1>
        <nav>
            <a href="#" class="active">Inicio</a>
            <a href="#">Conectar</a>
            <a href="#">Chats</a>
            <a href="#">Perfil</a>
            <a href="#">Configuración</a>
            <!-- 🔥 BOTÓN NUEVO -->
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <!-- Botones Login y Registro -->
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Registro</a>
        </nav>
    </header>

    <main>
        <div class="card">
            <div class="card-icon">+</div>
            <h3>Documentation</h3>
            <p>Encuentra toda la documentación de Tranquil Connect y aprende a usarla fácilmente.</p>
        </div>
        <div class="card">
            <div class="card-icon">+</div>
            <h3>Community</h3>
            <p>Únete a la comunidad, comparte experiencias y aprende junto a otros usuarios.</p>
        </div>
        <div class="card">
            <div class="card-icon">0</div>
            <h3>Support</h3>
            <p>Obtén ayuda rápida y sencilla con nuestro soporte especializado.</p>
        </div>
        <div class="card">
            <div class="card-icon">+</div>
            <h3>Settings</h3>
            <p>Configura tu cuenta y personaliza tu experiencia a tu gusto.</p>
        </div>
    </main>

    <div class="cta">
        <button>Comenzar Ahora</button>
    </div>

    <footer>
        © 2025 Tranquil_Connect. Todos los derechos reservados.
    </footer>
</body>
</html>
