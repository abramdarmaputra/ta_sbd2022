<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class Club extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_club', 'club_name','club_coach','id_player'
    ];
    protected $primaryKey = 'id_club';
    protected $keyType = 'bigInteger';
    public $incrementing = false;
}