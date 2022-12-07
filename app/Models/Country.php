<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class Country extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_country', 'country_name','country_code','id_player'
    ];
    protected $primaryKey = 'id_country';
    protected $keyType = 'bigInteger';
    public $incrementing = false;
}