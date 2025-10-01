document.addEventListener('turbo:load', loadTeam)

function loadTeam () {

    if (!$('#addTeamsModalBtn').length && !$('#editTeamsForm').length){
        return
    }
}

listenHiddenBsModal('#addTeamsModal', function (e) {
    $('#addTeamsForm')[0].reset()
    livewire.emit('refresh')
})

listenClick('#addTeamsModalBtn', function () {
    $('#addTeamsModal').modal('show').appendTo('body')
})

listenSubmit('#addTeamsForm', function (e) {
    e.preventDefault()
    $('#teamsAddBtn').prop('disabled', true)
    $.ajax({
        url: route('teams.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                livewire.emit('refresh')
                $('#addTeamsModal').modal('hide')
                $('#teamsAddBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#teamsAddBtn').prop('disabled', false)
        },
    })
})

listenClick('.teams-edit-btn', function (event) {
    let editTeamsId = $(event.currentTarget).data('id')
    renderData(editTeamsId)
})

function renderData (id) {
    $.ajax({
        url: route('teams.edit', id),
        type: 'GET',
        success: function (result) {
            let teams = result.data
            $('#teamsId').val(teams.id)
            $('#editTeamsName').val(teams.name)
            $('#editTeamImagePreview').
            css('background-image',
                'url("' + result.data.team_logo + '")')
            if (teams.status == 1) {
                $('#editTeamsStatus').prop('checked', true)
            } else {
                $('#editTeamsStatus').prop('checked', false)
            }
            $('#editTeamsModal').modal('show')
        },
    })
}

listenSubmit('#editTeamsForm', function (event) {
    event.preventDefault()
    $('#editTeamsFormBtn').prop('disabled', true)
    let teamsId = $('#teamsId').val()
    $.ajax({
        url: route('teams.update', teamsId),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editTeamsModal').modal('hide')
                Livewire.emit('refresh')
                $('#editTeamsFormBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editTeamsFormBtn').prop('disabled', false)
        },
    })
})

listenClick('.teams-change-status', function (event) {
    let teamsID = $(event.currentTarget).data('id')
    $.ajax({
        type: 'PUT',
        url: route('teams.change.status',teamsID),
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('.teams-delete-btn', function (event) {
    let recordId = $(event.currentTarget).attr('data-id');
    deleteItem(route('teams.destroy', recordId), 'Team')
})
