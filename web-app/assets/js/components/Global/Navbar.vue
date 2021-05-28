<template>
  <nav
    class="navbar navbar-expand-lg navbar-light bg-light"
    style="margin-bottom: 20px;"
  >
    <a class="navbar-brand" href="#">eWallet</a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('client') }}">Cliente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('payment') }}">Pagar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('recharge') }}">Recargar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('consult') }}">Consultar</a>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('app_logout') }}">Log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Navbar",
  data() {
    return {};
  },
  methods: {
    url() {
      return "/";
    },
  },
};
</script>
