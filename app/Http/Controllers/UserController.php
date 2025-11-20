<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{

    public function index(Request $request)
    {

        $searchableColumns = ['name'];

        $data['dataUser'] = User::search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.user.index', $data);
    }

    public function create(): View
    {
        return view('pages.admin.user.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',

        ], [
            'name.required'      => 'Nama pengguna wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',

        ]);

        $data             = $request->only(['name', 'email', 'password']);
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'Data user berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('pages.admin.user.edit', $data);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',

        ], [
            'name.required'      => 'Nama pengguna wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',

        ]);

        $data = $request->only(['name', 'email']); // ✅ tambahkan role
        if (! empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'Data user berhasil dihapus!');
    }
}
