<template>
    <div class="small-box bg-danger">
        <div class="inner">
            <h3>Peringkat</h3>
            <p>Kesalahan Karyawan</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-times"></i>
        </div>
        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#worstFailure">
            More info <i class="fas fa-arrow-circle-right"></i>
        </a>

        <div class="modal fade" id="worstFailure" tabindex="-1" role="dialog" aria-labelledby="worstFailureLabel" aria-hidden="true">
          <div class="modal-dialog text-dark" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="worstFailureLabel">Peringkat Karyawan yang melakukan Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <select name="filter" class="form-control" v-model="filter">
                            <option :value="null">-- Pilih Bulan --</option>
                            <option v-for="filter in filters" :value="filter">{{ filter }}</option>
                        </select>
                    </div>

                    <div class="col-12" v-for="(employee, index) in orderedEmployees" v-if="employee.failures !== 0">
                        <div class="card">
                            <div class="row">
                                <div class="col-10">
                                    <div class="card-default py-2 px-4">
                                        <p class="lead mb-0" style="font-weight: bolder;"><strong>{{ titleCase(employee.name) }}</strong></p>
                                        <p class="mb-0">Score: <span class="text-primary">{{ employee.failures }}</span></p>
                                    </div>
                                </div>
                                <div class="col-2 text-center">
                                    <p class="h3 pt-2 mt-1"><strong>#{{ index + 1 }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>

    export default {

        props: {
            token: {
                required: true,
            },
            route: {
                required: true,
            },
        },

        data() {
            return {
                response: null,
                date: null,
                filters: [],
                filter: null,
            }
        },

        mounted() {
            this.callApi();
        },

        methods: {
            callApi() {
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
                axios.get(this.route)
                    .then(response => {
                        this.response = response.data.data;
                        this.filters = this.response[0].ranges;
                    })
            },
            filterApi(str) {
              axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
              axios.get(this.route, {
                params: {
                  filter: str,
                }
              })
              .then(response => {
                this.response = response.data.data;
                this.filters = this.response[0].ranges;
              });
            },
            titleCase(str) {
              str = str.toLowerCase().split(' ');
              for (var i = 0; i < str.length; i++) {
                str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1); 
              }
              return str.join(' ');
            },
        },

        watch: {
            filter() {
                if (this.filter) {
                    this.filterApi(this.filter);
                }
            }
        },

        computed: {
          orderedEmployees: function () {
            return _.orderBy(this.response, ['failures'], ['desc'])
          }
        }

    }

</script>