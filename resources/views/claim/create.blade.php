@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">Создание заявки</span>
                    </div>

                    <div class="card-body">
                        <form action="{{route('claim.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="subject"><b>Тема</b></label>
                                <input class="form-control" id="subject" name="subject">
                            </div>

                            <div class="form-group">
                                <label for="text"><b>Текст</b></label>
                                <textarea class="form-control" id="text" name="text"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="file"><b>Файл</b></label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <div class="float-right">
                                <button class="btn btn-success">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
