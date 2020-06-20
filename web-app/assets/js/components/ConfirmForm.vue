<template>
    <transition name="modal" class="modal fade" tabindex="-1" role="dialog">
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

            },
            initForm(){
                this.form = {
                    token: ''
                }
            }
        }
    }
</script>