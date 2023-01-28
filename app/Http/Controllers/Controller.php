<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function encryption($string="")
    {
        if($string !=0 && $string !="")
        {
           return Crypt::encryptString($string); 
        }
        else
        {
            return $string;
        }
    }

    public function decryption($string="")
    {
        if($string !=0 && $string !="")
        {
           return Crypt::decryptString($string); 
        }
        else
        {
            return $string;
        }
    }
}
