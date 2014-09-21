<?php namespace HireMe\Managers;

class RegisterManager extends BaseManager {

    //validación extendida de BaseManager
    public function getRules()
    {
        /*  unique: para validación de email para no aceptar repetidos
         *   Confirmed validacion del pass
         *  confirmef: laravel buscara un sufijo con el campo confirmation
        */
        //reglas de registro
        $rules = [
            'full_name' => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed',
            'password_confirmation' => 'required'
        ];

        return $rules;
    }


} 