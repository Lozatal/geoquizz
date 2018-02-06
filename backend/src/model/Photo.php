<?php

namespace geoquizz\model;

class Photo extends \Illuminate\Database\Eloquent\Model {

  protected $table = 'photo';
  protected $primaryKey = 'id';
  public $timestamps = false;

  public function serie(){
  	return $this->belongsTo('geoquizz\model\Serie', 'id_serie');
  }
}
