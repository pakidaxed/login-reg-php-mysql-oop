<?php


class User extends Database
{
    private array $data;

    /**
     * Sets the data whenever i need instead of constructor
     *
     * @param array $validated_data
     */
    public function setData(array $validated_data)
    {
        $this->data = $validated_data;
    }

    /**
     * Checking for existing user before registration
     *
     * @param string $email
     * @param array|null $error
     * @return false|string
     */
    public function userExists(string $email, ?array &$error)
    {
        $sql = "SELECT email FROM users WHERE email='$email'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $db_match = $result['email'] ?? '';
        if ($email === $db_match) {
            return $error = 'Email all ready exists, please choose another one.';
        }
        return false;
    }

    /**
     * Registering user into database
     *
     * @return bool
     */
    public function userRegister(): bool
    {
        // Hashing the password before inserting to db
        $password = password_hash($this->data['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (email, name, last_name, phone, password)
                VALUES (:email, :name, :last_name, :phone, :password)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':email', $this->data['email']);
        $stmt->bindParam(':name', $this->data['name']);
        $stmt->bindParam(':last_name', $this->data['last_name']);
        $stmt->bindParam(':phone', $this->data['phone']);
        $stmt->bindParam(':password', $password);

        return $stmt->execute();
    }

    /**
     * User login check
     *
     * @return bool
     */
    public function userLogin(): bool
    {
        $email = $this->data['email'];
        $password = $this->data['password'];
        $sql = "SELECT email, password FROM users WHERE email='$email'";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt->execute()) {

            $result = $stmt->fetch();
            if (!password_verify($password, $result['password'] ?? '')) {
                return false;

            }
        }
        $sql = "UPDATE users SET last_login_at=now() WHERE email='$email'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        setcookie('PHPSESSID', session_id(), time() + (60 * 5)); // 5 minutes of inactivity
        $_SESSION['email'] = $email;
        $user = $email;
        return true;
    }

    /**
     * Logout function
     */
    public function logout()
    {
        unset($_SESSION['email']);
        $_SESSION = [];
        session_destroy();
        header('Location: index.php?action=login');
    }

    /**
     * Getting user data for display
     *
     * @param string $email
     * @return null|array
     */
    public function getUser($email): ?array
    {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

}