<?php namespace HireMe\Entities;

class Candidate extends \Eloquent {
	protected $fillable = [];
    //paginación de candidatos de 3 en 3, variable ya definida por el ORM
    protected $perPage = 3;

    public function user()
    {
        return $this->hasOne('HireMe\Entities\user', 'id', 'id');
    }

    //definición de que el candidato pertenece a una categoría
    public function category()
    {
        return $this->belongsTo('HireMe\Entities\Category');
    }

    //traduccion del tipo de trabajo del candidato en lang\en\utils.php
    public function getJobTypeTitleAttribute()
    {
        return \Lang::get('utils.job_types.' . $this->job_type);
    }
}