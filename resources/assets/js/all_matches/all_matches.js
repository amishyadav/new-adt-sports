document.addEventListener('turbo:load', loadAllMatches)

function loadAllMatches () {
    let startFrom = '.start-from'
    let endAt = '.end-at'

    if (!$(startFrom).length) {
        return
    }
    if (!$(endAt).length) {
        return
    }
    let lang = $('.currentLanguage').val()
    $(startFrom).flatpickr({
        'locale': lang,
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
    })
    $(endAt).flatpickr({
        'locale': lang,
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
    })
}

listenHiddenBsModal('#addMatchModal', function () {
    $('#addMatchForm')[0].reset()
    livewire.emit('refresh')
})

listenClick('#addMatchModalBtn', function () {
    $('#addMatchModal').modal('show').appendTo('body')
})

listenSubmit('#addMatchForm', function (e) {
    e.preventDefault()
    $('#matchAddBtn').prop('disabled', true)
    $.ajax({
        url: route('all-matches.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                livewire.emit('refresh')
                $('#addMatchModal').modal('hide')
                $('#matchAddBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#matchAddBtn').prop('disabled', false)
        },
    })
})

listenClick('.match-edit-btn', function (event) {
    let editMatchId = $(event.currentTarget).data('id')
    renderMatchData(editMatchId)
})

function renderMatchData (id) {
    $.ajax({
        url: route('all-matches.edit', id),
        type: 'GET',
        success: function (result) {
            let match = result.data
            $('#matchId').val(match.id)
            $('#editMatchTitle').val(match.match_title)
            if (match.league_id) {
                $('#editLeagueDropdown').
                    val(match.league_id).
                    prop('checked', true)
            }
            $('#editStartFrom').val(match.start_from)
            // let start_from = match.start_from
            // flatpickr('#editStartFrom', { start_from })
            $('#editEndAt').val(match.end_at)
            // let end_at = match.end_at
            // flatpickr('#editEndAt', { end_at })
            $('#editMatchModal').modal('show')
        },
    })
}

listenSubmit('#editMatchForm', function (event) {
    event.preventDefault()
    $('#editMatchFormBtn').prop('disabled', true)
    let matchId = $('#matchId').val()
    $.ajax({
        url: route('all-matches.update', matchId),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editMatchModal').modal('hide')
                Livewire.emit('refresh')
                $('#editMatchFormBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editMatchFormBtn').prop('disabled', false)
        },
    })
})

listenClick('.match-change-status', function (event) {
    let matchID = $(event.currentTarget).data('id')
    $.ajax({
        type: 'PUT',
        url: route('matches.change.status', matchID),
        data: { id: matchID },
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('.match-delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id')
    deleteItem(route('all-matches.destroy', recordId), 'Match')
})
