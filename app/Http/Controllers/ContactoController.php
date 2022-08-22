<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $contactos = Contacto::all();
        return response()->json($contactos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'cmessage' => 'required',
        ]);

        $contacto = new Contacto();
        $contacto->name = $request->name;
        $contacto->email = $request->email;
        $contacto->phone = $request->phone;
        $contacto->cmessage = $request->cmessage;

        $contacto->save();

        Mail::send(
            'contacto_email',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'cmessage' => $request->get('cmessage'),
            ),
            function ($menssage) use ($request) {
                $menssage->subject('Contacto Proyecto PIN'); //asunto
                $menssage->from($request->email);
                $menssage->to('hvonedelsberg@gmail.com');
            }

        );

        return response()->json([
            "message" => "Mensaje de contacto enviado.",
            'data' => $contacto
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contacto = Contacto::find($id);
        if (!empty($contacto)) {
            return response()->json($contacto);
        } else {
            return response()->json([
                'message' => "No encontrado",
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $contacto = Contacto::findOrFail($request->id);
        $contacto->name = $request->name;
        $contacto->email = $request->email;
        $contacto->phone = $request->phone;
        $contacto->message = $request->message;

        $contacto->save();

        return response()->json([
            "message" => "Actualizado.",
            'data' => $contacto
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Contacto::where('id', $request->id)->exists()) {
            $contacto = Contacto::find($request->id);
            $contacto->delete();

            return response()->json([
                "message" => "Borrado."
            ], 202);
        } else {
            return response()->json([
                "message" => "No encontrado."
            ], 404);
        }
    }
}
