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

            <div class="col-12 overflow-y-auto scrolling-touch h-64">
              <div class="card my-2" v-for="employee in employees">
                <div class="card-body" v-bind:class="{ 'bg-teal-400 text-white' : (selectedEmployee === employee) }"
                  @click="selectEmployee(employee)">
                  <p class="font-bold">Nama Karyawan</p>
                </div>
              </div>
            </div>

            <div class="col-12 py-2 mt-4 flex justify-center">
              <div class="w-12 mx-2">
                <div class="card">
                  <div class="card-body p-2 text-center">
                    <i class="fas fa-chevron-left"></i>
                  </div>
                </div>
              </div>
              <div class="w-12 mx-2">
                <div class="card">
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
        },

        data() {
            return {
              employees: 20,
              selectedEmployee: 0,
            }
        },

        methods: {
          selectEmployee(employee) {
            this.selectedEmployee = employee;
          }
        }

    }

</script>