<div class="card border-0" id="sidebar" style="width: 250px;">
    <div class="card-header bg-primary text-white text-center">
        Theme Settings
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item text-center">
            <button class="btn btn-sm btn-outline-primary" onclick="toggleTheme()">เปลี่ยนธีม</button>
        </li>
    </ul>
</div>

<script>
    function toggleTheme() {
        const body = document.body;
        body.classList.toggle('dark-theme');

        // เก็บสถานะไว้ใน localStorage เพื่อให้ธีมคงอยู่
        if (body.classList.contains('dark-theme')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    }

    // โหลดธีมจาก localStorage เมื่อเปิดหน้าใหม่
    window.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-theme');
        }
    });
</script>

<style>
    /* Light Theme (default) */
    body {
        background-color: #f8f9fa;
        color: #212529;
    }

    /* Dark Theme */
    body.dark-theme {
        background-color: #121212;
        color: #e0e0e0;
    }

    .dark-theme .card {
        background-color: #1e1e1e;
        color: white;
    }

    .dark-theme .btn-outline-primary {
        color: #ffffff;
        border-color: #ffffff;
    }

    .dark-theme .btn-outline-primary:hover {
        background-color: #ffffff;
        color: #121212;
    }

    .sidebar {
        width: 100px;
        margin-left: 7%;
        margin-top: 50px;
    }

    
</style>
