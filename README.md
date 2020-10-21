# Laravel Rest Api
------- 
Implementasi rest api menggunakan laravel framework dengan laravel passport sebagai otentikasi pengguna.

### Users Authentication
- Login `` /login ``
- Register `` /register ``
- Email verification link `` /email/verify/{id}/{hash} ``
- Resend email verification  `` /email/resend ``
- Forgot password `` /password/email ``
- Reset password `` /password/reset ``

### Management User
- User's details `` /v1/user/{id}/show ``
- Update user's details `` /v1/user/{id}/update `` 