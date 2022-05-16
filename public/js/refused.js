$(document).ready(function () {

    let demandId = null;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-refuse-demand').on('click', function () {
        Swal.fire({
            title: 'Delete demand',
            text: "Are you sure you want to refuse this demand ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, refuse it!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteDemand($(this))
            }
        })
    })

})
let deleteDemand = function (deleteBtn) {
    let demandId = deleteBtn.parents().eq(4).data('demand-id')
    $.ajax({
        method: 'delete',
        url: '/admins/demands/refuse/' + demandId,
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
let showAlert = function (success = true) {
    let icon = success ? 'success' : 'error';
    let text = success ? 'Demand refused successfully !' : 'Error while refusing the demand !'

    Swal.fire({
        icon: icon,
        title: 'Article demand',
        text: text,
    })

}
