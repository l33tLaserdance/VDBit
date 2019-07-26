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
			'sentby' => Auth::user()->id
		]);
		return redirect()->route('main')->with('message', 'Ваша заявка на обслуживание СКУД зарегистрирована в системе.');

		
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
			'sentby' => Auth::user()->id
		]);
		return redirect()->route('main')->with('message', 'Ваша заявка на обслуживание СВН зарегистрирована в системе.');
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
			'sentby' => Auth::user()->id
		]);
		return redirect()->route('main')->with('message', 'Ваша заявка на обслуживание охранной сигнализации зарегистрирована в системе.');
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
		DB::table('IT')->insert([
			'orgname' => $input['Org'],
			'trcname' => $input['TRC'],
			'name' => $input['Name'],
			'email' => $input['email'],
			'phone' => $input['Phone'],
			'info' => $input['Issue'],
			'sentby' => Auth::user()->id
		]);
		return redirect()->route('main')->with('message', 'Ваша заявка на IT-поддержку зарегистрирована в системе.');
	}
}