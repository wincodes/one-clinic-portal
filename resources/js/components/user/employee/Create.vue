<template>
  <div class="content">
    <div class="container-fluid sub-content">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-primary">
              <div class="row">
                <div class="col-lg-8 col-md-12">
                  <h4 class="card-title">Create Employees</h4>
                  <p>Create an Employee</p>
                </div>
                <router-link to="/employee" class="col-lg-4 text-white mt-2">
                  <div class="d-flex flex-column align-items-center">
                    <div>
                      <i class="fas fa-user"></i>
                    </div>
                    <div class="mt-2">
                      <p>View Employees</p>
                    </div>
                  </div>
                </router-link>
              </div>
            </div>
            <div class="card-body">
              <form class="form" @submit="submit">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">First Name</label>
                      <input type="text" class="form-control" v-model="user.first_name" required />
                    </div>

                    <span
                      class="text-danger"
                      v-if="error.first_name"
                    >{{ error.first_name | displayErrors }}</span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Last Name</label>
                      <input type="text" class="form-control" v-model="user.last_name" required />
                    </div>

                    <span
                      class="text-danger"
                      v-if="error.last_name"
                    >{{ error.last_name | displayErrors }}</span>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Email</label>
                      <input type="email" class="form-control" v-model="user.email" required />
                    </div>

                    <span class="text-danger" v-if="error.email">{{ error.email | displayErrors }}</span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Birthdate (YYYY-MM-DD)</label>
                      <input type="text" class="form-control" v-model="user.birth_date" />
                    </div>

                    <span
                      class="text-danger"
                      v-if="error.birth_date"
                    >{{ error.birth_date | displayErrors }}</span>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Office</label>
                      <input type="office" class="form-control" v-model="user.office" />
                    </div>

                    <span class="text-danger" v-if="error.office">{{ error.office | displayErrors }}</span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Phone Number</label>
                      <input type="text" class="form-control" v-model="user.phone_number" />
                    </div>

                    <span
                      class="text-danger"
                      v-if="error.phone_number"
                    >{{ error.phone_number | displayErrors }}</span>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Employee Role</label>
                      <select class="form-control" v-model="user.role" required>
                        <option value>Select</option>
                        <option value="doctor">Doctor</option>
                        <option value="nurse">Nurse</option>
                        <option value="receptionist">Receptionist</option>
                        <option value="pharmacist">Pharmacist</option>
                        <option value="account">Account Officer</option>
                        <option value="other">Others</option>
                      </select>
                    </div>

                    <span class="text-danger" v-if="error.role">{{ error.role | displayErrors }}</span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Department</label>
                      <select class="form-control" v-model="user.department">
                        <option value>Select</option>
                      </select>
                    </div>

                    <span
                      class="text-danger"
                      v-if="error.department_id"
                    >{{ error.department_id | displayErrors }}</span>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Password</label>
                      <input type="password" class="form-control" v-model="user.password" required />
                    </div>

                    <span
                      class="text-danger"
                      v-if="error.password"
                    >{{ error.password | displayErrors }}</span>
                  </div>

                  <Loading v-if="loading" />
                </div>

                <div class="clearfix">
                  <button type="submit" :disabled="disabled" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapMutations } from "vuex";
import axios from "axios";
import Loading from "../../Loading.vue";
export default {
  name: "create-employee",
  components: {
    Loading
  },
  data() {
    return {
      user: {},
      error: {},
      disabled: false,
      loading: false
    };
  },
  created() {
    if (this.$store.state.auth.user.role !== "admin") this.$router.push("/");
  },
  methods: {
    ...mapMutations(["setNotification"]),

    async submit(e) {
      e.preventDefault();
      this.loading = true;
      this.disabled = true;
      this.error = {};

      await axios
        .post("/employee/create", this.user)
        .then(resp => {
          if (resp.status === 201) {
            this.setNotification({
              type: "success",
              message: "Employee Created Successfully"
            });
            this.user = {};
          } else {
            this.setNotification({
              type: "danger",
              message: "An error occurred, Please try again"
            });
          }
        })
        .catch(err => {
          let message;
          err.response.status === 403
            ? (message = "Only Admin is allowed to create employee")
            : (message = "Check Error messages");
          const { errors } = err.response.data;
          this.error = { ...this.error, ...errors };

          this.setNotification({
            type: "danger",
            message
          });
        });

      this.loading = false;
      this.disabled = false;
    }
  }
};
</script>
<style lang="scss">
</style>
