<?php
require_once __DIR__ . '/../Models/Dashboard.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/auth.php';

/**
 * Controlador para la visualización del Dashboard de Inteligencia de Negocios.
 */
class DashboardController {
    private Dashboard $dashboardModel;

    public function __construct(PDO $pdo) {
        $this->dashboardModel = new Dashboard($pdo);
    }

    /**
     * Renderiza la suite analítica del sistema asegurando privilegios de administrador.
     */
    public function showAnalyticsSuite() {
        requireAdmin();

        // Atrapamos el periodo de la URL (por defecto 'month')
        $period = $_GET['period'] ?? 'month';

        // Le pasamos el periodo a las consultas
        $kpis = $this->dashboardModel->getSummaryKPIs($period);
        $alerts = $this->dashboardModel->getStockAlerts();
        $funnel = $this->dashboardModel->getConversionFunnelData($period);
        $chatbot = $this->dashboardModel->getChatbotDistributionData($period);
        $trends = $this->dashboardModel->getWeeklyTrendsData(); // Se queda fijo en 7 días

        return view('admin/dashboard.index', [
            'kpis' => $kpis,
            'alerts' => $alerts,
            'funnel' => $funnel,
            'chatbot' => $chatbot,
            'trends' => $trends,
            'currentPeriod' => $period // Lo pasamos a la vista para pintar el botón activo
        ]);
    }
}