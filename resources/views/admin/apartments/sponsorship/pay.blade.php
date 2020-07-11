@extends('layouts.app')

@section('content')
<div class="container text-center">
<h3>Ciao {{ Auth::user()->first_name }}, rendi il tuo annuncio più accattivante e fai in modo che lo vedano più persone!</h3>

 
<h4>Scegli il tuo piano di sponsorizzazione per il tuo <strong>{{ $apartment->title }}</strong> situato in {{ $apartment->address }} a {{ $apartment->city }}</h4>

<div class="btn-group d-flex justify-content-center mt-4">
	<div class="form-check ">
    	<input class="" type="radio" name="exampleRadios" id="exampleRadios1" value="2.99">
    	<label class="btn btn-secondary" for="exampleRadios1">
      		2,99 € per 24 ore di sponsorizzazione
    	</label>
  	</div>
  
  	<div class="form-check">
    	<input class="" type="radio" name="exampleRadios" id="exampleRadios2" value="5.99" checked>
    	<label class="btn btn-secondary" for="exampleRadios2">
      		5.99 € per 72 ore di sponsorizzazione
    	</label>
  	</div>
  
  	<div class="form-check">
    	<input class="" type="radio" name="exampleRadios" id="exampleRadios3" value="9.99">
    	<label class="btn btn-secondary" for="exampleRadios3">
      		9.99 € per 144 ore di sponsorizzazione
    	</label>
  	</div>
</div>

<?php
	$gateway = new Braintree\Gateway([
		'environment' => getenv('BT_ENVIRONMENT'),
		'merchantId' => getenv('BT_MERCHANT_ID'),
		'publicKey' => getenv('BT_PUBLIC_KEY'),
		'privateKey' => getenv('BT_PRIVATE_KEY')
	]);
?>

<div class="wrapper">
	<div class="checkout container">
    	<form method="post" id="payment-form" action="{{  route('admin.apartments.sponsorship.checkout', ['apartment' => $apartment]) }}"">
        	@csrf
        	@method('post')
          	<section>
            	<label for="amount">
                  	<div class="input-wrapper amount-wrapper">
						<input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="" style="display:none">
						<h1 id="amount_preview" class="mt-4">€ 5.99</h1>
                  	</div>
              	</label>

            	<div class="bt-drop-in-wrapper">
                	<div id="bt-dropin"></div>
              	</div>
          	</section>

          	<input id="nonce" name="payment_method_nonce" type="hidden" />
          	<input id="sponsor_plan" name="sponsor_plan" type="hidden" value="" />
          	<button class="btn btn-success" type="submit"><span>Paga e avvia la sponsorizzazione</span></button>
      	</form>
  	</div>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>
<script>

	document.addEventListener("DOMContentLoaded", function() {

		var form = document.querySelector('#payment-form');
		var client_token = "<?php echo($gateway->ClientToken()->generate()); ?>";

		var option1 = document.querySelector('#exampleRadios1');
		var option2 = document.querySelector('#exampleRadios2');
		var option3 = document.querySelector('#exampleRadios3');
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
</script>
  
@endsection