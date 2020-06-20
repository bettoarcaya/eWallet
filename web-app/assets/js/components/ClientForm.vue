<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            <h5 class="modal-title">Registar cliente</h5>
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
                            <form @submit="submit">
                                <div class="form-group">
                                    <label for="document">Documento</label>
                                    <input type="text" class="form-control" id="document" placeholder="222333222" v-model="form.documento">
                                    <p v-if="errors.documento" style="color: red;">{{errors.documento[0]}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Nombres</label>
                                    <input type="text" class="form-control" id="fullname" placeholder="Jhon Doe" v-model="form.nombres">
                                    <p v-if="errors.nombres" style="color: red;">{{errors.nombres[0]}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Jhon.Doe@example.com" v-model="form.email">
                                    <p v-if="errors.email" style="color: red;">{{errors.email[0]}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Celular</label>
                                    <input type="text" class="form-control" id="phone" placeholder="4243332211" v-model="form.celular">
                                    <p v-if="errors.celular" style="color: red;">{{errors.celular[0]}}</p>
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
                            >Confirmar</button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "ClientForm",
        mounted() {
            this.initForm();
        },
        data(){
            return {
                form: {},
                errors: {}
            }
        },
        methods: {
            submit() {
                this.$http.post('http://rest-api.test:40/client/register', this.form)
                     .then(response => {
                         this.$emit('close');
                     })
                     .catch(error => {
                         console.log(error.response)
                         this.errors = error.response.data
                     })
            },
            initForm(){
                this.form = {
                    documento: '',
                    nombres: '',
                    email: '',
                    celular: ''
                }
                this.errors = {}
            }
        }

    }
</script>