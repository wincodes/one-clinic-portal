<template>
  <div>
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
                <router-link to="/user/profile/create" class="btn btn-primary btn-round">Profile Setup</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>

    </div>
  </div>
</template>
<script>
import { mapActions, mapState } from "vuex";
export default {
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
