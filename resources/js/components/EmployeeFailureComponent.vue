<template>
    <div class="row justify-content-center">
      <div class="col-12 mb-4">
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                Banyaknya SPK Kesalahan : <strong>{{ employee.failures.length }}</strong>
              </div>
            </div>
          </div>
          
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                Kerugian Ditaksir : <strong>Rp. {{ collision.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') }}</strong>
                <a v-if="employee.failures.length != 0" href="#" data-toggle="modal" data-target="#showDetail" class="btn btn-sm float-right btn-primary">Detail</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-3">
        <p class="mb-2 lead"><strong>Dari</strong></p>
        <div class="card">
          <div class="card-body p-2">
            <datepicker input-class="form-control py-0" v-model="start"></datepicker>
          </div>
        </div>
        <p class="my-4 lead"><strong>Hingga</strong></p>
        <div class="card">
          <div class="card-body p-2">
            <datepicker input-class="form-control py-0" v-model="end"></datepicker>
          </div>
        </div>
        <button class="btn btn-block mt-4 bg-teal-400 text-white text-center" @click="fetchingData()">
          Ambil Data
        </button>
      </div>
      <div class="col-9">
          <div class="row">
            <div class="col-12">
              <failure-chart
                :options="options"
                :chart-data="datacollection"></failure-chart>
            </div>
          </div>
      </div>

      <div class="modal fade" id="showDetail" tabindex="-1" role="dialog" aria-labelledby="showDetailLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="showDetailLabel">Detail SPK Kesalahan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card my-2" v-for="failure in employee.failures">
                <div class="card-body">
                  <dl class="row">
                    <dt class="col-6">Tanggal</dt>
                    <dd class="col-6">{{ failure.date }}</dd>
                    <dt class="col-6">Kode</dt>
                    <dd class="col-6">{{ failure.number }}</dd>
                    <dt class="col-6">Perkiraan Kerugian</dt>
                    <dd class="col-6">Rp. {{ failure.subtotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') }}</dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>

    import FailureChart from './FailureChart'
    import Datepicker from 'vuejs-datepicker';

    export default {

        components: {
            FailureChart,
            Datepicker,
        },

        props: {
          employee: {
            required: true,
          },
          token: {
            required: true,
          },
        },

        data () {
          return {
            datacollection: null,
            labels: [],
            title: '',
            data: [],

            start: null,
            end: null,
            collision: 0,

            options: {
              responsive: true,
              maintainAspectRatio: false,
            },
          }
        },

        mounted () {
          this.computeData();
          this.fillData();
          axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        },

        watch: {
          employee() {
            this.computeData();
            this.fillData();
          }
        },

        methods: {
          computeData() {
            this.title = this.employee.name;

            this.labels = [];
            this.data = [];
            this.collision = 0;

            let dataset = {};

            this.employee.failures.map(data => {
                if (!this.labels.includes(data.date)) {
                    this.labels.push(data.date);
                    dataset[data.date] = 0;
                }

                dataset[data.date] += data.subtotal;
            })

            let array = Object.entries(dataset);

            array.map(data => {
                this.data.push(data[1]);
                this.collision += data[1];
            });

            this.start = this.labels[0];
            this.end = this.labels[this.labels.length - 1];
          },

          fillData () {
            this.datacollection = {
              labels: this.labels,
              datasets: [
                {
                    label: 'Jumlah Kerugian SPK',
                    backgroundColor: 'rgba(245, 102, 102, 0.7)',
                    borderColor: '#f56565',
                    pointBackgroundColor: '#f56565',
                    data: this.data,
                },
              ]
            }
          },
          fetchingData() {
            axios.post(this.employee.failure_range_link, {
              start: this.start,
              end: this.end,
            })
            .then(response => {
              this.employee = response.data.data;
            });

            this.computeData();
            this.fillData();
          }
        }
    }
    
</script>