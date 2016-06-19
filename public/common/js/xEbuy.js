$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

(function ($) {
    'use strict';

    $(document).ready(function () {
        NProgress.start();
    });

    $(window).load(function () {
        NProgress.done();
    })


    //切换栏目
    $("#change_system").change(function () {
        var url = $(this).val();
        location.href = url;
    })

    //全选
    $("#checked").click(function(){
        $('.checked_id').prop('checked', this.checked);
    }); 
})(jQuery);


