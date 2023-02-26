document.addEventListener('turbo:load', loadOptions)

function loadOptions () {
    
}

listenHiddenBsModal('#addOptionsModal', function () {
    $('#addOptionForm')[0].reset()
    livewire.emit('refresh')
})

listenClick('#addOptionModalBtn', function () {
    $('#addOptionsModal').modal('show').appendTo('body')
})

listenSubmit('#addOptionForm', function (e) {
    e.preventDefault()
    $('#optionAddBtn').prop('disabled', true)
    $.ajax({
        url: route('option.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                livewire.emit('refresh')
                $('#addOptionsModal').modal('hide')
                $('#optionAddBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#optionAddBtn').prop('disabled', false)
        },
    })
})

listenClick('.option-edit-btn', function (event) {
    let editOptionId = $(event.currentTarget).data('id')
    renderOptionData(editOptionId)
})

function renderOptionData (id) {
    $.ajax({
        url: route('option.edit', id),
        type: 'GET',
        success: function (result) {
            let optionData = result.data
            $('#optionId').val(optionData.id)
            $('#editOptionName').val(optionData.name)
            $('#editOptionDividend').val(optionData.dividend)
            $('#editOptionDivisor').val(optionData.divisor)
            if (optionData.status == 1) {
                $('#editOptionStatus').prop('checked', true)
            } else {
                $('#editOptionStatus').prop('checked', false)
            }
            $('#editOptionModal').modal('show')
        },
    })
}

listenSubmit('#editOptionForm', function (event) {
    event.preventDefault()
    $('#editOptionFormBtn').prop('disabled', true)
    let optionId = $('#optionId').val();
    console.log(optionId)
    $.ajax({
        url: route('option.update', optionId),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editOptionModal').modal('hide')
                Livewire.emit('refresh')
                $('#editOptionFormBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editOptionFormBtn').prop('disabled', false)
        },
    })
})

listenClick('.back-btn', function (e){
    e.preventDefault();
    window.history.back();
});


listenClick('.option-change-status', function (event) {
    let optionId = $(event.currentTarget).data('id')
    $.ajax({
        type: 'PUT',
        url: route('option-status-change', optionId),
        data: { id: optionId },
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})
