@component('mail::message')
# Cuenta Creada

UserName: {{ $username }}

Una cuenta fue creada por un Administrador, para acceder debes ir a https://dev.patrickwcity.com/password/reset y ingresar su correo para enviar una solitud a su correo para restablecer la contraseña.

@component('mail::button', ['url' => 'https://dev.patrickwcity.com/password/reset'])
Restablecer su Contraseña
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
