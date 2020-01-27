$(function () {
    /**
     * function click on button add ph
     */
    $('.add-ph-btn').click(function () {
        $('.ph-info').addClass('d-none');
        $('.add-ph').removeClass('d-none');
        $(this).addClass('d-none');
    });

    /**
     * post req for add ph in database
     */
    $('.sub-ph').click(function () {
        let form_fields = {};
        if ($('#name-ph').val() === '') {
            alert('Выедите имя');
            return 1;
        } else {
            form_fields.name = $('#name-ph').val();
            $('#name-ph').val('');
        }

        if ($('#info-ph').val() === '') {
            alert('Введите информацию');
            return 1;
        } else {
            form_fields.info = $('#info-ph').val();
            $('#info-ph').val('');
        }

        if ($("#school-ph option:selected").text() === "Choose...")
            form_fields.school = 'Не известно';
        else
            form_fields.school = $("#school-ph option:selected").text();

        $.ajax({
            url: window.location.href,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'data': form_fields,
                'operation': 'add-ph'
            },
        });

        $('.ph-info').removeClass('d-none');
        $('.add-ph').addClass('d-none');
        $('.add-ph-btn').removeClass('d-none')
    });

    $('.find-ph').on('keypress', function (e) {
        let form_fields = {};
        if (e.which === 13) {
            form_fields.name = $(this).val();
            form_fields.with_school = $('.with-school:checkbox:checked').val() === 'on' ? 1 : 0;
            form_fields.with_defin = $('.with-defin:checkbox:checked').val() === 'on' ? 1 : 0;
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
                    $('.ph-zone').append(res);
                }
            });
        }
    })

});
