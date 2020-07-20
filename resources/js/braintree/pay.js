document.addEventListener("DOMContentLoaded", function() {

    var form = document.querySelector('#payment-form');
    var client_token = document.querySelector('#client_token').value;

    var option1 = document.querySelector('#sponsorshipBasic');
    var option2 = document.querySelector('#sponsorshipMedium');
    var option3 = document.querySelector('#sponsorshipPremium');
    var amount  = document.querySelector('#amount');
    var sponsor_plan  = document.querySelector('#sponsor_plan');

    // Default values
    amount.value = option2.value;
    amount_preview.innerHTML = '€' + amount.value;
    sponsor_plan.value = 2;
    // End default values

    option1.onclick = function () {
        amount.value = option1.value;
        amount_preview.innerHTML = '€' + amount.value;
        sponsor_plan.value = 1;
    };

    option2.onclick = function () {
        amount.value = option2.value;
        amount_preview.innerHTML = '€' + amount.value;
        sponsor_plan.value = 2;
    };

    option3.onclick = function () {
        amount.value = option3.value;
        amount_preview.innerHTML = '€' + amount.value;
        sponsor_plan.value = 3;
    };

    braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
        paypal: {
            flow: 'vault'
        }
    }, function (createErr, instance) {
        
        if (createErr) {
            console.log('Create Error', createErr);
            return;
        }
        
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }	

                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
});