$(function () {
    /**
     * drop db
     */
    $('.drop-bd button').click(function () {
        $.ajax({
            type: "POST",
            url: window.location.href,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                'operation':'drop-table',
            },
            success:function (res) {
                if (res.data === 'ok'){
                    $('.drop-bd button').addClass('btn-success');
                    $('.drop-bd button').removeClass('btn-dark');
                    setTimeout(function(){
                        $('.drop-bd button').removeClass('btn-success');
                        $('.drop-bd button').addClass('btn-dark');
                    }, 2000);

                }
            }
        });
    });


    $('.download-db button').click(function () {
        $.ajax({
            type: "POST",
            url: window.location.href,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                'operation':'download-table',
            },
            success:function (res) {
                if (res.data === 'ok'){

                    setTimeout(function(){

                    }, 2000);

                }
            }
        });
    });
});
