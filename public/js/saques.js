document.addEventListener('DOMContentLoaded', function() {
      const saquesContainer = document.getElementById('userSaques');
      let useDarkBg = true; // Variável de controle para alternar a cor de fundo
  
      function generateRandomSaque() {
          // Gera nomes e valores aleatórios
          const nomes = [
            'Ana Silva', 'João Santos', 'Maria Oliveira', 'José Souza',
            'Francisco Costa', 'Antônio Pereira', 'Carlos Rodrigues', 'Paula Fernandes',
            'Pedro Alves', 'Lucas Lima', 'Luiz Marques', 'Marcos Teixeira',
            'Gabriel Ribeiro', 'Rafael Andrade', 'Daniel Carvalho', 'Marcelo Vieira',
            'Bruno Araújo', 'Eduardo Barbosa', 'Felipe Rocha', 'Ricardo Pinto',
            'Márcia Cavalcanti', 'Roberto Moura', 'Juliana Correia', 'Sandra Cardoso',
            'Beatriz Dias', 'Gustavo Monteiro', 'André Mendes', 'Camila Batista',
            'Amanda Martins', 'Fernanda Magalhães', 'Rodrigo Almeida', 'Rafaela Gomes',
            'Patrícia Ramos', 'Aline Soares', 'Vanessa Freitas', 'Cristiane Fonseca',
            'Mário Lopes', 'César Ferreira', 'Renata Castro', 'Cláudia Nascimento',
            'Carolina Sampaio', 'Fábio Rezende', 'Julia Sales', 'Luciana Peixoto',
            'Tatiana Fogaça', 'Flávio Leite', 'Giovana Teles', 'Larissa Barros',
            'Natália Pinheiro', 'Tiago Vieira', 'Vitor Andrade', 'Renato Duarte',
            'Bianca Alves', 'Hugo Neves', 'Leonardo Brito', 'Elisa Lemos',
            'Viviane Moraes', 'Elias Coelho', 'Silvia Lima', 'Douglas Pires',
            'Débora Prado', 'Diogo Farias', 'Helena Rocha', 'Igor Melo',
            'Tânia Macedo', 'Denis Porto', 'Simone Leal', 'Fabiana Araujo',
            'Ricardo Oliveira', 'Alice Ribeiro', 'Caio Carneiro', 'Isabela Fonseca',
            'Emerson Santos', 'Rosana Pereira', 'Samuel Teixeira', 'Carla Morais',
            'Luis Otávio', 'Fernando Cunha', 'Sônia Loureiro', 'Geraldo Magela',
            'Manuela Ferreira', 'Marco Antônio', 'Lívia Andrade', 'Rebeca Costa',
            'Guilherme Salgado', 'Regina Lima', 'Felipe Novaes', 'Priscila Guedes',
            'Henrique Dias', 'Raquel Xavier', 'Leonardo Martins', 'Beatriz Gomes',
            'Adriano Silva', 'Inês Carvalho', 'Gustavo Rocha', 'Mirella Furtado',
            'Lauro Queiroz', 'Esther Vieira', 'Bruna Campos', 'Thiago Pacheco',
            'Verônica Borges', 'Nelson Barreto', 'Fátima Bernardes', 'Júlio César',
            'Leticia Marinho', 'Rogerio Figueiredo', 'Isaac Monteiro', 'Lorena Bicalho',
            'Marcela Esteves', 'Ivan Carvalho', 'Gabriela Duarte', 'Otávio Souza',
            'Miriam Alcântara', 'Yuri Ferraz', 'Elaine Cardoso', 'Fábio Junior',
            'Daniela Lacerda', 'Arthur Gomes', 'Keila Siqueira', 'Joel Pimenta',
            'Sandra Faria', 'Alex Barros', 'Sílvia Pimentel', 'Heitor Vilela',
            'Sérgio Lima', 'Tamires Almeida', 'Rogério Costa', 'Jaqueline Melo',
            'Anderson Freire', 'Lídia Batista', 'Rodolfo Alves', 'Célia Tavares',
            'Eduardo Pereira', 'Monica Carvalho', 'Angelo Martins', 'Clara Mendes'
          ];
                    
          const valorMin = 1400;
          const valorMax = 10000;
          
          const nomeAleatorio = nomes[Math.floor(Math.random() * nomes.length)];
          const valorAleatorio = (Math.random() * (valorMax - valorMin) + valorMin).toFixed(2);
          const valorFormatado = Number(valorAleatorio).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
  
          // Cria o container do saque e alterna a cor de fundo
          // Cria o container do saque e aplica a animação inicial
        const saqueDiv = document.createElement('div');
        saqueDiv.className = `p-6 rounded-xl w-full flex justify-between items-center 
                              bg-white fade-in transition-height shadow-md hover:shadow-lg 
                              transform hover:scale-105 transition-transform duration-300`;

        // Adiciona a classe de animação para entrada suave
        saqueDiv.classList.add('animate-entry');
        setTimeout(() => {
            // Remove a classe de animação após 500ms (duração da animação)
            saqueDiv.classList.remove('animate-entry');
        }, 500);

        saqueDiv.innerHTML = `
            <div class="flex items-center space-x-4">
                <div class="text-gray-800">
                    <p class="font-bold text-lg">Usuário: ${nomeAleatorio}</p>
                    <p class="font-bold text-blue-500 text-lg">Valor: R$ ${valorFormatado}</p>
                </div>
            </div>
           <div class="flex items-center justify-center bg-blue-500 rounded-full w-10 h-10">
                    <!-- Ícone de saque (tema claro) -->
                    <svg class="text-white w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
        `;

          // Adiciona o novo saque ao container e alterna a cor de fundo
          // Dentro de generateRandomSaque, removemos a chamada duplicada para remoção do elemento
          if (saquesContainer.children.length >= 6) {
              // Chamamos removeElementSmoothly para o último filho
              removeElementSmoothly(saquesContainer.children[saquesContainer.children.length - 1]);
          }
  
          saquesContainer.insertBefore(saqueDiv, saquesContainer.firstChild);
          useDarkBg = !useDarkBg;
      }
  
      // Gera 10 saques iniciais com cores alternadas
      for (let i = 0; i < 6; i++) {
          generateRandomSaque();
      }
  
      // Continua gerando um novo saque a cada 2 segundos, alternando as cores
      setInterval(generateRandomSaque, 2000);
  });
  
  function removeElementSmoothly(element) {
      if (element && element.parentNode) {
          const currentScrollPosition = window.scrollY; // Salva a posição atual de scroll
  
          element.style.transition = 'opacity 0.5s ease-out, height 0.5s ease-out';
          element.style.opacity = '0';
          element.style.height = '0px'; // Ajuste conforme a propriedade de altura do seu elemento
  
          setTimeout(() => {
              if (element.parentNode) {
                  element.parentNode.removeChild(element);
  
                  // Após a remoção, restaura a posição de scroll anterior
                  window.scrollTo(0, currentScrollPosition);
              }
          }, 0); // O tempo aqui deve corresponder à duração da transição CSS
      }
  }
  
  
  