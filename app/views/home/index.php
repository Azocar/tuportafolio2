<?php
// app/views/home/index.php
// Vista principal: muestra la lista de estudiantes registrados
require_once __DIR__ . '/../layouts/header.php';
?>
<?php
// El botón solo debe mostrarse si el usuario está autenticado y no tiene habilidad principal
$usuario_id = $_SESSION['user_id'] ?? null;
$tieneHabilidad = false;
if ($usuario_id && !empty($estudiantes)) {
    foreach ($estudiantes as $est) {
        if ($est['usuario_id'] == $usuario_id) {
            $tieneHabilidad = true;
            break;
        }
    }
}
?>
<div class="home-actions" style="display:flex;justify-content:center;align-items:center;flex-wrap:wrap;gap:18px;margin-bottom:32px;">
    <?php if ($usuario_id && !$tieneHabilidad): ?>
        <a href="index.php?route=show_form" class="button gradient-btn"><?= $tr['main_skill'] ?? 'Habilidad' ?></a>
    <?php endif; ?>
</div>
<div class="cards-grid">
<?php if (!empty($estudiantes)): ?>
    <?php foreach ($estudiantes as $estudiante): ?>
        <div class="futuristic-card">
            <div class="name"><?= htmlspecialchars($estudiante['nombre']) ?></div>
            <div class="email"> <?= htmlspecialchars($estudiante['email']) ?> </div>
            <div class="skill"> <?= htmlspecialchars($estudiante['habilidad_principal']) ?> </div>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $estudiante['usuario_id']): ?>
                <div style="margin-top:12px; display:flex; gap:12px; justify-content:center;">
                    <a href="index.php?route=edit_skill" class="button gradient-btn sm"> <?= $tr['edit_btn'] ?? 'Modificar' ?> </a>
                    <a href="index.php?route=delete_skill" class="button danger sm" onclick="return showDeleteConfirm(event);"> <?= $tr['delete_btn'] ?? 'Eliminar' ?> </a>
                </div>
                <div style="display:flex; justify-content:center; margin-top:16px;">
                    <a href="index.php?route=download_pdf" class="button gradient-btn" style="min-width:180px;">
                        <?= $tr['download_pdf'] ?? 'Descargar PDF' ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div style="color:#00bcd4; font-size:1.2rem; text-align:center; margin:32px auto;">No hay estudiantes registrados.</div>
<?php endif; ?>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
<script>
function showDeleteConfirm(event) {
    event.preventDefault();
    const modal = document.createElement('div');
    modal.style.position = 'fixed';
    modal.style.top = 0;
    modal.style.left = 0;
    modal.style.width = '100vw';
    modal.style.height = '100vh';
    modal.style.background = 'rgba(0,0,0,0.45)';
    modal.style.display = 'flex';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';
    modal.style.zIndex = 9999;

    const box = document.createElement('div');
    box.style.background = 'linear-gradient(120deg, #232526 0%, #2c5364 100%)';
    box.style.color = '#fff';
    box.style.padding = '32px 28px 24px 28px';
    box.style.borderRadius = '16px';
    box.style.boxShadow = '0 8px 32px #00bcd488';
    box.style.textAlign = 'center';
    box.style.maxWidth = '90vw';
    box.style.minWidth = '320px';

    const msg = document.createElement('div');
    msg.textContent = <?= json_encode($tr['delete_confirm'] ?? '¿Seguro que deseas eliminar tu habilidad principal?') ?>;
    msg.style.fontSize = '1.18rem';
    msg.style.marginBottom = '22px';
    msg.style.fontWeight = '600';
    msg.style.letterSpacing = '0.02em';

    const btns = document.createElement('div');
    btns.style.display = 'flex';
    btns.style.justifyContent = 'center';
    btns.style.gap = '18px';

    const yes = document.createElement('button');
    yes.textContent = <?= json_encode($tr['yes_delete'] ?? 'Sí, eliminar') ?>;
    yes.className = 'button gradient-btn';
    yes.style.background = 'linear-gradient(90deg, #e53935 0%, #ff1744 100%)';
    yes.style.border = 'none';
    yes.style.fontWeight = '700';
    yes.onclick = function() {
        document.body.removeChild(modal);
        window.location.href = event.target.href;
    };

    const no = document.createElement('button');
    no.textContent = <?= json_encode($tr['cancel'] ?? 'Cancelar') ?>;
    no.className = 'button';
    no.style.background = '#b0bec5';
    no.style.color = '#232526';
    no.onclick = function() {
        document.body.removeChild(modal);
    };

    btns.appendChild(yes);
    btns.appendChild(no);
    box.appendChild(msg);
    box.appendChild(btns);
    modal.appendChild(box);
    document.body.appendChild(modal);
    return false;
}
</script>
