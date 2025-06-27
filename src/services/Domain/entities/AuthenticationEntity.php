<?php

namespace Hub\Financial\services\Domain\entities;

use Illuminate\Database\Eloquent\Model;

class AuthenticationEntity extends Model
{
    protected $table = "tb_saf_0001";

    protected $fillable = [
        'user', 
        'password'
    ];

    public string $User;
    public string $Password;  
    public $timestamps = false;
}