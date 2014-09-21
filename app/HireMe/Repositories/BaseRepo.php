<?php
namespace HireMe\Repositories;

/*En esta seccion se encargará  a realizar
 * las consultas junto con el ORM
 *
*/
abstract class BaseRepo {

    protected $model;

    public function __construct()
    {
        //asignamos la variable model obteniendolo por método get
        $this->model = $this->getModel();
    }
    //pasando el método para obtener el dato
    abstract public function getModel();

    //Método que busca en el ORM datos según el id hace el SELECT
    public function find($id)
    {
        //creando o definiendo como una variable model
        return $this->model->find($id);
    }
} 