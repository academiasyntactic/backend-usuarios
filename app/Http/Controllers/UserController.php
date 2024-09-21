<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $EmailExiste = User::where('email', $request->email)->exists();

        if ($EmailExiste) return response()->json(['message' => "Ya existe un usuario con ese email"]);

        $passwordIsStrong = strlen($request->password);

        if ($passwordIsStrong < 8) return response()->json(["message" => "La contraseña debe tener una mayor longitud"]);


        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;

        $user->save();

        return response(["response" => "ok"], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['mensaje' => 'Usuario no encontrado']);
        }

        return response()->json(['mensaje' => 'Usuario encontrado!', 'data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
