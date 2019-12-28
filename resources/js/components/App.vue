<template>
  <div class="dashboard">
    <Alert class="alert-component" />
    
    <!-- sidebar -->
    <Sidebar />

    <div class="main-panel">
      <!-- navbar -->
      <Navbar />

      <!-- content section starts here -->
      <div class="content">
        <router-view class="content-view" />
      </div>

      <!-- footer -->
      <Footer />
    </div>
  </div>
</template>

<script>
import Navbar from "./layout/Navbar.vue";
import Sidebar from "./layout/Sidebar";
import Footer from "./layout/Footer";
import Alert from "./alert/Alert";
import { mapMutations } from "vuex";
export default {
  props: { user: Object },
  components: {
    Navbar,
    Sidebar,
    Footer,
    Alert
  },
  methods: {
    ...mapMutations(["setUser"])
  },
  created() {
    this.setUser(this.user);
  }
};
</script>
<style lang="scss" scoped>
.dashboard {
  .alert-component {
    position: fixed;
    width: 500px;
    right: 30px;
    z-index: 2;
    top: 50px
  }
  .main-panel {
    background-color: #eee;
    color: #3c4858;
    z-index: 1;
    .content {
      margin-top: 70px;
      padding: 30px 15px;
      min-height: calc(100vh - 123px);
      background-color: #eee;
      color: #3c4858;
    }
  }

  @media only screen and (max-width: 767.99px) {
  .alert-component {
    position: fixed;
    width: 320px;
    right: 0px !important;
    z-index: 2;
    top: 50px;
  }
}
}
</style>
