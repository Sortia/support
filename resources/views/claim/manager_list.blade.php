@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">Заявки</span>
                        <span class="float-right"><a href="{{route('claim.create')}}"><button
                                    class="btn btn-primary btn-sm">Создать</button></a></span>
                    </div>

                    <div class="card-body">
                        <form action="{{route('claim.index')}}">
                            <div class="row">
                                <div class="col-sm-4 my-1 mb-3">
                                    <label class="sr-only" for="is_active">Активны</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Активны</div>
                                        </div>
                                        <select name="is_active" id="is_active" class="form-control">
                                            <option value="">Все</option>
                                            <option value="1">Да</option>
                                            <option value="0">Нет</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 my-1 mb-3">
                                    <label class="sr-only" for="is_viewed">Просмотрены</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Просмотрены</div>
                                        </div>
                                        <select name="is_viewed" id="is_viewed" class="form-control">
                                            <option value="">Все</option>
                                            <option value="1">Да</option>
                                            <option value="0">Нет</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 my-1 mb-3">
                                    <label class="sr-only" for="is_answered">С ответом</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">С ответом</div>
                                        </div>
                                        <select name="is_answered" id="is_answered" class="form-control">
                                            <option value="">Все</option>
                                            <option value="1">Да</option>
                                            <option value="0">Нет</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 float-right mb-3">
                                    <button class="btn btn-primary float-right btn-sm">Поиск</button>
                                </div>
                            </div>
                        </form>
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
