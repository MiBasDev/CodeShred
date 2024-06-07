<?php

class UsersControllerTest extends PHPUnit\Framework\TestCase {

    protected $usersController;
    protected $pdo;

    /**
     * Método que se ejecuta antes de cada método de prueba y se encarga de inicializar 
     * la instancia de pdo y UsersController y realizar las configuraciones necesarias.
     */
    protected function setUp(): void {
        $this->pdo = CodeShred\Core\DBManager::getInstance()->getConnection();
        $this->usersController = new \CodeShred\Controllers\UsersController();

        // Insertar un usuario de prueba
        $stmt = $this->pdo->prepare('INSERT INTO users(user, user_pass, user_name, user_surname, user_email, user_rol, user_gravatar) values (:user, :pass, :name, :surname, :email, :rol, :gravatar)');
        $testPass = password_hash('testpass', PASSWORD_DEFAULT);
        $stmt->execute(['user' => 'testuser', 'pass' => $testPass, 'name' => 'Test', 'surname' => 'User', 'email' => 'testuser@example.com', 'rol' => 1, 'gravatar' => 'gravatar/Url']);

        // Insertar un usuario existente
        $stmt->execute(['user' => 'existinguser', 'pass' => $testPass, 'name' => 'Existing', 'surname' => 'User', 'email' => 'existinguser@example.com', 'rol' => 1, 'gravatar' => 'gravatar/Url']);
    }

    private function callCheckForm(array $post, bool $isRegister = false): array {
        // Utilizar reflexión para acceder al método privado checkForm
        $reflection = new \ReflectionClass($this->usersController);
        $method = $reflection->getMethod('checkForm');
        $method->setAccessible(true);

        return $method->invokeArgs($this->usersController, [$post, $isRegister]);
    }

    // Pruebas para el campo 'user'
    public function testCheckFormUserSuccess() {
        $post = ['user' => 'newUserCheck'];
        $errors = $this->callCheckForm($post);
        $this->assertArrayNotHasKey('user', $errors);
    }

    public function testCheckFormUserTooShort() {
        $post = ['user' => 'te'];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('El nombre de usuario sólo permite letras y números. Longitud entre 3 y 20 caracteres', $errors['user']);
    }

    public function testCheckFormUserInvalidChars() {
        $post = ['user' => 'user!@#'];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('El nombre de usuario sólo permite letras y números. Longitud entre 3 y 20 caracteres', $errors['user']);
    }

    public function testCheckFormUserExists() {
        $post = ['user' => 'existinguser'];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('Ya existe un usuario con el nombre existinguser', $errors['user']);
    }

    // Pruebas para el campo 'email'
    public function testCheckFormEmailSuccess() {
        $post = ['email' => 'testuserNew@example.com'];
        $errors = $this->callCheckForm($post);
        $this->assertArrayNotHasKey('email', $errors);
    }

    public function testCheckFormEmailInvalid() {
        $post = ['email' => 'invalid-email'];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('El email es incorrecto', $errors['email']);
    }

    public function testCheckFormEmailExists() {
        $post = ['email' => 'existinguser@example.com'];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('Ya existe un usuario con este email', $errors['email']);
    }

    // Pruebas para las contraseñas
    public function testCheckFormPasswordsSuccess() {
        $post = [
            'currentPassword' => 'testpass',
            'password1' => 'Newpass1',
            'password2' => 'Newpass1'
        ];
        $_SESSION['user'] = ['id_user' => 515];
        $errors = $this->callCheckForm($post);
        $this->assertArrayNotHasKey('currentPassword', $errors);
        $this->assertArrayNotHasKey('password1', $errors);
        $this->assertArrayNotHasKey('password2', $errors);
    }

    public function testCheckFormWrongCurrentPassword() {
        $post = [
            'currentPassword' => 'wrongpass',
            'password1' => 'Newpass1',
            'password2' => 'Newpass1'
        ];
        $_SESSION['user'] = ['id_user' => 1];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('La contraseña actual es incorrecta', $errors['currentPassword']);
    }

    public function testCheckFormPasswordTooShort() {
        $post = [
            'currentPassword' => 'testpass',
            'password1' => 'short',
            'password2' => 'short'
        ];
        $_SESSION['user'] = ['id_user' => 1];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('La contraseña debe contener una mayúscula, una minúscula, un número y tener una longitud mínima de 8 caracteres.', $errors['password1']);
    }

    public function testCheckFormPasswordsDoNotMatch() {
        $post = [
            'currentPassword' => 'testpass',
            'password1' => 'Newpass1',
            'password2' => 'Newpass2'
        ];
        $_SESSION['user'] = ['id_user' => 1];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('Las contraseñas no coinciden', $errors['globalError']);
    }

    // Pruebas para el campo 'name'
    public function testCheckFormNameSuccess() {
        $post = ['name' => 'Miguel'];
        $errors = $this->callCheckForm($post);
        $this->assertArrayNotHasKey('name', $errors);
    }

    public function testCheckFormNameTooShort() {
        $post = ['name' => 'M'];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('El nombre sólo permite letras y espacios. Longitud entre 2 y 20 caracteres', $errors['name']);
    }

    public function testCheckFormNameInvalidChars() {
        $post = ['name' => 'Miguel@Bas'];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('El nombre sólo permite letras y espacios. Longitud entre 2 y 20 caracteres', $errors['name']);
    }

    // Pruebas para el campo 'surname'
    public function testCheckFormSurnameSuccess() {
        $post = ['surname' => 'Bastos'];
        $errors = $this->callCheckForm($post);
        $this->assertArrayNotHasKey('surname', $errors);
    }

    public function testCheckFormSurnameTooShort() {
        $post = ['surname' => 'B'];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('Los apellidos sólo permiten letras y espacios. Longitud entre 2 y 80 caracteres', $errors['surname']);
    }

    public function testCheckFormSurnameInvalidChars() {
        $post = ['surname' => 'Bastos@Gan'];
        $errors = $this->callCheckForm($post);
        $this->assertEquals('Los apellidos sólo permiten letras y espacios. Longitud entre 2 y 80 caracteres', $errors['surname']);
    }

    // Pruebas para el campo 'privacity'
    public function testCheckFormPrivacitySuccess() {
        $post = ['privacity' => 'true'];
        $errors = $this->callCheckForm($post, true);
        $this->assertArrayNotHasKey('privacity', $errors);
    }

    public function testCheckFormPrivacityNotAccepted() {
        $post = [];
        $errors = $this->callCheckForm($post, true);
        $this->assertEquals('Debes aceptar la Política de Privacidad para poder resgistrarte', $errors['privacity']);
    }
}
