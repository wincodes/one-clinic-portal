<template>
    <div class="wrapper">
      <!-- sidebar -->
      <Sidebar />
        
        <div class="main-panel">
            <!-- navbar -->
            <Navbar />

            <!-- content section starts here -->
            <div class="content">
                <router-view />
            </div>

          <!-- footer -->
          <Footer />
        </div>
    </div>
</template>

<script>
import Navbar from "./layout/Navbar.vue";
import Sidebar from './layout/Sidebar';
import Footer from "./layout/Footer";
import { mapMutations } from "vuex";
export default {
    props: { user: Object },
    components: {
        Navbar,
        Sidebar,
        Footer
    },
    methods: {
        ...mapMutations(["setUser"])
    },
    created() {
        this.setUser(this.user);
    }
};
</script>
<style>
.content {
    min-height: 50%;
}
</style>
