<?php
// app/views/auth/login.php
// Vista de login de usuario con soporte para idioma y temas
require_once __DIR__ . '/../layouts/header.php';
?>
<div class="auth-card">
    <form action="index.php?route=do_login" method="POST" autocomplete="on">
        <h2 class="auth-title"><?= $tr['login'] ?? 'Iniciar sesión' ?></h2>
        <div class="input-group">
            <label for="email"><span class="material-symbols-outlined">mail</span> <?= $tr['email'] ?? 'Correo electrónico' ?></label>
            <input type="email" id="email" name="email" required autocomplete="username">
        </div>
        <div class="input-group">
            <label for="password"><span class="material-symbols-outlined">lock</span> <?= $tr['password'] ?? 'Contraseña' ?></label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
        </div>
        <button type="submit" class="auth-btn gradient-btn"><?= $tr['login'] ?? 'Iniciar sesión' ?></button>
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="auth-error"> <?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?> </div>
        <?php endif; ?>
        <div class="auth-link">
            <a href="index.php?route=register">¿No tienes cuenta? <?= $tr['register'] ?? 'Regístrate' ?></a>
        </div>
    </form>
</div>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
