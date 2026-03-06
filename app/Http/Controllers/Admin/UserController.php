<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        Gate::authorize('manage_users');
        $users = User::with('permissions')->latest()->paginate(10);
        $permissions = \App\Models\Permission::all();
        return view('admin.users.index', compact('users', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        Gate::authorize('manage_users');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,gerente,atendente'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'permissions' => ['nullable', 'array'],
            'cpf' => ['nullable', 'string', 'max:14', 'unique:users,cpf'],
            'phone' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date'],
            'cep' => ['nullable', 'string', 'max:9'],
            'address' => ['nullable', 'string', 'max:255'],
            'number' => ['nullable', 'string', 'max:20'],
            'complement' => ['nullable', 'string', 'max:255'],
            'neighborhood' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:2'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data = $request->only([
            'name',
            'email',
            'role',
            'cpf',
            'phone',
            'birth_date',
            'cep',
            'address',
            'number',
            'complement',
            'neighborhood',
            'city',
            'state',
            'is_active'
        ]);
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create($data);

        event(new Registered($user));

        if ($request->has('permissions')) {
            $user->permissions()->sync($request->permissions);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Usuário criado com sucesso.',
                'user' => $user,
                'html' => view('admin.users._row', compact('user'))->render()
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário criado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse|JsonResponse
    {
        Gate::authorize('manage_users');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,gerente,atendente'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'permissions' => ['nullable', 'array'],
            'cpf' => ['nullable', 'string', 'max:14', 'unique:users,cpf,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date'],
            'cep' => ['nullable', 'string', 'max:9'],
            'address' => ['nullable', 'string', 'max:255'],
            'number' => ['nullable', 'string', 'max:20'],
            'complement' => ['nullable', 'string', 'max:255'],
            'neighborhood' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:2'],
            'is_active' => ['present', 'boolean'],
        ]);

        $data = $request->only([
            'name',
            'email',
            'role',
            'cpf',
            'phone',
            'birth_date',
            'cep',
            'address',
            'number',
            'complement',
            'neighborhood',
            'city',
            'state',
            'is_active'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        if ($request->has('permissions')) {
            $user->permissions()->sync($request->permissions);
        } else {
            $user->permissions()->detach();
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Usuário atualizado com sucesso.',
                'user' => $user,
                'html' => view('admin.users._row', compact('user'))->render()
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user): RedirectResponse|JsonResponse
    {
        Gate::authorize('manage_users');
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Você não pode excluir seu próprio usuário.');
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Usuário excluído com sucesso.'
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário excluído com sucesso.');
    }
}
