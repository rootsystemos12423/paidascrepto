document.addEventListener('DOMContentLoaded', () => {
    const rewardButton = document.getElementById('take-reward');
    const planInput = document.getElementById('sharkInput');
    const priceElement = document.getElementById('SharkPrice');
    const caseSection = document.getElementById('caseSec');

    rewardButton.addEventListener('click', () => {
        // Atualiza o valor do input para sharkDiscount
        planInput.value = 'sharkDiscount';

        // Calcula e exibe o novo preço com 20% de desconto
        const originalPrice = 899.90;
        const discount = originalPrice * 0.20;
        const newPrice = originalPrice - discount;

        // Atualiza o conteúdo do priceElement para incluir o novo preço e uma mensagem de desconto
        priceElement.innerHTML = `R$${newPrice.toFixed(2)} <b class="text-emerald-400">/mês</b>
                                  <br><span class="text-emerald-500 text-lg">Parabéns! Você ganhou 20% de desconto!</span>`;

        // Envia uma requisição para o Laravel para definir o cookie
        fetch('/set-cookie', {
            method: 'GET', // Ou POST, dependendo de como você configurou sua rota
        }).then(response => {
            console.log('Cookie set by Laravel');
        }).catch(error => {
            console.error('Error setting cookie', error);
        });

        // Faz o scroll até a seção de planos
        caseSection.remove();
        const plansSection = document.getElementById('plans');
        plansSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});
