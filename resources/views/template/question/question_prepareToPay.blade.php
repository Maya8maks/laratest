<div class="dashboard__main">
    <h1 class="physician__head">Ask a Doctor</h1><span class="physician__subtext">Answer within 24 hours</span>
    <div class="dashboard_table">
        {!! Form::open(
        [
        'url'=>'https://www.sandbox.paypal.com/cgi-bin/webscr',
        'class'=>'physician__form',
        'method'=>"POST",
        'style'=>'position: relative',
        ])
        !!}
        <label data-form_question_label = '1'>Your Question</label>
        <input data-form_question_input = '1' type="text" name="question" readonly  value="{!!$question!!}" maxlength="120">
        <label data-form_question_label = '2'>Description</label>
        <textarea id="counterLow" data-form_question_input = '2' readonly   placeholder="{!!$discription !!}" maxlength="500"></textarea>
        <input data-form_question_input = '1' type="hidden" name="description" readonly  value="{!!$discription!!}" maxlength="120">
        <label data-form_question_label = '3' >Email</label>
        <input data-form_question_input = '3' readonly  style="width: 100%; margin-bottom: 15px" type="email" name="email" value="{!! $email !!}">
        <input type= "hidden" name="cmd" value="_xclick">
        {{--<input type="hidden" name="hosted_button_id" value="HM4534KQESTV8">--}}
        <input type="hidden" name="business" value="kruhlov_1-facilitator@ukr.net">
        {{--<input type="hidden" name="no_shipping" value="1">--}}
        <input type='hidden' name='cancel_return' value='{!! route('editQuestion',array('question'=>$question,'email'=> $email)) !!}'>
        <input type="hidden" name="return" value="{!! route('paypal') !!}">
        <input type="hidden" name="amount" value="15">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="lc" value="15">
        {{--<input type="hidden" name="bn" value="PP-BuyNowBF">--}}
        <input type="hidden" name="custom" value="{!! $id !!}">
        {{--<input type="hidden" name="email" value="{!! $email !!}">--}}
        <a class="payBtn payBtn-a" href="{{route('editQuestion',array('question'=>$question,'email'=> $email))}}" name="submit">Go back</a>
        {{--<button type="submit"style="margin-left: 15px" name="submit" class="payBtn">Pay Now</button>--}}
        <input type="submit" class="payBtn payBtn-a" name="submit" value="Pay">
        </div>
        {!! Form::close() !!}

    </div>
</div>