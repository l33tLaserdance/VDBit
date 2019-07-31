@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создание заявки СКУД</div>

                <div class="card-body">
					
					<form method="post" action="{{ route('admin.scud.store') }}"> 
						@csrf
						
						Номер здания:
						<input type="text" name="inputBuild" class="form-control">
						<br><br>
						Этаж:
						<input type="text" name="inputLevel" class="form-control">
						<br><br>
						Номер двери:
						<input type="text" name="inputDoor" class="form-control">
						<br><br>
						Магнитный замок:
						<input type="text" name="inputMag" class="form-control">
						<br><br>
						Электричество:
						<input type="text" name="inputElec" class="form-control">
						<br><br>
						Строительно-монтажные работы:
						<input type="text" name="inputMont" class="form-control">
						<br><br>
						Email:
						<input type="text" name="inputEmail" class="form-control">
						<br><br>
						Имя:
						<input type="text" name="inputName" class="form-control">
						<br><br>
						Дополнительная информация:
						<input type="textarea" name="inputInfo" class="form-control">
						<br><br>
						<input type="submit" value="Сохранить" class="btn btn-primary">
						
					</form>
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection