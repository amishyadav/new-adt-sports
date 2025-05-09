listenClick('#addAmountm', function () {
    $('#createAmountModal').modal('show').appendTo('body')
})
listenSubmit('#addPaymentForm', function (e) {
    e.preventDefault()
    let paymentType = $('#paymentType').val()
    let payloadData = {

        amount: $('#totalAmount').val(),

    }
    let amount = $('#totalAmount').val()

    let stripes = 1
    let paypal = 2
    let razorpay = 3
    let paytm = 4
    let authorization = 6
    let paystack = 7

    if (paymentType == stripes) {
        $.post(route('user.add-payment'), payloadData).done((result) => {

            if (typeof result.data == 'undefined') {
                displaySuccessMessage(result.message)
                setTimeout(function () {
                    Turbo.visit(route('subscription.index'))
                }, 3000)

                return true
            }
            let sessionId = result.data.sessionId
            stripe.redirectToCheckout({
                sessionId: sessionId,
            }).then(function (result) {
                $(this).
                    html(Lang.get('messages.subscription.purchase')).
                    removeClass('disabled')
                $('.makePayment').attr('disabled', false)
                displaySuccessMessage(result.message)
            })
        }).catch(error => {
            $(this).
                html(Lang.get('messages.subscription.purchase')).
                removeClass('disabled')
            $('.makePayment').attr('disabled', false)
            displayErrorMessage(error.responseJSON.message)
        })
    }
    if (paymentType == razorpay) {
        $.ajax({
            type: 'POST',
            url: route('user.razorpay.init'),
            data: { 'payloadData': amount },
            success: function (result) {
                if (result.success) {

                    let { id, amount, name, email, contact } = result.data

                    options.amount = amount
                    options.order_id = id

                    let razorPay = new Razorpay(options)
                    console.log(razorPay)
                    razorPay.open()
                    razorPay.on('payment.failed', storeFailedPayment)
                }
            },
            error: function (result) {
            },
            complete: function () {
            },
        })
    }

    if (paymentType == paytm) {
        window.location.replace(
            route('paytm.init', { 'payloadData': amount }))
    }
    if (paymentType == authorization) {
        window.location.replace(route('user.authorize.init',
            { 'payloadData': amount }))
    }
    if (paymentType == paystack) {
        
        window.location.replace(
            route('user.paystack.init', { 'payloadData': amount }))
    }
})

function storeFailedPayment (response) {
    $.ajax({
        type: 'POST',
        url: route('razorpay.failed'),
        data: {
            data: response,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
            }
        },
        error: function () {
        },
    })
}

listenKeyup('#amount', function () {

    let amount = $(this).val()

    let taxRate = 18
    let tax = amount * taxRate / 100
    let total = parseFloat(amount) + parseFloat(tax)

    $('#totalAmount').val(total)
})
