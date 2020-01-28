<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <p class="lead font-bold mt-2 mb-6">
                List Karyawan
                <i class="fas fa-users float-right"></i>
              </p>              
            </div>

            <div class="col-12">
              <div class="py-0 pb-2">
                <input type="text" class="form-control" placeholder="Cari Karyawan">
              </div>
            </div>

            <div class="col-12 overflow-y-auto scrolling-touch h-64" v-if="response">
              <div class="card my-2" v-for="employee in response.data">
                <div class="card-body" v-bind:class="{ 'bg-teal-400 text-white' : (selectedEmployee === employee) }"
                  @click="selectEmployee(employee)">
                  <p class="font-bold">{{ employee.name }}</p>
                </div>
              </div>
            </div>

            <div class="col-12 py-2 mt-4 flex justify-center" v-if="response">
              <div class="w-12 mx-2 cursor-pointer" v-if="response.links.prev">
                <div class="card" @click="previousPage()">
                  <div class="card-body p-2 text-center">
                    <i class="fas fa-chevron-left"></i>
                  </div>
                </div>
              </div>
              <div class="w-12 mx-2 cursor-pointer" v-if="response.links.next">
                <div class="card" @click="nextPage()">
                  <div class="card-body p-2 text-center">
                    <i class="fas fa-chevron-right"></i>
                  </div>
                </div>
              </div>
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
          employees: {
            required: true,
          },
          token: {
            required: true,
          },
        },

        data() {
            return {
              response: null,
              selectedEmployee: 0,
            }
        },

        mounted() {
          axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
          this.getEmployees();
        },

        methods: {
          selectEmployee(employee) {
            this.selectedEmployee = employee;
          },

          getEmployees() {
            axios.get(this.employees).then(response => this.response = response.data);
          },

          nextPage() {
            axios.get(this.response.links.next).then(response => this.response = response.data);
          },

          previousPage() {
            axios.get(this.response.links.prev).then(response => this.response = response.data);
          },

          output() {
            this.$emit('output', this.selectedEmployee);
          }
        },

        watch: {
          selectedEmployee() {
            this.output(this.selectedEmployee);
          }
        }

    }

</script>