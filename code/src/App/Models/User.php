<?php
namespace APICrud\App\Models;

class User extends Model
{
    protected $table = 'user';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}