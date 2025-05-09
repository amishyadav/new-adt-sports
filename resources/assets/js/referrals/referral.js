document.addEventListener('turbo:load', loadReferrals)

function loadReferrals () {
   
}

listenClick('#generateReferralLevel', function () {
    let levelID = $(this).attr('data-id');
    let level = $('.referralLevelGenerate'+levelID).val();
    if (level > 0){
        $('.referralLevelForm'+levelID).removeClass('d-none');
        $(".generateReferralLevelContainer"+levelID).html("");
        for (let i = 1; i <= level; i++) {
            $('.generateReferralLevelContainer'+levelID).append(`
    <div class="input-group mt-4 referral-level${i+levelID}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text no-right-border">LEVEL</span>
                                            </div>
                                            <input name="level[]" class="form-control referral-current-level" type="number" readonly value="${i}" required placeholder="Level" data-id="${i}">
                                            <input name="commission[]" class="form-control margin-top-10" type="number" step=".01" required="" placeholder="Commission Percentage %">
                                            <div class="input-group-append bg-red-500">
                                                <button class="btn btn-danger margin-top-10 delete-referral-level" data-id="${i+levelID}" type="button"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
    `)
        }
    }
})


listenClick('.referrals-deposit-status', function (event) {
    let referralID = $(event.currentTarget).data('id')
    $.ajax({
        type: 'PUT',
        url: route('referrals.change.status', referralID),
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('.delete-referral-level', function (event) {
    let referralID = $(event.currentTarget).data('id')
    $('.referral-level'+referralID).remove();
})
