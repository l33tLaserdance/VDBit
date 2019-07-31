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
						<input type="text" name="numBuild" class="form-control">
						<br><br>
						Этаж:
						<input type="text" name="numLevel" class="form-control">
						<br><br>
						Номер двери:
						<input type="text" name="numDoor" class="form-control">
						<br><br>
						Магнитный замок:
						<input type="text" name="is_mag" class="form-control">
						<br><br>
						Электричество:
						<input type="text" name="is_electrified" class="form-control">
						<br><br>
						Строительно-монтажные работы:
						<input type="text" name="is_worked" class="form-control">
						<br><br>
						Email:
						<input type="text" name="email" class="form-control">
						<br><br>
						Имя:
						<input type="text" name="name" class="form-control">
						<br><br>
						Дополнительная информация:
						<input type="textarea" name="info" class="form-control">
						<br><br>
						<input type="submit" value="Сохранить" class="btn btn-primary">
						
					</form>
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection