@extends('layouts.app')

@section('content')
<div class="container text-center">
<h3>Ciao {{ Auth::user()->first_name }}, rendi il tuo annuncio più accattivante e fai in modo che lo vedano più persone!</h3>

 
<h4>Scegli il tuo piano di sponsorizzazione per il tuo {{}} in via/corso {{}}</h4>

    <div class="btn-group d-flex justify-content-center">
        <div class="form-check ">
            <input class="" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
            <label class="btn btn-secondary" for="exampleRadios1">
                2,99 € per 24 ore di sponsorizzazione
            </label>
          </div>
          <div class="form-check">
            <input class="" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
            <label class="btn btn-secondary" for="exampleRadios2">
                5.99 € per 72 ore di sponsorizzazione
            </label>
          </div>
          <div class="form-check">
            <input class="" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
            <label class="btn btn-secondary" for="exampleRadios3">
                9.99 € per 144 ore di sponsorizzazione
            </label>
          </div>
          
    </div>
    <input type="submit" value="Submit">
        
  </div>
    

  
@endsection