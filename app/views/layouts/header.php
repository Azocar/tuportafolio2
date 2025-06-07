<?php
// app/views/layouts/header.php
// Cabecera común para todas las vistas, incluye navegación, idioma y tema
$theme = $_SESSION['theme'] ?? 'light';
$lang = $lang ?? ($_SESSION['lang'] ?? 'es');
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $tr['welcome'] ?? 'TuPortafolio' ?></title>
    <link rel="icon" type="image/x-icon" href="/TuPortafolio/public/images/p.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/futuristic.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Orbitron:wght@700&family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(120deg, #232526 0%, #2c5364 100%);
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
            transition: background 0.4s;
            font-family: 'Inter', Arial, Helvetica, sans-serif;
        }
        .container {
            max-width: 1000px;
            margin: 32px auto 0 auto;
            background: rgba(255,255,255,0.04);
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            padding: 32px 16px 24px 16px;
            border: none;
            display: flex;
            flex-direction: column;
            min-height: 80vh;
        }
        header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }
        @media (min-width: 700px) {
            header { flex-direction: column; align-items: center; justify-content: center; }
        }
        header h1 {
            font-size: 3.2rem;
            color: #00bcd4; /* Azul que hace juego con los botones y enlaces */
            font-family: 'Montserrat', 'Orbitron', Arial, Helvetica, sans-serif !important;
            font-weight: 900;
            letter-spacing: 0.18em;
            margin: 0 auto;
            text-align: center;
            text-shadow: none;
            background: none;
        }
        .theme-switcher {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .theme-switcher select {
            border: 1.5px solid #00bcd4;
            background: #fff;
            color: #00796b;
            font-weight: 600;
            font-size: 1rem;
            padding: 7px 14px;
            border-radius: 7px;
            transition: border 0.2s;
        }
        .theme-switcher select:focus {
            border: 1.5px solid #007cf0;
        }
        nav {
            margin-top: 0;
        }
        nav a {
            color: #007cf0;
            text-decoration: none;
            margin-right: 18px;
            font-weight: 600;
            font-size: 1.08rem;
            letter-spacing: 0.02em;
            transition: color 0.2s;
        }
        nav a:last-child { margin-right: 0; }
        nav a:hover {
            color: #00bcd4;
            text-decoration: underline;
        }
        @media (max-width: 700px) {
            .container { max-width: 98vw; padding: 0 2vw; }
            header h1 { font-size: 2rem; }
        }
    </style>
</head>
<body class="<?= $theme ?>">
    <div class="container">
        <div class="theme-switcher">
            <form method="get" action="index.php" style="display:inline;">
                <input type="hidden" name="route" value="set_theme">
                <select name="theme" onchange="this.form.submit()">
                    <option value="light" <?= ($theme === 'light') ? 'selected' : '' ?>>Claro</option>
                    <option value="dark" <?= ($theme === 'dark') ? 'selected' : '' ?>>Oscuro</option>
                </select>
            </form>
            <form method="get" action="index.php" style="display:inline; margin-left:8px;">
                <input type="hidden" name="route" value="set_lang">
                <select name="lang" onchange="this.form.submit()">
                    <option value="es" <?= ($lang === 'es') ? 'selected' : '' ?>>Español</option>
                    <option value="en" <?= ($lang === 'en') ? 'selected' : '' ?>>English</option>
                </select>
            </form>
        </div>
        <header>
            <a href="index.php?route=home" style="text-decoration:none;">
                <h1><?= $tr['welcome'] ?? 'Bienvenido a TuPortafolio' ?></h1>
            </a>
        </header>
        <nav>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="index.php?route=logout"><?= $tr['logout'] ?? 'Cerrar sesión' ?></a>
            <?php else: ?>
                <a href="index.php?route=login"><?= $tr['login'] ?? 'Iniciar sesión' ?></a>
                <a href="index.php?route=register"><?= $tr['register'] ?? 'Registrarse' ?></a>
            <?php endif; ?>
        </nav>
