<template>
  <div class="edit-profile">
    <div class="loading">
      <Loading v-if="this.loading" />
    </div>
    <div class="container-fluid" v-if="auth.profile !== null">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Edit Profile</h4>
            </div>
            <div class="card-body">
              <form class="form" @submit="submit">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Hospital Name</label>
                      <input
                        type="text"
                        class="form-control"
                        disabled
                        v-model="auth.user.hospital_name"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Phone Number</label>
                      <input
                        type="text"
                        is-invalid
                        v-model="profile.phone_number"
                        class="form-control"
                        name="phone_number"
                        required
                      />
                      <span
                        v-if="errors.phone_number"
                        class="text-danger"
                      >{{ displayErrors(errors.phone_number) }}</span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Position in Hospital</label>
                      <input
                        type="text"
                        is-invalid
                        v-model="profile.position"
                        class="form-control"
                        name="position"
                      />
                    </div>
                    <span
                      v-if="errors.position"
                      class="text-danger"
                    >{{ displayErrors(errors.position) }}</span>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Fist Name</label>
                      <input
                        type="text"
                        is-invalid
                        v-model="profile.first_name"
                        class="form-control"
                        name="first_name"
                        required
                      />
                    </div>

                    <span
                      v-if="errors.first_name"
                      class="text-danger"
                    >{{ displayErrors(errors.first_name) }}</span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Last Name</label>
                      <input
                        type="text"
                        is-invalid
                        v-model="profile.last_name"
                        class="form-control"
                        name="last_name"
                        required
                      />
                    </div>

                    <span
                      v-if="errors.last_name"
                      class="text-danger"
                    >{{ displayErrors(errors.last_name) }}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Address</label>
                      <input
                        type="text"
                        is-invalid
                        v-model="profile.address"
                        class="form-control"
                        name="address"
                        required
                      />
                    </div>
                    <span
                      v-if="errors.address"
                      class="text-danger"
                    >{{ displayErrors(errors.address) }}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">City</label>
                      <input
                        type="text"
                        is-invalid
                        v-model="profile.city"
                        class="form-control"
                        name="city"
                        required
                      />
                    </div>

                    <span v-if="errors.city" class="text-danger">{{ displayErrors(errors.city) }}</span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">State</label>
                      <input
                        type="text"
                        is-invalid
                        v-model="profile.state"
                        class="form-control"
                        name="state"
                        required
                      />
                    </div>

                    <span v-if="errors.state" class="text-danger">{{ displayErrors(errors.state) }}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Gender</label>
                      <select
                        is-invalid
                        v-model="profile.gender"
                        class="form-control"
                        name="gender"
                      >
                        <option></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                      </select>
                    </div>

                    <span
                      v-if="errors.gender"
                      class="text-danger"
                    >{{ displayErrors(errors.gender) }}</span>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Country</label>
                      <select id="country" v-model="profile.country" class="form-control" required>
                        <option
                          :value="profile.country"
                        >{{ profile.country ? profile.country : "select .... "}}</option>
                        <option
                          v-for="(country, index) in general.countries"
                          :key="index"
                          :value="country.name"
                        >{{ country.name }}</option>
                      </select>

                      <span
                        v-if="errors.country"
                        class="text-danger"
                      >{{ displayErrors(errors.country) }}</span>
                    </div>
                  </div>
                  <br />
                </div>
                <div class="row">
                  <div class="col-md-12" v-if="profile.picture">
                    <img
                      class="img-fluid img-thumbnail"
                      :src="`/storage/images/uploads/${auth.profile.picture}`"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label>Change Picture (maximum 1 mb)</label>
                    <input
                      type="file"
                      is-invalid
                      class="btn btn-primary"
                      :file="this.picture"
                      @change="fileChange"
                      accept="image/x-png, image/gif, image/jpeg"
                    />

                    <span
                      v-if="errors.picture"
                      class="text-danger"
                    >{{ displayErrors(errors.picture) }}</span>
                  </div>
                </div>
                <button
                  type="submit"
                  class="btn btn-primary pull-right"
                  :disabled="this.loading || this.disabled"
                >Update Profile</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions, mapState, mapMutations } from "vuex";
import Loading from "../Loading.vue";
export default {
  components: {
    Loading
  },
  data() {
    return {
      profile: {},
      errors: {},
      picture: null,
      disabled: false,
      loading: false
    };
  },
  computed: {
    ...mapState(["auth", "general"])
  },
  methods: {
    ...mapMutations(["setNotification"]),
    ...mapActions(["getCountries"]),

    fileChange(e) {
      const file = e.target.files[0];
      this.picture = file;
      if (
        file.size < 1025000 &&
        file.type.match("image.jpeg|image.png|image.gif")
      ) {
        this.errors.picture = "";
        this.disabled = false;
        this.picture = file;
      } else {
        this.errors.picture = ["File must be an Image and less than 1mb"];
        this.disabled = true;
      }
    },

    async submit(e) {
      e.preventDefault();
      this.loading = true;
      this.disabled = true;
      this.errors = {};

      this.profile.picture = this.picture;

      const formData = new FormData();
      const keys = Object.keys(this.profile);
      Object.values(this.profile).forEach((value, index) => {
        if (value !== null && value !== "") {
          formData.append(keys[index], value);
        }
      });

      await axios
        .post("/user/profile/update", formData)
        .then(resp => {
          if (resp.status === 200) {
            this.setNotification({
              type: "success",
              message: "Profile Updated Successfully"
            });
            this.$router.push("/user/profile");
          } else {
            this.setNotification({
              type: "danger",
              message: "An error occurred, Please try again"
            });
          }
        })
        .catch(err => {
          const { errors } = err.response.data;
          this.errors = { ...this.errors, ...errors };

          this.setNotification({
            type: "danger",
            message: "Check Error messages"
          });
        });
      this.loading = false;
      this.disabled = false;
    },

    displayErrors(error) {
      let string = "";
      error.forEach(err => {
        string = string + " " + err;
      });
      return string;
    }
  },
  async created() {
    if (this.$store.state.auth.profile === null) {
      this.$router.push("/user/profile");
    }
    await this.getCountries();
    this.profile = {
      ...this.$store.state.auth.profile
    };
  }
};
</script>
<style lang="scss">
.edit-profile {
  .loading {
    position: fixed;
    z-index: 2;
    top: 30%;
    left: 40%;
  }
}
</style>
