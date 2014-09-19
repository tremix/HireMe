<?php
/**
 * Created by PhpStorm.
 * User: Tremix
 * Date: 15/09/14
 * Time: 11:04
 */

namespace HireMe\Repositories;

use HireMe\Entities\Candidate;
//Se integra para obtener Candidatos ordenados por categoría
use HireMe\Entities\Category;

class CandidateRepo extends BaseRepo{

    public function getModel()
    {
        return new Candidate;
    }

    //Método para obtener los últimos candidatos
    public function findLatest($take = 10)
    {
    /*  Traer el listado de Categorias con Candidatos incluyendo
        que c/candidato venga con su respectivo Usuario.
        El cual realizá la carga ambiciosa de Eloquent
        with(candidates, candidates.user).
        Se utiliza el método Get para traer los registros
    */
        return Category::with([
            'candidates' => function ($q) use ($take) {
                    $q->take($take);
                    $q->orderBy('created_at', 'DESC');
                },
            'candidates.user'
        ])->get();

        /*
         * Separacion de la consulta de los candidatos para no traer todos los registros
         * solo la cantidad solicitada(=10) según la funcion anónima y de forma descendente
         * */
    }
} 