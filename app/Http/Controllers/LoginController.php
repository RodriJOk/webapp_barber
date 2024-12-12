<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Mail\myEmail;
use App\Models\Branch;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {   
        return view('login/index');
    }

    public function singin(){
        $data = request()->all();

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $messages = [
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe ser un email',
            'password.required' => 'El campo password es requerido'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            toastr()->error('Error en los datos ingresados');
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::exitUser($data['email']);
        if (!$user) {
            toastr()->error('El email no se encuentra registrado. Contactese con el administrador del sistema.');
            return redirect('/login')
                ->withErrors(['email' => 'El email no se encuentra registrado. Contactese con el administrador del sistema.'])
                ->withInput();
        }

        $user_information = User::getUserByEmail($data['email']);
        $user_information->rol_name = $user_information->rol;
        $password = $data['password'];
        $password_hash = $user_information->password;
        if (!password_verify($password, $password_hash)) {
            toastr()->error('La contraseña es incorrecta');

            return redirect('/login')
                ->withErrors(['password' => 'La contraseña es incorrecta'])
                ->withInput();
        }

        Auth::login($user_information);
        // Guarda los datos del usuario en sesión si es necesario
        $branch = Branch::getBranchByUserId($user_information->id);
        session(['id_usuario' => $user_information->id]);
        session(['nombre_usuario' => $user_information->name]);
        session(['email_usuario' => $user_information->email]);
        session(['id_branch' => $branch['id'] ?? null]);
        session(['rol' => $user_information->rol]);

        return redirect('/home');
    }

    public function forget_password()
    {
        return view('login/forget_password');
    }
    public function reset_password()
    {
        $email = request()->input('email');

        $rules = [
            'email' => 'required|email|min:3|max:255', 
        ];

        $messages = [
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe ser un email valido',
            'email.min' => 'El campo email debe tener al menos 3 caracteres',
            'email.max' => 'El campo email debe tener como máximo 255 caracteres'
        ];

        $validator = Validator::make(request()->all(), $rules, $messages);

        if ($validator->fails()) {
            toastr()->error('Error en los datos ingresados.' . $validator->errors());
            return redirect('/forget_password')
                ->withErrors($validator)
                ->withInput();
        }

        $exit_user = User::exitUser($email);
        if(!$exit_user){
            toastr()->error('El email no se encuentra registrado. Contactese con el administrador del sistema.');
            return redirect('/forget_password')
                ->withErrors(['email' => 'El email no se encuentra registrado. Contactese con el administrador del sistema.'])
                ->withInput();
        }

        $data_user = User::getUserByEmail($email);
        if(!$data_user){
            toastr()->error('Error al obtener los datos del usuario');
            return redirect('/forget_password');
        }

        //Envio de los emails
        $data = [
            'name' => $data_user->name,
            'date' => now(),
            'subject' => 'Solicitud de reestablecimiento de contraseña',
            'resetLink' => route('new_password'),
        ];

        $send_email = Mail::to('juarezrodrigo59@gmail.com')->send(new myEmail($data, 'mail.reseteo_contraseña'));
        if(!$send_email){
            toastr()->error('Error al enviar el email');
            return redirect('/login');
        }
        toastr()->success('Se ha enviado un email a su casilla de correo para resetear la contraseña');
        return redirect('/login');
    }
    public function new_password()
    {
        return view('login/new_password');
    }
    public function save_new_password()
    {
        $data = request()->all();
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'repeat_password' => 'required|same:password'
        ];

        $messages = [
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe ser un email valido',
            'password.required' => 'El campo password es requerido',
            'repeat_password.required' => 'El campo confirmar password es requerido',
            'repeat_password.same' => 'Las contraseñas no coinciden'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            toastr()->error('Error en los datos ingresados.' . $validator->errors());
            return redirect('/new_password')
                ->withErrors($validator)
                ->withInput();
        }

        $email = request()->input('email');
        //Busco si existe el email en la BD
        $exit_user = User::exitUser($email);
        if(!$exit_user){
            toastr()->error('El email no se encuentra registrado. Contactese con el administrador del sistema.');
            return redirect('/new_password')
                ->withErrors(['email' => 'El email no se encuentra registrado. Contactese con el administrador del sistema.'])
                ->withInput();
        }

        //Guardo la nueva contraseña
        $email = request()->input('email');
        $password = request()->input('password');
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $save_password = User::saveNewPassword($email, $password_hash);
        if(!$save_password){
            
            toastr()->error('Ha ocurrido un error al actualizar sus credenciales. Por favor, vuelva a intentarlo.');
            return redirect('/new_password');
        }

        toastr()->success('Se ha actualizado su contraseña correctamente. Inicie sesión con sus nuevas credenciales.');
        return view('login/index');
    }
    public function register()
    {
        return view('login/register');
    }
    public function create_user(){
        $data = request()->all();

        $rules = [
            'nombre' => 'required|min:3|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|email',
            'password' => 'required',
            'rol' => 'required|regex:/^[1-3]$/'
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es requerido',
            'nombre.min' => 'El campo nombre debe tener al menos 3 caracteres',
            'nombre.alpha' => 'El campo nombre debe ser alfabético',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe ser un email',
            'password.required' => 'El campo password es requerido',
            'rol.required' => 'El campo rol es requerido',
            'rol.regex' => 'El rol seleccionado no es valido'
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            toastr()->error($validator->errors());
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::exitUser($data['email']);
        if($user){
            toastr()->error('El email ya se encuentra registrado. Contactese con el administrador del sistema.');
            return redirect('/register')
                ->withErrors(['email' => 'El email ya se encuentra registrado. Contactese con el administrador del sistema.'])
                ->withInput();
        }
        
        $password = $data['password'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        $data = [
            'name' => $data['nombre'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => $password_hash,
            'remember_token' => null,
            'created_at' => now(),
            'rol' => $data['rol'],
        ];

        $save_user = User::saveUser($data);
        
        if(!$save_user){
            toastr()->error('Ha ocurrido un error al guardar el usuario. Por favor, vuelva a intentarlo.');
            return redirect('/login');
        }
        toastr()->success('Se ha registrado correctamente. Inicie sesión con sus credenciales.');
        return view('login/index');
    }
    public function close_session(){
        Auth::logout();
        session()->flush();
        return redirect('/login');
    }
    public function test_email(){
        $data = [
            'name' => 'Rodrigo',
            'date' => now(),
            'subject' => 'Solicitud de reestablecimiento de contraseña',
            'resetLink' => 'http://localhost:8000/new_password',
        ];

        $send_email = Mail::to('juarezrodrigo59@gmail.com')->send(new myEmail($data, 'mail.reseteo_contraseña'));
        if(!$send_email){
            toastr()->error('Error al enviar el email');
            return redirect('/login');
        }
        toastr()->success('Email enviado correctamente');
        return redirect('/login');
    }
    public function template_email(){
        return view('mail/reseteo_contraseña');
    }
}