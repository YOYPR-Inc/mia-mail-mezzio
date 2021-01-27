<?php namespace Mia\Mail\Model;

class MIAEmailSent extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_email_sent';
    /**
     * Campos que se ocultan al obtener los registros
     * @var array
     */
    //protected $hidden = ['deleted', 'password'];
    public $timestamps = false;

}