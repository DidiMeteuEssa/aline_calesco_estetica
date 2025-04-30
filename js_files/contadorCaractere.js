document.addEventListener('DOMContentLoaded', () => {
    const textareas = document.querySelectorAll('textarea');

    textareas.forEach((textarea, index) => {
        const max = textarea.getAttribute('maxlength') || 1000;

        // Cria o elemento do contador
        const contador = document.createElement('div');
        contador.className = 'contador';
        contador.textContent = `0 / ${max} caracteres`;

        // Adiciona o contador no mesmo <td> do textarea
        textarea.parentNode.appendChild(contador);

        // Evento para atualizar o contador
        textarea.addEventListener('input', () => {
            contador.textContent = `${textarea.value.length} / ${max}`;
        });

        // Atualiza o contador no carregamento inicial, se houver texto
        contador.textContent = `${textarea.value.length} / ${max}`;
    });
});