<template>
    <div>
        <button type="button" class="btn btn-link text-dark btn-sm float-right" data-toggle="modal" data-target="#showRecomendationAlert">
            <i class="h1 float-right fas fa-bell"></i>
            <span class="badge badge-success">1</span>
        </button>

        <div class="modal fade" id="showRecomendationAlert" tabindex="-1" role="dialog" aria-labelledby="showRecomendationAlertLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="showRecomendationAlertLabel">Notifikasi Rekomendasi Promosi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
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
            }
        }

    }

</script>