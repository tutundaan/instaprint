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
              <div class="col-12" v-for="(employee, index) in orderedEmployees">
                <div class="card my-2">
                  <div class="card-body" v-bind:class="{ 'bg-purple-400 text-white' : (index === 0) }">
                    <p class="text-xl"><strong>{{ titleCase(employee.name) }}</strong></p>
                    <p>
                      <span class="mr-4">Rating : <strong>{{ employee.rating }}</strong></span>
                      <span class="mr-4">Skor Kehadiran : <strong>{{ employee.attendances }}</strong></span>
                      <span class="mr-4">Skor Kesalahan : <strong>{{ employee.failures }}</strong></span>
                    </p>
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
          }
        },

        mounted () {
          axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
          axios.get(this.rank)
          .then(response => {
            this.response = response.data.data;
          });
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
          }
        },

        computed: {
          orderedEmployees: function () {
            return _.orderBy(this.response, ['attendances', 'failures'], ['desc', 'asc'])
          }
        }
    }

</script>