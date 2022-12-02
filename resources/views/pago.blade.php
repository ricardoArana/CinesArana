<x-guest-layout>

    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
    </head>
    <div class="h-16"></div>
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif

    <div
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col text-center w-1/2 mx-auto justify-center items-center">
        <form role="form" action="{{ route('stripe.payment') }}" method="post" class="validation"
            data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
            @csrf
            @method('POST')
            <div class="mb-4" form-group required>
                <label class="block text-grey-darker text-sm font-bold mb-2" for="nombre">
                    Nombre y apellidos de la tarjeta
                </label>
                <input class="shadow appearance-none border rounded w-96 py-2 px-3 text-grey-darker" id="nombre"
                    type="text" placeholder="Nombre">
            </div>
            <div class="mb-6" form-group card required>
                <label class="block text-grey-darker text-sm font-bold mb-2" for="numero">
                    Número de la tarjeta
                </label>
                <input class="shadow appearance-none border border-red rounded w-96 py-2 px-3 text-grey-darker mb-3"
                    id="numero" type="numero" placeholder="Número">

            </div>

            <div class="mb-6 flex">
                <div class="mx-3" expiration required>
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="mes">
                        Mes de expiración
                    </label>
                    <input class="shadow appearance-none border border-red rounded w-32 py-2 px-3 text-grey-darker mb-3"
                        id="mes" type="mes" placeholder="mes">
                </div>
                <div class="mx-3" expiration required>
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="anyo">
                        Año de expiración
                    </label>
                    <input class="shadow appearance-none border border-red rounded w-32 py-2 px-3 text-grey-darker mb-3"
                        id="anyo" type="anyo" placeholder="año">
                </div>
                <div class="mx-3" form-group cvc required>
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="cvc">
                        CVC
                    </label>
                    <input class="shadow appearance-none border border-red rounded w-32 py-2 px-3 text-grey-darker mb-3"
                        id="cvc" type="cvc" placeholder="cvc">
                </div>

            </div>



            <div>
                <input type="submit"
                    class="bg-black mt-5 cursor-pointer hover:bg-[#2635da] px-7 py-3 text-2xl rounded text-white "
                    value="Pagar"> ({{ $total }}&euro;)
            </div>
        </form>
    </div>

    <div class="panel-body">


    </div>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {
            var $form = $(".validation");
            $('form.validation').bind('submit', function(e) {
                var $form = $(".validation"),
                    inputVal = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid = true;
                $errorStatus.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorStatus.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-num').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeHandleResponse);
                }

            });

            function stripeHandleResponse(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>

</x-guest-layout>
