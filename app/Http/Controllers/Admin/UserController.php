<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.create')->only('create','store');
        $this->middleware('can:admin.users.edit')->only('update','edit');
        $this->middleware('can:admin.users.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
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
    public function edit(User $user)
    {

        $roles = Role::select()->where("name","<>","doctor")->get();
        return view('admin.users.edit', compact('user','roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, User $user)
    {


            $leve=[
                'nombre'=>'required|string',
                'email' =>'required|string|email|max:100',
                'apellido'=>'required|string',
                'edad'=>'required|digits:2|integer',
                'fecha_nac'=>'required',
                'sexo'=>'required|string'];

            $estricto=[
                'nombre'=>'required|string',
                'email' =>'required|string|email|max:100|unique:users',
                'apellido'=>'required|string',
                'edad'=>'required|digits:2|integer',
                'fecha_nac'=>'required',
                'sexo'=>'required|string'];



        if ($request->email == $user->email) {
            $request->validate($leve);
        } else {
            $request->validate($estricto);
        }



        //actualiza solo el modelo user
        $user->update(['name'=>$request->nombre,'email'=>$request->email]);

        //actualiza solo el modelo profile
        $user->profile->update($request->only("nombre","apellido","edad","sexo","fecha_nac"));




        //ACTUALIZACION DE LOS ROLES-------------------------------------------------------
        if($user->doctor){
            //"si es doctor";
            $rol = Role::select()->where("name","doctor")->first(); // obtenemos el id del rol doctor

            $array = array(strval($rol["id"]));      //convertimos a string



            if($request->roles==null){              // si llegan datos vacios de roles, solo sincronizamos con el doctor
                $user->roles()->sync($array);

            } else{
                $roles = array_merge($request->roles,$array);   //unificamos los datos con doctor y los nuevos roles
                $user->roles()->sync($roles);
            }
        }


        else{
            //"si no es doctor"; hace el procedimiento normal de asignacion de roles de manera normal
                $user->roles()->sync($request->roles);  //admin 1 - doctor 2
        }




       return redirect()->route('admin.users.edit',$user)->with('msg','El usuario ha sido modificado correctamente');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index',$user)->with('mensaje','ok');
    }
}
