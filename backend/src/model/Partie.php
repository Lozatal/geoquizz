<?php

namespace geoquizz\model;

class Partie extends \Illuminate\Database\Eloquent\Model {

  protected $table = 'partie';
  protected $primaryKey = 'id';
  public $timestamps = false;

  public function serie(){
  	return $this->belongsTo('geoquizz\model\Serie', 'id_serie');
  }
}
