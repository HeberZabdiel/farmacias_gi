<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\User;
use App\Models\Sucursal;
use App\Models\Sucursal_empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Auth\Events\Registered;

//use Illuminate\Auth\Notifications\VerifyEmail;
//use Illuminate\Notifications\Messages\MailMessage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('isEmpleado');
        
    }

    public function index()
    {
        $usuarios = ['verEmpleado','crearEmpleado','eliminarEmpleado','modificarEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        return view('Empleado.index2');
       
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(array $data)
    {
        $usuarios = ['crearEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        return view('Empleado.index2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //permisos para acceder a esta funcion
        $usuarios = ['crearEmpleado','admin'];
        $sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
        $sE->authorizeRoles($usuarios); 
        //validar datos del formulario
        $this->validator($request->all())->validate();
        $datosEmpleado = request()->except('_token','password_confirmation','username','password','email');//,'apellidos','contra2','correo');
        //$dato = ['status','alta'];
        //$datosEmpleado = Arr::add($datosEmpleado,'status','alta');
        $usuario = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'tipo' => 0,
        ]);
        //$user = User::latest('id')->first();
        $datosEmpleado = Arr::add($datosEmpleado,'idUsuario',$usuario->id);
        //$empleado = new Empleado;
        $empleado = Empleado::create($datosEmpleado);
        /*$SucursalEmpleado = new Sucursal_empleado;
        $SucursalEmpleado->idEmpleado = $empleado->id;
        $SucursalEmpleado->idSucursal = session('sucursal');
        $SucursalEmpleado->save();*/
        //Empleado::insert($datosEmpleado);
        event(new Registered($usuario));
        $editar = ['verEmpleado','modificarEmpleado','eliminarEmpleado','admin'];
        if($sE->hasAnyRole($editar))
        {
            return redirect('puntoVenta/empleado/'.$empleado->id.'/edit');
        }else{
            return redirect('puntoVenta/empleado');
        }
        
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'primerNombre' => ['required', 'string', 'max:30'],
            'segundoNombre' => ['max:30'],
                'apellidoPaterno' => ['required', 'string', 'max:30'],
                'apellidoMaterno' => ['required', 'string', 'max:30'],
            'genero' => ['required', 'string',],
            'fechaNacimiento' => ['required','date'],
            'entidadFederativa' => ['required','string'],
                'domicilio' => ['required', 'string', 'max:191'],
                'curp' => ['required', 'string', 'max:18','unique:empleados'],
                'telefono' => ['required', 'string', 'max:10'],
                'claveE' => ['required', 'string', 'max:5','unique:empleados'],
                'username' => ['required', 'string', 'max:255','unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show($id)//Empleado $empleado)
    {
        $usuarios = ['verEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        if($id == 'empleados')
        {
            return Empleado::all();
        }
        if($id)
        return NULL;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//Empleado $empleado)
    {
        //$datos['empleados'] = Departamento::paginate();
        $usuarios = ['verEmpleado','eliminarEmpleado','modificarEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        if($id == 1)
            return redirect('puntoVenta/empleado');
        if($id == 0)
        {
            $admin = User::findOrFail(1);
            $users = User::findOrFail(1);
            $sucursal = Sucursal::findOrFail(session('sucursal'));
            $admin->claveE = Empleado::findOrFail(1)->claveE;
            return view('Empleado.index2',compact('admin','sucursal','users'));
        }
        else{
            $datosEmpleado = Empleado::findOrFail($id);
            $users = User::where('id','=',$datosEmpleado->idUsuario)->first();
            return view('Empleado.index2',compact('datosEmpleado','users'));
        }
        //return $users;//compact('datosEmpleado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuarios = ['modificarEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        if($id == 0)
        {
            /*$rules = [
                'passwordChange' => ['required', 'string', 'min:8'],
            ];
            $mesages = [
                'passwordChange.required' => 'Por favor escriba su contraseña',
                'passwordChange.min' => 'La contraseña debe tener al menos 8 caracteres',
                
            ];*/
            $admin = User::findOrFail(1);
            $adminEmpleado = Empleado::findOrFail(1);
            $datosUser = [];
            if($request->input('username') != $admin->username)
                $datosUser = Arr::add($datosUser,'username',$request->input('username'));
            if($request->input('email') != $admin->email)
                $datosUser = Arr::add($datosUser,'email',$request->input('email'));
            if($request->input('claveE') != $adminEmpleado->claveE)
                $datosUser = Arr::add($datosUser,'claveE',$request->input('claveE'));
            $validacion =  Validator::make($datosUser, [
                'username' => ['string', 'max:255','unique:users','min:3'],
                'email' => ['string', 'email', 'max:255', 'unique:users','min:5'],
                'claveE' => ['string', 'max:5','unique:empleados','min:5'],
            ]);
            if($validacion->fails()):
                return back()->withErrors($validacion)->with( ['cambios' => true] )->withInput($request->all());
            endif;
            $validacion->validate();
            $datosUsuario = request()->only(['email','username']);
            $datosEmpleado = request()->only(['claveE']);
            $admin->update($datosUsuario);
            $adminEmpleado->update($datosEmpleado);
            return redirect('puntoVenta/empleado/'.$id.'/edit');
            //return 'NO TE PREOCUPES, AQUI CACHO EL ERROR';
        }
        if($request->has('status'))
        {
            Empleado::where('id','=',$id)->update(['status' => $request->input('status')]);
            return redirect('puntoVenta/empleado/'.$id.'/edit');
        }
        if($request->has('passwordChange'))
        {
            $rules = [
                'passwordChange' => ['required', 'string', 'min:8'],
            ];
            $mesages = [
                'passwordChange.required' => 'Por favor escriba su contraseña',
                'passwordChange.min' => 'La contraseña debe tener al menos 8 caracteres',
                
            ];
            
            $validator = Validator::make($request->all(), $rules, $mesages);
            
            if($validator->fails())
                return $validator->errors()->first();
            //return 'Si entra';
            /*if($validator->fails()):
                return back()->withErrors($validator)->with('message','Se ha producido un error')->with(
                    'typealert','danger');
            endif;*/
            User::where('id','=',$id)->update(['password' => Hash::make($request->input('passwordChange'))]);
            return;
            //return redirect('puntoVenta/empleado/'.$id.'/edit');
        }
        else
        {
            
            $datos = []; //$request->all();
            $empleado = Empleado::findOrFail($id);
            $user = User::where('id','=',$empleado->idUsuario)->first();
            if($request->input('nombre') != $empleado->nombre)
                $datos = Arr::add($datos,'nombre',$request->input('nombre'));
            if($request->input('apellidoPaterno') != $empleado->apellidoPaterno)
                $datos = Arr::add($datos,'apellidoPaterno',$request->input('apellidoPaterno'));
            if($request->input('apellidoMaterno') != $empleado->apellidoMaterno)
                $datos = Arr::add($datos,'apellidoMaterno',$request->input('apellidoMaterno'));
            if($request->input('domicilio') != $empleado->domicilio)
                $datos = Arr::add($datos,'domicilio',$request->input('domicilio'));
            if($request->input('curp') != $empleado->curp)
                $datos = Arr::add($datos,'curp',$request->input('curp'));
            if($request->input('email') != $user->email)
                $datos = Arr::add($datos,'email',$request->input('email'));
            if($request->input('telefono') != $empleado->telefono)
                $datos = Arr::add($datos,'telefono',$request->input('telefono'));
            if($request->input('claveE') != $empleado->claveE)
                $datos = Arr::add($datos,'claveE',$request->input('claveE'));
            if($request->input('username') != $user->username)
                $datos = Arr::add($datos,'username',$request->input('username'));
            //return 'Si llega hasta aqui';
            //$this->validator($request->all())->validate();
            
            $validacion =  Validator::make($datos, [
                'nombre' => ['string', 'max:30','min:3'],
                'apellidoPaterno' => ['string', 'max:30','min:3'],
                'apellidoMaterno' => ['string', 'max:30','min:3'],
                'domicilio' => ['string', 'max:191','min:3'],
                'curp' => ['string','min:18' ,'max:18','unique:empleados'],
                'telefono' => ['string', 'max:10','min:7'],
                'claveE' => ['string', 'max:5','unique:empleados','min:5'],
                'username' => ['string', 'max:255','unique:users','min:3'],
                'email' => ['string', 'email', 'max:255', 'unique:users','min:5'],
            ]);
            if($validacion->fails()):
                return back()->withErrors($validacion)->with( ['cambios' => true] )->withInput($request->all());
            endif;
            $validacion->validate();
            $datosEmpleado = request()->except(['_token','_method','email','username']);
            $datosUser = request()->only(['email','username']);
            Empleado::where('id','=',$id)->update($datosEmpleado);
            User::where('id','=',$user->id)->update($datosUser);
            return redirect('puntoVenta/empleado/'.$id.'/edit');
            //return $datos;
        }
        //'password' => Hash::make($request['password'])
        
        return 'No lo reconoce';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = ['eliminarEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        
        try{            
            $empleado = Empleado::findOrFail($id);
            $usuario = User::findOrFail($empleado->idUsuario); //destroy();
            Empleado::destroy($id);
            $usuario->delete();
            return true;
        }
        catch (\Illuminate\Database\QueryException $e)
        { 
            return false;//'ID'.$empleado->idUsuario;
        }
        //$dato = (['status'=>'baja']);;
        //Empleado::where('id','=',$id)->update($dato);
        //return $empleado->idUsuario;//redirect('puntoVenta/empleado');
    }

    public function buscadorEmpleado(Request $request)
    {
        $usuarios = ['verEmpleado','crearEmpleado','eliminarEmpleado','modificarEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $datosConsulta['empleados'] = Empleado::where("primerNombre",'like',"%".$request->texto."%")
        ->orWhere("segundoNombre",'like',"%".$request->texto."%")
        ->orWhere("apellidoPaterno",'like',"%".$request->texto."%")
        ->orWhere("apellidoMaterno",'like',"%".$request->texto."%")->orderBy('primerNombre')->get();
        $admin = User::findOrFail(1);
        //where("status",'=','alta')->orderBy('nombre')->get();
        return view('Empleado.empleados',$datosConsulta,compact('admin'));
        //return $datosConsulta;
    }
    public function validarClave($clave)
    {
        $usuarios = ['crearEmpleado','modificarEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $empleado = Empleado::where('claveE','=',$clave)->get();
        if(count($empleado)>0)
            return false;
        return true;
    }
    protected function validarEmpleado($clave)
    {
        //$usuarios = ['crearEmpleado','modificarEmpleado','crearVenta','admin'];
        //Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $empleado = Empleado::where('claveE','=',$clave)->get();
        
        if(count($empleado)>0)
        {
            $sE = Sucursal_empleado::where('idEmpleado','=',$empleado->first()->id)
            ->where('idSucursal','=',session('sucursal'))->get();
            if(count($sE))
            {
                return $sE->first()->id;
            }
            return false;
        }
        return false;
    }
    public function editarEmpleado(Request $request, $id)
    {
        $usuarios = ['modificarEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        
        if($request->has('status'))
        {
            Empleado::where('id','=',$id)->update(['status' => $request->input('status')]);
            return redirect('puntoVenta/empleado/'.$id.'/edit');
        }
        if($request->has('passwordChange'))
        {
            $rules = [
                'passwordChange' => ['required', 'string', 'min:8'],
            ];
            $mesages = [
                'passwordChange.required' => 'Por favor escriba su contraseña',
                'passwordChange.min' => 'La contraseña debe tener al menos 8 caracteres',
                
            ];
            
            $validator = Validator::make($request->all(), $rules, $mesages);
            
            if($validator->fails())
                return $validator->errors()->first();
            //return 'Si entra';
            /*if($validator->fails()):
                return back()->withErrors($validator)->with('message','Se ha producido un error')->with(
                    'typealert','danger');
            endif;*/
            User::where('id','=',$id)->update(['password' => Hash::make($request->input('passwordChange'))]);
            return true;
            //return redirect('puntoVenta/empleado/'.$id.'/edit');
        }
        if($id == 0)
        {
            /*$rules = [
                'passwordChange' => ['required', 'string', 'min:8'],
            ];
            $mesages = [
                'passwordChange.required' => 'Por favor escriba su contraseña',
                'passwordChange.min' => 'La contraseña debe tener al menos 8 caracteres',
                
            ];*/
            $admin = User::findOrFail(1);
            $adminEmpleado = Empleado::findOrFail(1);
            $datosUser = [];
            if($request->input('username') != $admin->username)
                $datosUser = Arr::add($datosUser,'username',$request->input('username'));
            if($request->input('email') != $admin->email)
                $datosUser = Arr::add($datosUser,'email',$request->input('email'));
            if($request->input('claveE') != $adminEmpleado->claveE)
                $datosUser = Arr::add($datosUser,'claveE',$request->input('claveE'));
            $validacion =  Validator::make($datosUser, [
                'username' => ['string', 'max:255','unique:users','min:3'],
                'email' => ['string', 'email', 'max:255', 'unique:users','min:5'],
                'claveE' => ['string', 'max:5','unique:empleados','min:5'],
            ]);
            if($validacion->fails()):
                return back()->withErrors($validacion)->with( ['cambios' => true] )->withInput($request->all());
            endif;
            $validacion->validate();
            $datosUsuario = request()->only(['email','username']);
            $datosEmpleado = request()->only(['claveE']);
            $admin->update($datosUsuario);
            $adminEmpleado->update($datosEmpleado);
            return redirect('puntoVenta/empleado/'.$id.'/edit');
            //return 'NO TE PREOCUPES, AQUI CACHO EL ERROR';
        }
        else
        {
            
            $datos = []; //$request->all();
            $empleado = Empleado::findOrFail($id);
            $user = User::where('id','=',$empleado->idUsuario)->first();
            if($request->input('nombre') != $empleado->nombre)
                $datos = Arr::add($datos,'nombre',$request->input('nombre'));
            if($request->input('apellidoPaterno') != $empleado->apellidoPaterno)
                $datos = Arr::add($datos,'apellidoPaterno',$request->input('apellidoPaterno'));
            if($request->input('apellidoMaterno') != $empleado->apellidoMaterno)
                $datos = Arr::add($datos,'apellidoMaterno',$request->input('apellidoMaterno'));
            if($request->input('domicilio') != $empleado->domicilio)
                $datos = Arr::add($datos,'domicilio',$request->input('domicilio'));
            if($request->input('curp') != $empleado->curp)
                $datos = Arr::add($datos,'curp',$request->input('curp'));
            if($request->input('email') != $user->email)
                $datos = Arr::add($datos,'email',$request->input('email'));
            if($request->input('telefono') != $empleado->telefono)
                $datos = Arr::add($datos,'telefono',$request->input('telefono'));
            if($request->input('claveE') != $empleado->claveE)
                $datos = Arr::add($datos,'claveE',$request->input('claveE'));
            if($request->input('username') != $user->username)
                $datos = Arr::add($datos,'username',$request->input('username'));
            //return 'Si llega hasta aqui';
            //$this->validator($request->all())->validate();
            
            $validacion =  Validator::make($datos, [
                'nombre' => ['string', 'max:30','min:3'],
                'apellidos' => ['string', 'max:30','min:3'],
                'domicilio' => ['string', 'max:50','min:3'],
                'curp' => ['string','min:18' ,'max:18','unique:empleados'],
                'telefono' => ['string', 'max:10','min:7'],
                'claveE' => ['string', 'max:5','unique:empleados','min:5'],
                'username' => ['string', 'max:255','unique:users','min:3'],
                'email' => ['string', 'email', 'max:255', 'unique:users','min:5'],
            ]);
            if($validacion->fails()):
                return back()->withErrors($validacion)->with( ['cambios' => true] )->withInput($request->all());
            endif;
            $validacion->validate();
            $datosEmpleado = request()->except(['_token','_method','email','username']);
            $datosUser = request()->only(['email','username']);
            Empleado::where('id','=',$id)->update($datosEmpleado);
            User::where('id','=',$user->id)->update($datosUser);
            return redirect('puntoVenta/empleado/'.$id.'/edit');
            //return $datos;
        }
        //'password' => Hash::make($request['password'])
        
        return 'No lo reconoce';
    }
}
