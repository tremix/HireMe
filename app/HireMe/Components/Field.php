<?php namespace HireMe\Components;

use Illuminate\Support\Facades\Facade;


/**
 * @see \Illuminate\Html\FormBuilder
 * obtenido del vendor de laravel facedes\Form
 *
 * Nos permite instanciar a field builder
 */
class Field extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'field'; }

}
