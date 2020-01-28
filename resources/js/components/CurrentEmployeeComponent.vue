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
                            <ul>
                                <li>ID #{{ employee.number }}</li>
                                <li>{{ employee.phone ? employee.phone : 'Belum memiliki Akun' }}</li>
                                <li class="mt-2">
                                    {{ employee.rating ? null : 'Belum memiliki Rating' }}
                                    <div v-if="employee.rating">
                                        <i class="fas fa-star" v-for="star in Math.trunc(employee.rating.evaluate)"></i>
                                        <i class="fas fa-star-half-alt"
                                            v-if="employee.rating.evaluate - Math.trunc(employee.rating.evaluate) > 0"></i>
                                        <i class="far fa-star" v-for="star in (4 - Math.trunc(employee.rating.evaluate))"></i>
                                    </div>
                                </li>
                            </ul>
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