<?php 

namespace App;


use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel //custom base model for common functionality between other models - turns off mass assignment exception
{

	protected $guarded = [];  //list of fields for table that should be mass assignment protected

}


 ?>