document.addEventListener('turbo:load', loadLeague)

function loadLeague () {
    $('#leagueIconPicker').iconpicker();
    $('#editLeagueIconPicker').iconpicker();
}

listenHiddenBsModal('#addLeagueModal', function (e) {
    $('#addLeagueForm')[0].reset()
    livewire.emit('refresh')
})

listenClick('#addLeagueModalBtn', function () {
    $('#addLeagueModal').modal('show').appendTo('body')
})

listenClick('.btn-icon', function () {
    let iconValue =  $(this).val();
   $('#iconValue').attr('value',iconValue);
    $('#editLeagueIcon').val(iconValue);
})

listenSubmit('#addLeagueForm', function (e) {
    e.preventDefault()
    $('#leagueAddBtn').prop('disabled', true)
    $.ajax({
        url: route('leagues.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                livewire.emit('refresh')
                $('#addLeagueModal').modal('hide')
                $('#leagueAddBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#leagueAddBtn').prop('disabled', false)
        },
    })
})

listenClick('.league-edit-btn', function (event) {
    let editLeagueId = $(event.currentTarget).data('id')
    renderData(editLeagueId)
})

function renderData (id) {
    $.ajax({
        url: route('leagues.edit', id),
        type: 'GET',
        success: function (result) {
            let league = result.data
            $('#leagueId').val(league.id)
            $('#editLeagueName').val(league.name)
            $('#editLeagueIcon').val(league.icon)
            if (league.category_id) {
                $('#editCategoryDropdown').val(league.category_id).prop('checked', true)
            }
            if (league.status == 1) {
                $('#editLeagueStatus').prop('checked', true)
            } else {
                $('#editLeagueStatus').prop('checked', false)
            }
            $('#editLeagueModal').modal('show')
        },
    })
}

listenSubmit('#editLeagueForm', function (event) {
    event.preventDefault()
    $('#editLeagueFormBtn').prop('disabled', true)
    let categoryId = $('#leagueId').val()
    $.ajax({
        url: route('leagues.update', categoryId),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editLeagueModal').modal('hide')
                Livewire.emit('refresh')
                $('#editLeagueFormBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editLeagueFormBtn').prop('disabled', false)
        },
    })
})

listenClick('.league-change-status', function (event) {
    let categoryID = $(event.currentTarget).data('id')
    $.ajax({
        type: 'PUT',
        url: route('leagues.change.status',categoryID),
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('.league-delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id')
    deleteItem(route('leagues.destroy', recordId), 'League')
})
