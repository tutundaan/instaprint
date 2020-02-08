<template>
  <div class="row">
    <div class="modal fade" id="ranking" tabindex="-1" role="dialog" aria-labelledby="ranking" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ranking">Peringkat Karyawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-8 mb-4">
                <p class="lead">
                  <strong>{{ date }}</strong>
                </p>
              </div>
              <div class="col-4">
                <div class="dropdown show float-right">
                  <a class="btn btn-secondary" href="#" role="button" id="rankDateFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pilih Bulan
                  </a>
                  <div class="dropdown-menu" aria-labelledby="rankDateFilter">
                    <button type="button" v-for="filter in filters" @click="filterApi(filter)" class="dropdown-item">{{ filter }}</button>
                  </div>
                </div>
              </div>
              <div class="col-12" v-for="(employee, index) in orderedEmployees">
                <div class="card my-2">
                  <div class="card-body" v-bind:class="{ 'bg-purple-400 text-white' : (index === 0) }">
                    <div class="row">
                      <div class="col-10">
                        <p class="text-xl"><strong>{{ titleCase(employee.name) }}</strong></p>
                        <p>
                          <span class="mr-4">Rating : <strong>{{ employee.rating }}</strong></span>
                          <span class="mr-4">Kehadiran : <strong>{{ employee.attendances }}</strong></span>
                          <span class="mr-4">Kesalahan : <strong>{{ employee.failures }}</strong></span>
                        </p>
                      </div>
                      <div class="col-2">
                        <span class="font-bold" v-bind:class="{ 'text-4xl' : (index === 0), 'text-xl' : (index !== 0) }">#{{ index + 1 }}</span><br>
                        <small>{{ employee.score }}</small>
                      </div>
                    </div>
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

<script>
    
    export default {

        components: {
        },

        props: {
          token: {
            required: true,
          },
          rank: {
            required: true,
          },
        },

        data () {
          return {
            response: null,
            date: null,
            filters: [],
          }
        },

        mounted () {
          this.callApi();
        },

        watch: {
        },

        methods: {
          titleCase(str) {
            str = str.toLowerCase().split(' ');
            for (var i = 0; i < str.length; i++) {
              str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1); 
            }
            return str.join(' ');
          },
          filter(str) {
            this.filterApi(str);
          },
          callApi() {
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
            axios.get(this.rank)
            .then(response => {
              this.response = response.data.data;
              this.date = this.response[0].period;
              this.filters = this.response[0].ranges;
            });
          },
          filterApi(str) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
            axios.get(this.rank, {
              params: {
                filter: str,
              }
            })
            .then(response => {
              this.response = response.data.data;
              this.date = this.response[0].period;
              this.filters = this.response[0].ranges;
            });
          }
        },

        computed: {
          orderedEmployees: function () {
            return _.orderBy(this.response, ['score'], ['desc', 'asc'])
          }
        }
    }

</script>