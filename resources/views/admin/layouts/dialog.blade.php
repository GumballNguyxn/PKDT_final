@if(session('mes'))
    <div class="myDialog">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
        </div>
        <p class="mes mx-4 my-2">{{ session('mes') }}</p>
    </div>
    <style>
        .mes{
            font-size: x-large;
        }

        .myDialog {
            position: fixed;
            width: 350px;
            height: 100px;
            bottom: 0%;
            right: 0%;
            background: #ffffff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 0%;
            display: flex;
            opacity: 0;
            animation: fade 5s forwards;
        }

        @keyframes fade {
            0% {
                opacity: 1;
            }
            75% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

    </style>
    <script>
        window.addEventListener('load', function() {
            var element = document.querySelector('.myDialog');
            element.style.animation = 'fade 5s forwards';
        });
    </script>
@endif