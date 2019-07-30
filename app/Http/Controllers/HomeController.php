<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
	
	public function showAppList(Request $request)
	{
		$scud = DB::table('scud')->select('bitrix', 'name', 'info')
			->where('sentby', '=', Auth::user()->id)
			->where('closed', '=', 0)
			->whereNotNull('bitrix')
			->orderBy('bitrix', 'asc')
			->get();
		/*print_r($scud);
		echo "<br>";*/
		$svn = DB::table('svn')->select('bitrix', 'name', 'info')
			->where('sentby', '=', Auth::user()->id)
			->where('closed', '=', 0)
			->whereNotNull('bitrix')
			->orderBy('bitrix', 'asc')
			->get();
		/*echo "<br>";
		print_r($svn);
		echo "<br>";*/
		$alarm = DB::table('alarm')->select('bitrix', 'name', 'info')
			->where('sentby', '=', Auth::user()->id)
			->where('closed', '=', 0)
			->whereNotNull('bitrix')
			->orderBy('bitrix', 'asc')
			->get();
		/*echo "<br>";
		print_r($alarm);
		echo "<br>";*/
		$it = DB::table('IT')->select('bitrix', 'name', 'info')
			->where('sentby', '=', Auth::user()->id)
			->where('closed', '=', 0)
			->whereNotNull('bitrix')
			->orderBy('bitrix', 'asc')
			->get();
		/*echo "<br>";
		print_r($it);
		echo $it[0]->bitrix;
		echo "<br>";
		echo "<table>";
		foreach($it as $obj)
		{
			echo "<tr>";
			foreach($obj as $tbl)
			{
				echo "<td>".$tbl."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";*/
		return view('auth/applist', array(
			'it' => $it, 
			'scud' => $scud, 
			'svn' => $svn, 
			'alarm' => $alarm
		));
	}
}
