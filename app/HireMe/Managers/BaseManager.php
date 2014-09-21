<?php
/**
 * Created by PhpStorm.
 * User: silence
 * Date: 5/20/14
 * Time: 7:46 PM
 */

namespace HireMe\Managers;


//Validacion y Registro de Usuarios

abstract class BaseManager {

    protected $entity;
    protected $data;
    protected $errors;

    //creando un modelo o registro = usuario
    public function __construct($entity, $data)
    {
        $this->entity = $entity;
        //si campo valido entonces debe estar definifo en las reglas
        $this->data   = array_only($data, array_keys($this->getRules()));
    }
    //forzara a que cada manager implemente sus reglas
    abstract public function getRules();

    public function isValid()
    {
        //reglas de validación que se obtendran con el metodo getRules()
        $rules = $this->getRules();
        //data como propiedad de objeto
        $validation = \Validator::make($this->data, $rules);

        $isValid = $validation->passes();
        //errores de validacion
        $this->errors = $validation->messages();
        //retornar el booleano
        return $isValid;
    }
    //ademas de validar guardar los datos
    public function save()
    {
        //Si validacion no fue exitosa = False
        if ( ! $this->isValid())
        {
            return false;
        }
        //Si validacion fue exitosa q haga fill y guarde
        $this->entity->fill($this->data);
        $this->entity->save();

        return true;
    }
    //devolver propiedad con errores
    public function getErrors()
    {
        return $this->errors;
    }

} 