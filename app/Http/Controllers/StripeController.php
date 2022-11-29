<?php
namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Factura;
use App\Models\Linea;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;
class StripeController extends Controller
{
    /**
     * payment view
     */


    public function handleGet(Request $request)
    {
        return view('pago', [
            'total' => $request->total,
        ]);
    }

    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Making test payment."
        ]);

        return redirect()->route('dashboard')->with('success', 'Reserva realizada con exito.');
    }
}
