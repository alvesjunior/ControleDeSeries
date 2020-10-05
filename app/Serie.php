<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'series';
    public $timestamps = false;
    protected  $fillable = ['nome', 'capa'];



    public function temporadas()
    {
        return $this->hasMany(Temporada::class);

    }

}
