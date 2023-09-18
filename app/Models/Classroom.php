<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use SoftDeletes;




    use HasTranslations;


    public $translatable = ['classname'];


    protected $table = 'classrooms';
    public $timestamps = true;
    protected $fillable=['classname','grade_id'];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }
}
