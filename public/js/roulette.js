document.addEventListener('DOMContentLoaded', function() {
      const openBoxButton = document.querySelector('.bg-emerald-600.py-2.text-xl.font-bold.px-4.rounded.cursos-pointer');
      const innerDiv = document.getElementById('innerDiv');
      const rouletteContainer = document.getElementById('roulette-container');
      const modalSection = document.getElementById('modalSection');
      const SecondModal = document.getElementById('SecondModal')
      const rewardSection = document.getElementById('reward');
      const roulette = document.getElementById('roulette');
  
      openBoxButton.addEventListener('click', function() {
          // Alterna a visibilidade da innerDiv e da roulette-container
          innerDiv.classList.add('hidden');
          rouletteContainer.classList.remove('hidden');
          SecondModal.style.overflowY = 'hidden';

          // Garante que o conteúdo da roleta seja duplicado suficientemente para cobrir a animação
          roulette.innerHTML += roulette.innerHTML + roulette.innerHTML;
  
          setTimeout(() => {
              const desiredItem = document.querySelector('.roulette-item[data-id="desired"]');
              if (!desiredItem) {
                  console.error('Desired item not found.');
                  return;
              }
      
              const viewportWidth = window.innerWidth || document.documentElement.clientWidth;
              let scaleFactor = viewportWidth < 768 ? 0.8 : 0.4;
      
              const updateLayout = () => {
                  const items = document.querySelectorAll('.roulette-item');
                  const desiredIndex = Array.from(items).indexOf(desiredItem) % (items.length / 3); 
                  const itemWidth = items[0].offsetWidth + parseInt(window.getComputedStyle(items[0]).marginRight, 10);
                  const totalWidth = itemWidth * items.length / 3;
                  const desiredPosition = desiredIndex * itemWidth * scaleFactor;
      
                  return {totalWidth, desiredPosition};
              };
      
              const {totalWidth, desiredPosition} = updateLayout();
      
              let start = null;
              const duration = 10000; // 10 segundos para a animação
              const totalTurns = 10; // Número total de voltas antes de parar
      
              const step = (timestamp) => {
                  if (!start) start = timestamp;
                  const runtime = timestamp - start;
                  const progress = Math.min(runtime / duration, 1);
                  const easeOutProgress = 1 - Math.pow(1 - progress, 4); 
      
                  const currentPosition = easeOutProgress * (totalWidth * totalTurns + desiredPosition);
                  roulette.style.transform = `translateX(-${currentPosition % (totalWidth * 3)}px)`;
      
                  if (runtime < duration) {
                      requestAnimationFrame(step);
                  } else {
                      // No final da animação, adiciona 'hidden' a certos elementos e remove de 'rewardSection'
                      rouletteContainer.classList.add('hidden');
                      innerDiv.classList.add('hidden');
                      modalSection.classList.add('hidden');
                      rewardSection.classList.remove('hidden');
                      SecondModal.style.overflowY = 'auto';
                  }
              };
      
              requestAnimationFrame(step);
          }, 1000);
      });
  });

  document.addEventListener('DOMContentLoaded', function() {
      // Seleciona o botão pelo ID
      const openBoxButton = document.getElementById('openBoxButton');
      
      // Seleciona os elementos pelo ID
      const overlay = document.getElementById('overlay');
      const modalSection = document.getElementById('modalSection');
      const innerDiv = document.getElementById('innerDiv');
  
      openBoxButton.addEventListener('click', function() {
          overlay.classList.remove('hidden'); // Remove a classe 'hidden' do overlay
          modalSection.classList.remove('hidden'); // Remove a classe 'hidden' da section
          innerDiv.classList.remove('hidden'); // Remove a classe 'hidden' da div interna
          document.body.style.overflowY = 'hidden'; // Impede a rolagem no body
      });
  });
  
  document.addEventListener('DOMContentLoaded', function() {
      const takeRewardButton = document.getElementById('take-reward');
      const overlay = document.getElementById('overlay');
      const rewardSection = document.getElementById('reward');
  
      takeRewardButton.addEventListener('click', function() {
          // Adiciona a classe 'hidden' ao overlay e ao rewardSection, fechando-os
          overlay.classList.add('hidden');
          rewardSection.classList.add('hidden');
          // Restaura a rolagem do body ao estado original (auto)
          document.body.style.overflowY = 'auto';
      });
  });  