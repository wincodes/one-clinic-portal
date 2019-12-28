<template>
  <div class="main">
    <b-alert
      :show="dismissCountDown"
      :variant="notification.type"
      @dismissed="dismissCountDown=0"
      @dismiss-count-down="countDownChanged"
    >
      <div class="d-flex justify-content-between">
        <div class="alert-message">
          <i class="far fa-check-circle text-white pr-2" v-if="notification.type === 'info' || notification.type === 'success'"></i>
        <i class="fas fa-exclamation-triangle text-white pr-2" v-else></i>
        {{notification.message}}
        </div>
        <div class="close-btn">
          <i class="fas fa-times text-white pr-2" @click="dismissAlert"></i>
        </div>
      </div>
    </b-alert>
  </div>
</template>

<script>
import { mapState, mapMutations } from "vuex";

export default {
  data() {
    return {
      dismissSecs: 10,
      dismissCountDown: 0,
      showDismissibleAlert: false
    };
  },
  watch: {
    notification: {
      deep: true,

      handler() {
        if (this.notification.message !== null) {
          this.showAlert();
        }
      }
    }
  },
  computed: {
    ...mapState(["notification"])
  },
  methods: {
    ...mapMutations(["setNotification"]),

    countDownChanged(dismissCountDown) {
      if (dismissCountDown === 0) {
        this.setNotification({ type: null, message: null });
      }
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    },
    dismissAlert(){
      this.setNotification({ type: null, message: null });
      this.dismissCountDown = 0;
    }
  }
};
</script>