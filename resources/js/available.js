$(document).ready(function () {
    let articleId = null;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-demand').on('click', function () {
        clearAndShowModal();
        articleId = $(this).parents().eq(4).data('article-id');
    })

    $('#submit-demand').on('click', function () {
        if ($('#demand-form').valid()) {
            storeDemand()
        }
    })

    $('#demand-form').validate({
        rules: {
            motive: {
                required: true,
                maxlength: 400,
                nowhitespace: true
            }
        }
    })

    let storeDemand = function () {
        let motive = $('#motive-text').val().trim();

        let formData = new FormData()
        formData.append('motive', motive);

        $.ajax({
            method: 'post',
            url: '/user/demands/store/' + articleId,
            dataType: 'json',
            processData: false,
            data: formData,
            cache: false,
            contentType: false,
            success: function (response) {
                showAlert();
                $('div[data-article-id="' + articleId + '"]').remove();
            },
            error: function (response) {
                showAlert(false)
            },
            complete: function () {
                clearAndHideModal();
            }
        })
    }

    let showAlert = function (success = true) {
        let icon = success ? 'success' : 'error';
        let text = success ? 'Demand submitted successfully !' : 'Error while submitting your demand !'

        Swal.fire({
            icon: icon,
            title: 'Article demand',
            text: text,
        })

    }

    let clearAndHideModal = function () {
        $('#motive-text').val('');
        $('#motive-modal').modal('hide');
    }

    let clearAndShowModal = function () {
        $('#motive-text').val('');
        $('#motive-modal').modal('show');
    }

})
