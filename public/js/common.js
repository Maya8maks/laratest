(function ($) {
    $('.table__text, .table__form, .popup_submit, .table__questions, .table__answer').hide();

    var title = $('.table__title p');
    var fade_btn = $('.fade_btn');
    var submit = $('.submit_btn');
    var complete = $('.complete');

    function clickToTitle() {
        $(this).parent().next().next().next().stop(true).fadeToggle();
        $(this).toggleClass('blocking');
        // if($(this).hasClass('blocking')) {
        // fade_btn.off('click', clickToBtn);
        // } else {
        // fade_btn.on('click', clickToBtn);
        // }
    }

    function clickToBtn(e) {
        e.preventDefault();
        $(this).parent().next().stop(true).fadeToggle();
        $(this).parent().next().next().stop(true).fadeToggle();
        if($(this).hasClass('btn_answer')) {
            $(this).text('cancel').removeClass('btn_answer').addClass('cancel');
            // title.off('click', clickToTitle);
        } else {
            $(this).text('answer').removeClass('cancel').addClass('btn_answer');
            // title.on('click', clickToTitle);
        }
    }

    function submitClick(e) {
        e.preventDefault();
        var $that = $(this);
        $that.parent().parent().next().show();
        $that.parent().parent().prev().prev().children().text('complete').removeClass('cancel').addClass('complete');
        setTimeout(function () {
            $that.parent().parent().parent().hide();
            $that.parent().parent().hide();
            $that.parent().parent().prev().hide();
            $that.parent().parent().next().hide();
        }, 1500);
    }

    function clickComplete(e) {
        e.preventDefault();
        $(this).parent().next().fadeToggle();
        $(this).parent().next().next().fadeToggle();
    }

    complete.on('click', clickComplete);  // Click to complete
    title.on('click', clickToTitle);      // Click to title
    fade_btn.on('click', clickToBtn);     // Click to button
    submit.on('click', submitClick);      // Click to submit

    // KeyPress input

    var input = $('input[name="question"]');
    var textarea = $('#counterLow');
    var count = $('.counter');
    var countTextarea = $('.counterLow');

    input.on('keydown', function() {
        count.text(this.value.length + '/120');  });

    textarea.on('keydown', function() {
        countTextarea.text(this.value.length + '/500');
    });

    // Input Readonly

    var toggled = false;
    $('.table_title').click(function() {
        toggled = !toggled;
        $(this).parent().find('input').attr('readonly', toggled ? null :'readonly');
        if($(this).parent().find('input').attr('readonly')) {
            $('.sbmt').fadeOut();
        } else {
            $('.sbmt').fadeIn();
        }
    });
    window.onload = function() {
        var dashboard = "[0-9]/dashboard";
        var orders = "[0-9]/orders";
        var account = "[0-9]/account";
        var url = window.location.pathname;
        if( url == "/admin" || url == "/admin/dashboard/name" || url == "/admin/dashboard/date_add" || url.search(dashboard) == 1){
            $('*[data-sidebar=1]').addClass('active_line');
        }
        if(url == "/admin/order" || url == "/admin/order/name" || url == "/admin/order/date_finish" || url.search(orders) == 1){
            $('*[data-sidebar=2]').addClass('active_line');
        }
        if(url == "/admin/createAccount" || url.search(account ) == 1){
            $('*[data-sidebar=3]').addClass('active_line');
        }
    };
})(jQuery);

$(document).ready(function () {
    $('#QSubmit').click(function (event) {
        $this = $(this);
        event.preventDefault();
        var url = $this.parent('form').attr('action');
        var method = $this.parent('form').attr('method');
        console.log(method);
        var Question = $this.parent('form').find("input[name=question]").val();
        $('*[data-form_question_input]').css("border-color", '#808080');
        $('*[data-form_question_error]').remove();
        if (Question.length == 0) {
            $this.parent('form').find("[data-form_question_label=1]")
                .append('<p data-form_question_error =1 ; style="font-size:12px;margin:1px;color:#ac2925">Question is Required</p>');
            $this.parent('form').find("[data-form_question_input=1]")
                .css("border-color", '#ac2925');
            return
        }
        if (Question.length < 3) {
            $this.parent('form').find("[data-form_question_label=1]")
                .append('<p data-form_question_error =1 ; style="font-size:12px;margin:1px;color:#ac2925">Question must be more then 3 letters</p>');
            $this.parent('form').find("[data-form_question_input=1]")
                .css("border-color", '#ac2925');
            return
        }
        var Description = $this.parent('form').find("textarea[name=description]").val();
        if (Description.length == 0) {
            $this.parent('form').find("[data-form_question_label=2]")
                .append('<p data-form_question_error =2 ; style="font-size:12px;margin:1px;color:#ac2925">Description is Required</p>');
            $this.parent('form').find("[data-form_question_input=2]")
                .css("border-color", '#ac2925');
            return
        }
        if (Description.length < 15) {
            $this.parent('form').find("[data-form_question_label=2]")
                .append('<p data-form_question_error =2 ; style="font-size:12px;margin:1px;color:#ac2925">Description must be more then 15 letters</p>');
            $this.parent('form').find("[data-form_question_input=2]")
                .css("border-color", '#ac2925');
            return
        }
        var Email = $this.parent('form').find("input[name=email]").val();
        if (Email.length < 3) {
            $this.parent('form').find("[data-form_question_label=3]")
                .append('<p data-form_question_error =3 ; style="font-size:12px;margin:1px;color:#ac2925">Email is Required</p>');
            $this.parent('form').find("[data-form_question_input=3]")
                .css("border-color", '#ac2925');
            return
        }
        var data = $this.parent('form').serialize();
        console.log(method);
        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(response) {
                window.location.href = "question/"+Question+"/"+Description+"/"+Email;
            },
            error: function error(err) {
                console.log(err);
            }
        });
    });
});
