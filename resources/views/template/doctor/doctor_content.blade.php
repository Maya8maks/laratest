<div class="dashboard__main">
    <div class="dashboard_table">
        <h5 class="table_title">Customer Requests</h5>
        <ul class="table head">
            <li class="table__title"><b>Title</b></li>
            <li class="table__time"><b>Remaining time</b></li>
            <li class="table__btn"></li>
        </ul>
            @foreach($doctor->questions as $question)
                @if($question->status == false)
                    <ul class="table">
                        <li class="table__title">
                            <p>{{ $question->question }}</p>
                        </li>
                        <?  $timeDifferent = Carbon\Carbon::now()->diffInMinutes(Carbon\Carbon::parse($question->date_add));
                            $hours = floor($timeDifferent/60);
                            $minutes = $timeDifferent - ($hours*60) ?>
                        <li class="table__time"><span class="hours">{!! 24-($hours+1) !!} hours</span><span class="min">{!! 60 - $minutes !!} min</span></li>

                        <li class="table__btn"><a class="fade_btn btn_answer" href="#">Answer</a></li>
                        <li class="table__text">
                            <p>{{ $question->description }}</p>
                        </li>
                        <li class="table__form">
                            {!! Form::open(
                                [
                                    'url'=>route('answer',array('doctor_id'=>$doctor->id,'question_id'=>$question->id)),
                                    'class'=>'dashboard_form',
                                    'method'=>'POST',
                                    'enctype'=>'multipart/form-data',
                                     'style'=>'position: relative'
                                ])
                            !!}
                                <textarea name="text"></textarea>
                                <input class="" type="submit"  value="submit">
                            {!! Form::close() !!}
                        </li>
                        <li class="popup_submit">
                            <h2>Request complete</h2>
                            <p>Your answer is submitted!</p>
                        </li>
                    </ul>
                @endif
            @endforeach
    </div>
</div>