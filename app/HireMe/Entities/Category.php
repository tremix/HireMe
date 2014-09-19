<?php namespace HireMe\Entities;

class Category extends \Eloquent {
	protected $fillable = [];

    public function candidates()
    {
        return $this->hasMany('HireMe\Entities\Candidate');
    }
    //Deinición sobre la paginación de candidatos
    public function getPaginateCandidatesAttribute()
    {
        //traer candidatos donde categoría es = id de la categoría
        return Candidate::where('category_id', $this->id)->paginate();
    }
}