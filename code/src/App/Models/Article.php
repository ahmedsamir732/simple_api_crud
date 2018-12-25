<?php
namespace APICrud\App\Models;

class Article extends Model
{
    protected $table = 'article';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}