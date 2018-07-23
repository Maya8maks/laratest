<div class="dashboard__main">
    <div class="dashboard_table">
        <h5 class="table_title">Customer Requests</h5>
        <ul class="table head">
            <li class="table__title table__title__main" style="width: 25%"><b><a href="{!! route('adminOrders') !!}">Title</a></b></li>
            <li class="table__title table__title__main" style="width: 25%"><b><a href="{!! route('adminOrderOrderBy', array('orderBy'=>'name')) !!}">Name</a></b></li>
            <li class="table__time"><b><a href="{!! route('adminOrderOrderBy', array('orderBy'=>'date_finish')) !!}">Finnish time</a></b></li>
            <li class="table__btn"></li>
        </ul>
        @if(isset($doctors))
            @foreach($doctors as $doctor)
                <ul class="table head">
                    <li class="table__title" style="text-align: center"><b>Doctor name : {!! $doctor->name !!}</b></li>
                </ul>
                @foreach($doctor->questions as $question)
                    @if($question->status == true)
                        <ul class="table">
                            <li class="table__title">
                                <p>{{ $question->question }}</p>
                            </li>
                            <?$date = Carbon\Carbon::parse($question->date_finish)->format('d.M.Y');
                            $time = Carbon\Carbon::parse($question->date_finish)->format('H:m')?>

                            <li class="table__time"><span class="full_hours">{{$time}}</span><span class="date">{{$date}}</span></li>
                            <li class="table__btn"><a class="complete" href="#">Complete</a></li>
                            <li class="table__questions">
                                <p>{{ $question->description }}</p>
                            </li>
                            <li class="table__answer">
                                <p>{{ $question->answer['answer'] }}</p>
                            </li>
                        </ul>
                    @endif
                @endforeach
            @endforeach
        @elseif(isset($questions))
            @foreach($questions as $question)
                @if($question->status == true)
                    <ul class="table head">
                        <li class="table__title" style="text-align: center"><b>Doctor name : {!! $question->doctorName($question->user_id) !!}</b></li>
                    </ul>
                    <ul class="table">
                        <li class="table__title">
                            <p>{{ $question->question }}</p>
                        </li>
                        <?$date = Carbon\Carbon::parse($question->date_finish)->format('d.M.Y');
                        $time = Carbon\Carbon::parse($question->date_finish)->format('H:m')?>

                        <li class="table__time"><span class="full_hours">{{$time}}</span><span class="date">{{$date}}</span></li>
                        <li class="table__btn"><a class="complete" href="#">Complete</a></li>
                        <li class="table__questions">
                            <p>{{ $question->description }}</p>
                        </li>
                        <li class="table__answer">
                            <p>{{ $question->answer['answer'] }}</p>
                        </li>
                    </ul>
                @endif
            @endforeach
        @endif
    </div>
</div>