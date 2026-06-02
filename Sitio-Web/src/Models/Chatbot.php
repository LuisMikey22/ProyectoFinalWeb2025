<?php

/**
 * Entidad que gestiona las consultas del Árbol de Decisiones del Chatbot.
 */
class Chatbot {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Obtiene las opciones principales del menú.
     * @return array
     */
    public function getMainOptions() {
        try {
            $sql = "SELECT * FROM chatbot_options WHERE is_active = 1 ORDER BY display_order ASC";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error en Chatbot::getMainOptions(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtiene las sub-opciones y la respuesta ligada a una opción principal.
     * @param int $id_option
     * @return array
     */
    public function getExtraQuestions($id_option) {
        try {
            $sql = "SELECT * FROM chatbot_extra_questions WHERE id_chatbot_option = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_option]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error en Chatbot::getExtraQuestions(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Registra la interacción del usuario para las métricas del Dashboard.
     * @param int $id_option
     * @param int|null $id_extra
     * @param int|null $id_user
     * @return bool
     */
    public function logInteraction($id_option, $id_extra = null, $id_user = null) {
        try {
            $sql = "INSERT INTO chatbot_interactions (id_chatbot_option, id_chatbot_extra_question, id_user) VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id_option, $id_extra, $id_user]);
        } catch(PDOException $e) {
            error_log("Error en Chatbot::logInteraction(): " . $e->getMessage());
            return false;
        }
    }
}