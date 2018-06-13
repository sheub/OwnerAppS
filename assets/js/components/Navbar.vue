<template>
  <b-navbar toggleable="md" type="dark" variant="info">
    <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
    <b-navbar-brand href="/">OwnerApp</b-navbar-brand>
      <b-collapse is-nav id="nav_collapse">

      <b-navbar-nav>
        <b-nav-item href="/login">Login</b-nav-item>
        <b-nav-item href="#" disabled>Disabled</b-nav-item>
      </b-navbar-nav>


      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">

        <b-nav-form>
          <b-form-input size="sm" class="mr-sm-2" type="text" placeholder="Search"/>
          <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
        </b-nav-form>

        <b-nav-item-dropdown text="Lang" right>
          <b-dropdown-item href="#">EN</b-dropdown-item>
          <b-dropdown-item href="#">DE</b-dropdown-item>
          <b-dropdown-item href="#">FR</b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item-dropdown right>
          <!-- Using button-content slot -->
              <span class="navbar-text">
        <!--{{ currentUser.email }} -->
        <router-link to="/logout" class="btn btn-logout btn-sm">Logout</router-link>
      </span>
          <template slot="button-content">
            <em>User</em>
          </template>
          <b-dropdown-item href="#">Profile</b-dropdown-item>
          <b-dropdown-item href="#">Signout</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>

    </b-collapse>
  </b-navbar>

</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Navbar",
  computed: {
    ...mapGetters({ currentUser: "currentUser" })
  }
};
</script>

<style lang="scss" scoped>
.bg-bookstore {
  background: #605b56 !important;
}
.btn-logout {
  background-color: #837a75;
  border-color: #837a75;
  color: #fff;
}
.btn-logout:hover {
  background-color: darken(#837a75, 20%);
  border-color: darken(#837a75, 20%);
  color: #fff;
}
</style>