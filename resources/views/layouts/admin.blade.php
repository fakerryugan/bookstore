<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Ryuu Book</title>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
</head>
<body 
    x-data="{ sidebarToggle: true, sidebarHover: false, darkMode: false }" 
    x-cloak    :class="{ 'dark': darkMode }"
    class="font-outfit antialiased text-gray-600 bg-gray-50 dark:bg-black"
>
    <div class="flex h-screen overflow-hidden">
        @include('partials.admin.sidebar')

        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            @include('partials.admin.header')

            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
