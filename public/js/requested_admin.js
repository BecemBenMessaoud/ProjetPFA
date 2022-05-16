$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-refuse-demand').on('click', function () {
        let demandId = $(this).parents().eq(4).data('demand-id')
        Swal.fire({
            title: 'Refuse demand',
            text: "Are you sure you want to refuse this demand ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, refuse it!'
        }).then((result) => {
            if (result.isConfirmed) {
                refuse(demandId)
            }
        })
    })

    $('.btn-accept-demand').on('click', function () {
        let demandId = $(this).parents().eq(4).data('demand-id')
        Swal.fire({
            title: 'Accept demand',
            text: "Are you sure you want to refuse this demand ? All other pending requests for this article will be refused.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, accept it!'
        }).then((result) => {
            if (result.isConfirmed) {
                accept(demandId)
            }
        })
    })


    let showAlert = function (accept = true, success = true) {
        let icon = success ? 'success' : 'error';
        let text = '';
        let title = accept ? 'Accept demand' : 'Refuse demand';

        if (accept && success) {
            text = 'Demand accepted successfully !';
        } else if (accept && !success) {
            text = 'Failed to accept demand !';
        } else if (!accept && success) {
            text = 'Demand refused successfully !';
        } else {
            text = 'Failed to refuse demand !';
        }

        Swal.fire({
            icon: icon,
            title: title,
            text: text,
        })

    }

    let accept = function (demandId) {
        $.ajax({
            method: 'get',
            url: '/admin/demands/accept/' + demandId,
            dataType: 'json',
            processData: false,
            cache: false,
            contentType: false,
            success: function (response) {
                showAlert()
                let demandIds = response.demand_ids;
                demandIds.forEach(function (demandId) {
                    removeDemand(demandId)
                })
            },
            error: function (response) {
                showAlert(true, false)
            },
        })
    }

    let refuse = function (demandId) {
        $.ajax({
            method: 'get',
            url: '/admin/demands/refuse/' + demandId,
            dataType: 'json',
            processData: false,
            cache: false,
            contentType: false,
            success: function (response) {
                showAlert(false, true)
                removeDemand(demandId)
            },
            error: function (response) {
                showAlert(false, false)
            },
        })
    }

    let removeDemand = function (demandId) {
        $('div[data-demand-id="' + demandId + '"]').remove()
    }

})
