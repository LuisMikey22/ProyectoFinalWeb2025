<?php
require_once __DIR__ . '/../Models/Chatbot.php';
require_once __DIR__ . '/../helpers/functions.php';

/**
 * Controlador para la interfaz y API del Chatbot.
 */
class ChatbotController {
    private Chatbot $chatbotModel;

    public function __construct(PDO $pdo) {
        $this->chatbotModel = new Chatbot($pdo);
    }

    /**
     * Muestra la vista principal del Chatbot.
     */
    public function showChatInterface() {
        return view('chatbot/index');
    }

    /**
     * API: Devuelve las opciones principales en formato JSON.
     */
    public function apiGetMainOptions() {
        header('Content-Type: application/json');
        echo json_encode($this->chatbotModel->getMainOptions());
        exit();
    }

    /**
     * API: Devuelve las sub-opciones en formato JSON.
     */
    public function apiGetSubOptions($id_option) {
        header('Content-Type: application/json');
        echo json_encode($this->chatbotModel->getExtraQuestions($id_option));
        exit();
    }

    /**
     * API: Recibe y guarda el registro del clic.
     */
    public function apiLogInteraction() {
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data && isset($data['id_option'])) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $id_user = $_SESSION['id_user'] ?? null;
            $id_extra = isset($data['id_extra']) ? $data['id_extra'] : null;
            
            $this->chatbotModel->logInteraction($data['id_option'], $id_extra, $id_user);
        }
        http_response_code(200);
        exit();
    }
}