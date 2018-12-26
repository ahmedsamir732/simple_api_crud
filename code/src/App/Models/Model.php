<?php
namespace APICrud\App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends EloquentModel
{

	use SoftDeletes;

    protected $entityManager;
}