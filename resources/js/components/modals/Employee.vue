<template>
  <div>
    <b-modal ref="my-modal" hide-footer title="Edit or Delete Emoloyee">
      <div class="d-block text-center">
        <div class="col-md-12">
          <Loading v-if="loading" />
          <div class="form-group">
            <label class="bmd-label-floating pl-2">First Name</label>
            <input type="text" class="form-control" v-model="employee.first_name" required />
            <span class="text-danger" v-if="error.first_name">{{ error.first_name | displayErrors }}</span>
          </div>
          <div class="form-group">
            <label class="bmd-label-floating pl-2">Last Name</label>
            <input type="text" class="form-control" v-model="employee.last_name" required />
            <span class="text-danger" v-if="error.last_name">{{ error.last_name | displayErrors }}</span>
          </div>
          <div class="form-group">
            <label class="bmd-label-floating pl-2">Date of Birth</label>
            <input type="text" class="form-control" v-model="employee.birth_date" required />
            <span class="text-danger" v-if="error.birth_date">{{ error.birth_date | displayErrors }}</span>
          </div>
          <div class="form-group">
            <label class="bmd-label-floating pl-2">Office</label>
            <input type="text" class="form-control" v-model="employee.office" required />
            <span class="text-danger" v-if="error.office">{{ error.office | displayErrors }}</span>
          </div>
          <div class="form-group">
            <label class="bmd-label-floating pl-2">First Name</label>
            <input type="text" class="form-control" v-model="employee.phone_number" required />
            <span
              class="text-danger"
              v-if="error.phone_number"
            >{{ error.phone_number | displayErrors }}</span>
          </div>
        </div>
      </div>
      <b-button class="mt-3 bg-info text-white" :disabled="loading" block @click="saveEmployee">Save</b-button>
      <b-button
        class="mt-3 bg-danger text-white"
        :disabled="loading"
        block
        @click="deleteEmployee"
      >Delete</b-button>
      <b-button
        class="mt-3"
        variant="outline-danger"
        :disabled="loading"
        block
        @click="hideModal"
      >Close</b-button>
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";
import { mapMutations } from "vuex";
import Loading from "../Loading.vue";
export default {
  props: {
    employee: Object
  },
  components: {
    Loading
  },
  data() {
    return {
      error: {},
      loading: false
    };
  },
  methods: {
    ...mapMutations(["setNotification"]),

    showModal() {
      this.$refs["my-modal"].show();
    },
    hideModal() {
      this.$refs["my-modal"].hide();
    },
    async saveEmployee() {
      this.loading = true;

      await axios
        .put(`/employee/${this.employee.id}`, this.employee)
        .then(resp => {
          if (resp.status === 200) {
            this.setNotification({
              type: "success",
              message: "Employee Updated Successfully"
            });
            this.$emit("refresh");
          } else {
            this.setNotification({
              type: "danger",
              message: "An error occurred, Please try again"
            });
          }
          this.hideModal();
        })
        .catch(err => {
          let message;
          err.response.status === 403
            ? (message = "Only Admin is allowed to update employee")
            : (message = "Check Error messages");
          const { errors } = err.response.data;
          this.error = { ...this.error, ...errors };

          this.setNotification({
            type: "danger",
            message
          });
        });

      this.loading = false;
    },
    async deleteEmployee() {
      if (confirm("Delete Employee? This Is not Reversible")) {
        this.loading = true;

        await axios
          .delete(`/employee/${this.employee.id}`)
          .then(resp => {
            this.setNotification({
              type: "success",
              message: "Employee Deleted Successfully"
            });
            this.$emit("refresh");
          })
          .catch(err => {
            this.setNotification({
              type: "danger",
              message: "An error occurred, Please try again"
            });
          });
        this.hideModal();
        this.loading = false;
      }
    }
  }
};
</script>