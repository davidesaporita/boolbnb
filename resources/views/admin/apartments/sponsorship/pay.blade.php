@extends('layouts.app')

@section('content')

<div class="wrap-payment-container">
	<header class="container">
		<h3>Ciao <span>{{ Auth::user()->first_name }}</span>, rendi il tuo annuncio più accattivante e fai in modo che lo vedano più persone!</h3>
		<h4>Scegli il tuo piano di sponsorizzazione per il tuo <span>{{ $apartment->title }}</span> situato in <span>{{ $apartment->address }}</span> a <span>{{ $apartment->city }}</span></h4>
	</header>

	<div class="payment-action container">
		<div class="payment-button-container">
			<div class="payment-card">
				<section class="payment-card-header payment-color-basic">
					<h5>Basic</h5>
				</section>
				<section class="payment-card-main">
					<span class="bold">
						24 ore di sponsorizzazione
					</span>
					<span>2,99 €</span>
				  	<input class="" type="radio" name="sponsorshipRadios" id="sponsorshipBasic" value="2.99">
				</section>	
			</div>
		  
			<div class="payment-card">
				<section class="payment-card-header payment-color-medium">
					<h5>Medium</h5>
				</section>
				<section class="payment-card-main">
					<span class="bold">
						72 ore di sponsorizzazione
					</span>
					<span>5.99 €</span>
					<input class="" type="radio" name="sponsorshipRadios" id="sponsorshipMedium" value="5.99" checked>
				</section>		
			</div>
		  
			<div class="payment-card">
				<section class="payment-card-header payment-color-premium">
					<h5>Premium</h5>
				</section>
				<section class="payment-card-main">
					<span class="bold">
						144 ore di sponsorizzazione
					</span>
					<span>9.99 €</span>
					<input class="" type="radio" name="sponsorshipRadios" id="sponsorshipPremium" value="9.99">
				</section>
			</div>
		</div>
	</div>

	<div class="payment-checkout checkout">
		<form method="post" id="payment-form" class="payment-checkout-form container" action="{{  route('admin.apartments.sponsorship.checkout', ['apartment' => $apartment]) }}"">
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
			<button class="btn btn-success btn-pay" type="submit">
				<span>Paga e avvia la sponsorizzazione</span>
			</button>
		</form>
	</div>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>
<script src="{{ asset('js/braintree/pay.js') }}"></script>
  
@endsection