<!DOCTYPE html>
<html>
<head>
    <title>Suas Credenciais de Acesso</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9fafb; color: #374151; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2 style="color: rgb(59 130 246); text-align: center; font-size: 24px;">Bem-vindo(a), {{ $user->name }}!</h2>
        <p>Aqui estão suas credenciais de usuário:</p>
        <ul>
            <li>Usuário: <strong style="color: rgb(59 130 246);">{{ $user->username }}</strong></li>
            <li>Email: <strong style="color: rgb(59 130 246);">{{ $user->email }}</strong></li>
            <li>Senha: <strong style="color: rgb(59 130 246);">{{ $password }}</strong></li>
        </ul>
        <p>Recomendamos que você altere sua senha após o primeiro login.</p>
        <p style="text-align: center; font-size: 0.85em; color: #6b7280; margin-top: 20px;">&copy; 2024 Osorno Crypto Ltda. Todos os direitos reservados.</p>
    </div>
</body>
</html>
