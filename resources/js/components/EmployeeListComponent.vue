<template>
  <div class="row">
    <div class="card mb-4 w-full">
      <div class="card-body">
        <current-user-component :user="user"></current-user-component>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <p class="lead font-bold mt-2 mb-6">
              <span>{{ (selectedEmployee) ? selectedEmployee.name : 'List Karyawan' }}</span>
              <i v-if="!selectedEmployee" class="fas fa-users float-right"></i>
              <a v-if="selectedEmployee" href="#" data-toggle="modal" data-target="#showEmployeeDetail" class="text-primary">
                <i class="fas fa-users float-right"></i>
              </a>
            </p>
            <div v-if="selectedEmployee"
              class="modal fade" id="showEmployeeDetail" tabindex="-1" role="dialog" aria-labelledby="showEmployeeDetail" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="showEmployeeDetail">Detail Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                      <div class="card-body px-4">
                        <dl class="row">
                          <dt class="col-6">Nama Karyawan</dt>
                          <dd class="col-6">{{ selectedEmployee.name }}</dd>
                          <dt class="col-6">ID</dt>
                          <dd class="col-6">{{ selectedEmployee.number }}</dd>
                          <dt class="col-6">Akun Tertaut</dt>
                          <dd class="col-6">{{ selectedEmployee.user ? selectedEmployee.user.name : 'Akun tidak tertaut' }}</dd>
                          <dt class="col-6">Nomor Telepon</dt>
                          <dd class="col-6">{{ selectedEmployee.user ? selectedEmployee.user.phone : 'Akun tidak tertaut' }}</dd>
                          <dt class="col-6">Hak Akses</dt>
                          <dd class="col-6">{{ selectedEmployee.user ? selectedEmployee.user.role.name : 'Akun tidak tertaut' }}</dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="py-0 pb-2">
              <input type="text" class="form-control" placeholder="Cari Karyawan" v-model="search">
            </div>
          </div>

          <div class="col-12 overflow-y-auto scrolling-touch h-64" v-if="response">
            <div class="card my-2" v-for="employee in filteredList">
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
          user: {
            required: true,
          },
        },

        data() {
            return {
              response: null,
              selectedEmployee: 0,
              search: '',
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
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
            axios.get(this.response.links.next).then(response => this.response = response.data);
          },

          previousPage() {
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
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
        },

        computed: {
          filteredList() {
            return this.response.data.filter(employee => {
              return employee.name.toLowerCase().includes(this.search.toLowerCase())
            })
          }
        }

    }

</script>