<template>
    <div class="row">
        <div class="col-3">
            <employee-list-component :employees="employees" @output="setEmployee"></employee-list-component>
        </div>
        <div class="col-7">
        </div>
        <div class="col-2">
            <current-employee-component :employee="currentEmployee"></current-employee-component>
        </div>
    </div>
</template>

<script type="text/javascript">
    
    export default {

        props: {
            employees: {
                required: true,
            }
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