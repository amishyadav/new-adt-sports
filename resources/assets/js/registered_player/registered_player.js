document.addEventListener('turbo:load', loadRegisteredPlayer)

function loadRegisteredPlayer () {

    if (!$('#addRegisteredPlayerModalBtn').length && !$('#editRegisteredPlayerForm').length){
        return
    }
}

listenHiddenBsModal('#addRegisteredPlayerModal', function (e) {
    $('#addRegisteredPlayerForm')[0].reset()
    livewire.emit('refresh')
})

listenClick('#addRegisteredPlayerModalBtn', function () {
    $('#addRegisteredPlayerModal').modal('show').appendTo('body')
})

listenSubmit('#addRegisteredPlayerForm', function (e) {
    e.preventDefault()
    $('#RegisteredPlayerAddBtn').prop('disabled', true)
    $.ajax({
        url: route('registered-players.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                livewire.emit('refresh')
                $('#addRegisteredPlayerModal').modal('hide')
                $('#RegisteredPlayerAddBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#RegisteredPlayerAddBtn').prop('disabled', false)
        },
    })
})

listenClick('.registered-player-edit-btn', function (event) {
    let editRegisteredPlayerId = $(event.currentTarget).attr('data-id')
    console.log(editRegisteredPlayerId)
    renderData(editRegisteredPlayerId)
})

function renderData (id) {
    $.ajax({
        url: route('registered-players.edit', id),
        type: 'GET',
        success: function (result) {
            let RegisteredPlayer = result.data
            $('#RegisteredPlayerId').val(RegisteredPlayer.id)
            $('#editRegisteredPlayerName').val(RegisteredPlayer.user.unique_code)
            if (RegisteredPlayer.status == 1) {
                $('#editRegisteredPlayerStatus').prop('checked', true)
            } else {
                $('#editRegisteredPlayerStatus').prop('checked', false)
            }
            $('#editRegisteredPlayerModal').modal('show')
        },
    })
}

listenSubmit('#editRegisteredPlayerForm', function (event) {
    event.preventDefault()
    $('#editRegisteredPlayerFormBtn').prop('disabled', true)
    let RegisteredPlayerId = $('#RegisteredPlayerId').val()
    $.ajax({
        url: route('registered-players.update', RegisteredPlayerId),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editRegisteredPlayerModal').modal('hide')
                Livewire.emit('refresh')
                $('#editRegisteredPlayerFormBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editRegisteredPlayerFormBtn').prop('disabled', false)
        },
    })
})

listenClick('.registered-player-change-status', function (event) {
    let RegisteredPlayerID = $(event.currentTarget).attr('data-id')
    $.ajax({
        type: 'PUT',
        url: route('registered-players.change.status',RegisteredPlayerID),
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('.registered-player-delete-btn', function (event) {
    let recordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('registered-players.destroy', recordId), 'RegisteredPlayer')
})
