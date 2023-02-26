listenClick('.user-delete-btn', function (event) {
    let roleRecordId = $(event.currentTarget).data('id')
    deleteItem(route('users.destroy', roleRecordId),  Lang.get('messages.user.user'))
})
listenClick('#changePassword', function () {
    $('#changePasswordForm')[0].reset()
    $('.pass-check-meter div.flex-grow-1').removeClass('active')
    $('#changePasswordModal').modal('show').appendTo('body')
})
listenClick('#passwordChangeBtn', function () {
    $.ajax({
        url: route('user.changePassword'),
        type: 'PUT',
        data: $('#changePasswordForm').serialize(),
        success: function (result) {
            $('#changePasswordModal').modal('hide')
            $('#changePasswordForm')[0].reset()
            displaySuccessMessage(result.message)
            setTimeout(function () {
                location.reload()
            }, 1000)
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('.twoauth-enable', function () {
    $.ajax({
        url: route('user.twofactor.auth.enable'),
        type: 'GET',
        success: function (result) {
            displaySuccessMessage(result.message)
            setTimeout(function () {
                location.reload()
            }, 1000)
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('.twoauth-disable', function () {

    $('#disable2faModal').modal('show').appendTo('body')
})

listenSubmit('#disable2faForm',function (e) {
   e.preventDefault();
   
    $.ajax({
        url: route('user.twofactor.auth.disable'),
        type: 'POST',
        data: $('#disable2faForm').serialize(),
        success: function (result) {
            displaySuccessMessage(result.message)
            setTimeout(function () {
                location.reload()
            }, 3000)
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})
