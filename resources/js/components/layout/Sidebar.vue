<template>
  <div class="sidebar" data-color="purple" data-background-color="white" data-image>
    <div class="logo">
      <routerLink to="/dashboard" class="simple-text logo-normal">User Dashboard</routerLink>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item" :class="{active: $route.name === 'dashboard' || $route.name === 'index'}">
          <routerLink class="nav-link" to="/dashboard">
            <i class="material-icons">dashboard</i>
            <p>Dashboard</p>
          </routerLink>
        </li>
        <li
          class="nav-item"
          :class="{active: $route.name === 'profile' ||  $route.name === 'create-profile' ||  $route.name === 'edit-profile'}"
        >
          <routerLink class="nav-link" to="/user/profile">
            <i class="material-icons">person</i>
            <p>Profile</p>
          </routerLink>
        </li>
        <li
          class="nav-item"
          v-if="auth.user.role === 'admin'"
          :class="{active: $route.name === 'employee' || $route.name === 'create-employee'}"
        >
          <routerLink class="nav-link" to="/employee">
            <i class="material-icons">content_paste</i>
            <p>Employees</p>
          </routerLink>
        </li>
        <li class="nav-item">
          <routerLink class="nav-link" to="/dashboard">
            <i class="material-icons">library_books</i>
            <p>Typography</p>
          </routerLink>
        </li>
        <li class="nav-item">
          <routerLink class="nav-link" to="/dashboard">
            <i class="material-icons">bubble_chart</i>
            <p>Icons</p>
          </routerLink>
        </li>
        <li class="nav-item">
          <routerLink class="nav-link" to="/dashboard">
            <i class="material-icons">location_ons</i>
            <p>Maps</p>
          </routerLink>
        </li>
        <li class="nav-item">
          <routerLink class="nav-link" to="/dashboard">
            <i class="material-icons">notifications</i>
            <p>Notifications</p>
          </routerLink>
        </li>
        <li class="nav-item">
          <routerLink class="nav-link" to="/dashboard">
            <i class="material-icons">language</i>
            <p>RTL Support</p>
          </routerLink>
        </li>
        <li class="nav-item active-pro">
          <a class="nav-link" href="/logout">
            <i class="material-icons">power_settings_new</i>
            <p>Log Out</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  name: "sidebar",
  computed: {
    ...mapState(["auth"])
  }
};
</script>
