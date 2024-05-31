<?php

class PostsModelTest extends \PHPUnit\Framework\TestCase {

    protected $pdo;
    protected $postsModel;

    /**
     * Método que se ejecuta antes de cada método de prueba y se encarga de inicializar 
     * la instancia de pdo y PostsModel y realizar las configuraciones necesarias.
     */
    protected function setUp(): void {
        $this->pdo = CodeShred\Core\DBManager::getInstance()->getConnection();
        $this->postsModel = new CodeShred\Models\UsersModel();

        // Codificamos a JSON los datos
        $code = array('html' => 'testHTML', 'css' => 'testCSS', 'js' => 'testJS');
        $jsonCode = json_encode($code);

        // Insertar un post de prueba
        $stmt = $this->pdo->prepare('INSERT INTO posts(post_code,post_img,post_user_id,post_title) VALUES (:post_code, :post_img, :post_user_id, :post_title)');
        $stmt->execute(['post_code' => $jsonCode, 'post_img' => 'test.png', 'post_user_id' => 99999, 'post_title' => 'testTitle']);
    }
}
