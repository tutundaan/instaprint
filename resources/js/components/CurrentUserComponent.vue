<template>
    <div class="row">
        <div class="col-3">
            <img :src="currentUser.avatar" :alt="currentUser.name" class="rounded-circle w-12 mx-auto">
        </div>
        <div class="col-9">
            <p class="text-xl my-auto">{{ currentUser.name }}</p>
            <small>{{ currentUser.phone }}</small>
            <a href="#" data-toggle="modal" data-target="#logout" class="btn btn-sm mx-1 float-right btn-danger">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <a href="/auth/employee" class="btn btn-sm mx-1 float-right btn-success">
                <i class="fas fa-cogs"></i>
            </a>

            <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logout" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="logout">Yakin Keluar Aplikasi ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="logout-form" action="/logout" method="POST">
                        <input type="hidden" name="_token" :value="xcsrf">
                        <button type="button" class="btn btn-success btn-block" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger btn-block">Ya</button>
                    </form>
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
            user: {
                required: true,
            }
        },

        data() {
            return {
                currentUser: JSON.parse(this.user),
                xcsrf: xcsrf,
            }
        }

    }

</script>