<?php

use HireMe\Entities\User;
use HireMe\Managers\RegisterManager;
use HireMe\Repositories\CandidateRepo;

class UsersController extends BaseController {

    protected $candidateRepo;

    //inluyendo los repos en el constructor
    public function __construct(CandidateRepo $candidateRepo)
    {
        //acceder a la propiedad
        $this->candidateRepo = $candidateRepo;
    }
    //Metodo que llama a la vista 
    public function signUp()
    {
        //$fieldBuilder = new \HireMe\Components\FieldBuilder();
        //return View::make('users/sign-up', compact('fieldBuilder'));

        return View::make('users/sign-up');
    }
    //Método para registro de candidatos
    public function register()
    {
        //obtener del formulario los datos que deseamos grabar
        //$data = Input::only(['full_name','email','password','password_confirmation']);

        //crear un nuevo candidato en candidateRepo
        $user = $this->candidateRepo->newCandidate();
        //acceso a datos llamando al manager y enviando al usuario y toda la data
        $manager = new RegisterManager($user, Input::all());

        //Manager guarda al usuario solo si es valido
        if ($manager->save())
        {
            return Redirect::route('home');
        }
        //devolucion al formulario anterior si validacion falla e interactua con el manager
        //para obtener los errores
        return Redirect::back()->withInput()->withErrors($manager->getErrors());
        //muestra el envio de datos por post, en un array o acceso a datos
        //dd(Input::all());
    }

} 