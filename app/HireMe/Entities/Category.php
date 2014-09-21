<?php namespace HireMe\Entities;

class Category extends \Eloquent {
	protected $fillable = [];

    public function candidates()
    {
        /*definición de la relación de categorias con candidates
         *
         * Pasando el namespace como parámetro
         */
        return $this->hasMany('HireMe\Entities\Candidate');
    }
    //Definición sobre la paginación de candidatos
    public function getPaginateCandidatesAttribute()
    {
        //traer candidatos donde categoría es = id de la categoría
        return Candidate::where('category_id', $this->id)->paginate();
    }
}