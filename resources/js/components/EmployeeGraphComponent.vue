<template>
    <div class="row justify-content-center" v-if="employee">
        <div class="col-3 cursor-pointer" v-for="tab in tabs">
            <div class="card">
                <div class="card-body py-2 text-center" v-bind:class="[tab.hover, (activeTab === tab.id) ? tab.color : '']"
                    @click="setActiveTabTo(tab.id)">
                    <p class="lead font-bold">{{ tab.label }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4" v-if="activeTab">
            <div class="card">
                <div class="card-body">
                    <employee-rating-component v-if="activeTab === 1" :employee="employee"></employee-rating-component>
                    <employee-failure-component v-if="activeTab === 2"></employee-failure-component>
                    <employee-attendance-component v-if="activeTab === 3"></employee-attendance-component>
                </div>
            </div>
        </div>
    </div>    
</template>

<script>

    import EmployeeRatingComponent from './EmployeeRatingComponent.vue'
    import EmployeeFailureComponent from './EmployeeFailureComponent.vue'
    import EmployeeAttendanceComponent from './EmployeeAttendanceComponent.vue'

    export default {

        components: {
            EmployeeRatingComponent,
            EmployeeFailureComponent,
            EmployeeAttendanceComponent,
        },

        props: {
            employee: {
                required: true,
            }
        },

        data() {
            return {
                tabs: [
                    {
                        id: 1,
                        label: 'Penilaian',
                        color: 'bg-teal-400 text-white',
                        hover: 'hover:bg-teal-400 hover:text-white',
                    },
                    {
                        id: 2,
                        label: 'Kesalahan',
                        color: 'bg-red-400 text-white',
                        hover: 'hover:bg-red-400 hover:text-white',
                    },
                    {
                        id: 3,
                        label: 'Kehadiran',
                        color: 'bg-blue-400 text-white',
                        hover: 'hover:bg-blue-400 hover:text-white',
                    },
                ],

                activeTab: null,
            }
        },

        methods: {
            setActiveTabTo(number) {
                this.activeTab = number;
            }
        }

    }
</script>