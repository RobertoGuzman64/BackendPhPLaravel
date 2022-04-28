<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    // METODO DE REGISTRAR USUARIO
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'battlenetNombre' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'nombre' => $request->get('nombre'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->password),
            'battlenetNombre' => $request->get('battlenetNombre'),
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user'), 201);
    }
    // METODO DE LOGIN DE USUARIO
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }
    // METODO DE LOGOUT DE USUARIO
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->bearerToken());
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
    public function me()
    {
        return response()->json(auth()->user());;
    }
    // METODO DE ACTUALIZAR USUARIO
    public function actualizaUsuario(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Validación fallida'], 400);
            }
            $user = User::find($id);
            $user->nombre = $request->nombre;
            $user->email = $request->email;
            $user->save();
            return response()->json($user, 200);
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return response()->json(['error' => 'El email ya existe'], 409);
            } else {
                return response()->json(['error' => 'Error al actualizar el usuario'], 500);
            }
        }
    }
    // METODO DE ELIMINAR USUARIO
    public function borrarUsuario(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::where('id', '=', $id)->delete();
            return User::all()->where('id', '=', $id);
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return response()->json(['error' => 'El Usuario no existe'], 409);
            } else {
                return response()->json(['error' => 'Error al eliminar el usuario'], 500);
            }
        }
    }
}
