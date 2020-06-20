<template>
    <div>
        <div class="row">
            <h1>Consultar cuenta</h1>
        </div>
        <div class="row">
            <div class="col-md-4 text-center">
                <h3> Su saldo disponible es: {{amount}}</h3>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Consult",
        props: ['documento', 'celular'],
        mounted() {
            this.getRecords()
        },
        data(){
            return {
                amount: 0.00,
                form: {}
            }
        },
        methods: {
            getRecords(){
                this.form = {
                    documento: this.documento,
                    celular: this.celular
                }
                this.$http.post('http://rest-api.test:40/client/get-balance', this.form)
                    .then(response => {
                        this.amount = (response.success) ? response.data.data : this.amount
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            },
        }
    }
</script>