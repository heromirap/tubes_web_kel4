@if (session()->has('message'))
    <div class="alert-message">
        <p>{{ session('message') ?? 'hhhs' }}</p>
        <span class="close">x</span>
    </div>

    <script>
        let alertPanel = document.querySelector('.alert-message')
        let closeBtn = document.querySelector('.close')

        closeBtn.addEventListener('click', () => {
            alertPanel.style = 'display: none;'
        })
    </script>
@endif
