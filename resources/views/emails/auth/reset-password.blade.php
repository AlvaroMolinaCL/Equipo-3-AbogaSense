@component('mail::message')
# 👋 ¡Hola!

Hemos recibido una solicitud para restablecer la contraseña de tu cuenta en **AbogaSense**.

Haz clic en el botón a continuación para crear una nueva contraseña de forma segura:

@component('mail::button', ['url' => $url])
🔑 Restablecer contraseña
@endcomponent

Este enlace es válido por {{ $count }} minutos.  
Si no solicitaste este cambio, puedes ignorar este mensaje; tu contraseña actual seguirá siendo válida.

---

Gracias por confiar en nosotros,  
**El equipo de AbogaSense**
@endcomponent
