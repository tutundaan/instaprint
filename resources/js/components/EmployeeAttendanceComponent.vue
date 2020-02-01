<template>
    <div class="row justify-content-center">
      <div class="col-12 mb-4">
        <div class="row">
          <div class="col-3">
            <div class="card">
              <div class="card-body">
                Ketelambatan : <strong>{{ lateDuration }} Menit</strong>
              </div>
            </div>
          </div>

          <div class="col-3">
            <div class="card">
              <div class="card-body">
                Lembur : <strong>{{ overtimeDuration }} Menit</strong>
              </div>
            </div>
          </div>

          <div class="col-6">
            <div class="card">
              <div class="card-body">
                Jumlah Kehadiran Tercatat : <strong>{{ employee.attendances.length }} Record</strong>
                <a v-if="employee.attendances.length != 0" href="#" data-toggle="modal" data-target="#showAttendance" class="btn btn-sm float-right btn-primary">Detail</a>
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
              <attendance-chart
                :options="options"
                :chart-data="datacollection"></attendance-chart>
            </div>
          </div>
      </div>

      <div class="modal fade" id="showAttendance" tabindex="-1" role="dialog" aria-labelledby="showAttendanceLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="showAttendanceLabel">Detail Kehadiran</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card my-2" v-for="attendance in employee.attendances">
                <div class="card-body">
                  <dl class="row">
                    <dt class="col-6">Tanggal</dt>
                    <dd class="col-6">{{ attendance.date }}</dd>
                    <dt class="col-6">Jam</dt>
                    <dd class="col-6">{{ attendance.jam }}</dd>
                    <dt class="col-6">Keterangan</dt>
                    <dd class="col-6">{{ attendance.type_label   }}</dd>
                    <dt v-if="attendance.additional_type !== 0"
                      class="col-6">{{ attendance.additional_type === 1 ? 'Keterlambatan' : 'Overtime' }}</dt>
                    <dd class="col-6" v-if="attendance.additional_type !== 0">{{ attendance.additional_minutes }} Menit</dd>
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

    import AttendanceChart from './AttendanceChart'
    import Datepicker from 'vuejs-datepicker';

    export default {

        components: {
            AttendanceChart,
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

            attendance: 0,
            overtime: 0,
            overtimeDuration: 0,
            late: 0,
            lateDuration: 0,
            currentDate: null,

            start: null,
            end: null,

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
            this.attendance = 0;
            this.overtime = 0;
            this.overtimeDuration = 0;
            this.late = 0;
            this.lateDuration = 0;
            this.currentDate = null;

            this.employee.attendances.map(data => {

              if (data.date != this.currentDate) {
                this.attendance += 1;
                this.currentDate = data.date;
                if (!this.start) {
                  this.start = data.date;
                }

                this.end = data.date;
              }

              if (data.additional_type === 1) {
                this.late += 1;
                this.lateDuration += data.additional_minutes;
              }

              if (data.additional_type === 2) {
                this.overtime += 1;
                this.overtimeDuration += data.additional_minutes;
              }

            });

            let attendancePercent = (this.attendance / this.attendance) * 100;
            let overtimePercent = (this.overtime / this.attendance) * 100;
            let latePercent = (this.late / this.attendance) * 100;

            this.attendance = attendancePercent;
            this.overtime = overtimePercent;
            this.late = latePercent;
          },

          fillData () {
            this.datacollection = {
              labels: [
                'Kehadiran (%)',
                'Keterlambatan (%)',
                'Overtime (%)',
              ],
              datasets: [
                {
                    label: 'Perbandingan Kehadiran',
                    backgroundColor: [
                      '#48bb78',
                      '#f56565',
                      '#3182ce',
                    ],
                    data: [
                      this.attendance,
                      this.late,
                      this.overtime,
                    ],
                },
              ]
            }
          },
          fetchingData() {
            axios.post(this.employee.attendance_range_link, {
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