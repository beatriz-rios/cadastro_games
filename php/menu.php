<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>
    
</head>
<body>

    <!-- Imagem de fundo em máxima qualidade via <img> -->
    <div id="bg-wrapper">
        <img src="../img/33-2.jpg" alt="background" draggable="false">
    </div>

    <!-- Overlay escuro suave -->
    <div id="bg-overlay"></div>

    <!-- Canvas para animações abstratas sutis -->
    <canvas id="anim-canvas"></canvas>

    <h1>Menu Principal</h1>
    <h2>Bem vindo(a) Player <?php echo $_SESSION['usuario'];?>!</h2>
    <ul>
    <h2>Bem vindo <?php echo $_SESSION['usuario'];?>!</h2>
     <ul>
        <li><a href="jogos.php">Cadastro de Jogos</a></li>
        <li><a href="acao.php">Ação</a></li>
        <li><a href="menu.php">Tela Principal</a></li>
        <li><a href="gestao.php">Racking</a></li>
    </ul>

    <button onclick="sair()">Sair</button>

    <script src="../js/logout.js"></script>

    <script>
    /* ============================================================
       ANIMAÇÃO ABSTRATA NO CANVAS — partículas + orbs + raios
       ============================================================ */
    (function() {
        const canvas = document.getElementById('anim-canvas');
        const ctx    = canvas.getContext('2d');

        function resize() {
            canvas.width  = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        /* --- Partículas brilhantes --- */
        const PARTICLES = [];
        const PARTICLE_COUNT = 60;

        for (let i = 0; i < PARTICLE_COUNT; i++) {
            PARTICLES.push({
                x:     Math.random() * window.innerWidth,
                y:     Math.random() * window.innerHeight,
                r:     Math.random() * 2.5 + 0.8,
                alpha: 0,
                alphaDir: Math.random() > 0.5 ? 1 : -1,
                alphaSpeed: Math.random() * 0.035 + 0.018,
                vx:   (Math.random() - 0.5) * 1.4,
                vy:   (Math.random() - 0.5) * 1.4,
                color: Math.random() > 0.5
                    ? `rgba(214, 184, 118,`   // dourado
                    : `rgba(200, 220, 255,`   // azul pálido
            });
        }

        /* --- Orbs de luz flutuantes --- */
        const ORBS = [
            { x: 0.15, y: 0.15, r: 280, color: [214, 184, 118], phase: 0,     speed: 0.0004 },
            { x: 0.85, y: 0.80, r: 220, color: [100, 140, 220], phase: 2.1,   speed: 0.0003 },
            { x: 0.60, y: 0.45, r: 180, color: [200, 120,  80], phase: 4.2,   speed: 0.0005 },
        ];

        /* --- Raios de luz verticais --- */
        const RAYS = [];
        const RAY_COUNT = 5;
        for (let i = 0; i < RAY_COUNT; i++) {
            RAYS.push({
                x:     Math.random() * window.innerWidth,
                yStart: -window.innerHeight * 0.4,
                yEnd:   window.innerHeight * 0.5,
                alpha:  0,
                alphaTarget: Math.random() * 0.12 + 0.04,
                alphaDir: 1,
                speed:  Math.random() * 0.3 + 0.2,
                width:  Math.random() * 1.2 + 0.3,
            });
        }

        let t = 0;

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            t++;

            /* Orbs */
            ORBS.forEach(orb => {
                orb.phase += orb.speed;
                const cx = orb.x * canvas.width  + Math.sin(orb.phase * 1.3) * 60;
                const cy = orb.y * canvas.height + Math.cos(orb.phase)       * 40;
                const alpha = 0.08 + 0.04 * Math.sin(orb.phase * 2);
                const [r, g, b] = orb.color;

                const grad = ctx.createRadialGradient(cx, cy, 0, cx, cy, orb.r);
                grad.addColorStop(0,   `rgba(${r},${g},${b},${alpha})`);
                grad.addColorStop(0.5, `rgba(${r},${g},${b},${alpha * 0.4})`);
                grad.addColorStop(1,   `rgba(${r},${g},${b},0)`);

                ctx.fillStyle = grad;
                ctx.beginPath();
                ctx.arc(cx, cy, orb.r, 0, Math.PI * 2);
                ctx.fill();
            });

            /* Raios */
            RAYS.forEach(ray => {
                ray.yStart += ray.speed;
                ray.yEnd   += ray.speed;

                // Reset quando sai da tela
                if (ray.yStart > canvas.height * 1.1) {
                    ray.x      = Math.random() * canvas.width;
                    ray.yStart = -canvas.height * 0.6;
                    ray.yEnd   = canvas.height  * 0.3;
                    ray.alphaTarget = Math.random() * 0.12 + 0.03;
                }

                // Fade in / fade out
                ray.alpha += (ray.alphaTarget - ray.alpha) * 0.02;

                const grad = ctx.createLinearGradient(ray.x, ray.yStart, ray.x, ray.yEnd);
                grad.addColorStop(0,   `rgba(214,184,118,0)`);
                grad.addColorStop(0.4, `rgba(214,184,118,${ray.alpha})`);
                grad.addColorStop(0.7, `rgba(214,184,118,${ray.alpha * 0.6})`);
                grad.addColorStop(1,   `rgba(214,184,118,0)`);

                ctx.strokeStyle = grad;
                ctx.lineWidth   = ray.width;
                ctx.beginPath();
                ctx.moveTo(ray.x, ray.yStart);
                ctx.lineTo(ray.x, ray.yEnd);
                ctx.stroke();
            });

            /* Partículas */
            PARTICLES.forEach(p => {
                p.alpha += p.alphaSpeed * p.alphaDir;
                if (p.alpha >= 1)   { p.alpha = 1;  p.alphaDir = -1; }
                if (p.alpha <= 0)   { p.alpha = 0;  p.alphaDir =  1;
                    // Reposiciona quando desaparece
                    p.x = Math.random() * canvas.width;
                    p.y = Math.random() * canvas.height;
                }

                p.x += p.vx;
                p.y += p.vy;

                // Wrap nas bordas
                if (p.x < 0) p.x = canvas.width;
                if (p.x > canvas.width)  p.x = 0;
                if (p.y < 0) p.y = canvas.height;
                if (p.y > canvas.height) p.y = 0;

                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = `${p.color}${p.alpha.toFixed(3)})`;
                ctx.fill();

                // Brilho suave ao redor
                if (p.alpha > 0.4) {
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.r * 3, 0, Math.PI * 2);
                    ctx.fillStyle = `${p.color}${(p.alpha * 0.08).toFixed(3)})`;
                    ctx.fill();
                }
            });

            requestAnimationFrame(draw);
        }

        draw();
    })();
    </script>

</body>
</html>