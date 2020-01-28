<template>
    <div class="row">
        <div class="col-3">
            <img :src="currentUser.avatar" :alt="currentUser.name" class="rounded-circle w-12 mx-auto">
        </div>
        <div class="col-9">
            <p class="text-2xl my-auto">{{ currentUser.name }}</p>
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
            }
        }

    }

</script>