<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Daily Log</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="assets/libs/jquery/jquery.min.js"></script>
</head>


<body>

    <div id="layout-wrapper">

        @include('navbar')

        @yield('content')

    </div>

    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>


    <script src="assets/js/app.js"></script>
    <script>
        function changeTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.style.setProperty('--background-color', 'black');
                document.documentElement.style.setProperty('--text-color', 'white');
            } else {
                document.documentElement.style.setProperty('--background-color', 'white');
                document.documentElement.style.setProperty('--text-color', 'black');
            }
            localStorage.setItem('theme', theme);
            applyPalette(localStorage.getItem('palette') || 'red');
        }

        function changePalette(color) {
            localStorage.setItem('palette', color);
            applyPalette(color);
        }

        function applyPalette(color) {
            let colorVariable;
            if (document.documentElement.style.getPropertyValue('--background-color') === 'black') {
                colorVariable = `--afu-dark-theme-primary-${color}`;
                colorrgbVariable = `--afu-dark-theme-rgb-part-primary-${color}`;
                colordarkenVariable = `--afu-dark-theme-darken-primary-${color}`;
            } else {
                colorVariable = `--afu-light-theme-primary-${color}`;
                colorrgbVariable = `--afu-light-theme-rgb-part-primary-${color}`;
                colordarkenVariable = `--afu-light-theme-darken-primary-${color}`;
            }
            document.documentElement.style.setProperty('--afu-light-theme-primary', `var(${colorVariable})`);
            document.documentElement.style.setProperty('--afu-light-theme-rgb-part-primary',
                `var(${colorrgbVariable})`);
            document.documentElement.style.setProperty('--afu-light-theme-darken-primary',
                `var(${colordarkenVariable})`);
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const savedPalette = localStorage.getItem('palette') || 'first';
            if (savedPalette == 'first') {
                const optionPalette = document.getElementById('layout-palette-first');
                optionPalette.checked = true;
            } else if (savedPalette == 'second') {
                const optionPalette = document.getElementById('layout-palette-second');
                optionPalette.checked = true;
            } else if (savedPalette == 'third') {
                const optionPalette = document.getElementById('layout-palette-third');
                optionPalette.checked = true;
            } else if (savedPalette == 'fourth') {
                const optionPalette = document.getElementById('layout-palette-fourth');
                optionPalette.checked = true;
            }
            changeTheme(savedTheme);
            applyPalette(savedPalette);
        });
    </script>
</body>

</html>
