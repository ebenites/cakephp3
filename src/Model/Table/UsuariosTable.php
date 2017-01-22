<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use \Cake\Validation\Validator;

class UsuariosTable extends Table{
    
    public function initialize(array $config) {
        $this->table('usuarios');
        $this->primaryKey('id');
        $this->entityClass('App\Model\Entity\Usuario');
        
        $this->belongsTo('Roles', [
            'className' => 'Roles',
            'foreignKey' => 'roles_id',
            'propertyName' => 'rol'
        ]);
        
    }
    
    // https://book.cakephp.org/3.0/en/core-libraries/validation.html#creating-validators
    public function validationDefault(Validator $validator) {
        $validator->notEmpty('username', 'Nombre de usuario obligatorio')
                ->minLength('username', 8, 'Longitud mínima 8 caracteres')
                ->email('email', false, 'Correo inválido')
                ->notEmpty('password', 'Clave obligaroria')
                ->notEmpty('role', 'Rol obligatorio');
        return $validator;
    }
    
}
