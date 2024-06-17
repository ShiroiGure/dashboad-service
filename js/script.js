document.addEventListener('DOMContentLoaded', function() {
    fetchNotices();

    document.getElementById('noticeForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const id = document.getElementById('noticeId').value;
        const title = document.getElementById('title').value;
        const message = document.getElementById('message').value;

        if (id) {
            fetch('update_notice.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}&title=${title}&message=${message}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                fetchNotices();
                document.getElementById('noticeForm').reset();
                document.getElementById('noticeId').value = '';
            });
        } else {
            fetch('add_notice.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `title=${title}&message=${message}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                fetchNotices();
                document.getElementById('noticeForm').reset();
            });
        }
    });
});

function fetchNotices() {
    fetch('get_notices.php')
        .then(response => response.json())
        .then(data => {
            const noticesDiv = document.getElementById('notices');
            noticesDiv.innerHTML = '';
            data.forEach(notice => {
                const noticeDiv = document.createElement('div');
                noticeDiv.classList.add('notice');
                noticeDiv.innerHTML = `
                    <h3>${notice.title}</h3>
                    <p>${notice.message}</p>
                    <small>${notice.created_at}</small>
                    ${notice.is_admin ? `<button onclick="editNotice(${notice.id}, '${notice.title}', '${notice.message}')">Editar</button>
                    <button onclick="deleteNotice(${notice.id})">Excluir</button>` : ''}
                `;
                noticesDiv.appendChild(noticeDiv);
            });
        });
}

function editNotice(id, title, message) {
    document.getElementById('noticeId').value = id;
    document.getElementById('title').value = title;
    document.getElementById('message').value = message;
}

function deleteNotice(id) {
    if (confirm('Tem certeza de que deseja excluir este aviso?')) {
        fetch('delete_notice.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            fetchNotices();
        });
    }
}
