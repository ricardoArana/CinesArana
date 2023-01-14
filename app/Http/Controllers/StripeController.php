<?php
namespace App\Http\Controllers;

use App\Models\Proyeccion;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;
class StripeController extends Controller
{
    /**
     * payment view
     */


    public function handleGet(Request $request, Proyeccion $proyeccion)
    {

        if (empty(Auth::user())) {
            return redirect('/')->with('error', 'Para reservar debes iniciar sesión');
        }

        $sala = $request->input('sala');
        $hora_inicio = $request->input('hora_inicio');
        $pel_id = $request->input('pel_id');
        $cine_id = $request->input('cine_id');
        $asientos = $request->input('asientos');

        //selecciono el usuario actual
/*         $user = Auth::user(); */
$asientosArray = explode(",", $asientos);
        //Hago tantas reservas como asientos haya
/*         for ($i = 0; $i < sizeof($asientosArray); $i++) {
            $reserva = Reserva::create([
                'user_id' => $user->id,
                'cine_id' => $validado['cine_id'],
                'pelicula_id' => $validado['pel_id'],
                'hora_inicio' => $validado['hora_inicio'],
                'sala' => $validado['sala'],
                'asiento' => $asientosArray[$i]
            ]);
            $reserva->save();
        } */

        return view('pago', [
            'total' => count($asientosArray) * 7,
            'sala' => $sala,
            'hora_inicio' => $hora_inicio,
            'pel_id' => $pel_id,
            'cine_id' => $cine_id,
            'asientos' => $asientos,
            'proyeccion' => $proyeccion,
        ]);
    }

    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {

        if (empty(Auth::user())) {
            return redirect('/')->with('error', 'Para reservar debes iniciar sesión');
        }

        $sala = $request->input('sala');
        $hora_inicio = $request->input('hora_inicio');
        $pel_id = $request->input('pel_id');
        $cine_id = $request->input('cine_id');
        $asientos = $request->input('asientos');

        $asientosArray = explode(",", $asientos);

 //Hago tantas reservas como asientos haya
        for ($i = 0; $i < sizeof($asientosArray); $i++) {
            $reserva = Reserva::create([
                'user_id' => Auth::user()->id,
                'cine_id' => $cine_id,
                'pelicula_id' => $pel_id,
                'hora_inicio' => $hora_inicio,
                'sala' => $sala,
                'asiento' => $asientosArray[$i]
            ]);
            $reserva->save();
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from LaravelTus.com."
        ]);

        return redirect()->route('inicio')->with('success', 'Reserva realizada con exito.');
    }
}
