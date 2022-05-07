$(document).ready(function () {

    let demandId = null;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-delete-demand').on('click', function () {
        Swal.fire({
            title: 'Delete demand',
            text: "Are you sure you want to delete this demand ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteDemand($(this))
            }
        })
    })

    $('.btn-edit-demand').on('click', function () {
        demandId = $(this).parents().eq(4).data('demand-id');
        setAndShowModal(demandId);
    })

    $('#update-demand').on('click', function () {
        if ($('#demand-form').valid()) {
            updateDemand()
        }
    })

    let deleteDemand = function (deleteBtn) {
        let demandId = deleteBtn.parents().eq(4).data('demand-id')
        $.ajax({
            method: 'delete',
            url: '/user/demands/delete/' + demandId,
            dataType: 'json',
            processData: false,
            cache: false,
            contentType: false,
            success: function (response) {
                showAlert(false)
                destroyDemand(demandId)
            },
            error: function (response) {
                showAlert(false, false)
            },
        })
    }

    let destroyDemand = function (demandId) {
        $('div[data-demand-id="' + demandId + '"]').remove()
    }

    let updateDemand = function () {
        let motive = $('#motive-text').val().trim();

        let formData = new FormData()
        formData.append('motive', motive);

        $.ajax({
            method: 'post',
            url: '/user/demands/update/' + demandId,
            dataType: 'json',
            processData: false,
            data: formData,
            cache: false,
            contentType: false,
            success: function (response) {
                showAlert();
                $('div[data-demand-id="' + demandId + '"]').find('li.li-motive').first().html('<strong>Motive : </strong>' + response.demand.motive)
            },
            error: function (response) {
                showAlert(true, false)
            },
            complete: function () {
                clearAndHideModal();
            }
        })
    }

    let showAlert = function (edit = true, success = true) {
        let icon = success ? 'success' : 'error';
        let title = edit ? 'Update article' : 'Delete article'
        let text = '';

        if (edit && success) {
            text = 'Demand update successfully !'
        } else if (edit && !success) {
            text = 'Failed to update demand !'
        } else if (!edit && success) {
            text = 'Demand deleted successfully !'
        } else {
            text = 'Error while deleting your demand !'
        }

        Swal.fire({
            icon: icon,
            title: title,
            text: text,
        })
    }

    let setAndShowModal = function (demandId) {
        $.ajax({
            method: 'get',
            url: '/user/demands/' + demandId,
            success: function (demand) {
                $('#motive-text').val(demand.motive);
                $('#motive-modal').modal('show');
            }
        })

    }

    let clearAndHideModal = function () {
        $('#motive-text').val('');
        $('#motive-modal').modal('hide');
    }

    $('#demand-form').validate({
        rules: {
            motive: {
                required: true,
                maxlength: 400,
                nowhitespace: true
            }
        }
    })


})
