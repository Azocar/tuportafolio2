<?php
// app/views/form/index.php
// Formulario para registrar habilidad principal del estudiante
require_once __DIR__ . '/../layouts/header.php';
$editando = $editando ?? false;
$yaTieneHabilidad = isset($habilidad_principal) && !empty($habilidad_principal);
$error = $_SESSION['habilidad_error'] ?? null;
unset($_SESSION['habilidad_error']);
?>
<div class="auth-card">
    <?php if ($error): ?>
        <div class="auth-error"> <?= htmlspecialchars($tr['only_one_skill'] ?? $error) ?> </div>
    <?php endif; ?>
    <?php if ($editando): ?>
        <form action="index.php?route=update_skill" method="POST" id="studentForm" autocomplete="on">
            <h2 class="auth-title"> <?= $tr['main_skill'] ?? 'Habilidad principal' ?> </h2>
            <div class="input-group">
                <label for="habilidad" style="display:none;"></label>
                <input type="text" id="habilidad" name="habilidad" required autocomplete="off" value="<?= htmlspecialchars($habilidad_principal) ?>" style="text-align:center;font-size:1.3rem;">
            </div>
            <button type="submit" class="auth-btn gradient-btn"> <?= $tr['update_btn'] ?? 'Modificar' ?> </button>
            <div class="auth-link">
                <a href="index.php?route=home" class="button" style="background:#b0bec5;color:#232526;min-width:120px;"> <?= $tr['back'] ?? 'Atrás' ?> </a>
            </div>
        </form>
    <?php elseif ($yaTieneHabilidad): ?>
        <h2 class="auth-title"> <?= $tr['main_skill'] ?? 'Habilidad principal' ?> </h2>
        <div class="input-group">
            <label style="display:none;"></label>
            <input type="text" value="<?= htmlspecialchars($habilidad_principal) ?>" disabled style="text-align:center;font-size:1.3rem;">
        </div>
        <div class="auth-link">
            <a href="index.php?route=home" class="button" style="background:#b0bec5;color:#232526;min-width:120px;"> <?= $tr['back'] ?? 'Atrás' ?> </a>
        </div>
    <?php else: ?>
        <form action="index.php?route=save_student" method="POST" id="studentForm" autocomplete="on">
            <h2 class="auth-title"> <?= $tr['main_skill'] ?? 'Habilidad principal' ?> </h2>
            <div class="input-group">
                <label for="habilidad"><span class="material-symbols-outlined">star</span> <?= $tr['main_skill'] ?? 'Habilidad' ?></label>
                <input type="text" id="habilidad" name="habilidad" required autocomplete="off">
            </div>
            <button type="submit" class="auth-btn gradient-btn"> <?= $tr['register_btn'] ?? 'Registrar' ?> </button>
            <div class="auth-link">
                <a href="index.php?route=home" class="button" style="background:#b0bec5;color:#232526;min-width:120px;"> <?= $tr['back'] ?? 'Atrás' ?> </a>
            </div>
        </form>
    <?php endif; ?>
</div>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<script>
    if(document.getElementById('studentForm')){
        document.getElementById('studentForm').addEventListener('submit', function(event) {
            const habilidad = document.getElementById('habilidad').value;
            if (habilidad.trim() === '') {
                alert('<?= $tr['main_skill'] ?? 'Habilidad' ?> es obligatorio.');
                event.preventDefault();
            }
        });
    }
</script>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
