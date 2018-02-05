<?php

namespace geoquizz\model;

class Photos extends \Illuminate\Database\Eloquent\Model {

  protected $table = 'photo';
  protected $primaryKey = 'id';
  public $timestamps = false;
}
