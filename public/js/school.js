$(function () {
    /**
     * function click on button add ph
     */
    $('.add-ph-btn').click(function () {
        $('.ph-info').addClass('d-none');
        $('.add-ph').removeClass('d-none');
        $(this).addClass('d-none');
    });


    $('.sub-sch').click(function () {
        let form_fields = {};
        if ($('#name-sch').val() === '') {
            alert('Выедите название');
            return 1;
        } else {
            form_fields.name = $('#name-sch').val();
            $('#name-sch').val('');
        }

        if ($('#info-sch').val() === '') {
            alert('Введите информацию');
            return 1;
        } else {
            form_fields.info = $('#info-sch').val();
            $('#info-sch').val('');
        }

        form_fields.philops = $('ul.philops li input:checkbox:checked').map(function (i, el) {
            return $(el).parents('li').find('span').html();
        }).get();

        $.ajax({
            url: window.location.href,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'data': form_fields,
                'operation': 'add-sch'
            },
        });

        $('.ph-info').removeClass('d-none');
        $('.add-ph').addClass('d-none');
        $('.add-ph-btn').removeClass('d-none')
    });

    $('.find-sch').click(function () {
        let form_fields = {};
        if ($('.countic:radio:checked').val() === 'on')
            form_fields.oper = 1;
        else if ($('.max-ph:radio:checked').val() === 'on')
            form_fields.oper = 2;
        else if ($('.byph:radio:checked').val() === 'on')
            form_fields.oper = 3;
        form_fields.ph = $("#ph-select option:selected").text();
        form_fields.sh = $("#sh-select option:selected").text();
        form_fields.countic = $('.count-ph').val() !== '' ? $('.count-ph').val() : 10000;
        $.ajax({
            url: window.location.href + '/search',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'data': form_fields,
            },
            success: function (res) {
                $(".delete").remove();
                $('.sch-zone').append(res);
            }
        });
    });

});
