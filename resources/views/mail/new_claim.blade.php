<h1>Сообщение в заявке #{{$claim->id}}</h1>
<h3>{{$claim->subject}}</h3>
<p>{{$claimMessage->text}}</p>

@if($addressee->isManager())
    <p><a href="{{route('claim.auth', ['claim' => $claim])}}">Перейти к заявке</a></p>
@endif
