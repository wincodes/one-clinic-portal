<template>
  <div class="profile">
    <div class="loading">
      <Loading v-if="auth.loading" />
    </div>
    <div v-if="auth.profile === null" class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10">
            <div class="card card-profile">
              <div class="card-body">
                <h2 class="card-category text-gray">Profile Unavailable</h2>
                <h4 class="card-title">You have not set up your profile</h4>
                <p class="card-description">
                  Please click the button below to set up your
                  profile.
                </p>
                <router-link
                  to="/user/profile/create"
                  class="btn btn-primary btn-round"
                >Profile Setup</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10">
            <div class="card card-profile">
              <div class="img-fluid img-thumbnail" v-if="auth.profile.picture">
                <img class="img" :src="`/storage/images/uploads/${auth.profile.picture}`" />
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <h5 class="card-title">Hospital Name</h5>
                    <p class="card-text">{{auth.user.hospital_name}}</p>
                    <hr />
                  </div>

                  <div class="col-md-4">
                    <h5 class="card-title">Staff Position</h5>
                    <p class="card-text">{{auth.profile.position}}</p>
                    <hr />
                  </div>

                  <div class="col-md-4">
                    <h5 class="card-title">Phone Number</h5>
                    <p class="card-text">{{auth.profile.phone_number}}</p>
                    <hr />
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <h5 class="card-title">First Name</h5>
                    <p class="card-text">{{auth.profile.first_name}}</p>
                    <hr />
                  </div>

                  <div class="col-md-4">
                    <h5 class="card-title">Last Name</h5>
                    <p class="card-text">{{auth.profile.last_name}}</p>
                    <hr />
                  </div>

                  <div class="col-md-4">
                    <h5 class="card-title">Gender</h5>
                    <p class="card-text">{{auth.profile.gender}}</p>
                    <hr />
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-10">
                    <h5 class="card-title">Address</h5>
                    <p class="card-text">{{auth.profile.address}}</p>
                    <hr />
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <h5 class="card-title">City</h5>
                    <p class="card-text">{{auth.profile.city}}</p>
                    <hr />
                  </div>

                  <div class="col-md-4">
                    <h5 class="card-title">State</h5>
                    <p class="card-text">{{auth.profile.state}}</p>
                    <hr />
                  </div>

                  <div class="col-md-4">
                    <h5 class="card-title">Country</h5>
                    <p class="card-text">{{auth.profile.country}}</p>
                    <hr />
                  </div>
                </div>

                <router-link to="/user/profile/edit" class="btn btn-primary btn-round">Edit Profile</router-link>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions, mapState } from "vuex";
import Loading from "../Loading.vue";
export default {
  components: {
    Loading
  },
  methods: {
    ...mapActions(["getProfile"])
  },
  created() {
    this.getProfile();
  },
  computed: {
    ...mapState(["auth"])
  }
};
</script>
<style lang="scss">
.profile {
  .loading {
    position: fixed;
    z-index: 2;
    top: 30%;
    left: 40%;
  }
}
</style>
