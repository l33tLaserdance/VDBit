<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdminController extends Controller
{
	use RegistersUsers;
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
        return view('admin');
    }
	
	public function showUsers()
	{
		$users = DB::table('users')->select('id', 'name', 'email')
			->orderBy('id', 'asc')
			->get();
			
		return view('admin/users', array(
			'users' => $users
		));
	}
	
	public function createUser()
	{		
		return view('admin/users/create');
	}
	
	public function postValidateUser(Request $request)
	{
		$request->validate([
			'ID' => 'nullable|unique:users,id|max:20',
			'Name' => 'unique:users,name|max:45',
			'email' => 'unique:users,email|email|max:191',
			'Password' => 'min:6|max:15|confirmed',
		], [
			'ID.max' => 'ID не должен превышать 20 символов',
			'ID.unique' => 'Пользователь с таким ID уже существует',
			'Name.max' => 'Размер имени не должен превышать 45 символов',
			'Name.unique' => 'Пользователь с таким именем уже существует',
			'email.unique' => 'Данная электронная почта уже используется',
			'email.max' => 'Превышена максимальная длина электронной почты',
			'email.email' => 'Введите корректную электронную почту',
			'Password.min' => 'Пароль слишком короткий',
			'Password.max' => 'Пароль слишком длинный',
			'Password.confirmed' => 'Подтверждение не совпадает с паролем'
		]);
		$input = $request->all();
		$input['Password'] = Hash::make($input['Password']);
		
		if (isset($insert['ID'])) {	
			DB::table('users')->insert([
				'id' => $input['ID'],
				'name' => $input['Name'],
				'email' => $input['email'],
				'password' => $input['Password'],
			]);
		} else {
			DB::table('users')->insert([
				'name' => $input['Name'],
				'email' => $input['email'],
				'password' => $input['Password'],
			]);
		} 
		
		return redirect()->route('users')->with('message', 'Пользователь успешно создан. Имя пользователя: '.$input['Name'].".");
	}
	
	public function updateUser(Request $request)
	{	
		$id = $_GET['id'];
		
		if ($id == 4) {
			return redirect()->route('users')->with('message', 'Редактирование данного пользователя запрещено.');
		}	
		
		$usr = DB::table('users')->select('name', 'email', 'created_at')
			->where('id', '=', $id)
			->get();
		//print_r($usr);
		$request->session()->put('id', $id);
		$request->session()->put('name', $usr[0]->name);
		
		return view('admin/updateuser' ,array(
			'usr' => $usr
		));
	}
	
	public function postUpdateUser(Request $request)
	{
		$id = $request->session()->get('id');
		$name = $request->session()->get('name');
		
		$inputmail = $request->email;
		$inputname = $request->Name;
		$inputpassword = $request->Password;
		
		print_r($inputmail);
		echo "<br>";
		print_r($inputname);
		echo "<br>";
		print_r($inputpassword);
		
		if (isset($inputname)) {
			$request->validate([
				'Name' => 'unique:users,name|max:45',
			], [
				'Name.max' => 'Размер имени не должен превышать 45 символов',
				'Name.unique' => 'Пользователь с таким именем уже существует'
			]);
			
			$mail = DB::table('users')->where('id', '=', $id)->update(['name' => $inputname]);
			if (isset($message)) {
				$message = $message.'Имя пользователя '.$name." обновлено. Новое значение: ".$inputname.".";
			} else {
				$message = 'Имя пользователя '.$name." обновлено. Новое значение: ".$inputname.".";
			}
		}
		
		if (isset($inputmail)) {
			$request->validate([
				'email' => 'unique:users,email|email|max:191',
			], [
				'email.unique' => 'Данная электронная почта уже используется',
				'email.max' => 'Превышена максимальная длина электронной почты',
				'email.email' => 'Введите корректную электронную почту'
			]);
			
			$mail = DB::table('users')->where('id', '=', $id)->update(['email' => $inputmail]);
			if (isset($message)) {
				$message = $message.'Email пользователя '.$name." обновлён. Новое значение: ".$inputmail.".";
			} else {
				$message = 'Email пользователя '.$name." обновлён. Новое значение: ".$inputmail.".";
			}
		}
		
		if (isset($inputpassword)) {
			$request->validate([
				'Password' => 'min:6|max:15|confirmed',
			], [
				'Password.min' => 'Пароль слишком короткий',
				'Password.max' => 'Пароль слишком длинный',
				'Password.confirmed' => 'Подтверждение не совпадает с паролем'
			]);
			
			$inputpassword = Hash::make($inputpassword);
			
			$mail = DB::table('users')->where('id', '=', $id)->update(['password' => $inputpassword]);
			if (isset($message)) {
				$message = $message.'Пароль пользователя '.$name." изменён.";
			} else {
				$message = 'Пароль пользователя '.$name." изменён.";
			}
		}
		
		return redirect()->route('users')->with('message', $message);
	}
	
	public function deleteUser(Request $request)
	{
		$id = $_GET['id'];
		
		$bitrixsvn = DB::table('svn')->select('bitrix')
			->where('sentby', '=', $id)
			->where('closed', '=', 0)
			->get();
		//print_r(bitrixsvn);
		
		$bitrixalarm = DB::table('alarm')->select('bitrix')
			->where('sentby', '=', $id)
			->where('closed', '=', 0)
			->get();
		//print_r(bitrixalarm);
		
		$bitrixscud = DB::table('scud')->select('bitrix')
			->where('sentby', '=', $id)
			->where('closed', '=', 0)
			->get();
		//print_r(bitrixscud);
			
		$bitrixit = DB::table('IT')->select('bitrix')
			->where('sentby', '=', $id)
			->where('closed', '=', 0)
			->get();
		//print_r(bitrixit);
		
		$message = "У данного пользователя остались открытые заявки.";
		$messagesvn = 'Нет';
		$messagescud = 'Нет';
		$messagealarm = 'Нет';
		$messageit = 'Нет';
		$messagesuccess = "Пользователь успешно удалён";
		$messagere = "Владение данными заявками перенесено на администратора (NewReg).";
		
		$username = Auth::user()->name;
		
		if (isset($bitrixalarm[0]->bitrix)) {
			$messagealarm = "Охранная сигнализация: ";
			foreach ($bitrixalarm as $alarm) {
				$messagealarm = $messagealarm.$alarm->bitrix." ";
				
				$appParams = array(
					"taskId" => $alarm->bitrix,
					"arFields" => array(
						"POST_MESSAGE" => "Создатель данной заявки был удалён из приложения VD Bitrix пользователем ".$username,
					)
				);
				
				$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.commentitem.add.json?';
				$queryData = http_build_query($appParams);
				
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
				
				DB::table('alarm')->where('bitrix', '=', $alarm->bitrix)->update(['sentby' => 4]);
			}
		}
		
		if (isset($bitrixsvn[0]->bitrix)) {
			$messagesvn = "СВН: ";
			foreach ($bitrixsvn as $svn) {
				$messagesvn = $messagesvn.$svn->bitrix." ";
				
				$appParams = array(
					"taskId" => $svn->bitrix,
					"arFields" => array(
						"POST_MESSAGE" => "Создатель данной заявки был удалён из приложения VD Bitrix пользователем ".$username,
					)
				);
				
				$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.commentitem.add.json?';
				$queryData = http_build_query($appParams);
				
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
				
				DB::table('svn')->where('bitrix', '=', $svn->bitrix)->update(['sentby' => 4]);
			}
		}
		
		if (isset($bitrixscud[0]->bitrix)) {
			$messagescud = "СКУД: ";
			foreach ($bitrixscud as $scud) {
				$messagescud = $messagescud.$scud->bitrix." ";
				
				$appParams = array(
					"taskId" => $scud->bitrix,
					"arFields" => array(
						"POST_MESSAGE" => "Создатель данной заявки был удалён из приложения VD Bitrix пользователем ".$username,
					)
				);
				
				$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.commentitem.add.json?';
				$queryData = http_build_query($appParams);
				
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
				
				DB::table('scud')->where('bitrix', '=', $scud->bitrix)->update(['sentby' => 4]);
			}
		}
		
		
		if (isset($bitrixit[0]->bitrix)) {
			$messageit = "IT-поддержка: ";
			foreach ($bitrixit as $it) {
				$messageit = $messageit.$it->bitrix." ";
				
				$appParams = array(
					"taskId" => $it->bitrix,
					"arFields" => array(
						"POST_MESSAGE" => "Создатель данной заявки был удалён из приложения VD Bitrix пользователем ".$username,
					)
				);
				
				$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.commentitem.add.json?';
				$queryData = http_build_query($appParams);
				
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
				
				DB::table('IT')->where('bitrix', '=', $it->bitrix)->update(['sentby' => 4]);
			}
		}
		
		DB::table('users')->where('id', '=', $id)->delete();
		
		$users = DB::table('users')->select('id', 'name', 'email')
			->orderBy('id', 'asc')
			->get();
		
		if ($messagesvn != 'Нет' || $messagealarm != 'Нет' || $messagescud != 'Нет' || $messageit != 'Нет') {
			return view('admin/users', array(
				'users' => $users,
				'message' => $message,
				'messagealarm' => $messagealarm,
				'messagesvn' => $messagesvn,
				'messageit' => $messageit,
				'messagescud' => $messagescud,
				'messagere' => $messagere
			));
		} else {
			return redirect()->route('users')->with('message', $messagesuccess);
		}
	}
}