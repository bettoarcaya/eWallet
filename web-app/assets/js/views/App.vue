<template>
  <div class="col-md-12 bg-white padd-20">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Token ID</th>
          <th scope="col">Monto</th>
          <th scope="col">Estatus</th>
        </tr>
      </thead>
      <tbody>
        <div v-if="payments.length > 0">
          <tr v-for="(payment, index) in payments" :key="index">
            <th>{{ index }}</th>
            <th>{{ payment.token }}</th>
            <th>{{ payment.value }}</th>
            <th>{{ payment.status }}</th>
          </tr>
        </div>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "App",
  mounted() {
    this.getRecords();
  },
  data() {
    return {
      payments: {},
    };
  },
  methods: {
    getRecords() {
      this.$http
        .get("http://rest-api.test:40/client/get-payments")
        .then((response) => {
          this.payments = response.success ? response.data.data : {};
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>
