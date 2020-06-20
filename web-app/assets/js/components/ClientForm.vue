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
                            <input type="text" class="form-control" id="document" placeholder="222333222">
                        </div>
                        <div class="form-group">
                            <label for="fullname">Nombres</label>
                            <input type="text" class="form-control" id="fullname" placeholder="Jhon Doe">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Jhon.Doe@example.com">
                        </div>
                        <div class="form-group">
                            <label for="phone">Celular</label>
                            <input type="text" class="form-control" id="phone" placeholder="4243332211">
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
        name: "ClientForm",
        data(){
            return {

            }
        },
        methods: {
            submit() {
                this.$http.get('http://rest-api.test:40/')
                     .then(response => {
                         console.log(response);
                     })
                     .catch(error => {
                         console.log(error.response)
                     })
            }
        }

    }
</script>