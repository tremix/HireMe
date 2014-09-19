<?php
namespace HireMe\Repositories;


abstract class BaseRepo {

    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    abstract public function getModel();

    //Método que busca en el ORM datos según el id hace el SELECT
    public function find($id)
    {
        return $this->model->find($id);
    }
} 