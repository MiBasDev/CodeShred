<?php

class UsersModelTest extends \PHPUnit\Framework\TestCase {

    protected $pdo;
    protected $usersModel;

    /**
     * Método que se ejecuta antes de cada método de prueba y se encarga de inicializar 
     * la instancia de pdo y UsersModel y realizar las configuraciones necesarias.
     */
    protected function setUp(): void {
        $this->pdo = CodeShred\Core\DBManager::getInstance()->getConnection();
        $this->usersModel = new CodeShred\Models\UsersModel();

        // Insertar un usuario de prueba        
        $stmt = $this->pdo->prepare('INSERT INTO users(user, user_pass, user_name, user_surname, user_email, user_rol, user_gravatar) values (:user, :pass, :name, :surname, :email, :rol, :gravatar)');
        $testPass = password_hash('testpass', PASSWORD_DEFAULT);

        $stmt->execute(['user' => 'testuser', 'pass' => $testPass, 'name' => 'Test', 'surname' => 'User', 'email' => 'testuser@example.com', 'rol' => 1, 'gravatar' => 'gravatar/Url']);
    }

    /**
     * Método de prueba para validar el éxito del inicio de sesión cuando se 
     * proporcionan credenciales válidas.
     */
    public function testLoginSuccess() {
        $result = $this->usersModel->login('testuser', 'testpass');
        $this->assertIsArray($result);
        $this->assertEquals('testuser', $result['user']);
        $this->assertEquals('Test', $result['user_name']);
    }

    /**
     * Método de prueba para validar el fallo del inicio de sesión cuando se 
     * proporcionan credenciales inválidas.
     */
    public function testLoginFailure() {
        $result = $this->usersModel->login('testuser', 'wrongpass');
        $this->assertNull($result);
    }

    /**
     * Método de prueba para validar la verificación de existencia de usuario en 
     * el registro cuando se proporciona un usuario existente.
     */
    public function testRegisterCheckUserExists() {
        $result = $this->usersModel->registerCheck('testuser');
        $this->assertIsArray($result);
        $this->assertEquals('testuser', $result['user']);
    }

    /**
     * Método de prueba para validar la verificación de inexistencia de usuario
     * en el registro cuando se proporciona un usuario no existente.
     */
    public function testRegisterCheckUserDoesNotExist() {
        $result = $this->usersModel->registerCheck('nonexistentuser');
        $this->assertNull($result);
    }

    /**
     * Método de prueba para validar la verificación de existencia de email en el 
     * registro cuando se proporciona un email existente.
     */
    public function testEmailCheckEmailExists() {
        $result = $this->usersModel->emailCheck('testuser@example.com');
        $this->assertIsArray($result);
        $this->assertEquals('testuser@example.com', $result['user_email']);
    }

    /**
     * Método de prueba para validar la verificación de inexistencia de email en 
     * el registro cuando se proporciona un email no existente.
     */
    public function testEmailCheckEmailDoesNotExist() {
        $result = $this->usersModel->emailCheck('nonexistentemail@example.com');
        $this->assertNull($result);
    }

    /**
     * Método de prueba para validar el éxito del registro de usuario cuando se 
     * proporcionan datos válidos.
     */
    public function testRegisterSuccess() {
        $data = [
            'user' => 'newuser',
            'pass' => 'newpass',
            'name' => 'New',
            'surname' => 'User',
            'email' => 'newuser@example.com',
            'rol' => 1,
            'gravatar' => 'newgravatar.png'
        ];

        $result = $this->usersModel->register($data);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM users WHERE user = 'newuser'");
        $newUser = $stmt->fetch();

        $this->assertEquals('newuser', $newUser['user']);
        $this->assertEquals('New', $newUser['user_name']);
        $this->assertEquals('User', $newUser['user_surname']);
        $this->assertEquals('newuser@example.com', $newUser['user_email']);
    }
}
