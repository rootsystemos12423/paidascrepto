async function sendEventToAPI(eventData) {
      try {
          // Montando os dados do evento no formato esperado pela API
          const eventPayload = {
              event_name: eventData.event_name || 'Purchase', // Nome do evento (pode ser diferente de 'Purchase')
              event_time: Math.floor(Date.now() / 1000), // Tempo do evento em Unix timestamp
              action_source: 'website',
              user_data: {
                  em: eventData.email_hashed, // E-mail já em hash SHA256
                  ph: eventData.phone_hashed, // Telefone já em hash SHA256
                  fn: eventData.first_name_hashed, // Primeiro nome em hash SHA256
                  ln: eventData.last_name_hashed, // Último nome em hash SHA256
                  client_ip_address: eventData.user_ip, // IP do usuário
                  client_user_agent: eventData.user_agent, // User agent do navegador
                  external_id: eventData.external_id, // ID externo do usuário
                  fbc: eventData.fbc, // Cookie de click do Facebook
                  fbp: eventData.fbp, // Cookie do pixel do Facebook
              },
              custom_data: {
                  currency: 'BRL',
                  value: eventData.value, // Valor da compra
              },
              event_source_url: eventData.event_source_url, // URL da página onde o evento aconteceu
          };
  
          // URL para a API (substitua pela sua URL de backend Laravel)
          const url = '/api/send-event'; // Rota da API no seu backend
  
          // Fazendo o fetch para o backend Laravel
          const response = await fetch(url, {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
              },
              body: JSON.stringify(eventPayload), // Envia os dados do evento no corpo da requisição
          });
  
          // Verificando a resposta da API
          if (response.ok) {
              const data = await response.json();
              console.log('Evento enviado com sucesso:', data);
          } else {
              console.error('Erro ao enviar o evento:', response.statusText);
          }
      } catch (error) {
          console.error('Erro na requisição:', error);
      }
  }


  // Chamando a função para enviar o evento
  sendEventToAPI(eventData);
  