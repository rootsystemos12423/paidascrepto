<!DOCTYPE html>
<html>
<head>
    <title>Suas Credenciais de Acesso</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #111827; color: #e5e7eb; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #1e293b; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);">
        <h2 style="color: #10b981; text-align: center; font-size: 24px;">Bem-vindo(a), {{ $user->name }}!</h2>
        <p>Aqui estão suas credenciais de usuário:</p>
        <ul>
            <li>Usuário: <strong style="color: #4ade80;">{{ $user->username }}</strong></li>
            <li>Email: <strong style="color: #4ade80;">{{ $user->email }}</strong></li>
            <li>Senha: <strong style="color: #4ade80;">{{ $password }}</strong></li>
        </ul>
        <p>Recomendamos que você altere sua senha após o primeiro login.</p>
        <p style="text-align: center; font-size: 0.85em; color: #6b7280; margin-top: 20px;">&copy; 2024 Aurora Miners. Todos os direitos reservados.</p>
    </div>
</body>
</html>
