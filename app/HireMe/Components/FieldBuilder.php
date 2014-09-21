<?php
/**
 * Created by PhpStorm.
 * User: silence
 * Date: 5/20/14
 * Time: 8:15 PM
 */

namespace HireMe\Components;

use Illuminate\Html\FormBuilder as Form;
use Illuminate\View\Environment as View;

use Illuminate\Session\Store as Session;

class FieldBuilder {

    protected $form;
    protected $view;
    protected $session;

    //declarando la clase por defecto
    protected $defaultClass = [
        'default'  => 'form-control',
        'checkbox' => ''
    ];
    //definiendo el constructor para la inyeccion de dependencias
    public function __construct(Form $form, View $view, Session $session)
    {
        //asignando a traves del constructor
        $this->form = $form;
        $this->view = $view;
        $this->session = $session;
    }
    //clase por defecto dependiendo del campo
    public function getDefaultClass($type)
    {
        // si hay definido alguna clase para el tipo de clase seleccionado
        if (isset ($this->defaultClass[$type]))
        {
            return $this->defaultClass[$type];
        }
        //sino regresar el campo por defecto
        return $this->defaultClass['default'];
    }
    //construira los css de las clases enviando parametros por referencia
    public function buildCssClasses($type, &$attributes)
    {
        //otener clase por defecto dependiendo del tipo de campo
        $defaultClasses = $this->getDefaultClass($type);
        // si se envio una clase con nombre == Class se concatena con la clase por defecto
        if (isset ($attributes['class']))
        {
            $attributes['class'] .= ' ' . $defaultClasses;
        }
        // sino contendra la clase por defecto
        else
        {
            $attributes['class'] = $defaultClasses;
        }
    }
    //a partir del nombre del campo se creara una etiqueta
    public function buildLabel($name)
    {
        //Si el campo existe o definido
        if (\Lang::has('validation.attributes.' . $name))
        {
            //laravel lo trae con get
            $label = \Lang::get('validation.attributes.' . $name);
        }
        //si no se reemplazara por el siguiente
        else
        {
            $label = str_replace('_', ' ', $name);
        }
        //si no el campo sera ucFirst
        return ucfirst($label);
    }
    //construir los demas campos fuera del nombre de la etiqueta
    public function buildControl($type, $name, $value = null, $attributes = array(), $options = array())
    {
        switch ($type)
        {
            case 'select':
                return $this->form->select($name, $options, $value, $attributes);
            case 'password':
                return $this->form->password($name, $attributes);
            case 'checkbox':
                return $this->form->checkbox($name);
            default:
                return $this->form->input($type, $name, $value, $attributes);
        }
    }
    //metodo para traer o generar los errores
    public function buildError($name)
    {
        // por defecto no deeria haber error
        $error = null;
        //preguntando si hay errores
        if ($this->session->has('errors'))
        {
            //asignadolo a una variale el error
            $errors = $this->session->get('errors');
            //si en la coleccion de errores es el mismo nombre del campo
            if ($errors->has($name))
            {
                $error = $errors->first($name);
            }
        }
        //retornar el error o null o el nombre del campo
        return $error;
    }
    // obtener la plantilla dependiendo del tipo de campo
    public function buildTemplate($type)
    {
        // si la plantilla existe?
        if (\File::exists('app/views/fields/' . $type . '.blade.php'))
        {
            return 'fields/' . $type;
        }
        //usando la plantilla por defecto
        return 'fields/default';
    }
    //generar campos con la funcion input y sus atributos
    public function input($type, $name, $value = null, $attributes = array(), $options = array())
    {
        $this->buildCssClasses($type, $attributes);
        $label = $this->buildLabel($name);
        //recibe todas las variables
        $control = $this->buildControl($type, $name, $value, $attributes, $options);
        $error = $this->buildError($name);
        $template = $this->buildTemplate($type);
        //pasando el resto de parametros al template
        return $this->view->make($template, compact ('name', 'label', 'control', 'error'));
    }
    //definiendo el passwords aceptando como 1er param. el atributo y el 2do el tipo de campo =nombre
    public function password($name, $attributes = array())
    {
        //reordenamiendo de los parámetros
        return $this->input('password', $name, null, $attributes);
    }

    // funcion de php "call" se llama cuando se intenta acceder a un método que no existe
    public function __call($method, $params)
    {
        //funcion php que agrega un valor a la primera posicion de un array
        array_unshift($params, $method);
        //imprime el método
        //dd($method);

        //llamar a un controlador usando el metrodo call_user_func_array
        //1ra pos. es el (objeto, nombre del objeto=input) y el parámetro
        return call_user_func_array([$this, 'input'], $params);
    }
} 