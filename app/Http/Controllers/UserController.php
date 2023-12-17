<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function authenticate(Request $request){

        $credentials = $request->validate([
            'username'=> 'required|string',
            'password'=> 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
        ->with('loginError', 'Login gagal!');

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function create()
    {
        $employee = Employee::whereNull('user_id')->get();
        return view('components.user.form', ['employee' => $employee]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string|min:8',
            'karyawan' => 'required|string',
        ]);

        $hashPassword = Hash::make($request->password);
        $saveUser = User::create([
            'uuid' => Str::uuid(),
            'username' => $request->username,
            'password' => $hashPassword,
            'passwordC' => Crypt::encrypt($request->password)
        ]);

        if ($saveUser) {
            $karyawan = Employee::where('uuid', $request->karyawan)->firstOrFail();
            $karyawan->update([
                'user_id' => $saveUser->id,
            ]);
            if (!$karyawan) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
            $data = [
                'nama_lengkap'=> $karyawan->nama_lengkap,
                'username'=> $saveUser->username,
                'password'=> $request->password,
                'email'=> $karyawan->email,
                'typeEmail' => 'assign',
            ];
            $email = (new MailController)->index($data);

        }

        //send email notification

        return redirect()
            ->route('user.index')
            ->with([
                'success' => 'user has been added successfully'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $employee = Employee::all();
        $user = User::where('uuid', $uuid)->firstOrFail();
        return view('components.user.form', ['employee' => $employee, 'data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'nullable|string|min:8',
            'karyawan' => 'required|string',
        ]);

        $user = User::where('uuid', $uuid)->firstOrFail();
        $karyawan = Employee::where('user_id',$user->id)->firstOrFail();
        $data = [
            'nama_lengkap'=> $karyawan->nama_lengkap,
            'username'=> $user->username,
            'email'=> $karyawan->email,
        ];

        if($karyawan->uuid !== $request->karyawan){
            $karyawan->update([
                'user_id'=> null,
            ]);
            
            $data['typeEmail'] = 'remove';
            $remove = (new MailController)->index($data);
            
            $newKaryawan = Employee::where('uuid', $request->karyawan)->firstOrFail();
            $newKaryawan->update([
                'user_id' => $user->id,
            ]);

            $data['email'] = $newKaryawan->email;
        }

        $user->update([
            'username' => $request->username,
            'karyawan' => $request->karyawan,
        ]); 


        if ($request->password) {
            $hashPassword = Hash::make($request->password);
            $user->update([
                'password' => $hashPassword,
                'passwordC' => $request->password
            ]);
            $data['password'] = $request->password;
        } else {
            $data['password'] = Crypt::decrypt($user->passwordC);
        }

        $data['typeEmail'] = 'assign';
        
        $assign = (new MailController)->index($data);

        return redirect()
            ->route('user.index')
            ->with([
                'success' => 'user has been edited successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $user=User::where('uuid', $uuid)->firstOrFail();
        $karyawan = Employee::where('user_id',$user->id);

        if($user->delete()){
            $karyawan->update(['user_id' => null]);
            $response['success']=1;
            $data = [
                'nama_lengkap'=> $karyawan->nama_lengkap,
                'username'=> $user->username,
                'email'=> $karyawan->email,
                'typeEmail'=>'remove',
            ];
            $remove = (new MailController)->index($data);
        }else{
            $response['success']=0;
        }

        return response()->json($response);
    }

    public function getAll()
    {
        $data = User::leftJoin('employees', 'users.id', '=', 'employees.user_id')
            ->select('users.*', 'employees.nama_lengkap')
            ->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="user/' . $row->uuid . '/edit" class="btn btn-xs btn-secondary">Edit</a> ';
                $html .= '<button data-id="' . $row->uuid . '" class="btn btn-xs btn-danger" id="delete-user">Delete</button>';
                return $html;
            })
            ->toJson();
    }
}
