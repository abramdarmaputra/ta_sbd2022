<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class Player extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_player', 'player_name','position','id_club','id_country'
    ];
    protected $primaryKey = 'id_player';
    protected $keyType = 'bigInteger';
    public $incrementing = false;
}