<?php
namespace geoquizz\model;

class Compte extends \Illuminate\Database\Eloquent\Model {

       protected $table = 'utilisateur';
       protected $primaryKey = 'id';
       public $incrementing = false;
       public $keyType = 'string';
       public $timestamps = false;

}
