<!DOCTYPE html>
<html>
<head>
    <title>Confirmação de Compra</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9fafb; color: #374151; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2 style="color: rgb(59 130 246); text-align: center; font-size: 24px;">Confirmação de Compra</h2>
        <p>Olá, <strong style="color: rgb(59 130 246);">{{ $checkout->nome }}</strong>,</p>
        <p>Agradecemos por sua compra! Aqui estão os detalhes do seu pedido:</p>
        <ul>
            <li>ID do Pedido: <strong style="color: rgb(59 130 246);">{{ $pedido->order_id }}</strong></li>
            <li>Valor: <strong style="color: rgb(59 130 246);">R$ {{ json_decode($checkout->description, true)['valor'] }}</strong></li>
            <!-- Inclua outros detalhes conforme necessário -->
        </ul>
        <div style="background-color: #f3f4f6; padding: 20px; border-radius: 8px; border-left: 5px solid rgb(59 130 246); margin: 20px 0;">
            <p style="margin: 0; color: #374151;">Se tiver alguma dúvida sobre sua compra, por favor entre em contato.</p>
        </div>
        <p style="text-align: center; font-size: 0.85em; color: #6b7280; margin-top: 20px;">&copy; 2024 Osorno Crypto Ltda. Todos os direitos reservados.</p>
    </div>
</body>
</html>
