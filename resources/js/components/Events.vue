<template>
    <div>
        <h5 class="font-weight-bolder text-uppercase">{{ period }}</h5>
        <hr>
        <ul class="list-group list-group-flush">
            <li class="list-group-item" :class="event.name.length > 0 ? 'bg-event' : ''" v-for="(event, index) in events" :key="index">
                {{ event.date }} {{ event.day }}
                <ol>
                    <li class="" v-for="(name, index) in event.name">{{ name }}</li>
                </ol>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'CreateEvent',
    data() {
        return {
            events: [],
            period: ''
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
        }
    }
}
</script>

<style>
    .bg-event {
        background: #0fe86938;
    }
</style>
