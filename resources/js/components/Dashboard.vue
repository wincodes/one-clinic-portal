<template>
  <div class="dashboard container-fluid">
    <div class="container p-5 m-5">
      <Loading v-if="loading" />
    </div>
    <div class="row" v-if="!loading">
      <div class="col-lg-6 col-md-12" v-if="auth.user.role === 'admin'">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-lg-8 col-md-12">
                <router-link to="/employee/" class="col-lg-4 text-white">
                  <h4 class="card-title">Employees</h4>
                </router-link>
                <p>First 5 Employees</p>
              </div>
              <router-link to="/employee/create" class="col-lg-4 text-white mt-4">
                <i class="employees fas fa-user-plus"></i>
                <p class="mt-2">Add Employee</p>
              </router-link>
            </div>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-info">
                <th>First Name</th>
                <th>Last Name</th>
                <th>Office</th>
                <th>Phone Number</th>
              </thead>
              <tbody>
                <tr v-for="staffs in dashboard.staffs" :key="staffs.id">
                  <td>{{ staffs.first_name }}</td>
                  <td>{{ staffs.last_name }}</td>
                  <td>{{ staffs.office }}</td>
                  <td>{{ staffs.phone_number }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState, mapMutations } from "vuex";
import axios from "axios";
import Loading from "./Loading.vue";
export default {
  components: {
    Loading
  },
  data() {
    return {
      loading: false,
      dashboard: {}
    };
  },
  computed: {
    ...mapState(["auth"])
  },
  async mounted() {
    this.loading = true;

    await axios
      .get("/dashboard/all")
      .then(resp => {
        const { dashboard } = resp.data;
        this.dashboard = dashboard;
      })
      .catch(err => {
        this.setNotification({
          type: "danger",
          message: "An error occurred please refresh the page"
        });
      });

    this.loading = false;
  },
  methods: {
    ...mapMutations(["setNotification"])
  }
};
</script>
<style lang="scss" scoped>
.dashboard {
  .employees {
    margin-left: 30%;
  }
}
</style>