<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\MessageBag;

class MainController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/main';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function postLogin()
    {
		if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
			return redirect()->route('main');
		}
		return redirect()->back();
	}
	
	public function postValidateSCUD(Request $request)
	{
		$request->validate([
			'Build' => 'bail|max:45',
			'Level' => 'bail|max:45',
			'DoorPos' => 'bail|max:100',
			'Name' => 'bail|alpha|max:45',
		], [
			'Build.max' => 'Номер строения не должен превышать 45 символов',
			'Level.max' => 'Этаж не должен превышать 45 символов',
			'DoorPos.max' => 'Расположение и имя двери не должно превышать 100 символов',
			'Name.alpha' => 'Имя не должно содержать числовые значения',
			'Name.max' => 'Размер имени не должен превышать 45 символов'
		]); // Если валидация не пройдёт, то дальнейшее исполнение функции остановится.
		$input = $request->all();
		
		$appParams2 = array(
			//"auth" => "l8t3iuk4qyn4b555",
			"arNewTaskData" => array(
				"TITLE" => "Заявка на обслуживание СКУД от ".$input['Name']." <".$input['email']."> ",
				"DESCRIPTION" => "Номер строения: <br>".$input['Build']."<br>Этаж: <br>".$input['Level']."<br>Расположение либо имя двери: <br>".$input['DoorPos']."<br>Наличие магнитного замка на двери: <br>".$input['MagLock'].
			"<br>Электричество в строении:<br>".$input['Elec']."<br>Строительно-монтажные работы в строении:<br>".$input['Mont']."<br>Дополнительная информация:<br>".$input['Issue'],
				"RESPONSIBLE_ID" => 65,
				"CREATED_BY" => 44
				)
		);
		
		$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.item.add.json';
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
		$number = $final->result;
		
		$is_mag = 0;
		$is_electrified = 0;
		$is_worked =0;
		if (($input['MagLock']) == 'Да') {
			$is_mag = 1;
		}
		if (($input['Elec']) == 'Включено') {
			$is_electrified = 1;
		}
		if (($input['Mont']) == 'Проводятся') {
			$is_worked = 1;
		}
		DB::table('scud')->insert([
			'numBuild' => $input['Build'],
			'numLevel' => $input['Level'],
			'numDoor' => $input['DoorPos'],
			'is_mag' => $is_mag,
			'is_electrified' => $is_electrified,
			'is_worked' => $is_worked,
			'email' => $input['email'],
			'name' => $input['Name'],
			'info' => $input['Issue'],
			'sentby' => Auth::user()->id,
			'bitrix' => $number
		]);
		return redirect()->route('main')->with('message', 'Ваша заявка на обслуживание СКУД зарегистрирована в системе. Номер заявки: '.$number.".");

		
	}
	
	public function postValidateSVN(Request $request)
	{
		$request->validate([
			'Build' => 'bail|max:45',
			'Registrator' => 'bail|max:45',
			'Camera' => 'bail|max:45',
			'Name' => 'bail|alpha|max:45',
		], [
			'Build.max' => 'Номер строения не должен превышать 45 символов',
			'Registrator.max' => 'Название регистратора не должно превышать 45 символов',
			'Camera.max' => 'Название камеры не должно превышать 45 символов',
			'Name.alpha' => 'Имя не должно содержать числовые значения',
			'Name.max' => 'Размер имени не должен превышать 45 символов'
		]); // Если валидация не пройдёт, то дальнейшее исполнение функции остановится.
		$input = $request->all();
		
		$appParams2 = array(
			//"auth" => "l8t3iuk4qyn4b555",
			"arNewTaskData" => array(
				"TITLE" => "Заявка на обслуживание СВН от ".$input['Name']." <".$input['email']."> ",
				"DESCRIPTION" => "Номер строения: <br>".$input['Build']."<br>Название регистратора: <br>".$input['Registrator']."<br>Название камеры: <br>".$input['Camera']."<br>Наличие камеры на месте установки: <br>".$input['CamAvailable'].
			"<br>Электричество в строении:<br>".$input['Elec']."<br>Строительно-монтажные работы в строении:<br>".$input['Mont']."<br>Дополнительная информация:<br>".$input['Issue'],
				"RESPONSIBLE_ID" => 65,
				"CREATED_BY" => 44
				)
		);
		
		$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.item.add.json';
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
		$number = $final->result;
		
		$is_available = 0;
		$is_electrified = 0;
		$is_worked =0;
		if (($input['CamAvailable']) == 'Да') {
			$is_mag = 1;
		}
		if (($input['Elec']) == 'Включено') {
			$is_electrified = 1;
		}
		if (($input['Mont']) == 'Проводятся') {
			$is_worked = 1;
		}
		DB::table('svn')->insert([
			'numBuild' => $input['Build'],
			'numRegister' => $input['Registrator'],
			'numCam' => $input['Camera'],
			'is_available' => $is_available,
			'is_electrified' => $is_electrified,
			'is_worked' => $is_worked,
			'email' => $input['email'],
			'name' => $input['Name'],
			'info' => $input['Issue'],
			'sentby' => Auth::user()->id,
			'bitrix' => $number
		]);
		return redirect()->route('main')->with('message', 'Ваша заявка на обслуживание СВН зарегистрирована в системе. Номер заявки: '.$number.".");
	}
	
	public function postValidateAlarm(Request $request)
	{
		$request->validate([
			'Build' => 'bail|max:45',
			'Level' => 'bail|max:45',
			'ButNum' => 'bail|max:100',
			'Name' => 'bail|alpha|max:45',
		], [
			'Build.max' => 'Номер строения не должен превышать 45 символов',
			'Level.max' => 'Этаж не должен превышать 45 символов',
			'ButNum.max' => 'Номер кнопки не должен превышать 100 символов',
			'Name.alpha' => 'Имя не должно содержать числовые значения',
			'Name.max' => 'Размер имени не должен превышать 45 символов'
		]); // Если валидация не пройдёт, то дальнейшее исполнение функции остановится.
		$input = $request->all();
		
		$appParams2 = array(
			//"auth" => "l8t3iuk4qyn4b555",
			"arNewTaskData" => array(
				"TITLE" => "Заявка на обслуживание охранной сигнализации от ".$input['Name']." <".$input['email']."> ",
				"DESCRIPTION" => "Номер строения: <br>".$input['Build']."<br>Этаж: <br>".$input['Level']."<br>Номер кнопки на блоке индикации и её описание: <br>".$input['ButNum']."<br>Наличие двери: <br>".$input['DoorAvailable'].
			"<br>Электричество в строении:<br>".$input['Elec']."<br>Строительно-монтажные работы в строении:<br>".$input['Mont']."<br>Дополнительная информация:<br>".$input['Issue'],
				"RESPONSIBLE_ID" => 65,
				"CREATED_BY" => 1
				)
		);
		
		$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.item.add.json';
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
		$number = $final->result;
		
		$is_door_available = 0;
		$is_electrified = 0;
		$is_worked =0;
		if (($input['DoorAvailable']) == 'Да') {
			$is_door_available = 1;
		}
		if (($input['Elec']) == 'Включено') {
			$is_electrified = 1;
		}
		if (($input['Mont']) == 'Проводятся') {
			$is_worked = 1;
		}
		DB::table('alarm')->insert([
			'numBuild' => $input['Build'],
			'numLevel' => $input['Level'],
			'numBut' => $input['ButNum'],
			'is_door_available' => $is_door_available,
			'is_electrified' => $is_electrified,
			'is_worked' => $is_worked,
			'email' => $input['email'],
			'name' => $input['Name'],
			'info' => $input['Issue'],
			'sentby' => Auth::user()->id,
			'bitrix' => $number
		]);
		return redirect()->route('main')->with('message', 'Ваша заявка на обслуживание охранной сигнализации зарегистрирована в системе. Номер заявки: '.$number.".");
	}
	
	public function postValidateIT(Request $request)
	{
		$request->validate([
			'Org' => 'bail|max:191',
			'TRC' => 'bail|max:100',
			'Phone' => 'bail|regex:/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/|max:30',
			'Name' => 'bail|alpha|max:45',
		], [
			'Org.max' => 'Название организации не должно превышать 191 символ',
			'TRC.max' => 'Наименование торгового центра не должно превышать 100 символов',
			'Phone.regex' => 'Телефон указан некорректно',
			'Phone.max'=> 'Телефон слишком длинный',
			'Name.alpha' => 'Имя не должно содержать числовые значения',
			'Name.max' => 'Размер имени не должен превышать 45 символов'
		]); // Если валидация не пройдёт, то дальнейшее исполнение функции остановится.
		$input = $request->all();
		
		/*$appParams = array(
			 //"auth" => '92006f4ae0c55d400f1e6e09428af64a',
			 "ORDER" => array("DEADLINE" => "desc"),
			 "FILTER" => array("TITLE" => "Проверка дедлайна"),
			 "PARAMS" => array('NAV_PARAMS' => array("nPageSize" => 2, 'iNumPage' => 2)),
		);

		$appRequestUrl = 'http://vidim.bitrix24.ru/rest/65/l8t3iuk4qyn4b555/task.item.list.json?'.http_build_query($appParams);*/
		
		$appParams2 = array(
			//"auth" => "l8t3iuk4qyn4b555",
			"arNewTaskData" => array(
				"TITLE" => "Заявка на IT-поддержку от ".$input['Name']." <".$input['email']."> ",
				"DESCRIPTION" => "Организация: <br>".$input['Org']."<br>Наименование торгового центра: <br>".$input['TRC']."<br>Контактный телефон: <br>".$input['Phone']."<br>Суть проблемы: <br>".$input['Issue'],
				"RESPONSIBLE_ID" => 65,
				"CREATED_BY" => 44
				)
		);
			
		//$appReq2 = "http://vidim.bitrix24.ru/rest/65/l8t3iuk4qyn4b555/task.item.add.json?".http_build_query($appParams2);
		
		$queryUrl = 'http://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/task.item.add.json';
		$queryData = http_build_query($appParams2);
		
		/*$queryUrl = 'http://vidim.bitrix24.ru/rest/65/l8t3iuk4qyn4b555/task.item.list.json';
		$queryData = http_build_query($appParams);
		$choice = $queryUrl.$queryData;*/
		
		/*echo "<br>Выборка: <br>";
		print(urldecode($appRequestUrl));
		echo "<br>Создание: <br>";
		print(urldecode($appReq2));
		//echo "<br>Curl Выборка: <br>";
		print(urldecode($choice));*/

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
		$number = $final->result;
		
		DB::table('IT')->insert([
			'orgname' => $input['Org'],
			'trcname' => $input['TRC'],
			'name' => $input['Name'],
			'email' => $input['email'],
			'phone' => $input['Phone'],
			'info' => $input['Issue'],
			'sentby' => Auth::user()->id,
			'bitrix' => $number
		]);
		
		return redirect()->route('main')->with('message', 'Ваша заявка на IT-поддержку зарегистрирована в системе. Номер заявки: '.$number.".");
		/*https://vidim.bitrix24.ru/rest/65/l8t3iuk4qyn4b555/task.item.add.json?arNewTaskData[TITLE]=test%20task&arNewTaskData[DESCRIPTION]=test%20description&arNewTaskData[RESPONSIBLE_ID]=65&arNewTaskData[CREATED_BY]=1 - добавление
		https://vidim.bitrix24.ru/rest/44/65gj5x3fhghcxbhc/tasks.task.delete.json?taskId=3191 - удаление
		100% РАБОЧИЕ REST*/
		
		/*$final = json_decode($result);
		echo "<br>Массив: <br>";
		print_r($final->result[0]->TITLE); // декод элемента из листа */
	}
	
	public function deleteSCUD()
	{
		$id = $_GET['id'];
		echo $id;
	}
	
	public function deleteSVN()
	{
		$id = $_GET['id'];
		echo $id;
	}
	
	public function deleteAlarm()
	{
		$id = $_GET['id'];
		echo $id;
	}
	
	public function deleteIT()
	{
		$id = $_GET['id'];
		echo $id;
	}
}