<template>
    <!--<transition name="modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Pago</h5>
                    <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="$emit('close')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h3>Se ha enviado un token de confirmacion a su correo, ingreselo acontinuacion</h3>
                    </div>
                    <form @submit="submit">
                        <div class="form-group">
                            <label for="document">Token de confirmacion</label>
                            <input type="text" class="form-control" id="document" placeholder="" v-model="form.token">
                            <p v-if="errors.token" style="color: red;">{{errors.token[0]}}</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            @click="$emit('close')"
                    >Close</button>
                    <button
                            type="button"
                            class="btn btn-primary"
                            @click="submit"
                    >Registrar</button>
                </div>
            </div>
        </div>
    </transition>-->
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            <h5 class="modal-title">Confirmar Pago</h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                                @click="$emit('close')">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <div class="text-center">
                                <h3>Se ha enviado un token de confirmacion a su correo, ingreselo acontinuacion</h3>
                            </div>
                            <form @submit="submit">
                                <div class="form-group">
                                    <label for="document">Token de confirmacion</label>
                                    <input type="text" class="form-control" id="document" placeholder="" v-model="form.token">
                                    <p v-if="errors.token" style="color: red;">{{errors.token[0]}}</p>
                                </div>
                            </form>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                                @click="$emit('close')"
                            >Close</button>
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="submit"
                            >Registrar</button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "ConfirmForm",
        mounted() {
            this.initForm()
        },
        data(){
            return {
                form: {},
                errors: {}
            }
        },
        methods: {
            submit(){
                this.$http.post('http://rest-api.test:40/client/confirm-payment', this.form)
                    .then(response => {
                        if( response.success ){
                            this.initForm()
                        }
                    })
                    .catch(error => {
                        console.log(error.response)
                        this.errors = error.response.data
                    })
            },
            initForm(){
                this.form = {
                    token: ''
                }
            }
        }
    }
</script>