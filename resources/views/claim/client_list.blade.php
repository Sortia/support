@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">Заявки</span>
                        <span class="float-right"><a href="{{route('claim.create')}}"><button class="btn btn-primary btn-sm">Создать</button></a></span>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <td>#</td>
                                <td>Тема</td>
                                <td>Статус</td>
                                <td>Открыть</td>
                            </tr>
                            @foreach($claims ?? [] as $claim)
                                <tr>
                                    <td>{{$claim->id}}</td>
                                    <td>{{$claim->subject}}</td>
                                    <td>{{$claim->is_active ? 'Активна' : 'Закрыта'}}</td>
                                    <td><a href="{{route('claim.edit', compact('claim'))}}">Открыть</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
