document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search');
    const searchButton = document.querySelector('.btn-success');

    searchButton.addEventListener('click', () => {
        const query = searchInput.value.trim();
        if (query) {
            // Redirigir a una página de resultados de búsqueda
            window.location.href = `../../search-results.php?query=${encodeURIComponent(query)}`;
        }
    });

    // También puedes habilitar la búsqueda al presionar Enter
    searchInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
            const query = searchInput.value.trim();
            if (query) {
                window.location.href = `../../search-results.php?query=${encodeURIComponent(query)}`;
            }
        }
    });
});