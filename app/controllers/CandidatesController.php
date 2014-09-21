<?php

use HireMe\Repositories\CategoryRepo;
use HireMe\Repositories\CandidateRepo;

class CandidatesController extends BaseController{

    protected $categoryRepo;
    protected $candidateRepo;

    //definición de la instancia de la clase para pasar como parámetro
    public function __construct(CategoryRepo $categoryRepo, CandidateRepo $candidateRepo)
    {
        $this->categoryRepo = $categoryRepo;
        //asigna a la propiedad
        $this->candidateRepo = $candidateRepo;
    }
    //consulta a la entidad "category" para devolver loa datos de la categoría
    public function category($slug, $id)
    {
    //definición para la obtencion de la categoria en la URL
        $category = $this->categoryRepo->find($id);

        //imprime el fragmento de la URL correspondiente a la categ.--> dd($slug);
        //dd($category);

        //Envia a la vista creada
        return View::make('candidates/category', compact('category'));
    }

    //Vista para candidato que trabajará con show.blade
    public function show($slug, $id)
    {
        //pasando el repositorio candidateRepo con la fx find
        $candidate = $this->candidateRepo->find($id);
        return View::make('candidates/show', compact('candidate'));
    }
}