// forum.js
document.addEventListener('DOMContentLoaded', () => {
    function openCreateTopicModal() {
        // Logika untuk membuka modal atau form pembuatan topik baru
        console.log("Open create topic modal");
    }
    
    // Tambahkan event listener untuk tombol "Buat Topik Baru"
    document.querySelector('.btn-primary').addEventListener('click', openCreateTopicModal);
    function toggleDiscussion(discussionId) {
        const discussionElement = document.getElementById(discussionId);
        discussionElement.classList.toggle('hidden'); // Menggunakan kelas CSS untuk menyembunyikan atau menampilkan
    }
    
    // Contoh penggunaan:
    // toggleDiscussion('discussion1');
    function addComment(discussionId) {
        const commentInput = document.querySelector(`#commentInput-${discussionId}`);
        const commentText = commentInput.value;
        
        if (commentText) {
            // Logika untuk menambahkan komentar ke diskusi
            console.log(`Comment added to discussion ${discussionId}: ${commentText}`);
            commentInput.value = ''; // Kosongkan input setelah menambahkan komentar
        }
    }
    
    // Contoh penggunaan:
    // document.querySelector(`#addCommentButton-${discussionId}`).addEventListener('click', () => addComment(discussionId));
    function updateCommentCount(discussionId, count) {
        const countElement = document.querySelector(`#commentCount-${discussionId}`);
        countElement.textContent = `Comments: ${count}`;
    }
    function showNotification(message) {
        const notificationElement = document.createElement('div');
        notificationElement.className = 'alert alert-info';
        notificationElement.textContent = message;
        document.body.appendChild(notificationElement);
        
        setTimeout(() => {
            notificationElement.remove();
        }, 3000); // Hapus notifikasi setelah 3 detik
    }
    function searchDiscussions() {
        const searchTerm = document.querySelector('#searchInput').value.toLowerCase();
        const discussions = document.querySelectorAll('.forum-card');
    
        discussions.forEach(discussion => {
            const title = discussion.querySelector('.card-title').textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                discussion.style.display = 'block'; // Tampilkan diskusi yang cocok
            } else {
                discussion.style.display = 'none'; // Sembunyikan diskusi yang tidak cocok
            }
        });
    }
    
    // Tambahkan event listener untuk input pencarian
    document.querySelector('#searchInput').addEventListener('input', searchDiscussions);
    
    // Tambahkan event listener atau fungsi lainnya di sini
    console.log("Forum page loaded!");
});