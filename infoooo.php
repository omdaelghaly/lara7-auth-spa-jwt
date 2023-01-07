
// create email with markup
//php artisan make:mail Changepwd --markdown=emails.changepwd
php artisan make:mail Verifyemail --markdown=emails.verifyemail


//لتسطيع التعديل على الايميل
 php artisan vendor:publish --tag=laravel-mail


 MIX_APP_URL="${APP_URL}"


set axios baseurl -> error 405 method not allowed 