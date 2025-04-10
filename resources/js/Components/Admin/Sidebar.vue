<template>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a :href="route('main')" class="brand-link pl-4">
                <img class="img-fluid" src="/storage/images/imas.png" alt="imas">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a :href="route('dash-admin.projects')" :class="`nav-link ${route().current() == 'dash-admin.projects' ? 'active' : ''}`">
                    <i class="nav-icon fas fa-shopping-bag"></i>
                    <p>
                        Проекты
                    </p>
                     </a>
                </li>
                <li class="nav-item">
                    <a :href="route('dash-admin.index')" :class="`nav-link ${route().current() == 'dash-admin.index' ? 'active' : ''}`" >
                    <i class="nav-icon fas fa-shopping-bag"></i>
                    <p>
                        Проблемные вопросы
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a :href="route('dash-admin.tasks')" :class="`nav-link ${route().current() == 'dash-admin.tasks' ? 'active' : ''}`" >
                    <i class="nav-icon fas fa-shopping-bag"></i>
                    <p>
                        Пометки/Поручение
                    </p>
                    </a>
                </li>
                
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
</aside>

</template>
<script>
export default{ name : 'Sidebar'}

</script>