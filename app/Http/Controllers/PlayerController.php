<?php
    
namespace App\Http\Controllers;
    
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
    
class PlayerController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:player-list|player-create|player-edit|player-delete', ['only' => ['index','show']]);
         $this->middleware('permission:player-create', ['only' => ['create','store']]);
         $this->middleware('permission:player-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:player-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $players = DB::table('players')
                    ->where('player_name','LIKE','%'.$keyword.'%')
                    ->whereNull('deleted_at')
                    ->paginate(5);
        //$players = Player::where('player_name','LIKE','%'.$keyword.'%')->paginate(5);
        return view('players.index',compact('players'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('players.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_player' => 'required',
            'player_name' => 'required',
            'position' => 'required',
            'id_club' => 'required',
            'id_country' => 'required',
        ]);
    
        DB::insert('INSERT INTO players(id_player, player_name, position, id_club, id_country) VALUES (:id_player, :player_name, :position, :id_club, :id_country)',
        [
            'id_player' => $request->id_player,
            'player_name' => $request->player_name,
            'position' => $request->position,
            'id_club' => $request->id_club,
            'id_country' => $request->id_country,
        ]
        );
    
        return redirect()->route('players.index')
                        ->with('success','Player created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        return view('players.show',compact('player'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = DB::table('players')->where('id_player', $id)->first();
        return view('players.edit',compact('player'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
         $request->validate([
            'id_player' => 'required',
            'player_name' => 'required',
            'position' => 'required',
            'id_club' => 'required',
            'id_country' => 'required'
        ]);
       //$player->update($request->all());
         DB::update('UPDATE players SET id_player = :id_player,player_name = :player_name,position = :position,id_club = :id_club, id_country = :id_country WHERE id_player = :id',
        [
            'id' => $id,
            'id_player' => $request->id_player,
            'player_name' => $request->player_name,
            'position' => $request->position,
            'id_club' => $request->id_club,
            'id_country' => $request->id_country,
           
        ]
        );

        
        return redirect()->route('players.index')
                        ->with('success','player updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('UPDATE players SET deleted_at = NOW() WHERE id_player = :id_player', ['id_player' => $id]);

        //$player->delete();
    
        return redirect()->route('players.index')
                        ->with('success','player deleted successfully');
    }
    public function deletelist()
    {
        $players = DB::table('players')
        ->whereNotNull('deleted_at')
        ->paginate(5);
        return view('/players/trash',compact('players'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function restore($id)
    {
        DB::update('UPDATE players SET deleted_at = NULL WHERE id_player = :id_player', ['id_player' => $id]);
        return redirect()->route('players.index')
                        ->with('success','Player Restored successfully');
    }
    public function deleteforce( $id)
    {
        DB::delete('DELETE FROM players WHERE id_player=:id_player', ['id_player' => $id]);
        return redirect()->route('players.index')
                        ->with('success','Player Deleted Permanently');
    }   
}