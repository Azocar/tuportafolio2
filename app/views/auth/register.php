<?php
// app/views/auth/register.php
// Vista de registro de usuario con soporte para idioma y temas
require_once '../app/views/layouts/header.php';
?>
<div class="auth-card">
    <form action="index.php?route=do_register" method="POST" id="registerForm" autocomplete="on">
        <h2 class="auth-title"><?= $tr['register'] ?? 'Registrarse' ?></h2>
        <div class="input-group">
            <label for="nombre"><span class="material-symbols-outlined">person</span> <?= $tr['name'] ?? 'Nombre' ?></label>
            <input type="text" id="nombre" name="nombre" required autocomplete="name">
        </div>
        <div class="input-group">
            <label for="email"><span class="material-symbols-outlined">mail</span> <?= $tr['email'] ?? 'Correo electrónico' ?></label>
            <input type="email" id="email" name="email" required autocomplete="email">
        </div>
        <div class="input-group">
            <label for="password"><span class="material-symbols-outlined">lock</span> <?= $tr['password'] ?? 'Contraseña' ?></label>
            <input type="password" id="password" name="password" required autocomplete="new-password">
        </div>
        <button type="submit" class="auth-btn gradient-btn"><?= $tr['register'] ?? 'Registrarse' ?></button>
        <div class="auth-link">
            <a href="index.php?route=login">¿Ya tienes cuenta? <?= $tr['login'] ?? 'Inicia sesión' ?></a>
        </div>
    </form>
</div>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<script>
    // Validación básica en el cliente
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        const nombre = document.getElementById('nombre').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        if (nombre.trim() === '' || email.trim() === '' || password.trim() === '') {
            alert('Por favor, completa todos los campos.');
            event.preventDefault();
        }
    });
</script>
<?php
require_once '../app/views/layouts/footer.php';
?>
