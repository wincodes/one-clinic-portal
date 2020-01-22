<template>
  <div class="employee container-fluid">
    <div class="container p-5 m-5">
      <Loading v-if="loading" />
    </div>
    <div class="row" v-if="!loading">
      <div class="col-lg-12 col-md-12">
        <employee-modal ref="employee-modal" :employee="currentStaff" @refresh="fetchEmployees" />
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-lg-8 col-md-12">
                <h4 class="card-title">Employees</h4>
                <p>All Employees</p>
              </div>
              <router-link to="/employee/create" class="col-lg-4 text-white">
                <div class="d-flex flex-column align-items-center">
                  <div>
                    <i class="fas fa-user-plus"></i>
                  </div>
                  <div class="mt-2">
                    <p>Add Employee</p>
                  </div>
                </div>
              </router-link>
            </div>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-info">
                <th class="text-center">First Name</th>
                <th class="text-center">Last Name</th>
                <th class="text-center">Office</th>
                <th class="text-center">Phone Number</th>
                <th class="text-center">Edit/Delete</th>
              </thead>
              <tbody>
                <tr v-for="staffs in employees" :key="staffs.id">
                  <td class="text-center">{{ staffs.first_name }}</td>
                  <td class="text-center">{{ staffs.last_name }}</td>
                  <td class="text-center">{{ staffs.office }}</td>
                  <td class="text-center">{{ staffs.phone_number }}</td>
                  <td class="text-info text-center">
                    <i @click="showModal(staffs)" style="cursor: pointer;" class="far fa-edit"></i>
                  </td>
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
import Loading from "../../Loading.vue";
import EmployeeModal from "../../modals/Employee.vue";
export default {
  components: {
    Loading,
    EmployeeModal
  },
  data() {
    return {
      loading: false,
      employees: [],
      currentStaff: {}
    };
  },
  created() {
    if (this.$store.state.auth.user.role !== "admin") this.$router.push("/");
  },
  computed: {
    ...mapState(["auth"])
  },
  async mounted() {
    this.fetchEmployees();
  },
  methods: {
    ...mapMutations(["setNotification"]),

    showModal(staff) {
      this.currentStaff = staff;
      this.$refs["employee-modal"].showModal();
    },
    async fetchEmployees() {
      this.loading = true;

      await axios
        .get("/employee/all")
        .then(resp => {
          const { employees } = resp.data;
          this.employees = employees;
        })
        .catch(err => {
          this.setNotification({
            type: "danger",
            message: "An error occurred please refresh the page"
          });
        });

      this.loading = false;
    }
  }
};
</script>
<style lang="scss" scoped>
</style>