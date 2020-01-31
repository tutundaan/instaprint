<template>
    <div class="row">
        <div class="col-3">
            <employee-list-component :employees="employees" :token="token" @output="setEmployee"></employee-list-component>
        </div>
        <div class="col-9">
            <employee-graph-component :employee="currentEmployee" :token="token"></employee-graph-component>
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
        },

        data() {
            return {
                currentEmployee: null,
            }
        },

        methods: {
            setEmployee(employee) {
                this.currentEmployee = employee;
            }
        }

    }

</script>