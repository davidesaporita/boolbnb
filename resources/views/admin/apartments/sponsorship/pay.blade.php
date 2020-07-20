@extends('layouts.app')

@section('content')
<div class="container text-center">

<h3>Ciao {{ Auth::user()->first_name }}, rendi il tuo annuncio più accattivante e fai in modo che lo vedano più persone!</h3>

 
<h4>Scegli il tuo piano di sponsorizzazione per il tuo <strong>{{ $apartment->title }}</strong> situato in {{ $apartment->address }} a {{ $apartment->city }}</h4>

<div class="btn-group d-flex justify-content-center mt-4">
	<div class="form-check ">
    	<input class="" type="radio" name="sponsorshipRadios" id="sponsorshipBasic" value="2.99">
    	<label class="btn btn-secondary" for="sponsorshipBasic">
      		2,99 € per 24 ore di sponsorizzazione
    	</label>
  	</div>
  
  	<div class="form-check">
    	<input class="" type="radio" name="sponsorshipRadios" id="sponsorshipMedium" value="5.99" checked>
    	<label class="btn btn-secondary" for="sponsorshipMedium">
      		5.99 € per 72 ore di sponsorizzazione
    	</label>
  	</div>
  
  	<div class="form-check">
    	<input class="" type="radio" name="sponsorshipRadios" id="sponsorshipPremium" value="9.99">
    	<label class="btn btn-secondary" for="sponsorshipPremium">
      		9.99 € per 144 ore di sponsorizzazione
    	</label>
  	</div>
</div>

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
			  
          	<input id="client_token" name="client_token" type="hidden" value="{{ $client_token }}"/>
          	<input id="nonce" name="payment_method_nonce" type="hidden" />
          	<input id="sponsor_plan" name="sponsor_plan" type="hidden" value="" />
          	<button class="btn btn-success" type="submit"><span>Paga e avvia la sponsorizzazione</span></button>
      	</form>
  	</div>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>
<script src="{{ asset('js/braintree/pay.js') }}"></script>
  
@endsection