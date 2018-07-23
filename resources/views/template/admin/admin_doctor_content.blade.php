<div class="dashboard__main">
    <div class="dashboard_table">
        <h5 class="table_title">Customer Requests</h5>
        <ul class="table head">
            <li class="table__title"><b>Title</b></li>
            <li class="table__time"><b>Date add</b></li>
            <li class="table__time"><b>Date complete</b></li>
            <li class="table__btn"></li>
        </ul>
        @foreach($doctor->questions as $question)
                <ul class="table">
                    <li class="table__title">
                        <p>{{ $question->question }}</p>
                    </li>
                    <li class="table__time">
                        <?$date = Carbon\Carbon::parse($question->date_add)->format('d.M.Y');
                        $time = Carbon\Carbon::parse($question->date_add)->format('H:m')?>
                        <span class="full_hours">{{$time}}</span>
                        <span class="date">{{$date}}</span>
                    </li>
                    <li class="table__time">
                        <?$date = Carbon\Carbon::parse($question->date_finish)->format('d.M.Y');
                        $time = Carbon\Carbon::parse($question->date_finish)->format('H:m')?>
                        <span class="full_hours">{{$time}}</span>
                        <span class="date">{{$date}}</span>
                    </li>
                    @if($question->status == true)
                        <li class="table__btn"><a class="complete" href="#">Complete</a></li>
                        <li class="table__questions">
                            <p>{{ $question->description }}</p>
                        </li>
                        <li class="table__answer">
                            <p>{{ $question->answer['answer'] }}</p>
                        </li>
                    @else
                        <li class="table__btn"><a class="fade_btn btn_proggres" href="#">In proggres</a></li>
                        <li class="table__text">
                            <p>{{ $question->description }}</p>
                        </li>
                    @endif
                </ul>
        @endforeach
    </div>
</div>