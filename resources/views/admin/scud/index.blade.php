@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">СКУД</div>

                <div class="card-body">
					
					<a href="{{ route('admin.scud.create') }}" class="btn btn-sm btn-success">Добавить</a>
					<br>
					<br>
					<table class="table">
						<tr>
							<th>numBuild</th>
							<th></th>
						</tr>
						@forelse($scud as $scuds)
							<tr>
								<td>{{ $scuds->numBuild }}</td>
								<td><a href="{{ route(admin.scud.edit, $scuds->id) }}" class="btn btn-sm btn-danger">Редактировать</a></td>
							</tr>		
						@empty
							<tr>
								<td colspan="2">Записи не найдены</td>
							</tr>
						@endforelse
					</table>
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection