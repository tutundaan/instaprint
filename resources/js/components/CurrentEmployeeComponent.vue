<template>
    <div class="row" v-if="employee">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center py-4">
                            <div class="fas fa-user text-4xl"></div>
                        </div>
                        <div class="col-12 py-2 text-center">
                            <p class="font-bold text-lg">{{ employee.name }}</p>
                        </div>
                        <div class="col-12 py-2">
                            <dl class="row px-4">
                                <dt class="col-6">Nama</dt>
                                <dd class="col-6">{{ employee.name }}</dd>
                                <dt class="col-6">Nomor ID</dt>
                                <dd class="col-6"># {{ employee.code }}</dd>
                                <dt class="col-6">Akun Terkait</dt>
                                <dd class="col-6">{{ employee.user ? employee.user.name : 'Akun tidak tertaut' }}</dd>
                                <dt class="col-6">Nomor Telepon</dt>
                                <dd class="col-6">{{ employee.user ? employee.user.phone : 'Akun tidak tertaut' }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    
    export default {

        props: {
            employee: {
                required: true,
            }
        },

        data() {
            return {
            }
        }

    }

</script>