document.addEventListener('DOMContentLoaded', () => {
    window.Echo.channel('chat')
        .listen('.delete', (data) => {
            console.log("Evento recebido:", data);
            const selector = `[id="message-${data.messageId}"]`;
            console.log("Procurando por seletor:", selector);
            const elements = document.querySelectorAll(selector);
            console.log("Elementos encontrados:", elements.length);
            elements.forEach(element => {
                element.remove();
                console.log("Elemento removido:", element);
            });
        });
});



function deleteMessage(messageId) {
    if (confirm('Tem certeza que deseja excluir esta mensagem?')) {
        axios.post('/api/messages/delete', { id: messageId, username: window.username, })
            .then(response => {
            })
            .catch(error => {
                console.error('Erro ao excluir a mensagem:', error);
                alert('Não foi possível excluir a mensagem.');
            });
    }
}