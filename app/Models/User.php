<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'login',
        'password',
    ];
    //Проверка на роль пользователя для отображение соответствующих данных по роли
    public function isManager() {
        return $this->role === 'Manager';
    }
//Проверка на роль пользователя для отображение соответствующих данных по роли
    public function isProvider() {
        return $this->role === 'Provider';
    }
}
