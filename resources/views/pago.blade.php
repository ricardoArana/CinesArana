
 <!DOCTYPE html>
<html>
<head>
    <title>Pago con tarjeta</title>
    <link rel="icon" href="{{ URL('img/icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<style type="text/css">
    h2{
        margin:80px auto;
    }
</style>
<body style="background-image: url({{URL('img/cineFondo.jpg')}});">
    <a href="{{ route('reserva', [$proyeccion]) }}"><h3 style="color:white; background-color: rgb(31, 31, 31); cursor: pointer; padding-top: 8px; padding-bottom: 10px; width: 150px"><img src="{{ URL('img/volver.png') }}" alt="icono de volver" style="display: inline; margin-left: 15px;margin-right: 15px; width: 25px; height: 25px;"> Volver</h3></a>
<div class="container">

    <h2 class="text-center" style="color:white; background-color: rgb(31, 31, 31); padding-top: 10px; padding-bottom: 10px">Paga con tarjeta de crédito tus entradas:</h2>

    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <h3 class="panel-title text-center"><strong>Detalles del pago</strong></h3>
                </div>
                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                        <form
                            role="form"
                            action="{{ route('stripe.payment') }}"
                            method="post"
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Nombre en la tarjeta</label>
                                <input class='form-control' size='4' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Número de la tarjeta</label>
                                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Mes de expiración</label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Año de expiración</label>
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Por favor corrija los errores e intente de nuevo.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <input hidden type="text" value="{{$asientos}}" id="asientosPOST" name="asientos">
                                <input hidden type="text" value="{{ $proyeccion->pelicula->id }}" name="pel_id">
                                <input hidden type="text" value="{{ $proyeccion->cine->id }}" name="cine_id">
                                <input hidden type="text" value="{{ $proyeccion->sala }}" name="sala">
                                <input hidden type="text" value="{{ $proyeccion->hora_inicio }}" name="hora_inicio">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pagar Reserva ({{$total}}&euro;)</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@php
    $asientos = explode(",", $asientos);
@endphp
<div style="background-color:black; opacity:97%; color:white; padding-top: 10px; margin: 200px 5px 10px 5px;" id="mostrarReserva">
    <div class="lg:flex lg:justify-between mt-20 pb-12 mx-auto mb-10" style="display: flex; justify-content: space-between">
        <div class="h-auto w-[60%] xl:w-[25%] lg:ml-[10%] xl:ml-40 ml-[10%]" style="width: 50%">
            <img style="border: 5px solid white; height: 500px; width; auto; margin:10%" class="h-auto w-[100%]" src="{{ URL($proyeccion->pelicula->url) }}" alt="imagen de la pelicula">
        </div>
        <div class="h-96 lg:w-1/2 mt-10  lg:mr-44 ml-[10%] text-xl text-left" style="text-align: left; width: 50%; margin-top:10%; font-size: 2.25rem">
            <p class="text-3xl pb-3"><b>{{ $proyeccion->cine->nombre }}</b>
                ({{ $proyeccion->cine->localidad->nombre }})
            </p>
            <p class="text-2xl"> Ha seleccionado {{ count($asientos) }} asientos en este cine</p>
            <p class="text-xl my-4"> Hora de inicio: {{ $proyeccion->hora_inicio }} </p>


                <p> <b> Asientos: </b><br>

                    @foreach ($asientos as $asiento)
                        <span style="margin-right: 2%"> Fila: {{floor($asiento/16)+1}}</span> Asiento: {{$asiento%16+1}}<br>
                    @endforeach
                </p>
                <p style="margin-top:60px; font-size: 1.9rem">Precio: {{$total}} &euro;</p>

</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">

$(function() {

    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });

        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }

    });

    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
</html>
