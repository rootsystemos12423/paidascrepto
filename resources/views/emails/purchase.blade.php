<!DOCTYPE html>
<html>
<head>
    <title>Confirmação de Compra</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #111827; color: #e5e7eb; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #1e293b; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);">
        <h2 style="color: #10b981; text-align: center; font-size: 24px;">Confirmação de Compra</h2>
        <p>Olá, <strong style="color: #34d399;">{{ $checkout->nome }}</strong>,</p>
        <p>Agradecemos por sua compra! Aqui estão os detalhes do seu pedido:</p>
        <ul>
            <li>ID do Pedido: <strong style="color: #4ade80;">{{ $pedido->order_id }}</strong></li>
            <li>Valor: <strong style="color: #4ade80;">R$ @if(isset(json_decode($checkout->description, true)['plan']))
                    {{ json_decode($checkout->description, true)['plan']['value'] }}
                    @elseif(isset(json_decode($checkout->description, true)['maquinas']))
                    {{ json_decode($checkout->description, true)['maquinas']['value'] }}
                    @elseif(isset(json_decode($checkout->description, true)['upgradeMaquinas']))
                    {{ json_decode($checkout->description, true)['upgradeMaquinas']['value'] }}
                    @elseif(isset(json_decode($checkout->description, true)['salaData']))
                    {{ json_decode($checkout->description, true)['salaData']['value'] }}
                    @elseif(isset(json_decode($checkout->description, true)['UpgradePlanData']))
                    {{ json_decode($checkout->description, true)['UpgradePlanData']['value'] }}
                    @endif</strong></li>
            <!-- Inclua outros detalhes conforme necessário -->
        </ul>
        <div style="background-color: #1f2937; padding: 20px; border-radius: 8px; border-left: 5px solid #2dd4bf; margin: 20px 0;">
            <p style="margin: 0; color: #e5e7eb;">Se tiver alguma dúvida sobre sua compra, por favor entre em contato.</p>
        </div>
        <p style="text-align: center; font-size: 0.85em; color: #6b7280; margin-top: 20px;">&copy; 2024 Aurora Miners. Todos os direitos reservados.</p>
    </div>
</body>
</html>
