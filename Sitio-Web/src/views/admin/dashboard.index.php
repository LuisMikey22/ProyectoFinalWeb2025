<section style="max-width: 1200px; margin: 2rem auto; padding: 0 1rem; font-family: sans-serif;">
    
    <div style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h2 class="text-3xl font-bold text-teal-950">Panel de Control General</h2>
            <p class="text-sm text-teal-700" style="margin-top: 0.25rem;">Suite Analítica Comercial e Interacciones del Chatbot</p>
        </div>
        <div style="display: flex; gap: 0.5rem; background: #e2e8f0; padding: 0.25rem; border-radius: 0.75rem;">
            <a href="?period=day" style="text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: bold; <?= $currentPeriod == 'day' ? 'background: white; color: var(--color-dark-blue); box-shadow: 0 1px 3px rgba(0,0,0,0.1);' : 'color: #64748b;' ?>">Hoy</a>
            <a href="?period=week" style="text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: bold; <?= $currentPeriod == 'week' ? 'background: white; color: var(--color-dark-blue); box-shadow: 0 1px 3px rgba(0,0,0,0.1);' : 'color: #64748b;' ?>">Esta Semana</a>
            <a href="?period=month" style="text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: bold; <?= $currentPeriod == 'month' ? 'background: white; color: var(--color-dark-blue); box-shadow: 0 1px 3px rgba(0,0,0,0.1);' : 'color: #64748b;' ?>">Este Mes</a>
            <a href="?period=year" style="text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: bold; <?= $currentPeriod == 'year' ? 'background: white; color: var(--color-dark-blue); box-shadow: 0 1px 3px rgba(0,0,0,0.1);' : 'color: #64748b;' ?>">Este Año</a>
        </div>
    </div>

    <?php if(!empty($alerts)): ?>
    <div style="background-color: #fef2f2; border: 1px solid #fee2e2; padding: 1.5rem; border-radius: 1.5rem; margin-bottom: 2rem; display: flex; flex-direction: column; gap: 0.75rem;">
        <div style="display: flex; align-items: center; gap: 0.5rem; color: #991b1b; font-weight: bold;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>ALERTA DE SEGURIDAD: CONTROL DE INVENTARIO INFERIOR</span>
        </div>
        <p class="text-sm style-desc" style="color: #7f1d1d; margin: 0;">Los siguientes artículos han alcanzado niveles de desabastecimiento en almacén. Se requiere reposición:</p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.5rem;">
            <?php foreach($alerts as $item): ?>
                <span style="background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; padding: 0.5rem 1rem; border-radius: 2rem; font-size: 0.85rem; font-weight: 600;">
                    🧶 <?= htmlspecialchars($item['name']) ?> (Quedan: <strong><?= $item['stock'] ?></strong> unidades)
                </span>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
        <div class="figure-shadow" style="background: white; padding: 1.5rem; border-radius: 1.5rem; display: flex; align-items: center; gap: 1rem;">
            <div style="background: #ccfbf1; padding: 1rem; border-radius: 1rem; color: #0f766e;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p style="color: #64748b; font-size: 0.85rem; font-weight: bold; margin: 0; text-transform: uppercase;">Ingresos del Mes</p>
                <h4 class="text-2xl font-bold text-teal-950" style="margin: 0.25rem 0 0 0;">$<?= number_format($kpis['monthly_sales'], 2) ?> MXN</h4>
            </div>
        </div>
        <div class="figure-shadow" style="background: white; padding: 1.5rem; border-radius: 1.5rem; display: flex; align-items: center; gap: 1rem;">
            <div style="background: #fe f3c7; padding: 1rem; border-radius: 1rem; color: #b45309; background-color: #fef3c7;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <div>
                <p style="color: #64748b; font-size: 0.85rem; font-weight: bold; margin: 0; text-transform: uppercase;">Pedidos Pendientes</p>
                <h4 class="text-2xl font-bold text-teal-950" style="margin: 0.25rem 0 0 0;"><?= $kpis['pending_orders'] ?> Ordenes</h4>
            </div>
        </div>
        <div class="figure-shadow" style="background: white; padding: 1.5rem; border-radius: 1.5rem; display: flex; align-items: center; gap: 1rem;">
            <div style="background: #e0f2fe; padding: 1rem; border-radius: 1rem; color: #0369a1;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>
            <div>
                <p style="color: #64748b; font-size: 0.85rem; font-weight: bold; margin: 0; text-transform: uppercase;">Consultas Bot Hoy</p>
                <h4 class="text-2xl font-bold text-teal-950" style="margin: 0.25rem 0 0 0;"><?= $kpis['bot_interactions_today'] ?> Chats</h4>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        
        <div class="figure-shadow" style="background: white; padding: 2rem; border-radius: 1.5rem;">
            <h3 class="text-xl font-bold text-teal-950" style="margin-top: 0; margin-bottom: 1.5rem;">Tráfico Semanal vs. Conversiones</h3>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="trendsChart"></canvas>
            </div>
        </div>

        <div class="figure-shadow" style="background: white; padding: 2rem; border-radius: 1.5rem;">
            <h3 class="text-xl font-bold text-teal-950" style="margin-top: 0; margin-bottom: 1.5rem;">Flujo de Conversión Comercial (Embudo)</h3>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="funnelChart"></canvas>
            </div>
        </div>

        <div class="figure-shadow" style="background: white; padding: 2rem; border-radius: 1.5rem; grid-column: span 1;">
            <h3 class="text-xl font-bold text-teal-950" style="margin-top: 0; margin-bottom: 1.5rem;">Distribución de Consultas: Chatbot</h3>
            <div style="position: relative; height: 300px; width: 100%; display: flex; justify-content: center;">
                <canvas id="chatbotChart" style="max-width: 300px;"></canvas>
            </div>
        </div>
        
        <div class="figure-shadow" style="background: white; padding: 2rem; border-radius: 1.5rem;">
            <h3 class="text-xl font-bold text-teal-950" style="margin-top: 0; margin-bottom: 1rem;">Métricas Brutas de Conversión</h3>
            <p class="text-sm text-teal-700" style="margin-bottom: 1.5rem; margin-top: 0;">Resumen cuantificable del flujo operativo analizado por el sistema</p>
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem;">
                <thead>
                    <tr style="border-bottom: 2px solid #f1f5f9; color: var(--color-dark-blue);">
                        <th style="padding: 0.75rem 0; font-weight: bold;">Etapa del Proceso</th>
                        <th style="padding: 0.75rem 0; font-weight: bold; text-align: right;">Volumen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($funnel as $stage => $val): ?>
                    <tr style="border-bottom: 1px solid #f1f5f9; color: #334155;">
                        <td style="padding: 0.75rem 0;"><?= $stage ?></td>
                        <td style="padding: 0.75rem 0; text-align: right; font-weight: bold; color: #0f766e;"><?= number_format($val) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    
    // Paleta de Colores de la Marca (Inyectado de tu hoja de estilos)
    const darkBlue = '#115e59'; // Tu color verde-azul oscuro insignia
    const lightTeal = '#0f766e';
    const accentAqua = '#2dd4bf';
    const softGray = '#94a3b8';

    // 1. Configuración Gráfico de Líneas (Tendencias Semanales)
    const ctxTrends = document.getElementById('trendsChart').getContext('2d');
    new Chart(ctxTrends, {
        type: 'line',
        data: {
            labels: <?= json_encode($trends['labels']) ?>,
            datasets: [
                {
                    label: 'Visitas a Productos',
                    data: <?= json_encode($trends['views']) ?>,
                    borderColor: softGray,
                    backgroundColor: 'rgba(148, 163, 184, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Órdenes Pagadas',
                    data: <?= json_encode($trends['sales']) ?>,
                    borderColor: darkBlue,
                    backgroundColor: 'rgba(17, 94, 89, 0.2)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // 2. Configuración Gráfico del Embudo de Conversión (Barras Horizontales Estilizadas)
    const ctxFunnel = document.getElementById('funnelChart').getContext('2d');
    new Chart(ctxFunnel, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($funnel)) ?>,
            datasets: [{
                label: 'Interacciones',
                data: <?= json_encode(array_values($funnel)) ?>,
                backgroundColor: [darkBlue, lightTeal, accentAqua, '#14b8a6'],
                borderRadius: 8
            }]
        },
        options: {
            indexAxis: 'y', // Hace las barras horizontales para simular embudo
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // 3. Configuración Gráfico de Anillo / Donut (Distribución de Chatbot)
    const ctxChat = document.getElementById('chatbotChart').getContext('2d');
    const chatbotData = <?= json_encode($chatbot) ?>;
    
    new Chart(ctxChat, {
        type: 'doughnut',
        data: {
            labels: chatbotData.map(item => item.topic.substring(2)), // Limpia el emoji para el label
            datasets: [{
                data: chatbotData.map(item => item.total),
                backgroundColor: [darkBlue, lightTeal, accentAqua, '#64748b'],
                borderWidth: 2
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
});
</script>