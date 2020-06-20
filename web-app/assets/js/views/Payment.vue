<template>
    <div>
        <div class="row">
            <h1>Realizar Pago</h1>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 bg-white padd-20">
                <form @submit="submit">
                    <div class="form-group">
                        <label for="client">Cliente</label>
                        <select class="form-control" id="client" v-model="form.documento">
                            <option
                                v-for="(client, index) in clients"
                                :key="index"
                                :value="client.documento"
                            >{{client.documento}} - {{client.nombre}}</option>
                        </select>
                        <p v-if="errors.documento" style="color: red;">{{errors.documento[0]}}</p>
                    </div>
                    <div class="form-group">
                        <label for="amount">Monto</label>
                        <input type="number" class="form-control" id="amount" v-model="form.monto">
                        <p v-if="errors.monto" style="color: red;">{{errors.monto[0]}}</p>
                    </div>

                    <button type="button" class="btn btn-primary" @click="submit">Pagar</button>
                </form>
            </div>
        </div>
        <ConfirmForm
            v-if="showConfirmForm"
            @close="close"
        ></ConfirmForm>
    </div>
</template>

<script>
    import ConfirmForm from '../components/ConfirmForm.vue';
    export default {
        name: "Payment",
        components: {ConfirmForm},
        mounted() {
            this.initForm()
            this.getRecords()
        },
        data(){
            return {
                clients: {},
                form: {},
                errors: {},
                showConfirmForm: false
            }
        },
        methods: {
            initForm(){
                this.form = {
                    documento: '',
                    monto: ''
                }
                this.errors = {}
            },
            getRecords(){
                this.$http.get('http://rest-api.test:40/client/')
                    .then(response => {
                        this.clients = (response.success) ? response.data.data : {}
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            },
            submit(){
                this.$http.post('http://rest-api.test:40/client/pay', this.form)
                    .then(response => {
                      if( response.success ){
                          this.showConfirmForm = true
                          this.initForm()
                      }
                    })
                    .catch(error => {
                        console.log(error.response)
                        this.errors = error.response.data
                    })
            },
            close(){
                this.showConfirmForm = false;
            }
        }
    }
</script>