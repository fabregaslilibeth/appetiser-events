<template>
    <div class="container">
        <div class="row justify-content-center">
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="eventName">Event</label>
                    <input v-model="event.name" type="text" class="form-control" id="eventName" placeholder="Event Name">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dateFrom">Date from</label>
                        <input v-model="event.dateFrom" type="date" class="form-control" id="dateFrom">
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="dateTo">Date To</label>
                        <input v-model="event.dateTo" type="date" class="form-control" id="dateTo">
                    </div>
                </div>
             <div>
                 <div class="form-check form-check-inline">
                     <input v-model="event.monday" type="checkbox" class="form-check-input" id="monday">
                     <label class="form-check-label" for="monday">M</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input v-model="event.tuesday" type="checkbox" class="form-check-input" id="tuesday">
                     <label class="form-check-label" for="tuesday">Tu</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input v-model="event.wednesday" type="checkbox" class="form-check-input" id="wednesday">
                     <label class="form-check-label" for="wednesday">W</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input v-model="event.thursday" type="checkbox" class="form-check-input" id="thursday">
                     <label class="form-check-label" for="thursday">Th</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input v-model="event.friday" type="checkbox" class="form-check-input" id="friday">
                     <label class="form-check-label" for="friday">F</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input v-model="event.saturday" type="checkbox" class="form-check-input" id="saturday">
                     <label class="form-check-label" for="saturday">Sa</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input v-model="event.sunday" type="checkbox" class="form-check-input" id="sunday">
                     <label class="form-check-label" for="sunday">Su</label>
                 </div>
             </div>
             <button type="submit" class="btn btn-primary mt-4">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CreateEvent',
        data() {
            return {
                event: {
                    name: '',
                    dateFrom: '',
                    dateTo: '',
                    monday: '',
                    tuesday: '',
                    wednesday: '',
                    thursday: '',
                    friday: '',
                    saturday: '',
                    sunday: ''
                }
            }
        },
        methods: {
            submit () {
                axios.post('events', this.event)
                .then(({data}) => {
                    console.log(data)
                })
            }
        }

    }
</script>
