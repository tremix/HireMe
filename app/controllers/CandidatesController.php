<?php

use HireMe\Repositories\CategoryRepo;
use HireMe\Repositories\CandidateRepo;

class CandidatesController extends BaseController{

    protected $categoryRepo;
    protected $candidateRepo;

    //definición de la instancia de la clase para pasar como parametro
    public function __construct(CategoryRepo $categoryRepo, CandidateRepo $candidateRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->candidateRepo = $candidateRepo;
    }
    //consulta a la entidad "category" para devolver loa datos de la categoría
    public function category($slug, $id)
    {
    //definición para la obtencion de la categoria en la URL
        $category = $this->categoryRepo->find($id);
        //dd($slug);
        //dd($category);

        return View::make('candidates/category', compact('category'));
    }

    //Vista para candidato que trabajará con
    public function show($slug, $id)
    {
        $candidate = $this->candidateRepo->find($id);
        return View::make('candidates/show', compact('candidate'));
    }
}