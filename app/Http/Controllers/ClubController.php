<?php
    
namespace App\Http\Controllers;
    
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
    
class ClubController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:club-list|club-create|club-edit|club-delete', ['only' => ['index','show']]);
         $this->middleware('permission:club-create', ['only' => ['create','store']]);
         $this->middleware('permission:club-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:club-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $clubs = DB::table('clubs')
                    ->where('club_name','LIKE','%'.$keyword.'%')
                    ->whereNull('deleted_at')
                    ->paginate(5);
        //$clubs = club::where('club_name','LIKE','%'.$keyword.'%')->paginate(5);
        return view('clubs.index',compact('clubs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clubs.create');
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
            'id_club' => 'required',
            'club_name' => 'required',
            'club_coach' => 'required',
            'id_player' => 'required',
        ]);
    
        DB::insert('INSERT INTO clubs(id_club,club_name,club_coach,id_player) VALUES (:id_club, :club_name, :club_coach, :id_player)',
        [
            'id_club' => $request->id_club,
            'club_name' => $request->club_name,
            'club_coach' => $request->club_coach,
            'id_player' => $request->id_player,
        ]
        );
    
        return redirect()->route('clubs.index')
                        ->with('success','Club created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(club $club)
    {
        return view('clubs.show',compact('club'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $club = DB::table('clubs')->where('id_club', $id)->first();
        return view('clubs.edit',compact('club'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\club  $club
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
         $request->validate([
            'id_club' => 'required',
            'club_name' => 'required',
            'club_coach' => 'required',
            'id_player' => 'required',
        ]);
       //$club->update($request->all());
         DB::update('UPDATE clubs SET id_club = :id_club,club_name = :club_name,club_coach = :club_coach,id_player = :id_player WHERE id_club = :id',
        [
            'id' => $id,
            'id_club' => $request->id_club,
            'club_name' => $request->club_name,
            'club_coach' => $request->club_coach,
            'id_player' => $request->id_player,
        ]
        );

        return redirect()->route('clubs.index')
                        ->with('success','club updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('UPDATE clubs SET deleted_at = NOW() WHERE id_club = :id_club', ['id_club' => $id]);

        //$club->delete();
    
        return redirect()->route('clubs.index')
                        ->with('success','Club deleted successfully');
    }
    public function deletelist()
    {
        $clubs = DB::table('clubs')
        ->whereNotNull('deleted_at')
        ->paginate(5);
        return view('/clubs/trash',compact('clubs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function restore($id)
    {
        DB::update('UPDATE clubs SET deleted_at = NULL WHERE id_club = :id_club', ['id_club' => $id]);
        return redirect()->route('clubs.index')
                        ->with('success','Club Restored successfully');
    }
    public function deleteforce( $id)
    {
        DB::delete('DELETE FROM clubs WHERE id_club=:id_club', ['id_club' => $id]);
        return redirect()->route('clubs.index')
                        ->with('success','Club Deleted Permanently');
    }   
}