document.addEventListener('turbo:load', loadTeamMatch)

function loadTeamMatch () {

    if (!$('#addTeamMatchModalBtn').length && !$('#editTeamMatchForm').length){
        return
    }
}

listenHiddenBsModal('#addTeamMatchModal', function (e) {
    $('#addTeamMatchForm')[0].reset()
    livewire.emit('refresh')
})

listenClick('#addTeamMatchModalBtn', function () {
    $('#addTeamMatchModal').modal('show').appendTo('body')
})

listenSubmit('#addTeamMatchForm', function (e) {
    e.preventDefault()
    $('#teamsAddBtn').prop('disabled', true)
    $.ajax({
        url: route('team-matches.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                livewire.emit('refresh')
                $('#addTeamMatchModal').modal('hide')
                $('#teamMatchAddBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#teamMatchAddBtn').prop('disabled', false)
        },
    })
})

listenClick('.teams-edit-btn', function (event) {
    let editTeamMatchId = $(event.currentTarget).data('id')
    renderData(editTeamMatchId)
})

function renderData (id) {
    $.ajax({
        url: route('team-matches.edit', id),
        type: 'GET',
        success: function (result) {
            let teams = result.data
            $('#teamMatchId').val(teams.id)
            $('#editTeamMatchName').val(teams.name)
            $('#editTeamMatchModal').modal('show')
        },
    })
}

listenSubmit('#editTeamMatchForm', function (event) {
    event.preventDefault()
    $('#editTeamMatchFormBtn').prop('disabled', true)
    let teamMatchId = $('#teamMatchId').val()
    $.ajax({
        url: route('team-matches.update', teamMatchId),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editTeamMatchModal').modal('hide')
                Livewire.emit('refresh')
                $('#editTeamMatchFormBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editTeamMatchFormBtn').prop('disabled', false)
        },
    })
})

listenClick('.team-match-delete-btn', function (event) {
    let recordId = $(event.currentTarget).attr('data-id');
    deleteItem(route('team-matches.destroy', recordId), 'Team')
})
