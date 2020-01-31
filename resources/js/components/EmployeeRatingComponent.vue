<template>
    <div class="row justify-content-center">
        <div class="col-9">
            <radar-chart
              :options="options"
              :chart-data="datacollection"></radar-chart>
        </div>
    </div>
</template>

<script>
    
    import RadarChart from './RadarChart'

    export default {

        components: {
            RadarChart,
        },

        props: {
          employee: {
            required: true,
          }
        },

        data () {
          return {
            datacollection: null,
            labels: [],
            title: '',
            data: [],

            options: {
              scale: {
                  ticks: {
                    beginAtZero: true,
                    max: 5,
                    min: 0,
                  }
              }
            }
          }
        },

        mounted () {
          this.computeData();
          this.fillData();
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

            let entries = Object.entries(this.employee.rating);

            this.labels = [];
            this.data = [];

            entries.map(item => {
              if (this.labels.length < 5) {
                this.labels.push(this.titleCase(item[0]));
                this.data.push(item[1]);
              }
            });

          },

          fillData () {
            this.datacollection = {
              labels: this.labels,
              datasets: [
                {
                    label: 'Rating',
                    backgroundColor: 'rgba(56, 178, 172, 0.7)',
                    borderColor: '#38b2ac',
                    pointBackgroundColor: '#38b2ac',
                    data: this.data,
                },
              ]
            }
          },

          titleCase(str) {
            str = str.toLowerCase().split(' ');
            for (var i = 0; i < str.length; i++) {
              str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1); 
            }
            return str.join(' ');
          }
        }
    }

</script>