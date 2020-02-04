<template>
    <div class="row">
        <div class="col-3">
            <employee-list-component
                :employee="employee"
                :employees="employees" :token="token" @output="setEmployee" :user="user"></employee-list-component>
        </div>
        <div class="col-9">
            <employee-graph-component :employee="currentEmployee" :token="token" :rank="rank"></employee-graph-component>
        </div>
    </div>
</template>

<script type="text/javascript">
    
    import EmployeeGraphComponent from './EmployeeGraphComponent.vue'

    export default {

        components: {
            EmployeeGraphComponent,
        },

        props: {
            employees: {
                required: true,
            },
            token: {
                required: true,
            },
            user: {
                required: true,
            },
            employee: {
                required: true,
            },
            rank: {
                required: true,
            },
        },

        data() {
            return {
                currentEmployee: null,
            }
        },

        mounted() {
        },

        methods: {
            setEmployee(employee) {
                this.currentEmployee = employee;
            }
        }

    }

</script>