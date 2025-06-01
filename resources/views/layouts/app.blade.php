<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'TokoBuku.ID')</title>

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


        <style>
            html,
            body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                font-family: Arial, sans-serif;
                background: #f9f9f9;
                transition: background-color 0.4s, color 0.4s;
                color: inherit;
            }

            body.dark-mode {
                background-color: #121212;
                color: #e0e0e0;
            }

            header {
                background: #3f51b5;
                color: white;
                padding: 15px 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .header-left {
                display: flex;
                align-items: center;
                gap: 30px;
            }

            nav {
                display: flex;
                gap: 15px;
            }

            nav a {
                color: white;
                text-decoration: none;
                font-weight: 500;
            }

            nav a:hover {
                text-decoration: underline;
            }

            main.container {
                flex: 1 0 auto;
                max-width: 1200px;
                margin: 20px auto;
                padding: 0 15px;
            }

            footer {
                background: #3f51b5;
                color: white;
                text-align: center;
                padding: 15px 0;
                margin-top: 50px;
            }

            #darkModeToggle {
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 30px;
                padding: 8px 16px;
                cursor: pointer;
                font-weight: bold;
                box-shadow: 0 5px 10px rgba(0, 123, 255, 0.4);
                transition: background-color 0.3s ease;
            }

            #darkModeToggle:hover {
                background-color: #0056b3;
                box-shadow: 0 8px 15px rgba(0, 86, 179, 0.6);
            }

            body.dark-mode header,
            body.dark-mode footer {
                background: #222;
                color: #ccc;
            }

            body.dark-mode nav a {
                color: #ccc;
            }
        </style>

        @stack('styles')
    </head>

    <body>
        <header>
            <div class="header-left">
                <h1 style="margin: 0; font-size: 1.8rem;">TokoBuku.ID</h1>

                @if(request()->routeIs('admin.*') && !request()->routeIs('admin.login'))
                    <nav>
                        <a href="{{ route('admin.books.index') }}">Kelola buku</a>
                        <a href="{{ route('admin.dashboard') }}" rel="noopener noreferrer">Dashboard</a>
                    </nav>

                @elseif(request()->is('admin/login'))
                    <!-- kosongkan navbar -->
                    <nav></nav>
                @else
                    <!-- Navigasi untuk user biasa -->
                    <nav>
                        <a href="{{ route('books.index') }}">Beranda</a>
                        <a href="https://wa.me/081360765971" target="_blank" rel="noopener noreferrer">Kontak</a>
                        <a href="https://feedback.qadristore.my.id/feedback" target="_blank" rel="noopener noreferrer">Feedback</a>
                    </nav>
                @endif
            </div>


            <button id="darkModeToggle" style="margin-left: auto; margin-right: 10px;">Dark Mode</button>
            @if(request()->routeIs('admin.*') && !request()->routeIs('admin.login'))
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" style="margin-left: auto; margin-right: 10px;"
                        class="btn btn-danger">Logout</button>
                </form>
            @endif
        </header>


        <main class="container">
            @yield('content')
        </main>

        <footer>
            &copy; 2025 TokoBuku.ID | Semua hak cipta dilindungi
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



        <script>
            const darkModeToggle = document.getElementById('darkModeToggle');
            darkModeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                darkModeToggle.textContent = document.body.classList.contains('dark-mode') ? 'Light Mode' : 'Dark Mode';
            });
        </script>

        @stack('scripts')
        @yield('scripts')
    </body>

</html>