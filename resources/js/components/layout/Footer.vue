<template>
  <footer class="footer">
    <div class="container-fluid">
      <div class="copyright float-left">
        &copy;
        {{ new Date().getFullYear() }}
        , Clinic Portals by
        <a
          href="/"
          target="_blank"
        >HealthStack</a>
      </div>

      <div class="copyright float-right">
        &copy;
        {{ new Date().getFullYear() }}
        , theme made by
        <i
          class="material-icons"
        >favorite</i> by
        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
        for a better web.
      </div>
    </div>
  </footer>
</template>
<style lang="scss">
.footer {
    padding-bottom: 10px;
    background-color: #eee;
  a {
    color: #9c27b0;
  }
}
</style>
