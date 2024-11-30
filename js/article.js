document.addEventListener('DOMContentLoaded', () => {
    const articleList = document.getElementById('articleList');
    const createArticleButton = document.getElementById('createArticleButton');
    const articleModal = new bootstrap.Modal(document.getElementById('articleModal'));
    const articleForm = document.getElementById('articleForm');

    createArticleButton.addEventListener('click', () => {
        articleModal.show();
    });
    articleForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const title = document.getElementById('articleTitle').value;
        const content = document.getElementById('articleContent').value;

        addArticle(title, content);
        articleModal.hide();
        articleForm.reset();
    });

    function addArticle(title, content) {
        const articleCard = document.createElement('div');
        articleCard.className = 'article-card';
        articleCard.innerHTML = `
            <h5>${title}</h5>
            <p>${content}</p>
        `;
        articleList.appendChild(articleCard);
    }
});