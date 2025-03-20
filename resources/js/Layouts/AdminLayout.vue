<template>
     <Head title="Администрирование социальных очагов" />
 
    <div class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

    <!-- TOPTOOLS VUE -->
        <TOPTOOLS/>

    <!-- SIDEBAR VUE -->
          <SIDEBAR /> 

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <slot/>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer text-center">
            <strong>IMAS Dashboard {{ new Date().getFullYear() }}</strong><br/>
            &copy;Все права защищены.
        </footer>

        </div>
    </div>

</template>

<script setup>
// CSS
import '@/adminlte/plugins/fontawesome-free/css/all.min.css';
import '@/adminlte/dist/css/adminlte.min.css';
import '@/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css';

import 'vue-multiselect/dist/vue-multiselect.css'


// JS
import '@/adminlte/plugins/jquery/jquery.min.js';
import '@/adminlte/plugins/jquery-ui/jquery-ui.min.js';
import '@/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import '@/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js';
import '@/adminlte/dist/js/adminlte.js';
import { Head } from '@inertiajs/vue3';
import SIDEBAR from '@/Components/Admin/Sidebar.vue';
import TOPTOOLS from '@/Components/Admin/TopTools.vue';



</script>
