<!DOCTYPE html>
<html lang="id" class="bg-base-300">

<head>
    @include('layouts._partials.head')
    @include('layouts._partials.style')
</head>

<body>
    <div id="app">
        @include('layouts._partials.navbar')

        <main class="container mx-auto">
            <div class="py-8">
                @yield('main')
            </div>
        </main>
    </div>

    @include('layouts._partials.script')
</body>

</html>
