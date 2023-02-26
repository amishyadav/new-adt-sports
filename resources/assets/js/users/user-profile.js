listenClick('#changeLanguage', function () {
    $('#changeLanguageModal').modal('show').appendTo('body')
})

listenClick('#languageChangeBtn', function () {
    let language = $('#selectLanguage').val()

    $.ajax({
        url: route('change-language'),
        type: 'POST',
        data: {
            'language': language,
        },
        success: function (result) {
            $('#changeLanguageModal').modal('hide')
            displaySuccessMessage(result.message)
            setTimeout($.proxy(function () {
                Turbo.visit(window.location.href)
            }, this), 3000)
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})
