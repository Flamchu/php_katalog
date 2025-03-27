<?php
class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function login($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            $inputHash = hash('sha256', $password);
            return hash_equals($user['password_hash'], $inputHash);
        }

        return false;
    }

    public static function hashPassword($password)
    {
        return hash('sha256', $password);
    }
}