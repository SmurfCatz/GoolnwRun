<div class="card border-0 shadow-lg" id="sidebar" style="width: 250px;">
    <div class="card-header text-white text-center">
    {{ __('messages.setting') }}
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item text-center">
            <button class="btn-theme btn-sm " onclick="toggleTheme()">{{ __('messages.change theme') }}</button>
        </li>
    </ul>
</div>



<script>
    function toggleTheme() {
    const body = document.body;
    const isDark = body.classList.toggle('dark-theme');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }
                    
    document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
    document.body.classList.add('dark-theme');
    }
    });
</script>

<style>
    .sidebar {
        width: 100px;
        margin-left: 7%;
        margin-top: 50px;
    }

    .btn-theme {
        background-color:rgb(130, 66, 225);
        color:rgb(255, 255, 255);
        border: none;
        padding: 8px 30px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 16px
        transition: background-color 0.3s ease;
    }

    .btn-theme:hover {
        background-color:rgb(130, 66, 225);
        transform: scale(1.05);
    }

    .card-header {
        background-color:rgb(130, 66, 225);
        font-weight: 500;
        font-size: 30px
    }

    .dark-theme {
        background-color:rgb(130, 66, 225) !important;
        color: white;
    }

    .dark-theme .card, .dark-theme input, .dark-theme select, .dark-theme .form-control {
        background-color:rgb(174, 32, 157) !important;
        color: white !important;
    }
</style>
