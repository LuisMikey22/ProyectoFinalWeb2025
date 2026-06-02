<?php

class Dashboard {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Función auxiliar para generar el filtro WHERE de fechas en SQL.
     */
    private function getDateCondition($column, $period) {
        switch ($period) {
            case 'day':   return "DATE($column) = CURRENT_DATE()";
            case 'week':  return "YEARWEEK($column, 1) = YEARWEEK(CURRENT_DATE(), 1)";
            case 'year':  return "YEAR($column) = YEAR(CURRENT_DATE())";
            case 'month': 
            default:      return "MONTH($column) = MONTH(CURRENT_DATE()) AND YEAR($column) = YEAR(CURRENT_DATE())";
        }
    }

    public function getSummaryKPIs($period = 'month') {
        try {
            $dateCond = $this->getDateCondition('created_at', $period);
            $botCond = $this->getDateCondition('created_at', $period);

            $stmtSales = $this->pdo->query("SELECT SUM(total_amount) as total FROM orders WHERE status = 'paid' AND $dateCond");
            $stmtOrders = $this->pdo->query("SELECT COUNT(*) as total FROM orders WHERE status = 'pending' AND $dateCond");
            $stmtBot = $this->pdo->query("SELECT COUNT(*) as total FROM chatbot_interactions WHERE $botCond");

            return [
                'monthly_sales' => (float)($stmtSales->fetch(PDO::FETCH_ASSOC)['total'] ?? 0),
                'pending_orders' => (int)($stmtOrders->fetch(PDO::FETCH_ASSOC)['total'] ?? 0),
                'bot_interactions_today' => (int)($stmtBot->fetch(PDO::FETCH_ASSOC)['total'] ?? 0)
            ];
        } catch(PDOException $e) { return ['monthly_sales' => 0, 'pending_orders' => 0, 'bot_interactions_today' => 0]; }
    }

    public function getStockAlerts() {
        $stmt = $this->pdo->query("SELECT id_product, name, stock FROM products WHERE stock <= 5 ORDER BY stock ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConversionFunnelData($period = 'month') {
        try {
            $vCond = $this->getDateCondition('created_at', $period);
            $cCond = $this->getDateCondition('added_at', $period); 
            $oCond = $this->getDateCondition('created_at', $period);

            $views = $this->pdo->query("SELECT COUNT(*) as total FROM product_views WHERE $vCond")->fetch()['total'] ?? 0;
            $carts = $this->pdo->query("SELECT COUNT(*) as total FROM cart_items")->fetch()['total'] ?? 0; 
            $orders = $this->pdo->query("SELECT COUNT(*) as total FROM orders WHERE $oCond")->fetch()['total'] ?? 0;
            $paid = $this->pdo->query("SELECT COUNT(*) as total FROM orders WHERE status = 'paid' AND $oCond")->fetch()['total'] ?? 0;

            return ['Visitas' => (int)$views, 'Carrito' => (int)$carts, 'Checkout' => (int)$orders, 'Pagado' => (int)$paid];
        } catch(PDOException $e) { return ['Visitas' => 0, 'Carrito' => 0, 'Checkout' => 0, 'Pagado' => 0]; }
    }

   public function getChatbotDistributionData($period = 'month') {
        $botCond = $this->getDateCondition('i.created_at', $period);
        $sql = "SELECT o.button_text as topic, COUNT(*) as total 
                FROM chatbot_interactions i 
                JOIN chatbot_options o ON i.id_chatbot_option = o.id_chatbot_option 
                WHERE $botCond GROUP BY o.id_chatbot_option";
                
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // El gráfico de tendencias lo mantenemos siempre como "Últimos 7 días" para que la línea tenga sentido visual
    public function getWeeklyTrendsData() {
        $days = []; $views = []; $sales = [];
        for ($i = 6; $i >= 0; $i--) {
            $dateStr = date('Y-m-d', strtotime("-$i days"));
            $days[] = date('d M', strtotime($dateStr));
            $v = $this->pdo->prepare("SELECT COUNT(*) as total FROM product_views WHERE DATE(viewed_at) = ?");
            $v = $this->pdo->prepare("SELECT COUNT(*) as total FROM product_views WHERE DATE(created_at) = ?");
            $s = $this->pdo->prepare("SELECT COUNT(*) as total FROM orders WHERE status = 'paid' AND DATE(created_at) = ?");
            $s->execute([$dateStr]); $sales[] = (int)$s->fetch()['total'];
        }
        return ['labels' => $days, 'views' => $views, 'sales' => $sales];
    }
}