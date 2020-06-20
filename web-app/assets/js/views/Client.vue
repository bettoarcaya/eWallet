<template>
    <div>
        <div class="row">
            <div class="col-md-8">
                <h1>Listado de clientes registrados</h1>
            </div>
            <div class="col-md-4">
                <button
                    class="btn btn-primary float-right margin-t-5"
                    @click="showForm = true"
                >Agregar</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Email</th>
                        <th scope="col">Celular</th>
                    </tr>
                    </thead>
                    <tbody>
                        <div v-if="clients.length > 0">
                            <tr
                                v-for="(client, index) in clients"
                                :key="index">
                                <th>{{index}}</th>
                                <th>{{client.documento}}</th>
                                <th>{{client.nombre}}</th>
                                <th>{{client.email}}</th>
                                <th>{{client.celular}}</th>
                            </tr>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        <ClientForm
            v-if="showForm"
            @close="close"
        ></ClientForm>
    </div>
</template>

<script>
    import ClientForm from '../components/ClientForm.vue';

    export default {
        name: "Client",
        components: {ClientForm},
        data() {
            return {
                showForm: false,
                clients: {}
            }
        },
        methods: {
            close(){
                this.showForm = false;
            }
        }
    }
</script>