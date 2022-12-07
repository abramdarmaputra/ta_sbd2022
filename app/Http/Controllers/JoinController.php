<?php
    
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JoinController extends Controller
{
    public function index()
    {
        $joins = DB::table('players')
            ->join('clubs', 'players.id_club', '=', 'clubs.id_club')
            ->join('countries', 'players.id_country', '=', 'countries.id_country')
            ->select('players.player_name as player_name', 'clubs.club_name as club_name','countries.country_name as country_name')
            ->paginate(6);
            return view('totals.index',compact('joins'))
                ->with('i', (request()->input('page', 1) - 1) * 6);
    }
}
