<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;

class UsuController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profile.edit-profile', compact('user'));
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
        $usuario = User::findOrFail($id);

            $leve=[
                    'email' => ['required', 'string', 'email', 'max:100'],
                    'edad'=>'required|digits:2|integer',
                    'fecha_nac'=>'required',
                    'sexo'=>'required|string'];

            $estricto=[
                'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
                'edad'=>'required|digits:2|integer',
                'fecha_nac'=>'required',
                'sexo'=>'required|string'];



            if ($request->email == $usuario->email) {
                $request->validate($leve);
            } else {
                $request->validate($estricto);
            }

            //actualiza solo el modelo user
            $usuario->email=$request->email;
            $usuario->save();

            //actualiza solo el modelo profile
            $usuario->profile->update($request->only("edad","sexo","fecha_nac"));

        return redirect()->route('usuario.perfil.edit',$usuario->id)->with('msg','El usuario ha sido modificado correctamente');
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
