<!DOCTYPE html>
<html>
<head>
    <title>Explore Novas Possibilidades</title>
</head>
<style>
        .plan-card {
            background-color: #2d3748;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            text-align: center;
            width: 50%;
        }

        .plan-card img {
            width: 120px;
            height: auto;
            margin-bottom: 15px;
        }

        .plan-card h2 {
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .plan-price {
            background: linear-gradient(to right, #00ff9d, #00bd75);
            color: #ffffff;
            padding: 10px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 1rem;
        }

        .plan-details {
            list-style: none;
            padding: 0;
        }

        .plan-details li {
            margin-bottom: 5px;
        }

        .plan-sec {
            display: flex;
            gap: 10px;
            align-items: center;
        }
    </style>
<body style="font-family: Arial, sans-serif; background-color: #111827; color: #e5e7eb; margin: 0; padding: 20px;">
    <div style="max-width: 800px; margin: auto; background: #1e293b; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);">
        <!-- Banner Space -->
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="https://aurora-miner.b-cdn.net/images/BANNER-EMAIL.png" style="width: 100%; max-width: 550px; height: auto; border-radius: 8px;">
        </div>
        <p>Olá, <strong style="color: #00ff9d;">{{ $user->name }}</strong>,</p>
        <p>Agradecemos por se juntar à nossa comunidade! Notamos que você criou uma conta, mas ainda não experimentou nossos planos exclusivos. Estamos aqui para lembrá-lo do mundo de possibilidades que a Aurora Miners pode oferecer.</p>
        <p style="background-color: #1f2937; color: #e5e7eb; padding: 15px; border-radius: 8px; border-left: 5px solid #00ff9d; margin: 20px 0;">
            <strong>Por que se tornar um membro ativo?</strong><br>
            - Acesso as nossas maquinas de mineração.<br>
            - Salas de mineração compartilhada.<br>
            - Ofertas especiais e muito mais!
        </p>
        <div style="padding: 10px; display: flex; justify-content: center;">
            <a href="{{ env('APP_URL') }}/#plans" style="padding: 20px; border-radius: 15px; font-size: 3rem; font-weight: bold; color: white; background-color: #00c57a; text-decoration: none;">SAIBA MAIS DETALHES</a>
        </div>
        <p>Caso tenha alguma dúvida ou precise de assistência, estamos à disposição para ajudá-lo(a).</p>
        <p style="text-align: center; font-size: 0.85em; color: #6b7280; margin-top: 20px;">&copy; 2024 Aurora Miners. Todos os direitos reservados.</p>
    </div>
</body>
</html>
