<?php namespace Mia\Mail\Model;

class MIAEmailTemplate extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_email_template';
    /**
     * Campos que se ocultan al obtener los registros
     * @var array
     */
    //protected $hidden = ['deleted', 'password'];

    protected $casts = [
        'vars' => 'array',
        'data' => 'array',
    ];

    public $timestamps = false;

}