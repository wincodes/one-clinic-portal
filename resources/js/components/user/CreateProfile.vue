<template>
  <div class="content">
    <div class="container-fluid sub-content">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Create Profile</h4>
              <p class="card-category">Complete your profile</p>
            </div>
            <div class="card-body">
              <form class="form" @submit="submit">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Hospital Name</label>
                      <input
                        type="text"
                        class="form-control"
                        disabled
                        v-model="profile.hospital_name"
                      />
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Phone Number</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="profile.phone_number"
                        required
                      />
                    </div>

                    <span
                      class="text-danger"
                      v-if="error.phone_number"
                    >{{ displayErrors(error.phone_number) }}</span>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Position in Hospital</label>
                      <input type="text" class="form-control" v-model="profile.position" />
                    </div>

                    <span
                      class="text-danger"
                      v-if="error.position"
                    >{{ displayErrors(error.position) }}</span>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Fist Name</label>
                      <input type="text" class="form-control" v-model="profile.first_name" required />
                    </div>

                    <span
                      class="text-danger"
                      v-if="error.first_name"
                    >{{ displayErrors(error.first_name) }}</span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Last Name</label>
                      <input type="text" class="form-control" v-model="profile.last_name" required />
                    </div>

                    <span
                      class="text-danger"
                      v-if="error.last_name"
                    >{{ displayErrors(error.last_name) }}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Address</label>
                      <input type="text" class="form-control" v-model="profile.address" required />
                    </div>
                    <span
                      class="text-danger"
                      v-if="error.address"
                    >{{ displayErrors(error.address) }}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">City</label>
                      <input type="text" class="form-control" v-model="profile.city" required />
                    </div>

                    <span class="text-danger" v-if="error.city">{{ displayErrors(error.city) }}</span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">State</label>
                      <input type="text" class="form-control" v-model="profile.state" required />
                    </div>

                    <span class="text-danger" v-if="error.state">{{ displayErrors(error.state) }}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Gender</label>
                      <select class="form-control" v-model="profile.gender">
                        <option
                          :value="profile.gender"
                        >{{ profile.gender ? profile.gender : "Choose... "}}</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                      </select>
                    </div>

                    <span class="text-danger" v-if="error.gender">{{ displayErrors(error.gender) }}</span>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating pl-2">Country</label>
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
                        class="text-danger"
                        v-if="error.country"
                      >{{ displayErrors(error.country) }}</span>
                    </div>
                  </div>
                  <br />
                </div>

                <label>Your Picture (maximum 1 mb)</label>
                <input
                  type="file"
                  class="btn btn-primary"
                  :file="this.picture"
                  @change="fileChange"
                  accept="image/x-png, image/gif, image/jpeg"
                />

                <span class="text-danger" v-if="error.picture">{{displayErrors(error.picture) }}</span>

                <Loading v-if="loading" />

                <div class="clearfix">
                  <button
                    type="submit"
                    :disabled="disabled"
                    class="btn btn-primary pull-right"
                  >Create Profile</button>
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
import { mapActions, mapState, mapMutations } from "vuex";
import axios from "axios";
import Loading from "../Loading.vue";
export default {
  name: "create-profile",
  components: {
    Loading
  },
  data() {
    return {
      profile: {
        hospital_name: this.$store.state.auth.user.hospital_name,
        gender: "",
        country: "",
        phone_number: "",
        address: "",
        city: "",
        state: "",
        position: "",
        first_name: "",
        last_name: ""
      },
      error: {},
      picture: null,
      disabled: false,
      loading: false
    };
  },
  computed: {
    ...mapState(["auth", "general"])
  },
  async created() {
    await this.getCountries();
  },
  methods: {
    ...mapMutations(["setNotification"]),
    ...mapActions(["getCountries", "createProfile"]),

    fileChange(e) {
      const file = e.target.files[0];
      if (
        file.size < 1025000 &&
        file.type.match("image.jpeg|image.png|image.gif")
      ) {
        this.error.picture = "";
        this.disabled = false;
        this.picture = e.target.files[0];
      } else {
        this.error.picture = ["File must be an Image and less than 1mb"];
        this.disabled = true;
      }
    },

    async submit(e) {
      e.preventDefault();
      this.loading = true;
      this.disabled = true;
      this.error = {};

      this.profile.picture = this.picture;

      const formData = new FormData();
      const keys = Object.keys(this.profile);
      Object.values(this.profile).forEach((value, index) => {
        if (value !== null && value !== "") {
          formData.append(keys[index], value);
        }
      });

      await axios
        .post("/user/profile/create", formData)
        .then(resp => {
          if (resp.status === 201) {
            this.setNotification({
              type: "success",
              message: "Profile Created Successfully"
            });
            this.$router.push('/user/profile')
          }else{
            this.setNotification({
            type: "danger",
            message: "An error occurred, Please try again"
          });
          }
        })
        .catch(err => {
          const { errors } = err.response.data;
          this.error = { ...this.error, ...errors };
          
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
};
</script>
