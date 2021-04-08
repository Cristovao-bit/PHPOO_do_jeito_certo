<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use PDOException;

/**
 * Class User
 * @package Source\Models
 */
class User extends DataLayer{
    
    /**
     * User constructor
     */
    public function __construct() {
        parent::__construct("users", ["first_name", "last_name", "email", "passwd"]);
    }
    
    /**
     * Método responsável por salvar o usuário no banco de dados
     * @return bool
     * @throws PDOException
     */
    public function save(): bool {
        try {
            if($this->id):
                $user = $this->find("email = :e AND id != :i", "e={$this->email}&i={$this->id}")->count();
            else:
                $user = $this->find("email = :e", "e={$this->email}")->count();
            endif;
            
            if($user):
                throw new PDOException("O e-mail que você tentou cadastrar já existe!");
            endif;
            
            return parent::save();
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return false;
        }        
    }
}
