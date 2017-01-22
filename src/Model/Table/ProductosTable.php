<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProductosTable extends Table{
    
    public function initialize(array $config) {
        $this->table('productos');
        $this->primaryKey('id');
        $this->entityClass('App\Model\Entity\Producto');
        
        // Producto pertenece a una categoria
        $this->belongsTo('Categorias', [
            'className' => 'Categorias',
            'foreignKey' => 'categorias_id',
            'propertyName' => 'categoria'
        ]);
    }
    
    public function validationDefault(Validator $validator){
        return $validator
            ->notEmpty('nombre', 'Nombre de producto obligatorio')
            ->add('nombre', [
                'longitud' => [
                    'rule' => ['minLength', 3],
                    'message' => 'El nombre del producto no puede ser menor a 3 caracteres',
                ]
            ])
            ->add('precio', [
                'rango' => [
                    'rule' => ['range', 0, 100],
                    'message' => 'Precio debe ser mayor a cero y menor a 100',
                ]
            ])
            ->add('imagen', [
                'tipo' => [
                    'rule' => ['extension', ['gif', 'jpeg', 'png', 'jpg']],
                    'message' => 'Formato no válido',
                ],
                'tamanio' => array(
                    'rule' => array('fileSize', '<=', '1MB'),
                    'message' => 'La imagen debe ser menor a 1MB'
                )
            ])
            ;
    }

}
