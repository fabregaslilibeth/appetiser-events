<template>
   <transition name="fade">
       <div class="mx-auto p-4 flex justify-center mb-4 rounded" v-show="show">
           <div class="w-auto font-weight-bolder items-center text-center text-white">
               <i class="fas fa-check text-white"></i> {{ body }}
           </div>
       </div>
   </transition>
</template>

<script>
export default {
    name: 'Flash',
    props: ['message'],
    data () {
        return {
            body: this.message,
            show: false
        }
    },
    created() {
        if (this.message) {
            this.flash()
        }

        window.events.$on('flash', data => {
            this.flash(data)
        })
    },
    methods: {
        flash (data) {
            if (data) {
                this.body = data.message
            }

            this.show = true

            this.hide()
        },
        hide () {
            setTimeout(() => {
                this.show = false
            },  3000);
        }
    }
}
</script>


<style lang="scss">
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
</style>
