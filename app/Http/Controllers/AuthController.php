<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.auth');

    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => ['required', 'min:3'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return view('admin.login', [
                'email' => $request->email,
            ]);
        }

        return back()->withErrors(['login' => 'Email atau Password salah.']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data['nama'] = $request->nama;

        return view('admin.login', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
