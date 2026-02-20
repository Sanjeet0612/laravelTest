<!-- resources/views/admin/layout/layout.blade.php -->

<!DOCTYPE html>
<html lang="en" data-theme="light">

    <!-- ..:: Head Section ::.. -->
    <x-admin::head />
    <!-- This will load: resources/views/admin/components/head.blade.php -->

<body>

    <!-- ..:: Sidebar Start ::.. -->
    @include('admin.components.sidebar')
    <!-- This will load: resources/views/admin/components/sidebar.blade.php -->

    <main class="dashboard-main">

        <!-- ..:: Navbar Start ::.. -->
        @include('admin.components.navbar')
        <!-- This will load: resources/views/admin/components/navbar.blade.php -->

        <div class="dashboard-main-body">

            <!-- ..:: Breadcrumb Start ::.. -->
            <x-admin::breadcrumb 
                :title="$title ?? ''" 
                :subTitle="$subTitle ?? ''" 
            />
            <!-- This will load: resources/views/admin/components/breadcrumb.blade.php -->

            <!-- ..:: Main Content ::.. -->
            @yield('content')
        
        </div>

        <!-- ..:: Footer Start ::.. -->
        <x-admin::footer />
        <!-- This will load: resources/views/admin/components/footer.blade.php -->

    </main>

    <!-- ..:: Scripts Start ::.. -->
    <x-admin::script :script="$script ?? ''" />
    <!-- This will load: resources/views/admin/components/script.blade.php -->
    <!-- Pass dynamic JS via $script variable from controller -->
    <!-- ..:: Scripts End ::.. -->

</body>

</html>
