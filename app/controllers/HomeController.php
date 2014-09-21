<?php

use HireMe\Repositories\CandidateRepo;


class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    protected $candidateRepo;

    //solicitar repo para devolver los datos
    public function __construct(CandidateRepo $candidateRepo)
    {
        //asignamos a la variable
        $this->candidateRepo = $candidateRepo;
    }
    //
    public function index()
    {
        //obtener los ultimos candidatos registrados en el sistema.
        $latest_candidates = $this->candidateRepo->findLatest();

        //Solicita a latest_candidates
        return View::make('home', compact('latest_candidates'));
    }

}
