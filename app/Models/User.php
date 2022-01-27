<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static $rules = [
        'name' => 'required',
        'username' => 'required|unique:users',
        'password' => 'required|min:6',
        'password_confirm' => 'required|same:password',
        'role' => 'required',
        'picture' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10000'
    ];


    public static $updateRules = [
        'password' => 'nullable|min:6',
        'password_confirm' => 'nullable|same:password',
        'role' => 'required',
        'picture' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2000'
    ];

    public static $messages = [
        'name.required' => 'Nama tidak boleh kosong!',
        'username.required' => 'Username tidak boleh kosong!',
        'username.unique' => 'Username sudah terdaftar!',
        'password.required' => 'Password tidak boleh kosong!',
        'password.min' => 'Password minimal 6 karakter!',
        'password_confirm.required' => 'Konfirmasi password tidak boleh kosong!',
        'password_confirm.same' => 'Konfirmasi password harus sama dengan password!',
        'role.required' => 'Role tidak boleh kosong!',
        'picture.mimes' => 'Format tidak didukung!',
        'picture.image' => 'Format tidak didukung!',
        'picture.max' => 'Ukuran file maksimal 2mb!',
    ];

    public static $updateMessages = [
        'password.min' => 'Password minimal 6 karakter!',
        'password_confirm.same' => 'Konfirmasi password harus sama dengan password!',
        'role.required' => 'Role tidak boleh kosong!',
        'picture.mimes' => 'Format tidak didukung!',
        'picture.image' => 'Format tidak didukung!',
        'picture.max' => 'Ukuran file maksimal 2mb!',
    ];

    public static function saveUser($request)
    {

        $user = new self;
        $user->name = $request['name'];
        $user->username = $request['username'];
        $user->password = bcrypt($request['password']);
        $user->assignRole($request['role']);

        if($request->hasFile('picture')){
            $path = $request->file('picture')->store('user','public');
            $user->picture = $path;
        }

        if ($user->save()) {
            return true;
        }

        return false;
    }

    public static function updateUser($request, $id)
    {
        $user = self::findOrFail($id);
        if (!is_null($user->password))
            $user->password = bcrypt($request['password']);
        $user->syncRoles($request['role']);

        if($request->hasFile('picture')){
            $path = $request->file('picture')->store('user','public');
            $user->picture = $path;
        }

        if ($user->save()) {
            return true;
        }

        return false;
    }


    public static function getUserDetail($id)
    {
        $user = self::with('roles')->where('id', $id)
            ->first();
        return $user;
    }
}
