document.addEventListener('turbo:load', loadSmsGatewaysData);

function loadSmsGatewaysData () {

    if ($('#sendSmsMethod option:selected').val() == 1) {
        $('.nexmo').removeClass('d-none');
    }
    if ($('#sendSmsMethod option:selected').val() == 2) {
        $('.twilio').removeClass('d-none');
    }

}
listenChange('#sendSmsMethod', function () {

    let sendEmailMethod = $('#sendSmsMethod option:selected').val();
    
    if (sendEmailMethod == 1) {
        $('.nexmo').removeClass('d-none')
        $('.twilio').addClass('d-none')
    }
    if (sendEmailMethod == 2) {
        $('.twilio').removeClass('d-none')
        $('.nexmo').addClass('d-none')
    }
})

listenHiddenBsModal('#sendTestMessageModel', function (e) {
    $('#sendTestMessageForm')[0].reset()
    livewire.emit('refresh')
})

listenClick('.sendTestSmsBtn', function () {
    $('#sendTestMessageModel').modal('show').appendTo('body')
})
