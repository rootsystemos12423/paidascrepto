<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Rendimento de Mineração</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
            height: auto;
        }
        .header h1 {
            font-size: 24px;
            color: #333;
        }
        .header p {
            font-size: 16px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        tfoot {
            font-weight: bold;
            background-color: #f4f4f4;
        }
        .total-row td {
            font-weight: bold;
            background-color: #eaeaea;
        }
        .summary {
            margin-top: 20px;
            font-size: 16px;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">      
        <h1>Relatório de Rendimento de Mineração</h1>
        <p>Osorno Crypto LTDA</p>
        <p>Período: 01/01/2024 a 31/01/2024</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Criptomoeda</th>
                <th>Lucro (R$) No Periodo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01/01/2024</td>
                <td>ALPH</td>
                <td class="text-right">123,45</td>
            </tr>
            <tr>
                <td>02/01/2024</td>
                <td>KASPA</td>
                <td class="text-right">130,67</td>
            </tr>
            <tr>
                <td>03/01/2024</td>
                <td>BTC</td>
                <td class="text-right">140,89</td>
            </tr>
            <!-- Adicione mais linhas conforme necessário -->
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2">Total</td>
                <td class="text-right">R$ 394,01</td>
            </tr>
        </tfoot>
    </table>

    <div class="summary">
        <p><strong>Lucro total no período:</strong> R$ 394,01</p>
        <p><strong>Hashrate médio:</strong> 10.5 TH/s</p>
    </div>

    <div class="footer">
        <p>Osorno Crypto LTDA - 49.920.635/0001-04</p>
    </div>
</body>
</html>
