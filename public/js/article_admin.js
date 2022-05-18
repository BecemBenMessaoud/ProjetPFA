$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-refuse-article').on('click', function () {
        let articleId = $(this).parents().eq(4).data('article-id')
        Swal.fire({
            title: 'Refuse article',
            text: "Are you sure you want to refuse this article ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, refuse it!'
        }).then((result) => {
            if (result.isConfirmed) {
                refuse(articleId)
            }
        })
    })

    $('.btn-accept-article').on('click', function () {
        let articleId = $(this).parents().eq(4).data('article-id')
        Swal.fire({
            title: 'Accept article',
            text: "Are you sure you want to refuse this article ? ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, accept it!'
        }).then((result) => {
            if (result.isConfirmed) {
                accept(articleId)
            }
        })
    })

    let refuse = function (articleId) {
        $.ajax({
            method: 'get',
            url: '/admin/articles/refuse/' + articleId,
            dataType: 'json',
            processData: false,
            cache: false,
            contentType: false,
            success: function (response) {
                showAlert(false, true)
                removeArticle(articleId)
            },
            error: function (response) {
                showAlert(false, false)
            },
        })
    }
    let accept = function (articleId) {
        $.ajax({
            method: 'get',
            url: '/admin/articles/accept/' + articleId,
            dataType: 'json',
            processData: false,
            cache: false,
            contentType: false,
            success: function (response) {
                showAlert(true, true)
                removeArticle(articleId)
            },
            error: function (response) {
                showAlert(true, false)
            },
        })
    }

    let showAlert = function (accept = true, success = true) {
        icon = success ? 'success' : 'error'
        title = accept ? 'Accept article' : 'Refuse article'
        if (accept && success) {
            text = 'Article accepted successfully !'
        } else if (accept && !success) {
            text = 'Error while accepting article !'

        } else if (!accept && success) {
            text = 'Article refused successfully !'

        } else {
            text = 'Error while refusing article !'

        }

        Swal.fire({
            icon: icon,
            title: title,
            text: text,
        })
    }

    let removeArticle = function (articleId) {
        $('div[data-article-id="' + articleId + '"]').remove()
    }


})
