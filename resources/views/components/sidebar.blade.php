<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="header_profile d-flex align-items-center dropdown">
            <button class="btn btn-link text-white dropdown-toggle text-decoration-none d-flex align-items-center" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="header_img me-2">
                    <img src="{{ asset($user->photo) }}" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px;">
                </div>
                Hi, {{ $user->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li>
                    <a href="{{ route('showChangePassword') }}" class="dropdown-item d-flex align-items-center">
                        <i class="bx bx-key nav_icon me-2"></i>
                        <span class="nav_name">Ganti Password</span>
                    </a>
                </li>
                <li class="mt-2">
                    <a href="{{ route('logout') }}" class="dropdown-item d-flex align-items-center">
                        <i class='bx bx-log-out nav_icon me-2'></i>
                        <span class="nav_name">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <div class="ps-3">
                    <a href="#" class="nav_logo"><i class='bx bx-gas-pump nav_logo-icon'></i> <span
                            class="nav_logo-name">Molecule</span></a>
                    <div class="pb-4">
                        <div style="height: 3px; background-color: #5692F9;"></div>
                    </div>
                    <div class="nav_list">
                        <a href="{{ route('registration') }}" class="nav_link {{ Request::routeIs('registration') ? 'active' : '' }}">
                            <i class='bx bx-pen nav_icon'></i><span class="nav_name">Registrasi</span>
                        </a>
                        <a href="{{ route('chart') }}" class="nav_link {{ Request::routeIs('chart') ? 'active' : '' }}">
                            <i class="bx bx-line-chart nav_icon"></i><span class="nav_name">Grafik</span>
                        </a>
                        @if ($user->role == 'superadmin')    
                        <a href="{{ route('user') }}"
                                class="nav_link {{ Request::routeIs('user') ? 'active' : '' }}">
                                <i class="fa-solid fa-user nav_icon"></i><span class="nav_name">User</span>
                            </a>
                        <a href="{{ route('logo') }}"
                                class="nav_link {{ Request::routeIs('logo') ? 'active' : '' }}">
                                <i class="fa-solid fa-image nav_icon"></i><span class="nav_name">Logo</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
        </nav>
    </div>

    <style>
        :root {
            --header-height: 3rem;
            --nav-width: 75px;
            --first-color: white;
            --first-color-light: #9b92bf;
            --white-color: #5692F9;
            --body-font: 'Nunito', sans-serif;
            --normal-font-size: 1rem;
            --z-fixed: 100
        }

        *,
        ::before,
        ::after {
            box-sizing: border-box
        }

        body {
            position: relative;
            margin: var(--header-height) 0 0 0;
            padding: 0 1rem;
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            transition: .5s
        }

        .header {
            width: 100%;
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            background-color: var(--white-color);
            z-index: var(--z-fixed);
            transition: .5s
        }

        .header_toggle {
            color: var(--first-color);
            font-size: 1.5rem;
            cursor: pointer
        }

        .header_img {
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden
        }

        .header_profile {
            display: flex;
            align-items: center;
        }

        .header_profile span {
            color: #000;
            font-size: 1rem;
            font-weight: 500;
        }

        .header_img img {
            width: 40px
        }

        .l-navbar {
            position: sticky;
            overflow: hidden;
            top: 0;
            left: -30%;
            width: var(--nav-width);
            height: 100vh;
            background-color: var(--first-color);
            padding: .5rem 1rem 0 0;
            transition: .5s;
            z-index: var(--z-fixed);
        }

        @media (max-width: 992px) {
            .l-navbar {
                position: fixed;
                top: 0;
                left: -30%;
                width: var(--nav-width);
                height: 100vh;
                background-color: var(--first-color);
                padding: .5rem 1rem 0 0;
                transition: .5s;
                z-index: var(--z-fixed);
            }
        }

        .nav {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden
        }

        .nav_logo,
        .nav_link {
            text-decoration: none;
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            padding: .5rem 0 .5rem 12px
        }

        .nav_logo {
            margin-bottom: 1.4rem
        }

        .nav_logo-icon {
            font-size: 1.25rem;
            color: var(--white-color)
        }

        .nav_logo-name {
            color: var(--white-color);
            font-weight: 700
        }

        .nav_link {
            position: relative;
            color: var(--first-color-light);
            margin-bottom: 0.5rem;
            transition: .1s
        }

        .nav_link:hover {
            color: white;
            background-color: var(--white-color);

            overflow: hidden;
        }

        .show .nav_link:hover {}

        .nav_icon {
            font-size: 1.25rem
        }

        .show {
            left: 0
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 1rem)
        }

        .active {
            color: white;
            background-color: var(--white-color);

            overflow: hidden;
        }

        .show .active {
            /* When the sidebar is open, this handles full width */

        }

        .l-navbar:not(.show) .nav_link.active {
            /* Apply border-radius to both sides even when the sidebar is collapsed */

            width: calc(var(--nav-width) - 32px);
            /* Extend the width slightly when collapsed */
        }

        .l-navbar:not(.show) .nav_link:hover {
            /* Apply border-radius to both sides even when the sidebar is collapsed */

            width: calc(var(--nav-width) - 32px);
            /* Extend the width slightly when collapsed */
        }

        .height-100 {
            height: 100vh
        }

        @media print {

            .l-navbar,
            .header {
                display: none;
                /* Sembunyikan sidebar dan navbar saat mencetak */
            }

            body {
                margin: 0;
                /* Hapus margin saat mencetak */
                padding: 0;
                /* Hapus padding saat mencetak */
            }
        }

        @media screen and (min-width: 992px) {
            body {
                margin: calc(var(--header-height) + 1rem) 0 0 0;
                padding-left: calc(var(--nav-width) + 2rem)
            }

            .header {
                height: calc(var(--header-height) + 1rem);
                padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
            }

            .header_img {
                width: 40px;
                height: 40px
            }

            .header_img img {
                width: 45px
            }

            .l-navbar {
                left: 0;
                padding: 1rem 1rem 0 0
            }

            .show {
                width: calc(var(--nav-width) + 156px)
            }

            .body-pd {
                padding-left: calc(var(--nav-width) + 188px)
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Cek apakah sidebar dalam keadaan terbuka di localStorage
                if (localStorage.getItem('sidebarOpen') === 'true') {
                    nav.classList.add('show');
                    toggle.classList.add('bx-x');
                    bodypd.classList.add('body-pd');
                    headerpd.classList.add('body-pd');
                }

                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // Toggle kelas 'show' untuk sidebar
                        nav.classList.toggle('show');
                        toggle.classList.toggle('bx-x');
                        bodypd.classList.toggle('body-pd');
                        headerpd.classList.toggle('body-pd');

                        // Simpan status sidebar ke localStorage
                        if (nav.classList.contains('show')) {
                            localStorage.setItem('sidebarOpen', 'true');
                        } else {
                            localStorage.setItem('sidebarOpen', 'false');
                        }
                    });
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');

            const linkColor = document.querySelectorAll('.nav_link');

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink));
        });
    </script>
</body>
