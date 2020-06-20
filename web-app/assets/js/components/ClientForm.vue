<template>
    <transition name="modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registar cliente</h5>
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
                    <form @submit="submit">
                        <div class="form-group">
                            <label for="document">Documento</label>
                            <input type="text" class="form-control" id="document" placeholder="222333222" v-model="form.documento">
                            <p v-if="errors.documeto" style="color: red;">{{errors.documeto[0]}}</p>
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
                    >Confirmar</button>
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

<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>