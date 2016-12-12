<?php

namespace Wearenext\CMS\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Wearenext\CMS\Models\Role;
use Wearenext\CMS\Models\User;

class UserController extends BaseController
{
    public function portal()
    {
        return view('cms::user.portal');
    }

    public function login(Request $request)
    {
        $this->validate($request, ['email' => 'required', 'email' => 'required',]);
        
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->intended(route('cms.index'));
        }

        return redirect()
            ->route('cms.user.portal')
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['error' => $this->getFailedLoginMessage()]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect()
            ->route('cms.index');
    }

    public function index()
    {
        $this->authorize('cms.user_index');
        
        $model = config('auth.model');
        $users = $model::withTrashed()->orderBy('deleted_at', 'asc')->paginate(15);
        return view('cms::user.view')
            ->with('users', $users)
            ->with('roles', $this->roles());
    }

    public function create()
    {
        $this->authorize('cms.user_create');
        
        return view('cms::user.create')
            ->with('roles', $this->roles());
    }

    public function save(Request $request)
    {
        $this->authorize('cms.user_create');
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'cms_role' => 'required|in:'. implode(',', array_keys($this->roles())),
            'password' => 'required',
        ]);
        
        $attributes = $request->all();
        
        $attributes['password'] = bcrypt($attributes['password']);

        $model = config('auth.model');
        $user = $model::create($attributes);

        return redirect()->route('cms.user.edit', [$user])
            ->withErrors([
                'success' => [
                    trans('cms::user.messages.created', ['name' => $user->name,])
                ],
            ]);
    }

    public function edit($user)
    {
        $this->authorize('cms.user_edit');
        
        return view('cms::user.edit')
            ->with('user', $user)
            ->with('roles', $this->roles());
    }

    public function update(Request $request, $user)
    {
        $this->authorize('cms.user_edit');
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'. $user->id,
            'cms_role' => 'required|in:'. implode(',', array_keys($this->roles())),
        ]);
        
        $user->fill($request->all());

        if ($request->input('password') != '') {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return redirect()
            ->route('cms.user.edit', [$user])
            ->withErrors([
                'success' => [
                    trans('cms::user.messages.updated', ['name' => $user->name,])
                ],
            ]);
    }

    public function delete($user)
    {
        $this->authorize('cms.user_delete');
        
        $user->delete();

        return redirect()
            ->route('cms.user.index')
            ->withErrors([
                'success' => [
                    trans('cms::user.messages.deleted', ['name' => $user->name,])
                ],
            ]);
    }

    public function restore($id)
    {
        $this->authorize('cms.user_restore');
        
        $model = config('auth.model');
        $user = $model::withTrashed()->find($id);
        if ($user != null) {
            $user->restore();
            return redirect()
                ->route('cms.user.edit', [ $user ])
                ->withErrors(['success' => ['User restored successfully.']]);
        }
        return back()->withErrors(['error' => ['Unable to restore user.']]);
    }
    
    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }
    
    protected function roles()
    {
        return [
            'admin' => 'Administrator',
            'author' => 'Author',
        ];
    }
}
