<template>
    <div>
        <div class="row">
            <h1>Recargar cuenta</h1>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form @submit="submit">
                    <div class="form-group">
                        <label for="value">Monto</label>
                        <input type="number" class="form-control" id="value" v-model="form.valor">
                        <p v-if="errors.valor" style="color: red;">{{errors.valor[0]}}</p>
                    </div>
                    <button type="button" class="btn btn-primary" @click="submit">Recargar</button>
                </form>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        props: ['documento', 'celular'],
        name: "Recharge",
        mounted() {
            this.initForm()
        },
        data(){
            return {
                form: {},
                errors: {}
            }
        },
        methods:{
            initForm(){
                this.form = {
                    documento: this.documento,
                    celular: this.celular,
                    valor: 0
                }
                this.errors = {}
            },
            submit(){
                this.$http.post('http://rest-api.test:40/client/recharge', this.form)
                    .then(response => {
                        this.initForm()
                    })
                    .catch(error => {
                        console.log(error.response)
                        this.errors = error.response.data
                    })
            }
        }
    }
</script>