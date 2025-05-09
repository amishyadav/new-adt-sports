document.addEventListener('turbo:load', loaSocialIconData)

function loaSocialIconData () {
    $('#socialIconPicker').iconpicker();
    $('#editSocialIconPicker').iconpicker();
}

listenHiddenBsModal('#addSocialIconModal', function (e) {
    $('#addSocialIconForm')[0].reset()
    livewire.emit('refresh')
})

listenClick('#addSocialIconModalBtn', function () {
    $('#addSocialIconModal').modal('show').appendTo('body')
})

listenClick('.btn-icon', function () {
    let socialIconValue =  $(this).val();
   $('#socialIconValue').attr('value',socialIconValue);
    $('#editSocialIcon').val(socialIconValue);
})

listenSubmit('#addSocialIconForm', function (e) {
    e.preventDefault()
    $('#socialIconAddBtn').prop('disabled', true)
    $.ajax({
        url: route('social-icon.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                livewire.emit('refresh')
                $('#addSocialIconModal').modal('hide')
                $('#socialIconAddBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#socialIconAddBtn').prop('disabled', false)
        },
    })
})

listenClick('.social-icon-edit-btn', function (event) {
    let editSocialIconId = $(event.currentTarget).data('id')
    renderData(editSocialIconId)
})

function renderData (id) {
    $.ajax({
        url: route('social-icon.edit', id),
        type: 'GET',
        success: function (result) {
            let social_icon = result.data
            $('#socialIconId').val(social_icon.id)
            $('#editTitle').val(social_icon.title)
            $('#editSocialIcon').val(social_icon.icon)
            $('#editUrl').val(social_icon.url)
            $('#editSocialIconModal').modal('show')
        },
    })
}

listenSubmit('#editSocialIconForm', function (event) {
    event.preventDefault()
    $('#editLeagueFormBtn').prop('disabled', true)
    let socialIconId = $('#socialIconId').val()
    $.ajax({
        url: route('social-icon.update', socialIconId),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editSocialIconModal').modal('hide')
                Livewire.emit('refresh')
                $('#editSocialIconFormBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editSocialIconFormBtn').prop('disabled', false)
        },
    })
})

listenClick('.social-icon-delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id')
    deleteItem(route('social-icon.destroy', recordId), 'Social Icon')
})
