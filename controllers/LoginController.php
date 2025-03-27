<?php
require_once __DIR__ . '/../models/User.php';

class LoginController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
        $this->startSession();
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            session_regenerate_id(true);
        }
    }

    public function showLoginForm($error = null)
    {
        require __DIR__ . '/../views/login.php';
    }

    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /katalog/login');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        // Basic validation
        if (empty($username) || empty($password)) {
            $this->showLoginForm("Username and password are required");
            return;
        }

        // Throttle login attempts (basic protection against brute force)
        if ($this->isLoginThrottled($username)) {
            $this->showLoginForm("Too many login attempts. Please try again later");
            return;
        }

        if ($this->userModel->login($username, $password)) {
            // Login successful
            $_SESSION['admin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['login_time'] = time();

            // Clear any failed attempts
            $this->clearLoginAttempts($username);

            header('Location: /katalog/admin');
            exit;
        } else {
            // Record failed attempt
            $this->recordFailedAttempt($username);
            $this->showLoginForm("Invalid username or password");
        }
    }

    public function handleLogout()
    {
        // Clear session data
        $_SESSION = [];

        // Delete session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
        header('Location: /katalog/login');
        exit;
    }

    private function isLoginThrottled($username)
    {
        $key = 'login_attempts_' . md5($username);
        return ($_SESSION[$key] ?? 0) >= 5;
    }

    private function recordFailedAttempt($username)
    {
        $key = 'login_attempts_' . md5($username);
        $_SESSION[$key] = ($_SESSION[$key] ?? 0) + 1;
        $_SESSION['last_failed_attempt'] = time();
    }

    private function clearLoginAttempts($username)
    {
        $key = 'login_attempts_' . md5($username);
        unset($_SESSION[$key]);
    }
}