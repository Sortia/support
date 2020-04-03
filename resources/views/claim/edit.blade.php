@extends('layouts.app')

@section('js')
    <script src="{{asset('js/claim.js')}}" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <fieldset {{$claim->is_active ? '' : 'disabled'}}>
                            <span class="float-left">Создание заявки</span>
                            <span class="float-right">
                                @if(auth()->user()->is_manager === 0)
                                    <button id="close" class="btn btn-danger btn-sm">Закрыть заявку</button>
                                @else
                                    <button id="accept" class="btn btn-primary btn-sm">Принять</button>
                                @endif
                            </span>
                        </fieldset>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="subject"><b>Тема</b></label>
                            <input value="{{$claim->subject}}" disabled class="form-control" id="subject" name="subject">
                        </div>

                        <div class="card">
                            <div class="card-header">Сообщения</div>
                            <div class="card-body">
                                @foreach($claim->messages as $message)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            {{$message->user->name}}: {{$message->text}}
                                            <br>
                                            @if($message->file)
                                                <a href="{{route('file.get', compact('message'))}}"><button class="btn btn-secondary">Файл</button></a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <form action="{{route('claim.update', compact('claim'))}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <fieldset {{$claim->is_active ? '' : 'disabled'}}>
                            <div class="form-group">
                                <label for="text"><b>Текст</b></label>
                                <textarea class="form-control" id="text" name="text"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="file"><b>Файл</b></label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            </fieldset>
                            <div class="float-left">
                                <a href="{{route('claim.index')}}"><button type="button" class="btn btn-secondary">Назад</button></a>
                            </div>
                            <div class="float-right">
                                <button {{$claim->is_active ? '' : 'disabled'}} class="btn btn-success">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
