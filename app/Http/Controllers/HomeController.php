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
	
	public function showAppSCUD()
	{
		$id = $_GET['id'];
		
		$scud = DB::table('scud')->select('numBuild', 'numLevel', 'numDoor', 'is_mag', 'is_electrified', 'is_worked', 'email', 'name', 'info', 'bitrix', 'closed')
			->where('sentby', '=', Auth::user()->id)
			->where('bitrix', '=', $id)
			->get();
			
		$appParams2 = array(
			"taskId" => $id,
			"ORDER" => array("POST_DATE" => "desc")
		);
		
		$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.commentitem.getlist.json';
		$queryData = http_build_query($appParams2);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_POST => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $queryUrl,
			CURLOPT_POSTFIELDS => $queryData,
		));
		$result = curl_exec($curl);
		curl_close($curl);
		$final = json_decode($result);
		
		if (!empty($final->result)) {
	
			foreach($final->result as $fin)
			{
					$time = $fin->POST_DATE;
					$date = strtotime($time);
					$fixed = date('d-m-Y, H:i:s', $date);
					$fin->POST_DATE = $fixed;
			}
			
			if ($scud->isEmpty()) {
				return redirect()->route('showapplist')->with('message', 'Запрашиваемой заявки не существует.');
			} else {
				return view('auth/appscud', array(
					'scud' => $scud, 
					'final' => $final
				));
			}
		}
		
		if ($scud->isEmpty()) {
			return redirect()->route('showapplist')->with('message', 'Запрашиваемой заявки не существует.');
		} else {
			return view('auth/appscud', array(
				'scud' => $scud
			));
		}
	}
	
	public function showAppIT()
	{
		$id = $_GET['id'];
		
		$it = DB::table('IT')->select('orgname', 'trcname', 'name', 'email', 'phone', 'info', 'bitrix', 'closed')
			->where('sentby', '=', Auth::user()->id)
			->where('bitrix', '=', $id)
			->get();
		
		$appParams2 = array(
			"taskId" => $id,
			"ORDER" => array("POST_DATE" => "desc")
		);
		
		$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.commentitem.getlist.json';
		$queryData = http_build_query($appParams2);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_POST => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $queryUrl,
			CURLOPT_POSTFIELDS => $queryData,
		));
		$result = curl_exec($curl);
		curl_close($curl);
		$final = json_decode($result);
		
		if (!empty($final->result)) {
			
			foreach($final->result as $fin)
			{
					$time = $fin->POST_DATE;
					$date = strtotime($time);
					$fixed = date('d-m-Y, H:i:s', $date);
					$fin->POST_DATE = $fixed;
			}
			
			if ($it->isEmpty()) {
				return redirect()->route('showapplist')->with('message', 'Запрашиваемой заявки не существует.');
			} else {
				return view('auth/appit', array(
					'it' => $it,
					'final' => $final			
				));
			}
		}
		
		if ($it->isEmpty()) {
			return redirect()->route('showapplist')->with('message', 'Запрашиваемой заявки не существует.');
		} else {
			return view('auth/appit', array(
				'it' => $it			
			));
		}
	}
	
	public function showAppSVN()
	{
		$id = $_GET['id'];
		
		$svn = DB::table('svn')->select('numBuild', 'numRegister', 'numCam', 'is_available', 'is_electrified', 'is_worked', 'email', 'name', 'info', 'bitrix', 'closed')
			->where('sentby', '=', Auth::user()->id)
			->where('bitrix', '=', $id)
			->get();
		
		$appParams2 = array(
			"taskId" => $id,
			"ORDER" => array("POST_DATE" => "desc")
		);
		
		$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.commentitem.getlist.json';
		$queryData = http_build_query($appParams2);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_POST => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $queryUrl,
			CURLOPT_POSTFIELDS => $queryData,
		));
		$result = curl_exec($curl);
		curl_close($curl);
		$final = json_decode($result);
		
		if (!empty($final->result)) {
			
			foreach($final->result as $fin)
			{
					$time = $fin->POST_DATE;
					$date = strtotime($time);
					$fixed = date('d-m-Y, H:i:s', $date);
					$fin->POST_DATE = $fixed;
			}
			
			if ($svn->isEmpty()) {
				return redirect()->route('showapplist')->with('message', 'Запрашиваемой заявки не существует.');
			} else {
				return view('auth/appsvn', array(
					'svn' => $svn,
					'final' => $final
				));
			}
		}
		
		if ($svn->isEmpty()) {
			return redirect()->route('showapplist')->with('message', 'Запрашиваемой заявки не существует.');
		} else {
			return view('auth/appsvn', array(
				'svn' => $svn
			));
		}
	}
	
	public function showAppAlarm()
	{
		$id = $_GET['id'];
		
		$alarm = DB::table('alarm')->select('numBuild', 'numLevel', 'numBut', 'is_door_available', 'is_electrified', 'is_worked', 'email', 'name', 'info', 'bitrix', 'closed')
			->where('sentby', '=', Auth::user()->id)
			->where('bitrix', '=', $id)
			->get();
			
		$appParams2 = array(
			"taskId" => $id,
			"ORDER" => array("POST_DATE" => "desc")
		);
		
		$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.commentitem.getlist.json';
		$queryData = http_build_query($appParams2);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_POST => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $queryUrl,
			CURLOPT_POSTFIELDS => $queryData,
		));
		$result = curl_exec($curl);
		curl_close($curl);
		$final = json_decode($result);
		
		if (!empty($final->result)) {
			
			foreach($final->result as $fin)
			{
					$time = $fin->POST_DATE;
					$date = strtotime($time);
					$fixed = date('d-m-Y, H:i:s', $date);
					$fin->POST_DATE = $fixed;
			}
			
			if ($alarm->isEmpty()) {
				return redirect()->route('showapplist')->with('message', 'Запрашиваемой заявки не существует.');
			} else {
				return view('auth/appalarm', array(
					'alarm' => $alarm,
					'final' => $final
				));
			}
		}
		
		if ($alarm->isEmpty()) {
			return redirect()->route('showapplist')->with('message', 'Запрашиваемой заявки не существует.');
		} else {
			return view('auth/appalarm', array(
				'alarm' => $alarm
			));
		}
	}
}
