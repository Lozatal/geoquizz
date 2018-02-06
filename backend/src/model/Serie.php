<?php

namespace geoquizz\model;

class Serie extends \Illuminate\Database\Eloquent\Model {

  protected $table = 'serie';
  protected $primaryKey = 'id';
  public $timestamps = false;

  public function parties(){
    return $this->hasMany( 'geoquizz\model\Partie', 'id_serie');
  }
}
