<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function asignarRole($role){
        // "ADMIN"
        // {nombre: "ADMIN", "detalle": "Adminitrador"}
        if(is_string($role)){
            $role = Role::where("nombre", "=",  $role)->firstOrFail();
        }

        $this->roles()->sync($role, false);
    }

    public function quitarRole($role){
        // "ADMIN"
        // {nombre: "ADMIN", "detalle": "Adminitrador"}
        if(is_string($role)){
            $role = Role::where("nombre", "=",  $role)->firstOrFail();
        }

        $this->roles()->detach($role->id);
    }

    public function permisos(){
        return $this->roles->map->permisos->flatten()->pluck("nombre")->unique();
    }

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function sucursales(){
        return $this->belongsToMany(Sucursal::class);
    }

    public function notas(){
        return $this->belongsTo(Nota::class);
    }

}
