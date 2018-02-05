<?php
namespace geoquizz\model;

class Serie extends \Illuminate\Database\Eloquent\Model {

       protected $table      = 'serie';
       protected $primaryKey = 'id';
       public $incrementing = false;
       public $keyType = 'string';
       public $timestamps = false;

       public function photos(){
         return $this->hasMany( 'lbs\model\Photos', 'id_serie');
       }

       public function parties(){
         return $this->hasMany( 'lbs\model\Partie', 'id_serie');
       }

}
