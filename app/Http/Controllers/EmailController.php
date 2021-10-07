<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
  public function sendEmail()
  {
    Mail::raw('Hallo, Welcome To My System Muhammad Nurifan', function ($message) {
      $message->to('m.nurrifan@gmail.com')
        ->subject('Lumen Email Test');
    });
    if (Mail::failures()) {
      return 'Sorry! Please try again latter :(';
    } else {
      return 'Great! eMail successfully sent ;)';
    }
  }
}
