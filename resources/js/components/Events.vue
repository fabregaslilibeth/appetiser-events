<template>
    <div class="container-fluid bg-light m-4 p-4 mx-auto col-12 col-md-11 rounded">

             <flash v-show="message" :message="message" class="flash"></flash>

        <h4 class="font-weight-bolder text-uppercase">Calendar</h4>
        <hr>
        <div class="row">
            <div class="col-12 col-md-5 position-relative">
                <create-event @eventAdded="refresh"></create-event>
            </div>

            <div class="col-12 col-md-7">
                <div>
                    <h3 class="font-weight-bolder text-uppercase mt-4 mt-md-0">{{ period }}</h3>
                    <hr>
                    <ul class="list-group list-group-flush bg-transparent">
                        <li class="list-group-item" :class="event.name.length > 0 ? 'bg-event' : 'bg-transparent'" v-for="(event, index) in events" :key="index">
                            {{ event.date }} {{ event.day }} <span class="ml-3">{{ event.name }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'Events',
    data() {
        return {
            events: [],
            period: '',
            message: ''
        }
    },
    mounted() {
        this.getEvents()
    },
    methods: {
        getEvents () {
            axios.get('/events')
            .then(({data}) => {
                this.events = data.events
                this.period = data.period

            })
        },
        refresh() {
            this.getEvents()
        },
    }
}
</script>

<style>
    .bg-event {
        background: #0fe86938;
    }

    .flash {
        background: #0ba84bb3;;
        position: absolute;
        top: -20px;
        right: 50px;
    }
</style>
