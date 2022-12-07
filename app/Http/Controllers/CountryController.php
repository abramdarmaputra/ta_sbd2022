<?php
    
namespace App\Http\Controllers;
    
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
    
class CountryController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only' => ['index','show']]);
         $this->middleware('permission:country-create', ['only' => ['create','store']]);
         $this->middleware('permission:country-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $countries = DB::table('countries')
                    ->where('country_name','LIKE','%'.$keyword.'%')
                    ->whereNull('deleted_at')
                    ->paginate(5);
        //$countries = country::where('country_name','LIKE','%'.$keyword.'%')->paginate(5);
        return view('countries.index',compact('countries'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
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
            'id_country' => 'required',
            'country_name' => 'required',
            'country_coach' => 'required',
            'id_player' => 'required',
        ]);
    
        DB::insert('INSERT INTO countries(id_country,country_name,country_coach,id_player) VALUES (:id_country, :country_name,:country_coach, :id_player)',
        [
            'id_country' => $request->id_country,
            'country_name' => $request->country_name,
            'country_coach' => $request->country_coach,
            'id_player' => $request->id_player,
        ]
        );
    
        return redirect()->route('countries.index')
                        ->with('success','Country created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return view('countries.show',compact('country'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = DB::table('countries')->where('id_country', $id)->first();
        return view('countries.edit',compact('country'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
         $request->validate([
            'id_country' => 'required',
            'country_name' => 'required',
            'country_coach'=>'required',
            'id_player' => 'required',
        ]);
       //$country->update($request->all());
         DB::update('UPDATE countries SET id_country = :id_country,country_name = :country_name,country_coach = :country_coach,country_code = :country_code,id_player = :id_player WHERE id_country = :id',
        [
            'id' => $id,
            'id_country' => $request->id_country,
            'country_name' => $request->country_name,
            'country_coach' => $request->country_coach,
            'id_player' => $request->id_player,
        ]
        );

        return redirect()->route('countries.index')
                        ->with('success','Country updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('UPDATE countries SET deleted_at = NOW() WHERE id_country = :id_country', ['id_country' => $id]);

        //$country->delete();
    
        return redirect()->route('countries.index')
                        ->with('success','Country deleted successfully');
    }
    public function deletelist()
    {
        $countries = DB::table('countries')
        ->whereNotNull('deleted_at')
        ->paginate(5);
        return view('/countries/trash',compact('countries'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function restore($id)
    {
        DB::update('UPDATE countries SET deleted_at = NULL WHERE id_country = :id_country', ['id_country' => $id]);
        return redirect()->route('countries.index')
                        ->with('success','Country Restored successfully');
    }
    public function deleteforce( $id)
    {
        DB::delete('DELETE FROM countries WHERE id_country=:id_country', ['id_country' => $id]);
        return redirect()->route('countries.index')
                        ->with('success','country Deleted Permanently');
    }   
}