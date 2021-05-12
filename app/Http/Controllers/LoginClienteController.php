<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Sucursal;
use App\Models\Departamento;
use App\Models\Cliente;
use Illuminate\Support\Arr;
use Validator, Hash, Auth;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginClienteController extends Controller
{
    
    //use AuthenticatesUsers;

    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function loginCliente()
    {
        //$this->middleware('isCliente');
        $compra = "";
        if(isset($_GET['compra']))
            $compra = $_GET['compra'];//return "Recibi tu párametro";
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=',1)->get(['id','nombre']);
        
        if(!Auth::check())
            return view('auth.loginCliente',compact('sucursales','departamentos','compra'));
        return redirect('/');
    }

    public function loginPost(Request $request)
    {
        
        /*$rules = [
            'email' =>'required|email',
            'password' => 'required|min:8'
        ];
        $mesages = [
            'email.required' => 'Su correo electronico es requerido',
            'email.email' => 'El formato de su correo electronico es invalido',
            'password.required' => 'Por favor escriba su contrseña',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ]
        $validator = Validator::make($request->all(), $rules, $mesages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with(
                'typealert','danger');
        endif;*/
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->tipo == 2)
            {
                $request->session()->regenerate();
                session(['idCliente' => Auth::user()->id]);
                if(isset($_GET['compra']))
                    return redirect('/direccionEnvio');
                return redirect('/');//->intended('/');
            }
            Auth::logout();
        }

        return redirect('loginCliente')->withErrors([
            'email' => 'El email y/o la contraseña son incorrectos',
        ]);
    }

    public function logout(Request $request)
    {
        session()->forget('idCliente');
        Auth::logout();
        /*$idCliente = NULL;
        if(session()->has('idCliente'))
        {
            $idCliente = session('idCliente');
        }*/
        //$request->session()->invalidate();
        $request->session()->regenerate();

        $request->session()->regenerateToken();
        /*if($idCliente != NULL)
        {
            session(['idCliente'])
        }*/
        
        return redirect('/loginCliente');
        //return 'Tambien entra a esta funcion';
    }
    public function register()
    {
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=',1)->get(['id','nombre']);
        if(!Auth::check())
            return view('auth.registerCliente',compact('sucursales','departamentos'));
        return redirect('/');
        
    }
    public function registerPost(Request $request)
    {
        $this->validator($request->all())->validate();
        //return 'ok';
        $datosEmpleado = request()->except('_token','password_confirmation','username','password','email');//,'apellidos','contra2','correo');
        $usuario = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'tipo' => 2,
        ]);
        $datosEmpleado = Arr::add($datosEmpleado,'idUsuario',$usuario->id);
        $datosEmpleado = Arr::add($datosEmpleado,'tipo',2);
        //$empleado = new Empleado;
        $cliente = Cliente::create($datosEmpleado);
        return redirect('/');// $datosEmpleado;//view('auth.registerCliente');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:50'],
            //'domicilio' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'string', 'max:10'],
            'username' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);    
    }


}
